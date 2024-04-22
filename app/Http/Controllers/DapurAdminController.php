<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Website;
use App\Models\Roleadmin;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DapurAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Website $website)
    {
        return view('dapur.useradmin.index', [
            'users' => User::orderBy('id', 'ASC')->fastPaginate(10)->withQueryString(),
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
    public function create(Website $website, User $useradmin)
    {
        return view('dapur.useradmin.create', [
            'users' => User::all(),
            'roles' => Roleadmin::all(),
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:5', 'max:50', 'unique:users'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|confirmed|min:5|max:50',
            'phone' => 'min:10|max:13',
            'address' => 'max:255',
            'role_id' => 'required',
            'image' => 'image|file|max:200'
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('gambar-user');
        }

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/useradmin')->with('success', 'User baru berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $useradmin, Website $website)
    {
        return view('dapur.useradmin.show', [
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $useradmin, Website $website)
    {
        return view('dapur.useradmin.edit', [
            'useradmin' => $useradmin,
            'roles' => Roleadmin::all(),
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $useradmin)
    {
        $rules = [
            'name' => 'required|max:255',
            'phone' => 'min:10|max:13',
            'address' => 'max:255',
            'role_id' => 'required',
            'image' => 'image|file|max:200'
        ];

        if ($request->username != $useradmin->username) {
            $rules['username'] = 'required|min:5|max:50|unique:users';
        }

        if ($request->email != $useradmin->email) {
            $rules['email'] = 'required|email:dns|unique:users';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('gambar-user');
        }

        User::where('id', $useradmin->id)
            ->update($validatedData);

        return redirect('/dapur-imajinasi/ruangredaksi/useradmin')->with('success', 'Data User berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $useradmin)
    {
        if ($useradmin->image) {
            Storage::delete($useradmin->image);
        }

        Article::where('author_id', $useradmin->id)->update(['author_id' => 2]);
        Article::where('user_id', $useradmin->id)->update(['user_id' => 2]);
        User::destroy($useradmin->id);
        return redirect('/dapur-imajinasi/ruangredaksi/useradmin')->with('success', 'User Admin berhasil dihapus!');
    }


    public function trash(Website $website)
    {
        return view('dapur.useradmin.trash', [
            'users' => User::onlyTrashed()->latest()->fastPaginate(10)->withQueryString(),
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
            User::onlyTrashed()->where('id', $id)->restore();
        } else {
            User::onlyTrashed()->restore();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/useradmin/trash')->with('success', 'User Admin berhasil direstore');
    }

    public function delete($id = null)
    {
        if ($id != null) {
            User::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            User::onlyTrashed()->forceDelete();
        }

        return redirect('/dapur-imajinasi/ruangredaksi/useradmin/trash')->with('success', 'User Admin berhasil dihapus permanen!');
    }
}
