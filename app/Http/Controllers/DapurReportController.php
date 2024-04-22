<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Website;
use App\Models\User;
use App\Models\Roleadmin;
use Illuminate\Http\Request;


class DapurReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        return view('dapur.report.editor', [
            'websites' => Website::latest()->take(1)->get(),
            'website' => $website,
            'icon' => $website->first()->icon,
            'title' => 'Dashboard Admin - ' . $website->first()->domain,
            'domain' => $website->first()->domain,
            'name' => $website->first()->name,
            'description' => $website->first()->description,
            'keywords' => $website->first()->domain . $website->first()->description,
            'artikels' => Article::where('status', 1)->latest()->get(),
            'users' => User::with('roleadmin')->where([['role_id', 1]])->orWhere([['role_id', 2]])->orWhere([['role_id', 3]])->fastPaginate(10)->withQueryString(),
            'user' => User::all(),
            'rolenavbar' => auth()->user()->roleadmin->role
        ]);
    }

    public function author(Website $website)
    {
        return view('dapur.report.author', [
            'websites' => Website::latest()->take(1)->get(),
            'website' => $website,
            'icon' => $website->first()->icon,
            'title' => 'Dashboard Admin - ' . $website->first()->domain,
            'domain' => $website->first()->domain,
            'name' => $website->first()->name,
            'description' => $website->first()->description,
            'keywords' => $website->first()->domain . $website->first()->description,
            'artikels' => Article::where('status', 1)->latest()->get(),
            'authors' => User::with('roleadmin')->where([['role_id', 4]])->fastPaginate(10)->withQueryString(),
            'user' => User::all(),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
