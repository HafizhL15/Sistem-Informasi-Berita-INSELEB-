<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Website;
use App\Models\Ads;
use App\Models\Tag;
use App\Models\Positionads;
use Illuminate\Pagination\LengthAwarePaginator;
use CyrildeWit\EloquentViewable\Support\Period;

class CariController extends Controller
{
    public function cari(Website $website, Tag $tag)
    {
        // dd(request('search'));
        $judul = '';
        if (request('search')) {
            $kata = (request('search'));
            $judul = 'Hasil Pencarian : ' . $kata;
        }

        return view('cari', [
            // "home" => Article::all(),
            'judul' => $judul,
            'title' => $website->first()->domain . ' - ' . $website->first()->slogan,
            'sidebar' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'artikels' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->filter(request(['search']))->fastPaginate(10)->withQueryString(),
            // 'artikels' => $artikel->fastPaginate(15)->withQueryString(),
            'icon' => $website->first()->icon,
            'website' => Website::latest()->take(1)->get(),
            'name' => $website->first()->name,
            'categories' => Category::all(),
            'domain' => $website->first()->domain,
            'description' => $website->first()->description,
            'keywords' => $website->first()->meta_keyword,
            'headline' => Article::where([['headline', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'pilihan' => Article::where([['pilihan', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(3)->get(),
            'rekomendasi' => Article::where([['rekomendasi', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            // 'populer' => Article::where('status', 1)->orderBy('views', 'desc')->where('published_at', '<', now())->limit('5')->get(),
            'populer' => Article::where('status', 1)->where('published_at', '<', now())->orderByViews('desc', Period::pastDays(1))->limit('5')->get(),
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
