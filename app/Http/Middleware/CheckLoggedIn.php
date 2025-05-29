<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLoggedIn
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            session()->flash('error', 'You are not logged in yet, please log in or register.');
            return redirect('/');
        }

        return $next($request);
    }
}
