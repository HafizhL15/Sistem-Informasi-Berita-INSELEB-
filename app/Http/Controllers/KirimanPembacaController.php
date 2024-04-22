<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Website;
use App\Models\Category;
use Path\To\DOMDocument;
use Illuminate\Http\Request;
use App\Models\ArtikelPembaca;
use App\Models\KirimanPembaca;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class KirimanPembacaController extends Controller
{
    public function index(Website $website)
    {
        return view('kirim-artikel', [
            'title' => 'Kirim Artikel ke ' . $website->first()->domain,
            'icon' => $website->first()->icon,
            'logo' => $website->first()->image,
            'categories' => Category::all(), 
            'description' => $website->first()->description,
            'website' => Website::latest()->take(1)->get(),
            'name' => $website->first()->name,
            'domain' => $website->first()->domain,
            'keywords' => $website->first()->meta_keyword,
            'ads' => Ads::where('status', 1)->latest()->get(),
            'meta_header' => $website->first()->meta_header,
            'meta_footer' => $website->first()->meta_footer,
            'facebook' => $website->first()->facebook,
            'twitter' => $website->first()->twitter,
            'instagram' => $website->first()->instagram,
            'youtube' => $website->first()->youtube,
            'tiktok' => $website->first()->tiktok
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:110',
            'description' => 'required|max:170',
            'body' => 'required',
            'sumber' => 'nullable',
            'image' => 'required|image|file|max:200',
            'namapengirim' => 'required'
        ]);

        //img summernote
        $storage = 'storage/gambar-kirimanpembaca';
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();

        $image = $dom->getElementsByTagName('img');

        foreach ($image as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 7, 7) . '-' . time();
                $filepath = ("$storage/$fileNameContentRand.$mimetype");
                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-fluid');
            }
        }

        $fileNameContent = uniqid();
        $fileName = substr(md5($fileNameContent), 7, 7) . '-' . time() . '.' . $request->image->extension();
        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->storeAs('gambar-kirimanpembaca', $fileName);
        }

        $validatedData['body'] = $dom->saveHTML();

        ArtikelPembaca::create($validatedData);

        return redirect('/kirim-artikel')->with('success', 'Artikel/Opini telah dikirim. Jika disetujui oleh tim redaksi, artikel/opini akan segera kami terbitkan. Terimakasih!');

        // if ($request->file('image')) {
        //     $validatedData['image'] = $request->file('image')->store('gambar-penulis');
        // }
    }
}
