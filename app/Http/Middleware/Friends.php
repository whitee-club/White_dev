<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Confession;
use Auth;
use DB;

class Friends
{
    
    public function handle(Request $request, Closure $next)
    {
        $id = $request->route('id');

        if (auth()->check()) {
            $ip = DB::table('recieveds')->where('user_id', '=', Auth::user()->uuid)->where('friends_id', '=', $id)->first();
              
            if ($ip && $ip->friends_id == $id) {

                $d =  Confession::where('confessionFrom', $id)
            ->update(['name' => $ip->name]);
                return redirect('/chat');
            }
        }
        
        return $next($request);
    }
}
