<?php

namespace App\Listeners;

use App\ApiCall;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class ListenForApiCalls
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ApiCall $call)
    {
		Log::Info('Api Called', $call->toArray());
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
    }
}
