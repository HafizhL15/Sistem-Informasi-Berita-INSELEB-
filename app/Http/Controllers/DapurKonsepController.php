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

class DapurKonsepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {

        return view('dapur.konsep.index', [
            'artikels' => Article::with(['tags'])->where('status', 0)->where('published_at', '<', now())->orderBy('published_at', 'desc')->fastPaginate(10)->withQueryString(),
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
        return view('dapur.konsep.create', [
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
    public function store(Request $request, Article $konsep)
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

        // $fileName = time() . '.' . $request->image->extension();
        // if ($request->file('image')) {
        //     $validatedData['image'] = $request->file('image')->storeAs('gambar-upload', $fileName);
        // }

        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 170);
        $validatedData['body'] = $dom->saveHTML();

        $validatedData['published_at'] = str_replace('', 'T', $request->published_at);

        // dd($request->all());

        $konsep = Article::create($validatedData);

        // Handle Tags Function
        $this->handleTags($request, $konsep);

        // Handle Longtails Function
        $this->handleLongtails($request, $konsep);

        return redirect('/dapur-imajinasi/ruangredaksi/konsep')->with('success', 'Artikel berhasil ditambahkan. Jika status belum terpublish, Cek di menu Konsep');
    }

    public function handleTags(Request $request, Article $konsep)
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
        $konsep->tags()->attach($tags);
    }

    public function handleLongtails(Request $request, Article $konsep)
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
        $konsep->longtails()->attach($longtails);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $konsep, Website $website)
    {
        return view('dapur.konsep.show', [
            'artikel' => $konsep,
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
    public function edit(Article $konsep, Website $website)
    {
        return view('dapur.konsep.edit', [
            'categories' => Category::all(),
            'users' => User::all(),
            'editors' => User::where([['role_id', 1]])->orWhere([['role_id', 2]])->orWhere([['role_id', 3]])->get(),
            'artikel' => $konsep,
            'tags' => Tag::all(),
            'longtails' => Longtail::all(),
            'websites' => Website::all(),
            'website' => $website,
            'icon' => $website->first()->icon,
            'title' => 'Dashboard Admin - ' . $website->first()->domain,
            'domain' => $website->first()->domain,
            'name' => $website->first()->name,
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
    public function update(Request $request, Article $konsep)
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

        if ($request->slug != $konsep->slug) {
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

        $konsep->update($validatedData);

        // Handle Tags Function
        $this->handleTagsOnUpdate($request, $konsep);

        // Handle Longtails Function
        $this->handleLongtailsOnUpdate($request, $konsep);

        return redirect('/dapur-imajinasi/ruangredaksi/konsep')->with('success', 'Artikel berhasil diedit!');
    }

    public function handleTagsOnUpdate(Request $request, Article $konsep)
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
        $konsep->tags()->sync($tags);
    }

    public function handleLongtailsOnUpdate(Request $request, Article $konsep)
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
        $konsep->longtails()->sync($longtails);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $konsep)
    {
        // if ($konsep->image) {
        //     Storage::delete($konsep->image);
        // }

        Article::destroy($konsep->id);
        return redirect('/dapur-imajinasi/ruangredaksi/konsep')->with('success', 'Artikel berhasil dihapus!');
    }

    public function konsepSlug(Request $request)
    {
        $slug = SlugService::createSlug(Article::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
