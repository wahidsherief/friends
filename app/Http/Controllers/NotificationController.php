<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\NotificationEvent;
use Auth;

class NotificationController extends Controller
{
    public function readNotification()
    {
    	event(new NotificationEvent('hi'));
    }

    public function markAsRead()
    {
    	Auth::user()->unreadNotifications->markAsRead();
    }

    public function getNavInfo()
    {
    	$nav_info = [
    		'userID' => Auth::user()->id,
	    	'username' => Auth::user()->firstname.' '.Auth::user()->lastname,
	    	'profile_pic' => Auth::user()->profile_pic,
	    	'unreads' => Auth::user()->unreadNotifications
    	]; 

    	return $nav_info;

    }
}
