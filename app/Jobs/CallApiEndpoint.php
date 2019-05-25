<?php

namespace App\Jobs;

use App\ApiCall;
use App\ApiEndpoint;
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
     * @var ApiEndpoint
     */
    private $endpoint;
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
     * @param ApiEndpoint $endpoint
     * @param array $params
     * @param array $headers
     */
    public function __construct(ApiEndpoint $endpoint, array $params = [], array $headers = [])
    {
        $this->endpoint = $endpoint;
        $this->headers = $headers;
        $this->call = $endpoint->api_calls()->save(new ApiCall([
            'status' => 'PENDING',
            'request' => $params
        ]));
//        $this->client = new Client([
//            'base_uri' => $this->endpoint->api->base_url,
//        ]);

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

//        $request = new Request($this->call->method, $this->call->getUri(),$this->headers);
//        dd($request);


        try {
//            dd($client->getConfig());
            $response = $client->request($this->call->method, $this->call->getUri());

            $this->call->response = json_decode($response->getBody()->getContents());
            $this->call->status = $response->getStatusCode();
            $this->call->save();
        } catch (RequestException $e) {
//            $this->fail($e);

//            $this->job->fail($e);


            $this->failed($e);
        }


    }


    public function failed(\Exception $e)
    {
//        $users = User::where('email','like','ethan%')->get();


        $this->call->response = json_decode($e->getResponse()->getBody()->getContents());
        $this->call->status = $e->getCode();
        $this->call->save();

//        Notification::send($users, new ApiEndpointFail);

    }
}
