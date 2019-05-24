<?php

use App\Api;
use App\ApiAuthType;
use App\ApiEndpoint;
use App\User;
use App\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTables();


        /** @var User $user */
        $user = User::create([
            'name'=>'Ethan Brace',
            'email'=> 'eab@frc.org',
            'password' => bcrypt(env('MY_PASSWORD'))
        ]);




        ApiAuthType::create([
            'type' => 'basic'
        ]);
        $vendor = Vendor::create([
            'name' => 'Cornerstone Payments',
        ]);

        /** @var \App\Api $api */
        $api = $vendor->apis()->save(new Api([
            'client_id' => 'test_3kdyN4LepSQxKYFx2uYa',
            'client_secret' => 'test_PR5OMgJ498wNRGrv4tLgwFHub',
            'base_url' => 'https://api.cornerstone.cc/v1',
            'auth_type_id' => ApiAuthType::where('type', 'basic')->first()->id,
        ]));

        $api->newEndpoint('transactions?show_test=true')->addSchedule('everyMinute');
        $api->newEndpoint('transactions')->addSchedule('everyMinute');
//        $api->addEndpoint('transactions', 'POST')->addSchedule('everyMinute');

    }

    private function truncateTables()
    {
        $tables = [
            'apis',
            'users',
            'api_calls',
            'api_endpoints',
            'api_auth_types',
            'endpoint_call_schedules',
            'vendors',
        ];
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
    }
}
