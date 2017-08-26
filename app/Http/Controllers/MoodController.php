<?php

namespace App\Http\Controllers;
use App\Mood;

use Illuminate\Http\Request;

class MoodController extends Controller
{
    public function index()
    {
    	return Mood::all();
    }
}
