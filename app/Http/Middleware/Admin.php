<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class Admin
{
   
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->email == 'whiteee247@gmail.com') {
                return $next($request);
            }

            return redirect('/chat');
    }
}
