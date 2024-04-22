<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Article;
use App\Models\Website;
use App\Models\Category;
use App\Models\Info;
use Illuminate\Routing\Controller;
use CyrildeWit\EloquentViewable\Support\Period;

class InfoController extends Controller
{
    public function tampilinfo(Info $info, Website $website)
    {
        return view('info', [
            'title' => $info->title . ' - ' . $website->first()->domain,
            'info' => $info,
            'description' => $info->description,
            'keywords' => $info->title . ',' . $website->first()->domain,
            'sidebar' => Article::where('status', 1)->where('published_at', '<', now())->latest()->take(5)->get(),
            'categories' => Category::all(),
            'headline' => Article::where([['headline', 1], ['status', 1]])->where('published_at', '<', now())->latest()->take(5)->get(),
            'pilihan' => Article::where([['pilihan', 1], ['status', 1]])->where('published_at', '<', now())->latest()->take(3)->get(),
            'rekomendasi' => Article::where([['rekomendasi', 1], ['status', 1]])->where('published_at', '<', now())->latest()->take(5)->get(),
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
    
}
