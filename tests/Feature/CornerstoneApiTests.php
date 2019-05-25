<?php

namespace Tests\Feature;

use App\Api;
use App\ApiAuthType;
use App\Jobs\CallApiEndpoint;
use App\Jobs\Job;
use App\Vendor;
use Faker\Factory;
use http\Url;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CornerstoneApiTests
 * @package Tests\Feature
 *
 * @property Api $api
 */
class CornerstoneApiTests extends TestCase
{
    use DatabaseTransactions;


    private $api;
    private $vendor;

    protected function setUp(): void
    {
        parent::setUp();

        ApiAuthType::firstOrCreate([
            'type' => 'basic'
        ]);
        $this->vendor = Vendor::create([
            'name' => 'Cornerstone Payments',
        ]);

        $this->api = $this->vendor->apis()->save(new Api([
            'client_id' => 'test_3kdyN4LepSQxKYFx2uYa',
            'client_secret' => 'test_PR5OMgJ498wNRGrv4tLgwFHub',
            'base_url' => 'https://api.cornerstone.cc/v1',
            'auth_type_id' => ApiAuthType::where('type', 'basic')->first()->id,
        ]));

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetTransactions()
    {
        $ep = $this->api->newEndpoint('transactions','GET');
        dd($ep->full_path);
        $response = $this->get($ep->full_path);
        dd($response->getContent());

    }
}
