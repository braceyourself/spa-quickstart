<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EndpointTests extends TestCase
{
    /** @test a visitor can visit the home page */
    public function a_visitor_can_visit_the_home_page(){

        $response = $this->get('/');

        $response->assertStatus(200);

    }

}
