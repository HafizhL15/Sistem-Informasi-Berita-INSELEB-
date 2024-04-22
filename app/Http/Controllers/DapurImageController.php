<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Website;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DapurImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        return view('dapur.image.index', [
            'images' => Image::orderBy('published_at', 'desc')->fastPaginate(5)->withQueryString(),
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Website $website)
    {
        return view('dapur.image.create', [
            'image' => Image::all(),
            'users' => User::all(),
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
            'article_id' => 'nullable',
            'user_id' => 'required',
            'name' => 'required|max:255',
            'slug' => 'required|unique:images',
            'caption' => 'required',
            'body' => 'required',
            'sumber' => 'required',
            'image' => 'required',
            // 'image' => 'required|image|file|max:200'
        ]);

        // if ($request->file('image')) {
        //     $validatedData['image'] = $request->file('image')->store('gambar-upload');
        // }

        Image::create($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/image')->with('success', 'Foto baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image, Website $website)
    {
        return view('dapur.image.edit', [
            'image' => $image,
            'users' => User::all(),
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
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        $rules = [
            'article_id' => 'nullable',
            'user_id' => 'required',
            'name' => 'required|max:255',
            'caption' => 'required',
            'body' => 'required',
            'sumber' => 'required',
            'image' => 'required',
            // 'image' => 'image|file|max:200'
        ];

        if ($request->slug != $image->slug) {
            $rules['slug'] = 'required|unique:images';
        }

        $validatedData = $request->validate($rules);

        Image::where('id', $image->id)->update($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/image')->with('success', 'Foto berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        Image::destroy($image->id);
        return redirect('/dapur-imajinasi/ruangredaksi/image')->with('success', 'Foto berhasil dihapus!');
    }

    public function imageSlug(Request $request)
    {
        $slug = SlugService::createSlug(Image::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
