<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DapurWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        return view('dapur.website.index', [
            'websites' => Website::latest()->take(1)->get(),
            'website' => $website,
            'icon' => $website->first()->icon,
            'title' => 'Dashboard Admin - ' . $website->first()->domain,
            'domain' => $website->first()->domain,
            'name' => $website->first()->name,
            'description' => $website->first()->description,
            'keywords' => $website->first()->domain . $website->first()->description,
            'rolenavbar' => auth()->user()->roleadmin->role,
            'meta_header' => $website->first()->meta_header,
            'meta_footer' => $website->first()->meta_footer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function show(Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function edit(Website $website)
    {
        return view('dapur.website.edit', [
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
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Website $website)
    {
        $rules = [
            'name' => 'required|max:30',
            'domain' => 'required|max:30',
            'slogan' => 'required|max:170',
            'description' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable',
            'image' => 'image|file|max:200',
            'icon' => 'image|file|max:200',
            'facebook' => 'nullable',
            'twitter' => 'nullable',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
            'tiktok' => 'nullable',
            'meta_header' => 'nullable',
            'meta_footer' => 'nullable',
        ];

        if ($request->slug != $website->slug) {
            $rules['slug'] = 'required|unique:websites';
        }

        $validatedData = $request->validate($rules);

        // Delete old image when post edit image
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('gambar-situs');
        }

        if ($request->file('icon')) {
            if ($request->oldIcon) {
                Storage::delete($request->oldIcon);
            }
            $validatedData['icon'] = $request->file('icon')->store('gambar-icon');
        }

        // $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 130);

        Website::where('id', $website->id)
            ->update($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/website')->with('success', 'Situs berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy(Website $website)
    {
        //
    }

    public function webSlug(Request $request)
    {
        $slug = SlugService::createSlug(Website::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
