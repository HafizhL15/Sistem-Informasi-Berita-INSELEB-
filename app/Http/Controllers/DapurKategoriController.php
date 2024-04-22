<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DapurKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        return view('dapur.kategori.index', [
            'categories' => Category::latest()->fastPaginate(10)->withQueryString(),
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
        return view('dapur.kategori.create', [
            'categories' => Category::all(),
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
            'name' => 'required|max:30',
            'slug' => 'required|unique:categories',
            'description' => 'required|max:170',
            'image' => 'image|file|max:200'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('gambar-kategori');
        }

        // $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 170);

        Category::create($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/kategori')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $kategori, Website $website)
    {
        return view('dapur.kategori.show', [
            'kategori' => $kategori,
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $kategori, Website $website)
    {
        return view('dapur.kategori.edit', [
            'categories' => Category::all(),
            'kategori' => $kategori,
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $kategori)
    {
        $rules = [
            'name' => 'required|max:30',
            'description' => 'required|max:170',
            'image' => 'image|file|max:200'
        ];

        if ($request->slug != $kategori->slug) {
            $rules['slug'] = 'required|unique:categories';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('gambar-kategori');
        }

        // $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 130);

        Category::where('id', $kategori->id)->update($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/kategori')->with('success', 'Kategori berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $kategori, Article $artikel)
    {
        if ($kategori->image) {
            Storage::delete($kategori->image);
        }

        Article::where('category_id', $kategori->id)->update(['category_id' => 1]);
        Category::destroy($kategori->id);
        return redirect('/dapur-imajinasi/ruangredaksi/kategori')->with('success', 'Kategori berhasil dihapus!');
    }

    public function ambilSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function trash(Website $website)
    {
        return view('dapur.kategori.trash', [
            'categories' => Category::onlyTrashed()->latest()->fastPaginate(10)->withQueryString(),
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
            Category::onlyTrashed()->where('id', $id)->restore();
        } else {
            Category::onlyTrashed()->restore();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/kategori/trash')->with('success', 'Kategori berhasil direstore!');
    }

    public function delete($id = null)
    {
        if ($id != null) {
            Category::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Category::onlyTrashed()->forceDelete();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/kategori/trash')->with('success', 'Kategori berhasil dihapus permanen!');
    }
}
