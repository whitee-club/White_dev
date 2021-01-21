<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Confession;
use Auth;
use DB;

class ConfessionsController extends Controller
{

public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create($id)
    {
        $confessingTo = DB::table('users')
        ->where('uuid', $id)
        ->first();
        return view('Confession.create', compact('confessingTo', 'id'));
    }

    public function post(Request $request, $id)
    {
        $data = request()->validate([
            'confession' => 'required'
        ]);
            $confessor = DB::table('users')
            ->where('uuid', $id)
            ->first();

            if(Auth::user()->id == $confessor->id){
                return view('error.error');
            }
         else{   

        Confession::create([
            'confession' => $data['confession'],
            'confessedTo' => $id,
            'confessionFrom' => Auth::user()->id,
        ]);
        return redirect('home');
        }
        
    }

    public function destroy($id)
    {   
        Confession::findOrFail($id)->delete();
        return redirect('home');
    }

    
}
