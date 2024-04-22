<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Article;
use App\Models\Website;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use CyrildeWit\EloquentViewable\Support\Period;

class CategoryController extends Controller
{
    // public function DaftarKategori()
    // {
    //     //Tampil Data
    //     $datas['categories'] = Category::all();
    //     return view('partials.navbar', $datas);
    // }

    public function index(Category $kategori, Website $website)
    {
        // $categories = Category::all();
        // dd($categories->toArray());

        return view('kategori', [
            'title' => 'Berita Terbaru Hari Ini - ' . $kategori->name,
            'artikel_kategori' => $kategori->articles,
            'kategori' => Category::all(),
            'sidebar' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'headline' => Article::where([['headline', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'pilihan' => Article::where([['pilihan', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(3)->get(),
            'rekomendasi' => Article::where([['rekomendasi', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'icon' => $website->first()->icon,
            'website' => Website::latest()->take(1)->get(),
            'name' => $website->first()->name,
            'domain' => $website->first()->domain,
            'ads' => Ads::where('status', 1)->latest()->get(),
            'populer' => Article::where('status', 1)->where('published_at', '<', now())->orderByViews('desc', Period::pastDays(1))->limit('5')->get(),
            'keywords' => $kategori->name . ',' . $website->first()->name . ',' . $website->first()->description,
            'meta_header' => $website->first()->meta_header,
            'meta_footer' => $website->first()->meta_footer,
            'facebook' => $website->first()->facebook,
            'twitter' => $website->first()->twitter,
            'instagram' => $website->first()->instagram,
            'youtube' => $website->first()->youtube,
            'tiktok' => $website->first()->tiktok
        ]);
    }

    public function artikelKategori($slug, Category $kategori, Website $website)
    {
        return view('kategori', [
            'title' => 'Berita Terbaru Hari Ini di Rubrik ' . $kategori->name . ' - ' . $website->first()->domain,
            'judul' => 'KATEGORI - ' . $kategori->name,
            'artikel_kategori' => $kategori->artikel()->where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->fastPaginate(15)->withQueryString(),
            'sidebar' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'description' => $kategori->description,
            'keywords' => $kategori->name . ',' . $website->first()->name . ',' . $website->first()->meta_keyword,
            'kategori' => Article::where('status', 1)->orderBy('published_at', 'desc')->get(),
            'artikel' => Article::find($slug),
            'headline' => Article::where([['headline', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'pilihan' => Article::where([['pilihan', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(3)->get(),
            'rekomendasi' => Article::where([['rekomendasi', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'populer' => Article::where('status', 1)->where('published_at', '<', now())->orderByViews('desc', Period::pastDays(1))->limit('5')->get(),
            'icon' => $website->first()->icon,
            'logo' => $website->first()->image,
            'website' => Website::latest()->take(1)->get(),
            'name' => $website->first()->name,
            'domain' => $website->first()->domain,
            'categories' => Category::all(),
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
}
