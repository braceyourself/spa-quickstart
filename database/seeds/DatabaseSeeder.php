<?php

use App\Api;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		$me = [
			'name' => env('MY_NAME'),
			'email' => env('MY_EMAIL'),
			'email_verified_at' => today(),
			'password' => bcrypt(env('MY_PASSWORD'))
		];

		if (!$user = User::where('email', $me['email'])){
			User::create($me);
		}

		Api::create([
			'name' => 'Random Foxes',
			'base_url' => 'https://randomfox.ca/floof/',
			'auth_type_id' => \App\ApiAuthType::firstOrCreate([
				'name' => 'none'
			])->id,
		]);
	}
}
