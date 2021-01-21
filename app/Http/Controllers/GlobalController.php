<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PublicProblem;
use Auth;
use DB;
use App\Models\PublicAnswer;

class GlobalController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }  

	public function index()
	{
		$problems = DB::table('public_problems')
    ->latest()
    ->get();
		return view('Global.indexGlobal', compact('problems'));
	}

    public function create()
    {
    	return view('Global.createGlobal');
    }

    public function Post(Request $request)
    {		
    	$data = request()->validate([
            'problem' => 'required'
        ]);

    	PublicProblem::create([
    		'problem' => $data['problem'],
    		'user_id' => Auth::user()->id,
    	]);
    	return redirect('home');
    }

    public function show($id)
    {
    	$problem = PublicProblem::findOrFail($id);
    	 return view('Global.showGlobal', compact('problem'));
    }

   	public function answerPost(Request $request, $id)
   	{	
   			$problem = PublicProblem::findOrFail($id);

   			$data = request()->validate([
   				'answer' => 'required',
   			]);
        if($problem->user_id == Auth::user()->id){
          return view('error.globalError');
        }
          else{
   		PublicAnswer::create([
   				'answer' => $data['answer'],
   				'problem_id' => $id,
   				'problem' => $problem->problem,
   				'answered_by' => Auth::user()->id,
          'asked_by' => $problem->user_id,
          // 'deleted' => false,
   		]);
      return redirect('home');
    }
   	}

    public function response(Request $request, $id)
    {   
        $globalPost = PublicAnswer::find($id);

        if($request->resp == "normal")
        {
           DB::table('users')
        ->where('id', $globalPost->answered_by)
        ->increment('karma', 1);
        DB::table('public_answers')
        ->where('id', $id)
        ->update(['response' => $request->response]);

        } 
        elseif ($request->resp == "smile") {
             DB::table('users')
        ->where('id', $globalPost->answered_by)
        ->increment('karma', 2);
        DB::table('public_answers')
        ->where('id', $id)
        ->update(['response' => $request->response]);
        
        }
        elseif($request->resp == "happy")
        {
           DB::table('users')
        ->where('id', $globalPost->answered_by)
        ->increment('karma', 4);
        DB::table('public_answers')
        ->where('id', $id)
        ->update(['response' => $request->response]);
        }

        $globalPost = PublicAnswer::find($id)
        ->update(['deleted' => true]);

        return redirect('home');

    }

    public function destroy($id)
    {
      PublicAnswer::findOrFail($id)->delete();
    }
    public function replies()
    {
      $responses = PublicAnswer::where('answered_by', Auth::user()->id)->where('response', '!=', null)->latest()->get();
        return view('Global.replies', compact('responses'));

    }
}
