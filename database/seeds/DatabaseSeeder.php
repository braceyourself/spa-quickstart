<?php

use App\Api;
use App\ApiAuthType;
use App\ApiEndpoint;
use App\User;
use App\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tables = [
            'apis',
			'users',
            'api_calls',
            'api_auth_types',
            'vendors',
        ];
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

		User::create([
			'name' => 'Ethan Brace',
			'email' => 'ethanabrace@gmail.com',
			'password' => bcrypt(env('MY_PASSWORD'))
		]);


        ApiAuthType::create([
            'type' => 'basic'
        ]);
        $vendor = Vendor::create([
            'name' => 'Cornerstone Payments',
        ]);

        $api = $vendor->apis()->save(new Api([
            'client_id' => 'test_3kdyN4LepSQxKYFx2uYa',
            'client_secret' => 'test_PR5OMgJ498wNRGrv4tLgwFHub',
            'base_url' => 'https://api.cornerstone.cc/v1',
            'auth_type_id' => ApiAuthType::where('type', 'basic')->first()->id,
        ]));

        $api->addEndpoint('/transactions');
    }
}
