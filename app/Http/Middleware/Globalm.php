<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use DB;
use Auth;

class Globalm
{
   
    public function handle(Request $request, Closure $next)
    {   
        $id = $request->route('id');

       $user =  DB::table('public_problems')
        ->where('id', '=', $id)
        ->first();
        dd($user->all());

        if(Auth::user()->id == $user->user_id){
            return "You cannot rsepond to yourself";
        }
        return $next($request);
    }
}
