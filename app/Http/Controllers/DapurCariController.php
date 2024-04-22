<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Website;
use App\Models\Tag;

class DapurCariController extends Controller
{
    public function cariArtikel(Website $website)
    {
        $judul = '';
        if (request('search')) {
            $kata = (request('search'));
            $judul = 'Hasil Pencarian : ' . $kata;
        }

        return view('dapur.cari-artikel', [
            'judul' => $judul,
            'artikels' => Article::with(['tags'])->where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->filter(request(['search']))->fastPaginate(10)->withQueryString(),
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
}
