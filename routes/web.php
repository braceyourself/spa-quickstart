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
    dd($form_params);

    $response = $client->post($uri, compact('form_params'));
    dd($response->all());


});

Route::get('/insta/authenticated', function (Request $request) {
    dd($request->all());
});
