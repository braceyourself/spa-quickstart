<?php

use Illuminate\Http\Request;


/**
 * @group Users
 *
 * Get your user or all the users or a single user.
 * should be authenticated
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('vendors', 'VendorController');
Route::get('vendors/{vendor}/api-calls', 'VendorController@apiCalls');
Route::get('vendors/{vendor}/call-api/{api}', 'VendorController@apiCalls');
Route::resource('api-calls', 'ApiCallController');
//Route::get('vendor')


