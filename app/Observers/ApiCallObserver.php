<?php

namespace App\Observers;

use App\ApiCall;
use GuzzleHttp\Client;

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
        $client = new Client($apiCall->requestOptions());
        $response = $client->request($apiCall->method, $apiCall->getUri());

        $apiCall->response = $response->getBody()->getContents();
        $apiCall->save();
    }

    /**
     * Handle the api call "updated" event.
     *
     * @param  \App\ApiCall  $apiCall
     * @return void
     */
    public function updated(ApiCall $apiCall)
    {
        //
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
