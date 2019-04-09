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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('insta-callback', function(Request $request){
    $client = new \GuzzleHttp\Client();
    $client_id = 'c49c60f5de314bfc92abd2d128d469e1';
    $client_secret = '43e24660e0c740b5a2ef61a79ea275f4 ';
    $redirect = '/inst/authenticated';
    $code = $request->code;

    $client->request('POST', "https://api.instagram.com/oauth/access_token",[
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'grant_type' => 'authorization_code',
        'redirect_uri' => $redirect,
        'code' => $code
    ]);
});

Route::get('/inst/authenticated', function(Request $request){
    dd($request->all());
});
