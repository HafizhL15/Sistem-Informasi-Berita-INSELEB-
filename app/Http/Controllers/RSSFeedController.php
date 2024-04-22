<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Website;
use App\Models\Image;
use Illuminate\Http\Request;

class RSSFeedController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(Website $website)
    {
        $artikel = Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(30)->get();

        return response()->view('feed', [
            'artikels' => $artikel,
            'categories' => Category::all(),
            'images' => Image::all(),
            'websites' => $website->first()->description,
            'icon' => $website->first()->icon
        ])->header('Content-Type', 'text/xml');
    }
}
