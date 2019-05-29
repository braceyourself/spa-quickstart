<?php

use App\Mail\InspirationalEmail;
use App\Notifications\InspirationalNotification;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/


Artisan::command('inspire', function () {
	$dt = \Carbon\Carbon::now()->toDateTimeString();
	$users = \App\User::where('email', 'ethanabrace@gmail.com')->get();
	$users->each(function ($user) {
		/** @var \App\User $user */

		$data = [
			'user' => $user,
			'quote' => Inspiring::quote()
		];

		$user->notify(new InspirationalNotification($data));
//		Mail::send('email.inspire', $data, function ($m) use ($user) {
////			$m->from('hello@app.com', 'Your Application');
//			$m->to($user->email, $user->name)->subject('Your Inspiration!');
//		});
	});
//    $this->comment("[$dt] ".Inspiring::quote());

})->describe('Display an inspiring quote');


//Artisan::command('cornerstone:getTransactions');
