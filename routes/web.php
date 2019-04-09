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

    if ($request->code) {

        $client = new \GuzzleHttp\Client();
        $redirect = 'http://api.braceyourself.solutions/insta-callback';
        $code = $request->code;
        $form_params = [
            'client_id' => env('INSTAGRAM_ID'),
            'client_secret' => env('INSTAGRAM_SECRET'),
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirect,
            'code' => $code
        ];

        $response = $client->post("https://api.instagram.com/oauth/access_token", compact('form_params'));

        dd($response);

    } else
        dd($request->all());

});

Route::get('/inst/authenticated', function (Request $request) {
    dd($request->all());
});
