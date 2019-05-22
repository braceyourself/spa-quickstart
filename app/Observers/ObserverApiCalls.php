<?php

namespace App\Observers;

use Illuminate\Support\Facades\Log;

class ObserverApiCalls
{
	public function created() {
		Log::info('making call to api');
    }
}
