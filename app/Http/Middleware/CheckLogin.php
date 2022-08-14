<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;

class CheckLogin
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
        $role = Role::where('status',1)->where('name','admin')->first();
        if (Auth::check() && Auth::user()->role_id == $role->id) {
            return $next($request);
        } else {
            return redirect()->route('admin.user.login')->with(['errors' => "Account not for admin"]);
        }
    }
}
