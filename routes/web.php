<?php

Route::get('/', function () {
    return view('welcome');
});


//Route::get('test', function(){
//
//
//    \App\FRC\Test::create([
//        'id' => 100
//    ]);
//    echo '<div>FRC</div>';
//    dump(\App\FRC\Test::all());
//
//
//    \App\FRCA\Test::create([
//        'id' => 1000
//    ]);
//    echo '<div>FRCA</div>';
//    dump(\App\FRCA\Test::all());
//
//});


Route::get('test_api_call','ApiController@call_vendor_api');
