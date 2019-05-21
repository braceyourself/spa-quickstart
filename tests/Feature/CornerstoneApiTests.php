<?php

namespace Tests\Feature;

use App\Vendor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CornerstoneApiTests extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     * @return void
     */
    public function we_can_create_a_transaction()
    {
        Artisan::call('db:seed');

        $cornerstone = Vendor::where('name', 'Cornerstone Payments')->first();
        $response = $cornerstone->get('/transactions');
        dd($response);
//        $response->assertStatus(200);
    }
}
