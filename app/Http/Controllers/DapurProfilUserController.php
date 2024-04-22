<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class DapurProfilUserController extends Controller
{
    public function show(User $useradmin, Website $website)
    {
        return view('dapur.profil.show', [
            'useradmin' => User::all(),
            'fotoprofil' => $useradmin->image,
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

    public function edit(User $useradmin, Website $website)
    {
        return view('dapur.profil.edit', [
            'useradmin' => $useradmin,
            'fotoprofil' => $useradmin->image,
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

    public function update(Request $request, User $profil)
    {
        $rules = [
            'name' => 'required|max:255',
            'phone' => 'min:10|max:13',
            'address' => 'max:255',
            'image' => 'image|file|max:200'
        ];

        if ($request->username != $profil->username) {
            $rules['username'] = 'required|min:5|max:50|unique:users';
        }

        if ($request->email != $profil->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('gambar-user');
        }

        User::where('id', $profil->id)
            ->update($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi')->with('success', 'Data User berhasil diupdate!');
    }
}
