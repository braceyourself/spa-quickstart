<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


/**
 * @group Users
 *
 * Get your user or all the users or a single user.
 * should be authenticated
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cc/transactions/callback', function(){
    Log::info('got a callbakc', request());
});

Route::resource('vendors', 'VendorController');
Route::get('vendors/{vendor}/api-calls', 'VendorController@apiCalls');
Route::get('vendors/{vendor}/call-api/{api}', 'VendorController@apiCalls');
Route::resource('api-calls', 'ApiCallController');
//Route::get('vendor')


Route::resource('users', 'UserController');
Route::resource('apis', 'ApiController');
Route::resource('cornerstone/transactions', 'Cornerstone\TransactionsController');

