<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Confession;
use App\Models\Report;
use App\Models\PublicAnswer;
use Auth;

class ReportsController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function confession($id)
    {		
    	$alert = "Please define your reason for reportng this post";
    	$confession = Confession::findOrFail($id);
    	return view('Report.report', compact('alert', 'confession'));
    }

    public function confessionReport(Request $request, $id)
    {	
    	$confession = Confession::findOrFail($id);
    	$data = request()->validate([
    		'reason' => 'required',
    	]);
    	Report::create([
    		'reported_by' => Auth::user()->id,
    		'reported_to' => $confession->confessionFrom,
    		'reason' => $data['reason'],
    		'section' => "confessions" 
    	]);

    	$confession->delete();
    	return redirect('home');
    } 

    public function answer($id)
    {
    	$alert = "Please define your reason for reportng this post";
    	$confession = PublicAnswer::findOrFail($id);
    	return view('Report.globalReport', compact('alert', 'confession'));
    }

    public function answerReport(Request $request, $id)
    {
    	$confession = PublicAnswer::findOrFail($id);
    	$data = request()->validate([
    		'reason' => 'required',
    	]);
    	Report::create([
    		'reported_by' => Auth::user()->id,
    		'reported_to' => $confession->answered_by,
    		'reason' => $data['reason'],
    		'section' => "PublicAnswer" 
    	]);

    	 PublicAnswer::find($id)
        ->update(['deleted' => true]);
    	return redirect('home');
    }
}
