<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class DapurPassUserController extends Controller
{
    public function edit(User $editpassword, Website $website)
    {
        return view('dapur.profil.editpass', [
            'useradmin' => $editpassword,
            'fotoprofil' => $editpassword->image,
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

    public function update(Request $request, User $editpassword)
    {
        $rules = [
            'password' => 'required|confirmed|min:5|max:50',
        ];

        $validatedData = $request->validate($rules);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::where('id', $editpassword->id)
            ->update($validatedData);


        return redirect('/dapur-imajinasi/ruangredaksi')->with('success', 'Password User berhasil diubah!');
    }
}
