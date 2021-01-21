<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Recieved;
use DB;
use App\Models\Sent;
use App\Models\Message;
use App\Events\NewMessage;

class ChatController extends Controller
{
            public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
	{
		return view('chatbox');
	}

    public function get(){
    	// $sem = Auth::user()->id;
    	$contacts = DB::table('recieveds')
    ->where('user_id', Auth::user()->uuid)
    ->get();
    // dd($contacts->all());
    // dd('$contacts->all()');
	// $contacts = User::where('id', '!=', auth()->id())->get();

	 // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        
        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', Auth::user()->uuid)
            ->where('read', false)
            ->groupBy('from')
            ->get();

        //     // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->friends_id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

	return response()->json($contacts);
        }

public function newcontacts(){
	// $contacts = Auth::user()->id;
    	$contacts = DB::table('sents')
    ->where('user_id', Auth::user()->id)
    ->get();
    // dd($contacts->all());
	// $contacts = User::where('id', '!=', auth()->id())->get();

	 // get a collection of items where sender_id is the user who sent us a message
        // and messages_count is the number of unread messages we have from him
        $unreadIds = Message::select(\DB::raw('`from` as sender_id, count(`from`) as messages_count'))
            ->where('to', Auth::user()->id)
            ->where('read', false)
            ->groupBy('from')
            ->get();
            // dd($unreadIds->all());

        //     // add an unread key to each contact with the count of unread messages
        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->friends_id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

	return response()->json($contacts);
}

	public function getMessagesFor($id)
{       
    Message::where('from', $id)->where('to', Auth::user()->uuid)->update(['read'=> true]);
    // dd($id);
	$messages = Message::where('from', $id)->orWhere('to', $id)->get();
	$messages = Message::where(function($q) use ($id) {
		$q->where('from', Auth::user()->uuid);
		$q->where('to', $id);
	})->orWhere(function($q) use ($id){

		$q->where('from', $id);
		$q->where('to', Auth::user()->uuid);
	})
	->get();
	return response()->json($messages);
}
public function getMessagesForNew($id)
{
    Message::where('from', $id)->where('to', Auth::user()->id)->update(['read'=> true]);


    $messages = Message::where('from', $id)->orWhere('to', $id)->get();
    $messages = Message::where(function($q) use ($id) {
        $q->where('from', auth()->id());
        $q->where('to', $id);
    })->orWhere(function($q) use ($id){

        $q->where('from', $id);
        $q->where('to', auth()->id());
    })
    ->get();
    return response()->json($messages);
}

		public function send(Request $request)

{	
	     $message = Message::create([
		'from' => Auth::user()->uuid,
		'to' => $request->contact_id,
		'text' => $request->text
]);
	     	broadcast(new NewMessage($message));
		return response()->json($message);
}

public function sendNew(Request $request)

{   
    // dd($request->all());
         $message = Message::create([
        'from' => auth()->id(),
        'to' => $request->contact_id,
        'text' => $request->text,
        'list_no' => "2"
]);
            broadcast(new NewMessage($message));
        return response()->json($message);
}
}
