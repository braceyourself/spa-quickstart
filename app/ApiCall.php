<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Api api
 * @property string method
 * @property string path
 */
class ApiCall extends Model
{
    protected $fillable = [
        'method',
        'path'
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

    public function api()
    {
        return $this->hasOneThrough(Api::class, ApiEndpoint::class);
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

}
