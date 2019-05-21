<?php

namespace App\Http\Controllers;

use App\VendorData;
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
        $url = $base_url . '/transactions?show_test=true&include_gid=true';
        $client = new Client();
        $response = $client->get($url, $options);

        $existing_transactions = VendorData::first();
        dd($existing_transactions);

        dd(json_decode($response->getBody()->getContents()));


    }

}
