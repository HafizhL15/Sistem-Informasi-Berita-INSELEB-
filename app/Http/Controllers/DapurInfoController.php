<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Website;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DapurInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        return view('dapur.info.index', [
            'infos' => Info::orderBy('id', 'ASC')->fastPaginate(10)->withQueryString(),
            'websites' => Website::all(),
            'website' => $website,
            'name' => $website->first()->name,
            'icon' => $website->first()->icon,
            'title' => 'Dashboard Admin - ' . $website->first()->domain,
            'domain' => $website->first()->domain,
            'description' => $website->first()->description,
            'keywords' => $website->first()->domain . $website->first()->description,
            'rolenavbar' => auth()->user()->roleadmin->role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Website $website)
    {
        return view('dapur.info.create', [
            'infos' => Info::all(),
            'websites' => Website::all(),
            'website' => $website,
            'name' => $website->first()->name,
            'icon' => $website->first()->icon,
            'title' => 'Dashboard Admin - ' . $website->first()->domain,
            'domain' => $website->first()->domain,
            'description' => $website->first()->description,
            'keywords' => $website->first()->domain . $website->first()->description,
            'rolenavbar' => auth()->user()->roleadmin->role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:110',
            'slug' => 'required|unique:infos',
            'description' => 'required|max:170',
            'body' => 'required',
            'image' => 'image|file|max:200'
        ]);

        //img summernote
        $storage = 'storage/gambar-info';
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
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
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

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('gambar-info');
        }

        $validatedData['body'] = $dom->saveHTML();
        // $validatedData['image'] = $fileName;

        Info::create($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/info')->with('success', 'Info baru berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function show(Info $info)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function edit(Info $info, Website $website)
    {
        return view('dapur.info.edit', [
            'infos' => Info::all(),
            'info' => $info,
            'websites' => Website::all(),
            'website' => $website,
            'name' => $website->first()->name,
            'icon' => $website->first()->icon,
            'title' => 'Dashboard Admin - ' . $website->first()->domain,
            'domain' => $website->first()->domain,
            'description' => $website->first()->description,
            'keywords' => $website->first()->domain . $website->first()->description,
            'rolenavbar' => auth()->user()->roleadmin->role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Info $info)
    {
        $rules = [
            'title' => 'required|max:110',
            'description' => 'required|max:170',
            'body' => 'required',
            'image' => 'image|file|max:200'
        ];

        if ($request->slug != $info->slug) {
            $rules['slug'] = 'required|unique:infos';
        }

        $validatedData = $request->validate($rules);

        $storage = 'storage/gambar-info';
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
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
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

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('gambar-info');
        }

        $validatedData['body'] = $dom->saveHTML();

        Info::where('id', $info->id)->update($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/info')->with('success', 'Info berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Info  $info
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {
        if ($info->image) {
            Storage::delete($info->image);
        }

        Info::destroy($info->id);
        return redirect('/dapur-imajinasi/ruangredaksi/info')->with('success', 'Info berhasil dihapus!');
    }

    public function trash(Website $website)
    {
        return view('dapur.info.trash', [
            'infos' => Info::onlyTrashed()->latest()->fastPaginate(10)->withQueryString(),
            'websites' => Website::latest()->take(1)->get(),
            'website' => $website,
            'name' => $website->first()->name,
            'icon' => $website->first()->icon,
            'title' => 'Dashboard Admin - ' . $website->first()->domain,
            'domain' => $website->first()->domain,
            'description' => $website->first()->description,
            'keywords' => $website->first()->domain . $website->first()->description,
            'rolenavbar' => auth()->user()->roleadmin->role
        ]);
    }

    public function restore($id = null)
    {
        if ($id != null) {
            Info::onlyTrashed()->where('id', $id)->restore();
        } else {
            Info::onlyTrashed()->restore();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/info/trash')->with('success', 'Info berhasil direstore!');
    }

    public function delete($id = null)
    {
        if ($id != null) {
            Info::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Info::onlyTrashed()->forceDelete();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/info/trash')->with('success', 'Info berhasil dihapus permanen!');
    }

    public function infoSlug(Request $request)
    {
        $slug = SlugService::createSlug(Info::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
