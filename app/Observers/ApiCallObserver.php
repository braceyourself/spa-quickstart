<?php

namespace App\Observers;

use App\ApiCall;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

class ApiCallObserver
{
    /**
     * Handle the api call "created" event.
     *
     * @param  \App\ApiCall  $apiCall
     * @return void
     */
    public function created(ApiCall $apiCall)
    {

    }

    /**
     * Handle the api call "updated" event.
     *
     * @param  \App\ApiCall  $apiCall
     * @return void
     */
    public function updated(ApiCall $apiCall)
    {
        if($apiCall->finished){

        }

    }

    /**
     * Handle the api call "deleted" event.
     *
     * @param  \App\ApiCall  $apiCall
     * @return void
     */
    public function deleted(ApiCall $apiCall)
    {
        //
    }

    /**
     * Handle the api call "restored" event.
     *
     * @param  \App\ApiCall  $apiCall
     * @return void
     */
    public function restored(ApiCall $apiCall)
    {
        //
    }

    /**
     * Handle the api call "force deleted" event.
     *
     * @param  \App\ApiCall  $apiCall
     * @return void
     */
    public function forceDeleted(ApiCall $apiCall)
    {
        //
    }
}
