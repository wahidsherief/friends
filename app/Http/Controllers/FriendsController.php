<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class FriendsController extends Controller
{

    public function index()
    {
    	$user = User::find(2);
    	$senders = $user->getFriendRequests();
    	$i=0;
    	foreach ($senders as $sender) {
    		$friends[$i] = User::find($sender->sender_id)->first(['id', 'firstname', 'lastname']);
    		$i++;
    	}
    	
    	
    	dd(collect($friends));
    }

    public function getAllFriends()
    {
    	$sender = User::find(Auth::id());
    	$friends = User::where('id', '!=', Auth::id())->get(['id', 'firstname', 'lastname']);
    	foreach ($friends as $friend) {
    		$request_sent = $sender->hasSentFriendRequestTo($friend);
    		$friend->requestSent = $request_sent;
    	}
    	
    	return $friends;
    }

    public function getFriendRequests()
    {
    	// $sender = User::find(Auth::id());
    	// $friends = User::where('id', '!=', Auth::id())->get(['id', 'firstname', 'lastname']);
    	$user = User::find(2);
    	$senders = $user->getFriendRequests();
    	$i=0;
    	foreach ($senders as $sender) {
    		$friends[$i] = User::find($sender->sender_id)->first(['id', 'firstname', 'lastname']);
    		$i++;
    	}
    	
    	return collect($friends);
    }

    public function addFriend(Request $request)
    {
    	$recipientID = $request->id;
    	$user = new User;
    	$sender = $user->find(Auth::id());
    	$recipient = $user->find($recipientID);

    	$sender->befriend($recipient);

    	$request_sent = $sender->hasSentFriendRequestTo($recipient);
    	
    	return response()->json($request_sent);
    }
}
