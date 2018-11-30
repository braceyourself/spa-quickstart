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

use App\Http\Controllers\UserController;

Route::post('/import', 'UserController@import');

Route::get('/{catchall?}', function(){
    return view('master');
})->where('catchall','[\/\w\.-]*');
