<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if (empty($roles)) $roles = ['SuperAdmin'];
        // foreach ($roles as $role) {
        //     if ($request->user()->role === $role) {
        //         return $next($request);
        //     }
        // }


        $roleIds = ['SuperAdmin' => 1, 'Admin' => 2, 'Editor' => 3, 'Author' => 4];
        $allowedRoleIds = [];
        foreach ($roles as $role) {
            if (isset($roleIds[$role])) {
                $allowedRoleIds[] = $roleIds[$role];
            }
        }
        $allowedRoleIds = array_unique($allowedRoleIds);

        if (Auth::check()) {
            if (in_array(Auth::user()->role_id, $allowedRoleIds)) {
                return $next($request);
            }
        }

        return redirect('/dapur-imajinasi/ruangredaksi')->with('warning', 'Ups, Anda tidak memiliki akses');
    }
}
