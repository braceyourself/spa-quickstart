<?php

namespace App;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property ApiAuthType auth_type
 * @property string base_url
 * @property string client_id
 * @property string client_secret
 * @property Collection endpoints
 */
class Api extends Model
{

    protected $fillable = [
        'base_url', 'auth_type_id'
    ];
    protected $casts = [
        'vendor_id' => 'integer',
        'auth_type_id' => 'integer'
    ];

    /**********************************************
     * Relations
     **********************************************/
    public function auth_type()
    {
        return $this->belongsTo(ApiAuthType::class);
    }

    public function calls()
    {
        return $this->hasMany(ApiCall::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function resources()
    {
        return $this->hasMany(ApiResource::class);
    }

    /**********************************************
     * Methods
     *********************************************/

    /**
     * @param string $path
     * @param string $method
     */
    public function call($path = '/', $method = 'get')
    {
        $endpoint = $this->endpoints->where('path', $path)->first();
        if (!$endpoint) {
            $endpoint = $this->newResource($path);
        }

        return $endpoint->api_calls()->save(new ApiCall([
            'method' => $method
        ]));

    }

    public function get($path)
    {
        $endpoint = ApiResource::where('path', $path)->first();
        return $this->call($endpoint);
    }

    /**
     * @param $resource
     * @param string $method
     * @param null $storeInTable
     * @return false|ApiResource
     */
    public function newResource($resource, $storeInTable = null)
    {
        $resource = $this->makeResource($resource, $storeInTable);
        $resource->save();
        return $resource;
    }

    public function makeResource($resource, $storeInTable = null)
    {
        return $this->resources()->firstOrNew([
            'resource' => $resource,
            'store_in_table' => $storeInTable
        ]);

    }

    public function typeOf($type_name)
    {
        return $this->auth_type->type === $type_name;
    }


}
