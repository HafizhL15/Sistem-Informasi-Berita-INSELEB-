<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Longtail;
use App\Models\User;
use App\Models\Article;
use App\Models\Website;
use App\Models\Category;
use Path\To\DOMDocument;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DapurArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {

        return view('dapur.artikel.index', [
            'artikels' => Article::with(['tags'])->where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->fastPaginate(10)->withQueryString(),
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

        // Artikel berdasar user login
        // return Article::where('user_id', auth()->user()->id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Website $website)
    {
        return view('dapur.artikel.create', [
            'categories' => Category::all(),
            'users' => User::all(),
            'editors' => User::where([['role_id', 1]])->orWhere([['role_id', 2]])->orWhere([['role_id', 3]])->get(),
            'artikel' => Article::all(),
            'tags' => Tag::all(),
            'longtails' => Longtail::all(),
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
    public function store(Request $request, Article $artikel)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:110',
            'slug' => 'required|unique:articles',
            'description' => 'required|max:170',
            'category_id' => 'required',
            'body' => 'required',
            'published_at' => 'required',
            'tags' => 'required',
            'longtails' => 'required',
            'user_id' => 'required',
            'author_id' => 'required',
            'sumber' => 'nullable',
            'headline' => 'nullable',
            'pilihan' => 'nullable',
            'rekomendasi' => 'nullable',
            'status' => 'nullable',
            // 'image' => 'required|image|file|max:200',
            'image' => 'required',
            'caption' => 'required',
            'credit' => 'required'
        ]);

        //img summernote
        $storage = 'storage/gambar-upload';
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

        // $fileNameContent = uniqid();
        // $fileName = substr(md5($fileNameContent), 7, 7) . '-' . time() . '.' . $request->image->extension();
        // if ($request->file('image')) {
        //     $validatedData['image'] = $request->file('image')->storeAs('gambar-upload', $fileName);
        // }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 170);
        $validatedData['body'] = $dom->saveHTML();

        $validatedData['published_at'] = str_replace('', 'T', $request->published_at);

        // dd($request->all());

        $artikel = Article::create($validatedData);

        // Handle Tags Function
        $this->handleTags($request, $artikel);

        // Handle Longtails Function
        $this->handleLongtails($request, $artikel);

        return redirect('/dapur-imajinasi/ruangredaksi/artikel')->with('success', 'Artikel baru berhasil dibuat. Jika status belum terpublish, Cek di menu Konsep');
    }

    public function handleTags(Request $request, Article $artikel)
    {
        /**
         * Setelah artikel di simpan, fungsi handle tags menjalankan logic
         * Mengambil tag dari field input, lalu relasikan dengan artikel
         */
        $isiTags = $request->input('tags');

        // Buat tag baru kedalam tabel tags
        foreach ($isiTags as $namaTag) {
            Tag::firstOrCreate(['name' => $namaTag, 'slug' => Str::slug($namaTag)])->save();
        }

        // Setelah tag dibuat, jalankan kueri untuk relasi tag dengan artikel
        $tags = Tag::whereIn('name', $isiTags)->pluck('id');
        $artikel->tags()->attach($tags);
    }

    public function handleLongtails(Request $request, Article $artikel)
    {
        /**
         * Setelah artikel di simpan, fungsi handle longtails menjalankan logic
         * Mengambil longtail dari field input, lalu relasikan dengan artikel
         */
        $isiLongtails = $request->input('longtails');

        // Buat longtail baru kedalam tabel tags
        foreach ($isiLongtails as $namaLongtail) {
            Longtail::firstOrCreate(['name' => $namaLongtail, 'slug' => Str::slug($namaLongtail)])->save();
        }

        // Setelah longtail dibuat, jalankan kueri untuk relasi tag dengan artikel
        $longtails = Longtail::whereIn('name', $isiLongtails)->pluck('id');
        $artikel->longtails()->attach($longtails);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $artikel, Website $website)
    {
        return view('dapur.artikel.show', [
            'artikel' => $artikel,
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $artikel, Website $website)
    {
        return view('dapur.artikel.edit', [
            'categories' => Category::all(),
            'users' => User::all(),
            'editors' => User::where([['role_id', 1]])->orWhere([['role_id', 2]])->orWhere([['role_id', 3]])->get(),
            'artikel' => $artikel,
            'tags' => Tag::all(),
            'longtails' => Longtail::all(),
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
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $artikel)
    {
        // if ($request->hasFile('image')) {
        //     $fileCheck = 'required|image|file|max:200';
        // } else {
        //     $fileCheck = 'image|file|max:200';
        // }
        $rules = [
            'title' => 'required|max:110',
            'description' => 'required|max:170',
            'category_id' => 'required',
            'body' => 'required',
            'published_at' => 'required',
            'tags' => 'required',
            'longtails' => 'required',
            'user_id' => 'required',
            'author_id' => 'required',
            'sumber' => 'nullable',
            'headline' => 'nullable',
            'pilihan' => 'nullable',
            'rekomendasi' => 'nullable',
            'status' => 'nullable',
            // 'image' => $fileCheck,
            'image' => 'required',
            'caption' => 'required',
            'credit' => 'required'
        ];

        if ($request->slug != $artikel->slug) {
            $rules['slug'] = 'required|unique:articles';
        }

        $validatedData = $request->validate($rules);

        $storage = 'storage/gambar-upload';
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

        // if ($request->file('image')) {
        //     if ($request->oldImage) {
        //         Storage::delete($request->oldImage);
        //     }
        //     $fileNameContent = uniqid();
        //     $fileName = substr(md5($fileNameContent), 7, 7) . '-' . time() . '.' . $request->image->extension();
        //     $validatedData['image'] = $request->file('image')->storeAs('gambar-upload', $fileName);
        // }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 170);
        $validatedData['body'] = $dom->saveHTML();
        $validatedData['published_at'] = str_replace('', 'T', $request->published_at);

        // dd($request->all());

        $artikel->update($validatedData);

        // Handle Tags Function
        $this->handleTagsOnUpdate($request, $artikel);

        // Handle Longtails Function
        $this->handleLongtailsOnUpdate($request, $artikel);

        return redirect('/dapur-imajinasi/ruangredaksi/artikel')->with('success', 'Artikel berhasil diedit!');
    }

    public function handleTagsOnUpdate(Request $request, Article $artikel)
    {
        /**
         * Setelah artikel di simpan, fungsi handle tags menjalankan logic
         * Mengambil tag dari field input, lalu relasikan dengan artikel
         */
        $isiTags = $request->input('tags');

        // Update tag baru kedalam tabel tags
        foreach ($isiTags as $namaTag) {
            Tag::firstOrCreate(['name' => $namaTag, 'slug' => Str::slug($namaTag)])->save();
        }

        // Setelah tag update, jalankan kueri untuk relasi tag dengan artikel
        $tags = Tag::whereIn('name', $isiTags)->pluck('id');
        $artikel->tags()->sync($tags);
    }

    public function handleLongtailsOnUpdate(Request $request, Article $artikel)
    {
        /**
         * Setelah artikel di simpan, fungsi handle longtails menjalankan logic
         * Mengambil longtail dari field input, lalu relasikan dengan artikel
         */
        $isiLongtails = $request->input('longtails');

        // Buat longtail baru kedalam tabel tags
        foreach ($isiLongtails as $namaLongtail) {
            Longtail::updateOrCreate(['name' => $namaLongtail, 'slug' => Str::slug($namaLongtail)])->save();
        }

        // Setelah longtail dibuat, jalankan kueri untuk relasi tag dengan artikel
        $longtails = Longtail::whereIn('name', $isiLongtails)->pluck('id');
        $artikel->longtails()->sync($longtails);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $artikel, User $user)
    {
        // if ($artikel->image) {
        //     Storage::delete($artikel->image);
        // }

        Article::destroy($artikel->id);
        return redirect('/dapur-imajinasi/ruangredaksi/artikel')->with('success', 'Artikel berhasil dihapus!');
    }

    public function cekSlug(Request $request)
    {
        $slug = SlugService::createSlug(Article::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }


    public function trash(Website $website)
    {
        return view('dapur.artikel.trash', [
            'artikels' => Article::onlyTrashed()->orderBy('published_at', 'desc')->fastPaginate(10)->withQueryString(),
            'websites' => Website::latest()->take(1)->get(),
            'website' => $website,
            'icon' => $website->first()->icon,
            'name' => $website->first()->name,
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
            Article::onlyTrashed()->where('id', $id)->restore();
        } else {
            Article::onlyTrashed()->restore();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/artikel/trash')->with('success', 'Artikel berhasil direstore. Cek di menu Konsep untuk artikel dengan status belum terpublish');
    }

    public function delete($id = null)
    {
        if ($id != null) {
            Article::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Article::onlyTrashed()->forceDelete();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/artikel/trash')->with('success', 'Artikel berhasil dihapus permanen!');
    }


    public function listGambar()
    {
        $files = array_filter(glob('assets/storage/gambar-upload/*'), 'is_file');
        $response = [];
        foreach ($files as $file)
            if (strpos($file, 'index.html')) {
                continue;
            }
        $response[] = basename($file);
        header('Content-Type:application/json');
        echo json_encode($response);
        die();
    }
}
