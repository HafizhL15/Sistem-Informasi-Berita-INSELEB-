<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Website;
use App\Models\Ads;
use App\Models\Category;
use Illuminate\Http\Request;

class RegisterPenulisController extends Controller
{
    public function index(Website $website)
    {
        return view('register.daftar-penulis', [
            'title' => 'Yuk Daftar Jadi Penulis di ' . $website->first()->slogan,
            'icon' => $website->first()->icon,
            'logo' => $website->first()->image,
            'domain' => $website->first()->domain,
            'categories' => Category::all(),
            'description' => $website->first()->description,
            'keywords' => $website->first()->domain . $website->first()->description,
            'website' => Website::latest()->take(1)->get(),
            'name' => $website->first()->name,
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'address' => 'required|max:255',
            'email' => 'required|email:dns|unique:pendaftars',
            'phone' => 'required|min:8|max:13',
            'image' => 'required|image|file|max:200'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('gambar-calonpenulis');
        }

        Pendaftar::create($validatedData);

        // $request->session()->flash('success', 'Pendaftaran Berhasil, Secepatnya kami akan menghubungi anda melalui email/whatsapp yang aktif');

        return redirect('/daftar-penulis')->with('success', 'Pendaftaran Berhasil, Secepatnya kami akan menghubungi anda melalui email/whatsapp yang aktif');

        // if ($request->file('image')) {
        //     $validatedData['image'] = $request->file('image')->store('gambar-penulis');
        // }
    }
}
