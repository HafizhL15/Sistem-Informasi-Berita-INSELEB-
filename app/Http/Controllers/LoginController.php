<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Website $website)
    {
        return view('login.dapur-redaksi', [
            'title' => $website->first()->domain . ' - ' . $website->first()->slogan,
            'icon' => $website->first()->icon,
            'logo' => $website->first()->image,
            'name' => $website->first()->name,
            'description' => $website->first()->description,
            'domain' => $website->first()->domain,
            'keywords' => $website->first()->domain . $website->first()->description,
            'meta_header' => $website->first()->meta_header,
            'meta_footer' => $website->first()->meta_footer,
            'facebook' => $website->first()->facebook,
            'twitter' => $website->first()->twitter,
            'instagram' => $website->first()->instagram,
            'youtube' => $website->first()->youtube,
            'tiktok' => $website->first()->tiktok
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dapur-imajinasi/ruangredaksi');
        }

        return back()->with('loginError', 'Upss, Login Gagal');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
