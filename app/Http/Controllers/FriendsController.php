<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Notifications\Notifications;
use App\Notifications\SendFriendRequest;

class FriendsController extends Controller
{

    // public function index()
    // {
    // 	$user = User::find(Auth::id());
    // 	$all_friends = $user->getAllFriendships();
    // 	dd($all_friends);
    // 	$total_friend = count($all_friends);
    // 	$except_friend[0] = $user->recipient_id ;
    // 	$j=0;
    // 	for($i=1; $i<=$total_friend; $i++) {
    // 		$except_friend[$i] = $all_friends[$j]->id;
    // 		$j++;
    // 	}

    // 	$friends = User::whereNotIn('id', $except_friend)->get(['id', 'firstname', 'lastname']);

    // 	foreach ($friends as $friend) {
    // 		$request_sent = $user->hasSentFriendRequestTo($friend);
    // 		$mutual_friend_count = $user->getMutualFriendsCount($friend);
    // 		$friend->requestSent = $request_sent;
    // 		$friend->mutualFriendCount = $mutual_friend_count;
    // 	}
    	
    // 	return $friends;
    // }

    public function getAllFriends()
    {
    	$user = User::find(Auth::id());
    	$all_friends = $user->getAllFriendships();
    	$total_friend = count($all_friends);
    	$except_friend[0] = $user->id ;
    	$j=0;
    	for($i=1; $i<=$total_friend; $i++) {
    		$except_friend[$i] = $all_friends[$j]->recipient_id;
    		$j++;
    	}

    	$friends = User::whereNotIn('id', $except_friend)->get(['id', 'firstname', 'lastname']);

    	foreach ($friends as $friend) {
    		$request_sent = $user->hasSentFriendRequestTo($friend);
    		$mutual_friend_count = $user->getMutualFriendsCount($friend);
    		$friend->requestSent = $request_sent;
    		$friend->mutualFriendCount = $mutual_friend_count;
    	}
    	
    	return $friends;
    }

    public function getFriendRequests()
    {
    	$user = User::find(Auth::id());
    	$senders = $user->getFriendRequests();
    	$friends = array();
    	$i=0;
    	foreach ($senders as $sender) {
    		$friends[$i] = User::where('id', $sender->sender_id)->first(['id', 'firstname', 'lastname']);
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

        $recipient->notify(new SendFriendRequest($sender));
    	
    	return response()->json($request_sent);
    }

    public function acceptFriendRequest(Request $request)
    {
    	$request_sender_id = $request->id;
    	$user = new User;
    	$request_acceptor = $user->find(Auth::id());
    	$request_sender = $user->find($request_sender_id);

    	$request_accepted = $request_acceptor->acceptFriendRequest($request_sender);

        $request_acceptor->notification_type = 'accept_request';

        $request_sender->notify(new Notifications($request_acceptor));
    	
    	return response()->json($request_accepted);
    }

    public function cancelFriendRequest(Request $request)
    {
    	$request_sender_id = $request->id;
    	$user = new User;
    	$request_canceler = $user->find(Auth::id());
    	$request_sender = $user->find($request_sender_id);

    	$request_canceled = $request_canceler->denyFriendRequest($request_sender);
    	
    	return response()->json($request_canceled);
    }

    public function getFriendList()
    {
    	$user = User::find(Auth::id());
    	$friends = $user->getFriends();

    	return $friends;
    }

    public function unfriend(Request $request)
    {
    	$unfriend_id = $request->id;
    	$user = new User;
    	$user_doing_unfriend = $user->find(Auth::id());
    	$user_being_unfriend = $user->find($unfriend_id);

    	$unfriended = $user_doing_unfriend->unfriend($user_being_unfriend);
    	
    	return response()->json($unfriended);
    }
}
