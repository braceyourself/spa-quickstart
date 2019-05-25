<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Api api
 * @property string method
 * @property string path
 * @property ApiEndpoint api_endpoint
 * @property string response
 * @property string status
 */
class ApiCall extends Model
{
    protected $fillable = [
        'method',
        'path',
        'status'
    ];



    protected $dispatchesEvents = [
        'created',
    ];



    /**********************************************
     * Relations
     **********************************************/
    public function api_endpoint()
    {
        return $this->belongsTo(ApiEndpoint::class);
    }

    /**********************************************
     * Methods
     **********************************************/
    public function getUri()
    {
        return $this->api->base_url . '/' . $this->path;
    }

    public function requestOptions(array $options = [])
    {
        $opts = [];
        switch ($this->api->auth_type->type) {
            case 'basic':
                $opts['auth'] = [
                    $this->api->client_id,
                    $this->api->client_secret
                ];
                break;
        }

        return array_merge($opts, $options);
    }


    /**********************************************
     * Attributes
     **********************************************/
    public function getApiAttribute(){
        return $this->api_endpoint->api;
    }

    public function getMethodAttribute(){
        return $this->api_endpoint->method;
    }

    public function getPathAttribute(){
        return $this->api_endpoint->path;
    }

}
