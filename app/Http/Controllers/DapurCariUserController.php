<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Website;

class DapurCariUserController extends Controller
{
    public function cariUser(Website $website)
    {
        $judul = '';
        if (request('search')) {
            $kata = (request('search'));
            $judul = 'Hasil Pencarian : ' . $kata;
        }

        return view('dapur.cari-user', [
            'judul' => $judul,
            'users' => User::orderBy('id', 'ASC')->latest()->filter(request(['search']))->fastPaginate(10)->withQueryString(),
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
