<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Models\Website;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DapurTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        return view('dapur.tag.index', [
            'tags' => Tag::latest()->fastPaginate(10)->withQueryString(),
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
        return view('dapur.tag.create', [
            'tags' => Tag::all(),
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
            'name' => 'required',
            'slug' => 'required|unique:tags',
        ]);

        Tag::create($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/tag')->with('success', 'Tag berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag, Website $website)
    {
        return view('dapur.tag.edit', [
            'tags' => Tag::all(),
            'tag' => $tag,
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
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $rules = [
            'name' => 'required',
        ];

        if ($request->slug != $tag->slug) {
            $rules['slug'] = 'required|unique:tags';
        }

        $validatedData = $request->validate($rules);

        // $validatedData['user_id'] = auth()->user()->id;

        Tag::where('id', $tag->id)->update($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/tag')->with('success', 'Tag berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag, Article $artikel)
    {
        $artikel->tags()->update(['tag_id' => 1]);
        Tag::destroy($tag->id);
        return redirect('/dapur-imajinasi/ruangredaksi/tag')->with('success', 'Tag berhasil dihapus!');
    }

    public function tagSlug(Request $request)
    {
        $slug = SlugService::createSlug(Tag::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function trash(Website $website)
    {
        return view('dapur.tag.trash', [
            'tags' => Tag::onlyTrashed()->latest()->fastPaginate(10)->withQueryString(),
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
            Tag::onlyTrashed()->where('id', $id)->restore();
        } else {
            Tag::onlyTrashed()->restore();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/tag/trash')->with('success', 'Tag berhasil direstore!');
    }

    public function delete($id = null)
    {
        if ($id != null) {
            Tag::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Tag::onlyTrashed()->forceDelete();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/tag/trash')->with('success', 'Tag berhasil dihapus permanen!');
    }
}
