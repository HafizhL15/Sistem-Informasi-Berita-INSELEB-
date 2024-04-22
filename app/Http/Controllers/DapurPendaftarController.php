<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\User;
use App\Models\Article;
use App\Models\Website;
use App\Models\Roleadmin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DapurPendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        return view('dapur.form.index', [
            'calon' => Pendaftar::latest()->fastPaginate(10)->withQueryString(),
            'websites' => Website::latest()->take(1)->get(),
            'website' => $website,
            'icon' => $website->first()->icon,
            'title' => 'Dashboard Admin - ' . $website->first()->domain,
            'domain' => $website->first()->domain,
            'name' => $website->first()->name,
            'description' => $website->first()->description,
            'keywords' => $website->first()->domain . $website->first()->description,
            'rolenavbar' => auth()->user()->roleadmin->role
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftar $pendaftar, Website $website)
    {
        return view('dapur.form.show', [
            'calon' => $pendaftar,
            'fotoprofil' => $pendaftar->image,
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftar $pendaftar)
    {
        //
    }
}
