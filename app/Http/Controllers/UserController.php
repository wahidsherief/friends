<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function getUserInfo()
    {
    	return User::find(\Auth::id())->first();
    }

    public function updateBasicInfo(Request $request)
    {
    	$user = User::find(\Auth::id())->first();
    	$fields = $request->all();
    	foreach ($fields as $key => $field) {
    		if ($field != NULL && $field != '' && $field != 'Day' && $field != 'Month' && $field != 'Year' && $field != 'Choose your gender' && $field != 'Choose your religion') {

    			$user->$key = $field;
    		}
    	}

    	$user->save();
    }
}

