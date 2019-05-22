<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string path
 * @property Collection $api_calls
 */
class ApiEndpoint extends Model
{

    protected $fillable = ['path','store_in_table'];


    /**********************************************
     * Relations
     **********************************************/
    public function api()
    {
        return $this->belongsTo(Api::class);
    }

    public function api_calls(){
        return $this->hasMany(ApiCall::class);
    }


    /**********************************************
     * Methods
     **********************************************/
    public function call(){
        return $this->api_calls()->save(new ApiCall());
    }
}
