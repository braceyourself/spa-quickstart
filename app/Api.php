<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property ApiAuthType auth_type
 * @property string base_url
 * @property string client_id
 * @property string client_secret
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
     **********************************************/
    public function call(ApiEndpoint $endpoint, $method = 'get')
    {
        $endpoint->calls()->save(new ApiCall([
            'api_endpoint_id' => $endpoint->id,
            'method' => $method
        ]));

    }

    public function get($path)
    {
        $endpont = ApiEndpoint::where('path', $path)->first();
        return $this->call($endpont);
    }

    public function addEndpoint($path, $storeInTable = null)
    {
        $this->endpoints()->save(new ApiEndpoint([
            'path' => $path,
            'store_in_table' => $storeInTable
        ]));
    }

    public function typeOf($type_name)
    {
        return $this->auth_type->type === $type_name;
    }


}
