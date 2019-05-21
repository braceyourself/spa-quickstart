<?php

namespace App;

use App\Events\ApiCalled;
use Illuminate\Database\Eloquent\Model;

class ApiCall extends Model
{
	protected $dispatchesEvents = [
		'created' => ApiCalled::class
	];
}
