<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Positionads;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DapurIklanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        return view('dapur.iklan.index', [
            'ads' => Ads::latest()->fastPaginate(10)->withQueryString(),
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Website $website)
    {
        return view('dapur.iklan.create', [
            'positionads' => Positionads::all(),
            'websites' => Website::all(),
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'positionads_id' => 'required',
            'link' => 'nullable',
            'script' => 'nullable',
            'status' => 'required',
            'image' => 'image|file|max:200',
            'caption' => 'nullable',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('gambar-iklan');
        }

        Ads::create($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/iklan')->with('success', 'Iklan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $iklan, Website $website)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit(Ads $iklan, Website $website)
    {
        return view('dapur.iklan.edit', [
            'iklan' => $iklan,
            'positionads' => Positionads::all(),
            'websites' => Website::all(),
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ads $iklan)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'positionads_id' => 'required',
            'link' => 'nullable',
            'script' => 'nullable',
            'status' => 'required',
            'image' => 'image|file|max:200',
            'caption' => 'nullable',
        ]);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('gambar-iklan');
        }

        Ads::where('id', $iklan->id)->update($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/iklan')->with('success', 'Iklan berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ads $iklan)
    {
        if ($iklan->image) {
            Storage::delete($iklan->image);
        }

        Ads::destroy($iklan->id);
        return redirect('/dapur-imajinasi/ruangredaksi/iklan')->with('success', 'Iklan berhasil dihapus!');
    }


    public function trash(Website $website)
    {
        return view('dapur.iklan.trash', [
            'ads' => Ads::onlyTrashed()->latest()->fastPaginate(10)->withQueryString(),
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

    public function restore($id = null)
    {
        if ($id != null) {
            Ads::onlyTrashed()->where('id', $id)->restore();
        } else {
            Ads::onlyTrashed()->restore();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/iklan/trash')->with('success', 'Iklan berhasil direstore!');
    }

    public function delete($id = null)
    {
        if ($id != null) {
            Ads::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            Ads::onlyTrashed()->forceDelete();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/iklan/trash')->with('success', 'Iklan berhasil dihapus permanen!');
    }
}
