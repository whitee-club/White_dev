<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sent;
use App\Models\User;
use App\Models\Recieved;
use App\Models\Confession;
use App\Models\Name;
use App\Models\FemaleName;
use Auth;
use DB;

class FriendsController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $id)
    {       
        $friend = User::findOrFail($id);
        if ($friend->gender == "male") {
           
        $name = Name::inRandomOrder()->first()->name;
        }
         else{
            $name = FemaleName::inRandomOrder()->first()->name;
         }
        // $user = User::find($id);
        

        Sent::create([
            'friends_id' => Auth::user()->uuid,
            'user_id' => $id,
            'name' => Auth::user()->name,
            'list_no' => '2',
        ]);

        Recieved::create([
            'friends_id' => $id,
            'user_id' => Auth::user()->uuid,
            'name' => $name

            ]);

           $d =  Confession::where('confessionFrom', $id)
            ->update(['name' => $name]);
        
        return redirect()->route('chat.index');
    }
}



