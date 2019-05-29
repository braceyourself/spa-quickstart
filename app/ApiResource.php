<?php

namespace App;

use App\Jobs\CallApiEndpoint;
use App\Rules\IsValidFrequency;
use Illuminate\Console\Scheduling\ManagesFrequencies;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;
use Illuminate\Validation\Validator;
use Zttp\Zttp;

/**
 * @property string resource
 * @property Api api
 */
class ApiResource extends Model
{
    protected $fillable = ['resource','store_in_table','method'];




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
    public function call($method = 'get', array $params = [], array $headers = []){
        $job = new CallApiEndpoint($this, $method, $params, $headers);
        dispatch($job);
        return $job->call;
    }


    /**
     * @param string $method
     * @param array $params
     * @param array $headers
     * @return ApiCall|false|Model
     */
    public function callAndWait($method = 'get', array $params = [], array $headers = []){
        $job = new CallApiEndpoint($this, $method, $params, $headers);
        Bus::dispatchNow($job);
        return $job->call;
    }




    public function get($id = null){
        return $this->callAndWait()->response;

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
        return $this->api->base_url . '/' . $this->resource;
    }

}
