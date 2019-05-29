<?php

namespace Tests\Feature;

use App\Api;
use App\ApiCall;
use App\ApiResource;
use App\Jobs\CallApiEndpoint;
use App\Vendor;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiEndpointTests extends TestCase
{
//    use DatabaseTransactions;
    use DispatchesJobs;


    /**
     * @test
     * @return void
     */
    public function test_available_endpoints()
    {
        $vendors = Vendor::all();


        $vendors->each(function (Vendor $vendor) {
            $vendor->apis->each(function (Api $api) {
                $api->endpoints->each(function (ApiResource $e) {
                    /** @var CallApiEndpoint $job */
                    $api_call = $e->call();

                    Queue::after(function(JobProcessed $event){
                        $failed = $event->job->hasFailed();
                        $this->assertNotTrue($failed);

                    });

                });
            });

        });

//        $response->assertStatus(200);
    }

    public function test_jobs_get_queued()
    {
        Queue::fake();

        $vendors = Vendor::all();
        $vendors->each(function (Vendor $vendor) {
            $vendor->apis->each(function (Api $api) {
                $api->endpoints->each(function (ApiResource $e) {
                    $e->call();
                });
                Queue::assertPushed(CallApiEndpoint::class, $api->endpoints->count());
            });

        });

    }
    public function test_jobs_get_dispatched()
    {
        Bus::fake();

        $vendors = Vendor::all();
        $vendors->each(function (Vendor $vendor) {
            $vendor->apis->each(function (Api $api) {
                $api->endpoints->each(function (ApiResource $e) {
                    $e->call();
                });
                Bus::assertDispatched(CallApiEndpoint::class, $api->endpoints->count());
            });

        });

    }
}
