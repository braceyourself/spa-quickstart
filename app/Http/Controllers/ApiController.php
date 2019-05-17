<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{
    public function call_vendor_api(Request $request)
    {
//        dd($request->all());
        $client_id = 'test_3kdyN4LepSQxKYFx2uYa';
        $key = 'test_PR5OMgJ498wNRGrv4tLgwFHub';
        $options = [
            'auth' => [$client_id, $key]
        ];
        $base_url = 'https://api.cornerstone.cc/api/v1';
        $url = $base_url . '/transactions?show_test=true';
        $client = new Client();
        $req = new \GuzzleHttp\Psr7\Request('GET', $base_url . '/transactions?show_test=true');
        $response = $client->get($url, $options);
        dd(json_decode($response->getBody()->getContents()));

        $promise = $client->sendAsync($req,$options)->then(function ($response) {
            dd(json_decode($response->getBody()->getContents()));
        });
//        $promise->wait();


    }

}
