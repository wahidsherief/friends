<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class FriendsController extends Controller
{

    public function getAllFriends()
    {
    	return User::where('id', '!=', Auth::id())->get();
    }

    public function addFriend(Request $request)
    {
    	$recipientID = $request->id;
    	$user = new User;
    	$sender = $user->find(Auth::id());
    	$recipient = $user->find($recipientID);

    	$sender->befriend($recipient);

    	return 1;
    }
}
