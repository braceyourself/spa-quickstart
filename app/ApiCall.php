<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Api api
 * @property string method
 * @property string path
 * @property ApiResource api_endpoint
 * @property array response
 * @property array request
 * @property string status
 */
class ApiCall extends Model
{
    protected $fillable = [
        'method',
        'path',
        'status',
        'request'
    ];

    protected $casts = [
        'response' => 'array',
        'request' => 'array'
    ];



    protected $dispatchesEvents = [
        'created',
    ];



    /**********************************************
     * Relations
     **********************************************/
    public function api_resource()
    {
        return $this->belongsTo(ApiResource::class);
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
