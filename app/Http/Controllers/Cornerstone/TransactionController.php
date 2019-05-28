<?php

namespace App\Http\Controllers\Cornerstone;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $client;
    public function __construct()
    {
        $this->client = new Client([]);
    }

    public function index(Request $request){
        return ;
    }
}
