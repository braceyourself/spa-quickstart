<?php

namespace App\Jobs;

use App\ApiCall;
use App\ApiResource;
use App\Notifications\ApiEndpointFail;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Psr\Http\Message\ResponseInterface;

class CallApiEndpoint implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var ApiResource
     */
    private $resource;
    /**
     * @var array
     */
    private $headers;
    /**
     * @var Client
     */
    private $client;

    /**
     * @var ApiCall
     */
    public $call;

    /**
     * Create a new job instance.
     *
     * @param ApiResource $resource
     * @param string $method
     * @param array $params
     * @param array $headers
     */
    public function __construct(ApiResource $resource, $method = 'get', array $params = [], array $headers = [])
    {
        $this->resource = $resource;
        $this->headers = $headers;
        $this->call = $resource->api_calls()->save(new ApiCall([
            'status' => 'PENDING',
            'request' => $params,
            'method' => $method
        ]));

    }

    /**
     * Execute the job.
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {

        $client = new Client($this->call->requestOptions([
            'form_params' => $this->call->request
        ]));


        try {
            $response = $client->request($this->call->method, $this->call->getUri());

            $this->call->response = json_decode($response->getBody()->getContents());
            $this->call->status = $response->getStatusCode();
            $this->call->save();
        } catch (RequestException $e) {
            $this->failed($e);
        }


    }


    public function failed(\Exception $e)
    {

        $this->call->response = json_decode($e->getResponse()->getBody()->getContents());
        $this->call->status = $e->getCode();
        $this->call->save();

    }
}
