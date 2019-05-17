<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * @group Users
 *
 * Get your user or all the users or a single user.
 * should be authenticated
 */
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('apis', 'ApiController');

Route::get('frc', function(){
    return response([
        'message' => 'hello world!'
    ]);
});


