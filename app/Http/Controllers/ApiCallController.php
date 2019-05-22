<?php

namespace App\Http\Controllers;

use App\ApiCall;
use Illuminate\Http\Request;

class ApiCallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ApiCall::all();
    }

}
