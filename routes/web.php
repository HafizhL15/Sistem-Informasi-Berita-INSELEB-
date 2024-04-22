<?php

use App\Models\Ads;
use App\Models\User;
use App\Models\Article;
use App\Models\Website;
use App\Models\Category;
use App\Models\Roleadmin;
use App\Models\KirimanPembaca;
use App\Http\Middleware\isAdmin;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CariController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\DapurController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PilihanController;
use App\Http\Controllers\RSSFeedController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DapurTagController;
use App\Http\Controllers\DapurCariController;
use App\Http\Controllers\DapurInfoController;
use App\Http\Controllers\DapurAdminController;
use App\Http\Controllers\DapurIklanController;
use App\Http\Controllers\DapurImageController;
use App\Http\Controllers\DapurJadwalController;
use App\Http\Controllers\DapurKonsepController;
use App\Http\Controllers\DapurReportController;
use CyrildeWit\EloquentViewable\Support\Period;
use App\Http\Controllers\DapurArtikelController;
use App\Http\Controllers\DapurPWAdminController;
use App\Http\Controllers\DapurWebsiteController;
use App\Http\Controllers\DapurCariUserController;
use App\Http\Controllers\DapurKategoriController;
use App\Http\Controllers\DapurPassUserController;
use App\Http\Controllers\DapurPendaftarController;
use App\Http\Controllers\KirimanPembacaController;
use App\Http\Controllers\DapurProfilUserController;
use App\Http\Controllers\RegisterPenulisController;
use App\Http\Controllers\DapurKirimanPembacaController;
use App\Http\Controllers\LongtailController;
use App\Http\Controllers\RSSFotoController;
use App\Models\Longtail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Home
Route::get('/', [ArticleController::class, 'index']);

//Tampil Artikel Tunggal
Route::get('/artikel/rlo-{id}/{artikel:slug}', [ArticleController::class, 'tampilartikel']);

//Tampil Artikel didalam Kategori
Route::get('/kategori/{id}/{kategori:slug}', [CategoryController::class, 'artikelKategori'])->name('category');

//Tampil Artikel Didalam Tag
Route::get('/tag/{id}/{tag:slug}', [TagController::class, 'artikelTag'])->name('tag');
Route::get('/rlo-{id}/{longtail:slug}', [LongtailController::class, 'artikelLongtail'])->name('longtail');

//Cari
Route::get('/cari-artikel', [CariController::class, 'cari']);

