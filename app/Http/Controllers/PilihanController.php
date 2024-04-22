<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Website;
use App\Models\Ads;
use App\Models\Image;
use App\Models\Positionads;
use App\Models\Tag;
use App\Models\Longtail;
use Illuminate\Pagination\LengthAwarePaginator;
use LengthException;
use CyrildeWit\EloquentViewable\Support\Period;

class PilihanController extends Controller
{
    public function index(Website $website, Image $image)
    {
        return view('pilihaneditor', [
            // "home" => Article::all(),
            'title' => 'Berita Terbaru Hari Ini - ' . $website->first()->domain,
            'sidebar' => Article::orderBy('published_at', 'desc')->take(5)->get(),
            'artikels' => Article::where([['pilihan', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->fastPaginate(10)->withQueryString(),
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
