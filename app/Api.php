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

    public function endpoints()
    {
        return $this->hasMany(ApiEndpoint::class);
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
            $endpoint = $this->newEndpoint($path);
        }

        return $endpoint->api_calls()->save(new ApiCall([
            'method' => $method
        ]));

    }

    public function get($path)
    {
        $endpoint = ApiEndpoint::where('path', $path)->first();
        return $this->call($endpoint);
    }

    /**
     * @param $path
     * @param string $method
     * @param null $storeInTable
     * @return false|ApiEndpoint
     */
    public function newEndpoint($path, $method = 'GET', $storeInTable = null)
    {
        $endpoint = $this->makeEndpoint($path, $method, $storeInTable);
        $endpoint->save();
        return $endpoint;
    }

    public function makeEndpoint($path, $method = 'GET', $storeInTable = null)
    {
        return $this->endpoints()->firstOrNew([
            'path' => $path,
            'method' => $method,
            'store_in_table' => $storeInTable
        ]);

    }

    public function typeOf($type_name)
    {
        return $this->auth_type->type === $type_name;
    }


}
