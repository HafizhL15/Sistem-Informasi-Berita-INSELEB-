<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class DapurController extends Controller
{
    public function index(Website $website)
    {
        return view('dapur.dapur_admin', [
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
