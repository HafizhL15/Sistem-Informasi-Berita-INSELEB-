<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\Image;
use Illuminate\Http\Request;

class RSSFotoController extends Controller
{
    public function index(Website $website)
    {
        $image = Image::latest()->take(30)->get();

        return response()->view('feed-foto', [
            'images' => $image,
            'websites' => $website->first()->description,
            'icon' => $website->first()->icon
        ])->header('Content-Type', 'text/xml');
    }
}
