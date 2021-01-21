<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confession;
use App\Models\PublicAnswer;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   $confessions = DB::table('confessions')
        ->where('confessedTo', Auth::user()->uuid)
        ->latest()
        ->get();
        
       $globals = DB::table('public_answers')
       ->where('asked_by', Auth::user()->id )
       ->where('deleted', null)
       ->latest()
       ->get();

       $responses = PublicAnswer::where('answered_by', Auth::user()->id)->where('response', '!=', null)->latest()->get();
        return view('home', compact('confessions', 'globals', 'responses'));
    }
}
