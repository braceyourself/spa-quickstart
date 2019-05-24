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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

//Auth::routes();
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');





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

