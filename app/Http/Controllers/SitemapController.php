<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use App\Models\Info;
use App\Models\Tag;
use App\Models\Longtail;
use App\Models\Website;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Website $website, Article $artikel)
    {
        // Ambil tag untuk keyword
        $getTags = $artikel->tags;
        $ambilTags = array();
        foreach ($getTags as $tag) {
            $ambilTags[] = $tag->name;
        }
        $showTags = implode(',', $ambilTags);

        // Ambil longtail untuk keyword
        $getLontails = $artikel->longtails;
        $ambilLongtails = array();
        foreach ($getLontails as $longtail) {
            $ambilLongtails[] = $longtail->name;
        }
        $showLongtails = implode(',', $ambilLongtails);

        $artikel = Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->get();

        return response()->view('sitemap', [
            'artikels' => $artikel,
            'keywords' => $showTags . ',' . $showLongtails,
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'longtails' => Longtail::all(),
            'infos' => Info::all(),
            'images' => Image::all(),
            'websites' => $website->first()->description,
            'webcreated' => $website->first()->created_at,
            'webtitle' => $website->first()->name,
            'icon' => $website->first()->icon
        ])->header('Content-Type', 'text/xml');
    }
}
