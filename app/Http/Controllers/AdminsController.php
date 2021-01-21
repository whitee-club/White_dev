<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Name;
use App\Models\FemaleName;
use App\Models\User;
use App\Models\Report;

class AdminsController extends Controller
{
      public function __construct()
    {
        $this->middleware('admin');
    }

   public function index()
   {
   		$users = User::all();
   	return view('Admin.adminIndex', compact('users'));
   }	

   public function nameCreate()
   {
   	return view('Admin.nameCreate');
   }

   public function nameStore(Request $request)
   {	

   		Name::create([
   			'name' => $request->name,
   		]);

   		return redirect()->route('admin.nameCreate');
   }

   public function fnameStore(Request $request)
   {  

      FemaleName::create([
        'name' => $request->name,
      ]);

      return redirect()->route('admin.nameCreate');
   }

   public function reports()
   {
   		$reports = Report::all();
          return view('Admin.reportIndex', compact('reports'));  
   }

   public function reportDetails($report)
   {
      $rep = Report::find($report);
      $reportedBy = User::find($rep->reported_by);
      $reported_to = User::find($rep->reported_to);
      return view('Admin.reportShow', compact('rep', 'reportedBy', 'reported_to'));
   }

   
}
