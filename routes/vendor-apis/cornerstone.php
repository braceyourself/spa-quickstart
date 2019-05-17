<?php use Illuminate\Http\Request;

Route::get('transactions',function(){
    return response([
        'transactions' => ['all of them','...']
    ]);
});

//Route::