Route::get('/indeks', function (Website $website) {
    return view('indeks', [
        'title' => 'Berita terbaru hari ini - ' . $website->first()->domain . ' - ' . $website->first()->slogan,
        'sidebar' => Article::orderBy('published_at', 'desc')->take(5)->get(),
        'artikel' => Article::where('status', 1)->where('published_at', '<', now())->orderBy('published_at', 'desc')->fastPaginate(10)->withQueryString(),
        'icon' => $website->first()->icon,
        'logo' => $website->first()->image,
        'categories' => Category::all(),
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
});

Route::get('/lainnya', function (Website $website) {
    return view('lainnya', [
        'title' => 'Berita terbaru hari ini - ' . $website->first()->domain,
        'categories' => Category::all(),
        'icon' => $website->first()->icon,
        'logo' => $website->first()->image,
        'description' => $website->first()->description,
        'website' => Website::latest()->take(1)->get(),
        'name' => $website->first()->name,
        'domain' => $website->first()->domain,
        'categories' => Category::all(),
        'keywords' => $website->first()->meta_keyword,
        'ads' => Ads::where('status', 1)->latest()->get(),
        'meta_header' => $website->first()->meta_header,
        'meta_footer' => $website->first()->meta_footer,
        'facebook' => $website->first()->facebook,
        'twitter' => $website->first()->twitter,
        'instagram' => $website->first()->instagram,
        'youtube' => $website->first()->youtube,
        'tiktok' => $website->first()->tiktok
    ]);
});

//Register Penulis
Route::get('/daftar-penulis', [RegisterPenulisController::class, 'index'])->middleware('guest');
Route::post('/daftar-penulis', [RegisterPenulisController::class, 'store']);

//Register Penulis
Route::get('/kirim-artikel', [KirimanPembacaController::class, 'index'])->middleware('guest');
Route::post('/kirim-artikel', [KirimanPembacaController::class, 'store']);

//File Manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//RSSFeed
Route::get('/feed', [RSSFeedController::class, 'index']);
Route::get('/feed/foto', [RSSFotoController::class, 'index']);

//Sitemap
Route::get('sitemap.xml', [SitemapController::class, 'index'], function () {
    return response()->view('sitemap')->header('Content-type', 'text/xml');
});

//Tampil Pilihan Editor
Route::get('/pilihan-editor', [PilihanController::class, 'index']);

//Tampil Gambar Tunggal
Route::get('/foto/rlo-{id}/{gambar:slug}', [ImageController::class, 'tampilGambar'])->name('gambar');
Route::get('/list-foto', [ImageController::class, 'listGambar'])->name('listgambar');

//Tampil Info Tunggal
Route::get('/{info:slug}', [InfoController::class, 'tampilinfo'])->name('info');
// Route::get('/{network:slug}', [NetworkController::class, 'tampilinfo'])->name('info');

// Dapur Redaksi

//login
Route::get('/masuk/dapur-redaksi/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/masuk/dapur-redaksi/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

//dashboard
Route::get('/dapur-imajinasi/ruangredaksi', function (Website $website) {
    return view('dapur.dapur-admin', [
        'websites' => Website::latest()->take(1)->get(),
        'website' => $website,
        'icon' => $website->first()->icon,
        'logo' => $website->first()->image,
        'title' => 'Dashboard Admin - ' . $website->first()->domain,
        'name' => $website->first()->name,
        'domain' => $website->first()->domain,
        'description' => $website->first()->description,
        'artikel' => Article::count(),
        'kategori' => Category::count(),
        'iklan' => Ads::count(),
        'user' => User::count(),
        'rolenavbar' => auth()->user()->roleadmin->role
    ]);
})->middleware('auth');

//Tampil Artikel Dashboard
Route::get('/dapur-imajinasi/ruangredaksi/artikel/trash', [DapurArtikelController::class, 'trash'])->middleware('auth');
Route::get('/dapur-imajinasi/ruangredaksi/artikel/restore/{id?}', [DapurArtikelController::class, 'restore'])->middleware('auth');
Route::get('/dapur-imajinasi/ruangredaksi/artikel/delete/{id?}', [DapurArtikelController::class, 'delete'])->middleware('auth');
Route::resource('/dapur-imajinasi/ruangredaksi/artikel', DapurArtikelController::class)->middleware('auth');
//Tampil Artikel konsep
Route::resource('/dapur-imajinasi/ruangredaksi/konsep', DapurKonsepController::class)->middleware('auth');
//Tampil Artikel terjadwal
Route::resource('/dapur-imajinasi/ruangredaksi/jadwalposting', DapurJadwalController::class)->middleware('auth');
// Slug Otomatis Artikel
Route::get('/dapur-imajinasi/ruangredaksi/cekSlug', [DapurArtikelController::class, 'cekSlug'])->middleware('auth');
// Slug Otomatis konsep
Route::get('/dapur-imajinasi/ruangredaksi/konsepSlug', [DapurKonsepController::class, 'konsepSlug'])->middleware('auth');
// Slug Otomatis Artikel terjadwaljadwal
Route::get('/dapur-imajinasi/ruangredaksi/jadwalSlug', [DapurJadwalController::class, 'jadwalSlug'])->middleware('auth');

Route::group(['middleware' => 'checkRole:SuperAdmin,Admin'], function () {
    //Tampil Kategori Dashboard
    Route::get('/dapur-imajinasi/ruangredaksi/kategori/trash/', [DapurKategoriController::class, 'trash']);
    Route::get('/dapur-imajinasi/ruangredaksi/kategori/restore/{id?}', [DapurKategoriController::class, 'restore']);
    Route::get('/dapur-imajinasi/ruangredaksi/kategori/delete/{id?}', [DapurKategoriController::class, 'delete']);
    Route::resource('/dapur-imajinasi/ruangredaksi/kategori', DapurKategoriController::class)->except('show');
    // Slug Otomatis Kategori
    Route::get('/dapur-imajinasi/ruangredaksi/ambilSlug', [DapurKategoriController::class, 'ambilSlug']);

    //Tampil Iklan  Dashboard
    Route::get('/dapur-imajinasi/ruangredaksi/iklan/trash/', [DapurIklanController::class, 'trash']);
    Route::get('/dapur-imajinasi/ruangredaksi/iklan/restore/{id?}', [DapurIklanController::class, 'restore']);
    Route::get('/dapur-imajinasi/ruangredaksi/iklan/delete/{id?}', [DapurIklanController::class, 'delete']);
    Route::resource('/dapur-imajinasi/ruangredaksi/iklan', DapurIklanController::class);

    // Artikel Kiriman Pembaca
    Route::resource('/dapur-imajinasi/ruangredaksi/kirimanpembaca', DapurKirimanPembacaController::class);

    // Data Pendaftar
    Route::resource('/dapur-imajinasi/ruangredaksi/pendaftar', DapurPendaftarController::class);
});

//Tampil Tag Dashboard
Route::get('/dapur-imajinasi/ruangredaksi/tag/trash/', [DapurTagController::class, 'trash'])->middleware('auth');
Route::get('/dapur-imajinasi/ruangredaksi/tag/restore/{id?}', [DapurTagController::class, 'restore'])->middleware('auth');
Route::get('/dapur-imajinasi/ruangredaksi/tag/delete/{id?}', [DapurTagController::class, 'delete'])->middleware('auth');
Route::resource('/dapur-imajinasi/ruangredaksi/tag', DapurTagController::class)->middleware('auth');
// Slug Otomatis Tag
Route::get('/dapur-imajinasi/ruangredaksi/tagSlug', [DapurTagController::class, 'tagSlug'])->middleware('auth');

Route::middleware('SuperAdmin')->group(function () {
    //Tampil Setting Website Dashboard
    Route::resource('/dapur-imajinasi/ruangredaksi/website', DapurWebsiteController::class);
    // Slug Otomatis Website
    Route::get('/dapur-imajinasi/ruangredaksi/webSlug', [DapurWebsiteController::class, 'webSlug']);

    //Tampil User Admin  Dashboard
    Route::get('/dapur-imajinasi/ruangredaksi/useradmin/trash/', [DapurAdminController::class, 'trash']);
    Route::get('/dapur-imajinasi/ruangredaksi/useradmin/restore/{id?}', [DapurAdminController::class, 'restore']);
    Route::get('/dapur-imajinasi/ruangredaksi/useradmin/delete/{id?}', [DapurAdminController::class, 'delete']);
    Route::resource('/dapur-imajinasi/ruangredaksi/useradmin', DapurAdminController::class);

    //Ubah Password User
    Route::resource('/dapur-imajinasi/ruangredaksi/useradmin/editpassword', DapurPWAdminController::class);

    //Info Dashboard
    Route::get('/dapur-imajinasi/ruangredaksi/info/trash/', [DapurInfoController::class, 'trash']);
    Route::get('/dapur-imajinasi/ruangredaksi/info/restore/{id?}', [DapurInfoController::class, 'restore']);
    Route::get('/dapur-imajinasi/ruangredaksi/info/delete/{id?}', [DapurInfoController::class, 'delete']);
    Route::resource('/dapur-imajinasi/ruangredaksi/info', DapurInfoController::class);
    // Slug Otomatis info
    Route::get('/dapur-imajinasi/ruangredaksi/infoSlug', [DapurInfoController::class, 'infoSlug']);
});

//Tampil Report Dashboard
Route::get('/dapur-imajinasi/ruangredaksi/report/author', [DapurReportController::class, 'author'])->middleware('auth');
Route::resource('/dapur-imajinasi/ruangredaksi/report/editor', DapurReportController::class)->middleware('auth');

//Image Dasboard
Route::get('/dapur-imajinasi/ruangredaksi/image/trash/', [DapurImageController::class, 'trash'])->middleware('auth');
Route::get('/dapur-imajinasi/ruangredaksi/image/restore/{id?}', [DapurImageController::class, 'restore'])->middleware('auth');
Route::get('/dapur-imajinasi/ruangredaksi/image/delete/{id?}', [DapurImageController::class, 'delete'])->middleware('auth');
Route::resource('/dapur-imajinasi/ruangredaksi/image', DapurImageController::class)->middleware('auth');
// Slug Otomatis info
Route::get('/dapur-imajinasi/ruangredaksi/imageSlug', [DapurImageController::class, 'imageSlug'])->middleware('auth');

Route::get('/dapur-imajinasi/ruangredaksi/cari-artikel', [DapurCariController::class, 'cariArtikel'])->middleware('auth');
Route::get('/dapur-imajinasi/ruangredaksi/cari-user', [DapurCariUserController::class, 'cariUser'])->middleware('auth');

//Profil User
Route::resource('/dapur-imajinasi/ruangredaksi/profil', DapurProfilUserController::class)->middleware('auth');
Route::resource('/dapur-imajinasi/ruangredaksi/profil/editpassword', DapurPassUserController::class)->middleware('auth');
