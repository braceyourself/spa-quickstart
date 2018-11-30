<?php

namespace App\Http\Controllers;

use App\Imports\MasterImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller {

    public function import() {

        Excel::import(new MasterImport(), request()->file('file'));

    }

}
