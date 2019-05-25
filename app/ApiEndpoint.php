<?php

namespace App;

use App\Jobs\CallApiEndpoint;
use App\Rules\IsValidFrequency;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;
use Illuminate\Validation\Validator;

/**
 * @property string path
 * @property Collection $api_calls
 * @property Api api
 */
class ApiEndpoint extends Model
{

    protected $fillable = ['path','store_in_table','method'];



    /**********************************************
     * Relations
     **********************************************/
    public function api()
    {
        return $this->belongsTo(Api::class);
    }

    public function schedule(){
        return $this->hasMany(EndpointCallSchedule::class,'endpoint_id');
    }

    public function api_calls(){
        return $this->hasMany(ApiCall::class);
    }


    /**********************************************
     * Methods
     *********************************************/


    /**
     * @param array $params
     * @param array $headers
     * @return ApiCall
     */
    public function call(array $params = [], array $headers = []){
        $job = new CallApiEndpoint($this, $params, $headers);
        dispatch($job);
        return $job->call;
    }


    public function callAndWait(array $params = [], array $headers = []){
        $job = new CallApiEndpoint($this, $params, $headers);
        Bus::dispatchNow($job);
        return $job->call;
    }


    /**
     * @param string $frequency
     */
    public function addSchedule($frequency = '* * * * *'){

        $this->schedule()->save(EndpointCallSchedule::withFrequency($frequency));

    }


    /**********************************************
     * Attributes
     **********************************************/
    public function getFullPathAttribute(){
        return $this->api->base_url . '/' . $this->path;
    }

}
