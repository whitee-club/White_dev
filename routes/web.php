<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConfessionsController;
use App\Http\Controllers\FriendsController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\Auth\VerificationController;




Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
	
	//Confessions
Route::get('/confessions', [ConfessionsController::class, 'index'])->name('confession.index');
Route::get('/c/{id}', [ConfessionsController::class, 'create'])->name('confession.create');
Route::post('/confessions/created/{id}', [ConfessionsController::class, 'post'])->name('confession.store')->middleware('confessions');
Route::get('/confessions/delete/{id}', [ConfessionsController::class, 'destroy'])->name('confession.destroy');
	
	//friends
Route::post('/confessions/add/{id}', [FriendsController::class, 'store'])->name('friend.store')->middleware('friends');


//chat
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::get('/contacts', [ChatController::class, 'get'])->name('chat.contacts');
Route::get('/newcontacts', [ChatController::class, 'newcontacts'])->name('chat.newcontacts');
Route::get('/conversation/{id}', [ChatController::class, 'getMessagesFor'])->name('chat.newconversation');
Route::get('/conversationNew/{id}', [ChatController::class, 'getMessagesForNew'])->name('chat.conversation');
Route::post('/conversation/send', [ChatController::class, 'send'])->name('chat.post');
Route::post('/conversationNew/send', [ChatController::class, 'sendNew'])->name('chat.newpost');

//Global
Route::get('/global', [GlobalController::class, 'index'])->name('global.index');
Route::get('/global-create', [GlobalController::class, 'create'])->name('global.create');
Route::get('/global/problem/{id}', [GlobalController::class, 'show'])->name('global.show');
Route::post('/global-post', [GlobalController::class, 'post'])->name('global.post');
Route::post('/global/answer/{id}', [GlobalController::class, 'answerPost'])->name('globalAnswer.post')->middleware('globalm');
Route::post('/global/response/{id}', [GlobalController::class, 'response'])->name('global.response');
Route::get('/global/delete/{id}', [GlobalController::class, 'destroy'])->name('global.destroy');
Route::get('/global/delete-response/{id}', [GlobalController::class, 'destroyResponse'])->name('global.deleteResponse');
Route::get('/global-replies', [GlobalController::class, 'replies'])->name('global.replies');


//Report
Route::get('/report-confession/{id}', [ReportsController::class, 'confession'])->name('report.confession');
Route::get('/report-answer/{id}', [ReportsController::class, 'answer'])->name('report.answer');
Route::post('/reported-confession/{id}', [ReportsController::class, 'confessionReport'])->name('report.reportedCon');
Route::post('/reported-answer/{id}', [ReportsController::class, 'answerReport'])->name('report.answerReport');

//Admin
Route::get('/hokage-kakashi/name', [AdminsController::class, 'nameCreate'])->name('admin.nameCreate');
Route::post('name/store', [AdminsController::class, 'nameStore'])->name('admin.nameStore');
Route::post('fname/store', [AdminsController::class, 'fnameStore'])->name('admin.fnameStore');
Route::get('/hokage-kakashi', [AdminsController::class, 'index'])->name('admin.index');
Route::get('/hokage-kakashi/reports', [AdminsController::class, 'reports'])->name('admin.reports');
Route::get('/hokage-kakashi/report-details/{report}', [AdminsController::class, 'reportDetails'])->name('admin.reportDetails');

