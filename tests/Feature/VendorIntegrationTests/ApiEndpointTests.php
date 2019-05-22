<?php

namespace Tests\Feature;

use App\Api;
use App\ApiCall;
use App\ApiEndpoint;
use App\Vendor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiEndpointTests extends TestCase
{
//    use DatabaseTransactions;


    /**
     * @test
     * @return void
     */
    public function test_available_endpoints()
    {
        $vendors = Vendor::all();
        $vendors->each(function(Vendor $vendor){
            $vendor->apis->each(function(Api $api){
                $api->endpoints->each(function(ApiEndpoint $e){
                    $this->assertTrue($e->call() instanceof ApiCall);
                });
            });



        });

//        $response->assertStatus(200);
    }
}
