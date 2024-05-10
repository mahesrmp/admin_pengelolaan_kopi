<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles) //$guards
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (in_array($user->role, $roles)) {
                switch ($user->role) {
                    case 'admin':
                        return redirect('/admin/dashboard');
                    case 'fasilitator':
                        return redirect('/fasilitator/dashboard');
                }
            }
            return redirect('/');
        }

        return $next($request);
    }
}
