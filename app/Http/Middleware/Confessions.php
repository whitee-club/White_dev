<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;

class Confessions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');
        
       $ip = DB::table('users')->where('uuid', '=', $id)->first();
    if(optional($ip)->uuid == $id) {
        return $next($request);
    }
     abort(404);


    }
}
