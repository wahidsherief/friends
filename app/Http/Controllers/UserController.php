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
        $image = $request->image;

        if (isset($image) || !empty($image) || $image != null) {
                $profile_pic  = '/user/images/profile/'.$this->uploadProfilePic($image);
                $user->profile_pic = $profile_pic;
                $user->save();
        } else {
            $image_file = '';
        }
    }

    private function uploadProfilePic($image) {
        $file_name = uniqid().'_'.$image;
        $path = public_path().'/user/images/profile/'.$file_name;
        file_put_contents($path, $file_name);

        return $file_name;
    }
}

