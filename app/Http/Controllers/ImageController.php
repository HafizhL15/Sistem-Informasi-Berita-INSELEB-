<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Article;
use App\Models\Website;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Routing\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use CyrildeWit\EloquentViewable\Support\Period;

class ImageController extends Controller
{
    public function tampilGambar($slug, Image $gambar, Website $website)
    {
        return view('gambar', [
            'title' => $gambar->name . ' - ' . $website->first()->domain,
            'gambar' => Image::find($slug),
            'description' => $gambar->caption,
            'keywords' => $gambar->name . ',' . $website->first()->domain,
            'sidebar' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'categories' => Category::all(),
            'headline' => Article::where([['headline', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'pilihan' => Article::where([['pilihan', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(3)->get(),
            'rekomendasi' => Article::where([['rekomendasi', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            // 'populer' => Article::where('status', 1)->orderBy('views', 'desc')->where('published_at', '<', now())->limit('5')->get(),
            'populer' => Article::where('status', 1)->where('published_at', '<', now())->orderByViews('desc', Period::pastDays(1))->limit('5')->get(),
            'icon' => $website->first()->icon,
            'logo' => $website->first()->image,
            'website' => Website::latest()->take(1)->get(),
            'name' => $website->first()->name,
            'domain' => $website->first()->domain,
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

    public function listGambar(Website $website)
    {
        return view('list-foto', [
            'title' => 'Berita Foto Terbaru Hari Ini - ' . $website->first()->domain,
            'sidebar' => Article::orderBy('published_at', 'desc')->take(5)->get(),
            'images' => Image::latest()->fastPaginate(10)->withQueryString(),
            'icon' => $website->first()->icon,
            'logo' => $website->first()->image,
            'website' => Website::latest()->take(1)->get(),
            'name' => $website->first()->name,
            'domain' => $website->first()->domain,
            'description' => $website->first()->description,
            'keywords' => $website->first()->meta_keyword,
            'headline' => Article::where([['headline', 1], ['status', 1]])->orderBy('published_at', 'desc')->take(5)->get(),
            'pilihan' => Article::where([['pilihan', 1], ['status', 1]])->orderBy('published_at', 'desc')->take(3)->get(),
            'rekomendasi' => Article::where([['rekomendasi', 1], ['status', 1]])->orderBy('published_at', 'desc')->take(5)->get(),
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
