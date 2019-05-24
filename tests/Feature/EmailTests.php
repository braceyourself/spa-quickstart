<?php

namespace Tests\Feature;

use App\Notifications\TestNotify;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTests extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEmailNotifications()
    {

//        Mail::fake();
//        Notification::fake();

        /** @var User $user */
        $user = User::firstOrCreate([
            'password'=>'test',
            'email' => 'ethanabrace@gmail.com',
            'name'=>'hellow world'
        ]);

        $user->notify(new TestNotify());


    }
}
