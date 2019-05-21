<?php

namespace App\Http\Controllers;

use App\Api;
use App\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function index(){
        return Vendor::with('apis')->get();
    }

    public function create(){
        return view('vendors.create');
    }

    public function callApi(Request $request, Vendor $vendor, Api $api){
        $api->call();
        return redirect("/api/vendors/$vendor->id/api-calls");
    }

    public function apiCalls(Request $request, Vendor $vendor){
        return $vendor->apis->map(function(Api $api){
            return $api->calls();
        });
    }

}
