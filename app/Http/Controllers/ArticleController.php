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
use PhpParser\Node\Stmt\Return_;

class ArticleController extends Controller
{
    public function index(Website $website, Image $image)
    {
        return view('home', [
            // "home" => Article::all(),
            'title' => $website->first()->name . ' - ' . $website->first()->slogan,
            'sidebar' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'artikels' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->fastPaginate(15)->withQueryString(),
            'icon' => $website->first()->icon,
            'logo' => $website->first()->image,
            'website' => Website::latest()->take(1)->get(),
            'categories' => Category::all(),
            'name' => $website->first()->name,
            'domain' => $website->first()->domain,
            'description' => $website->first()->description,
            'keywords' => $website->first()->meta_keyword,
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
            'tiktok' => $website->first()->tiktok,
            'images' => Image::orderBy('published_at', 'desc')->take(3)->get()
        ]);
    }

    public function tampilartikel($slug, Article $artikel, Website $website, Tag $tags)
    {
        views($artikel)
            ->cooldown($minutes = 1)
            ->record();

        // Split Artikel
        $items = array();

        // Membagi halaman artikel setelah kata break
        // $bodyParts = explode("break", $artikel->body);
        $bodyParts = $artikel->body;

        // Pengulangan melalui bagian-bagian dan mengisi array
        // foreach ($bodyParts as $bodyPart) {
        //     array_push($items, $bodyPart);
        // }

        // Dapatkan halaman saat ini untuk paginasi
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Menunjukkan jumlah page untuk ditampilkan per halaman
        $perPage = 2;

        $currentItems = array_slice($items, $perPage * ($currentPage - 1), $perPage);
        $paginator = new LengthAwarePaginator($currentItems, count($items), $perPage, $currentPage);
        $results = $paginator->appends('filter', request('filter'));
        $results->withPath($artikel->slug);

        // Ambil tag untuk keyword
        $getTags = $artikel->tags;
        $ambilTags = array();
        foreach ($getTags as $tag) {
            $ambilTags[] = $tag->name;
        }
        $showTags = implode(',', $ambilTags);

        // Ambil longtail untuk keyword
        $getLongtails = $artikel->longtails;
        $ambilLongtails = array();
        foreach ($getLongtails as $longtail) {
            $ambilLongtails[] = $longtail->name;
        }
        $showLongtails = implode(',', $ambilLongtails);

        //Update jumlah views artikel
        $artikel = Article::find($slug);
        $update = ['views' => $artikel->views + 1,];
        Article::where('slug', $artikel->slug)->update($update);

        return view('artikel', [
            'title' => $artikel->title,
            'artikel' => Article::find($slug),
            'description' => $artikel->description,
            'keywords' => $showTags . ',' . $showLongtails,
            'sidebar' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'categories' => Category::all(),
            'tags' => $artikel->tags,
            'headline' => Article::where([['headline', 1], ['status', 1]])->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'pilihan' => Article::where([['pilihan', 1], ['status', 1]])->where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'rekomendasi' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->take(5)->get(),
            'icon' => $website->first()->icon,
            'logo' => $website->first()->image,
            'website' => Website::latest()->take(1)->get(),
            'name' => $website->first()->name,
            'domain' => $website->first()->domain,
            'ads' => Ads::where('status', 1)->latest()->get(),
            'populer' => Article::where('status', 1)->where('published_at', '<', now())->orderByViews('desc', Period::pastDays(1))->limit('5')->get(),
            'related' => Article::whereHas('tags')->where('id', '!=', $artikel->id)->where('status', 1)->where('published_at', '<', now())->inRandomOrder()->get(),
            'meta_header' => $website->first()->meta_header,
            'meta_footer' => $website->first()->meta_footer,
            'facebook' => $website->first()->facebook,
            'twitter' => $website->first()->twitter,
            'instagram' => $website->first()->instagram,
            'youtube' => $website->first()->youtube,
            'tiktok' => $website->first()->tiktok
        ], compact('bodyParts', 'artikel'));
    }
}
