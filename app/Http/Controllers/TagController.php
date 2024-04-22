<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Tag;
use App\Models\User;
use App\Models\Article;
use App\Models\Website;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use CyrildeWit\EloquentViewable\Support\Period;

class TagController extends Controller
{
    public function artikelTag($slug, Tag $tag, Website $website)
    {
        return view('tag', [
            'tags' => Tag::find($slug)->artikel()->where('status', 1)->with('category')->with('user')->where('published_at', '<', now())->orderBy('published_at', 'desc')->fastPaginate(15)->withQueryString(),
            'title' => 'Berita dan Informasi ' . $tag->name . ' Terbaru Hari Ini - ' . $website->first()->domain,
            'judul' => 'TAG - ' . $tag->name,
            'sidebar' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'icon' => $website->first()->icon,
            'logo' => $website->first()->image,
            'website' => Website::latest()->take(1)->get(),
            'name' => $website->first()->name,
            'domain' => $website->first()->domain,
            'description' => $website->first()->description,
            'keywords' => $tag->name . ',' . $website->first()->name . ',' . $website->first()->description,
            'headline' => Article::where([['headline', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'pilihan' => Article::where([['pilihan', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(3)->get(),
            'rekomendasi' => Article::where([['rekomendasi', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
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
