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

use App\Http\Controllers\Auth\LoginController;
use App\Jobs\InviteNewUsers;
use App\Notifications\TestNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('test',function(){
    $user = \App\User::first();

    $user->notify(new TestNotify());
    dd($user);
});
//Auth::routes();
Route::post('login', 'Auth\LoginController@login');
//Route::get('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout');

Route::get('insta-callback', function (Request $request) {


	$client = new \GuzzleHttp\Client();
	$uri = "https://api.instagram.com/oauth/access_token";
	$form_params = [
		'client_id' => env('INSTAGRAM_ID'),
		'client_secret' => env('INSTAGRAM_SECRET'),
		'grant_type' => 'authorization_code',
		'redirect_uri' => env('INSTAGRAM_CALLBACK'),
		'code' => $request->code
	];

	$response = $client->post($uri, compact('form_params'))->getBody();
	$data = json_decode($response->getContents());

	Session::put('INSTA_ACCESS', $data->access_token);
	Session::put('INSTA_USER', $data->user);
	Session::save();

	return redirect('insta-feed');


});

Route::get('insta-feed', function () {
	return view('insta-feed');
});

Route::get('/insta/authenticated', function (Request $request) {
	dd($request->all());
});

Route::get('insta-key', function () {
	return 'key from web';
});


//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::post('invite-user', function(Request $request){
	InviteNewUsers::dispatch([$request->all()]);
});
Route::get('csrf-token', function () {
	return csrf_token();
});

Route::get('{catchall?}', function (Request $request) {
	$fields = [
		'showRegister' => Route::has('register'),
		'user' => Auth::user(),
		'guest' => Auth::guest(),
        'session' => Session::all(),
		'csrfToken' => csrf_token(),
		'appName' => config('app.name'),
	];
	return view('layouts.app', compact('fields'));
})->where('catchall', '^(?!api).*$');

