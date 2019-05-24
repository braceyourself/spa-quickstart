<?php

namespace Tests\Feature;

use App\Api;
use App\ApiAuthType;
use App\Vendor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTests extends TestCase
{
//    use DatabaseTransactions;

    /**
     * @test
     * A basic feature test example.
     *
     * @return void
     */
    public function calling_an_api_creates_a_new_api_call_record()
    {

        /** @var Api $api */
        $api = Vendor::firstOrCreate([
            'name' =>'test-vendor'
        ])->apis()->save(Api::firstOrCreate([
            'base_url' => 'google.com',
            'auth_type_id' => ApiAuthType::firstOrCreate(['type'=>'basic'])->id
        ]));

        $api_call = $api->call();
//        dd($api->calls()->get());

//        dd($api_call);

        $this->assertTrue(optional($api_call)->exists);
    }
}
