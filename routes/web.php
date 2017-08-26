<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test', function () {
// 	$x = "'firstname' => 'wahid', 'lastname' => 'rocksss'";
//    App\User::where('id',\Auth::id())->update([$x]);

// });

Route::get('test2', 'DashboardController@getPosts');

Route::get('/', function () {
    if (Auth::check()) {
        return view('user.dashboard');
    } else {
        return view('site.index');
    }
});


Route::get('signin', 'AuthController@showSignIn');
Route::get('signup', 'AuthController@showSignUp');
Route::post('signup', 'AuthController@registerUser');
Route::post('signin', ['as' => 'login', 'uses' => 'AuthController@loginUser']);
Route::get('logout', 'AuthController@logout');

Route::get('profile', 'ProfileController@index');

Route::get('posts', 'DashboardController@getPosts');
Route::post('posts', 'DashboardController@insertPost');
Route::post('getcomments', 'DashboardController@getComments');
Route::post('comments', 'DashboardController@insertComment');

Route::get('react', 'ReactController@createReaction');
Route::post('react', 'ReactController@saveReaction');

Route::get('getMoods', 'MoodController@index');

Route::get('get_user_info', 'UserController@getUserInfo');
Route::post('update_basic_info', 'UserController@updateBasicInfo');

