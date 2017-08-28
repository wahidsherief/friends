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

    public function updateProfilePic(Request $request)
    {
        $user = User::find(\Auth::id())->first();
        $image = $request->image[0];

        $profile_pic  = '/user/images/profile/'.$this->uploadProfilePic($image);
        $user->profile_pic = $profile_pic;
        $user->save();
    }

    private function uploadProfilePic($image) {
        $exploded = explode(',', $image);
        $decoded = base64_decode($exploded[1]);
        $explode = explode('/',$exploded[0]);
        $extension = explode(';',$explode[1]);
        $file_name = uniqid().'_'.str_random().'.'.$extension[0];
        $path = public_path().'/user/images/profile/'.$file_name;
        file_put_contents($path, $decoded);

        return $file_name;
    }
}

