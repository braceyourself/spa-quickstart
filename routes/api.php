<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('insta', function(){
    $root = 'https://api/instagram.com/v1';
    $redirect_url = 'http://api.braceyourself.solutions/insta-callback';

    $client = new \GuzzleHttp\Client();
    $client_id = 'c49c60f5de314bfc92abd2d128d469e1';



    $insta_url = "https://api.instagram.com/oauth/authorize/?client_id=$client_id&redirect_uri=$redirect_url&response_type=code";
    return redirect($insta_url);

});

Route::group(['prefix' => 'ethanbrace.com'], function(){
    Route::get('/', function(){
        return 'hello world!';
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
