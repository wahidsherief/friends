<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function __construct() 
    {
    	$this->middleware('guest', ['except' => 'logout']);
    }

    public function showSignIn()
    {
    	return view('user.signin');
    }

    public function showSignUp()
    {
    	return view('user.signup');
    }

   	public function registerUser() 
   	{
   		$this->validate(request(), [
   			'email' => 'required|email',
   			'name' => 'required',
   			'password' => 'required|min:4|confirmed'
   		]);

   		$user = User::create(request(['email', 'name', 'password']));

   		auth()->login($user);

   		return redirect()->intended('/');
   	}

   	public function loginUser()
   	{
   		$this->validate(request(), [
   			'email' => 'required|email',
   			'password' => 'required'
   		]);

   		if (! auth()->attempt(request(['email', 'password']))) {
   			return back()->withErrors([
   					'message' => 'Please check your credentials and try again'
   				]);
   		}

   		return redirect('/');
   	}

   	public function logout()
   	{
   		auth()->logout();
   	    return redirect('/');
   	}
}
