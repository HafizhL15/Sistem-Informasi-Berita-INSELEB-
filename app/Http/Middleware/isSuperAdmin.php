<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\Roleadmin;
use Closure;
use Illuminate\Http\Request;

class isSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || auth()->user()->role_id != '1') {
            // abort(403);
            return redirect('/dapur-imajinasi/ruangredaksi')->with('warning', 'Ups, Anda tidak memiliki akses');
        }
        return $next($request);
    }
}
