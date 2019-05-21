<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string path
 */
class ApiEndpoint extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**********************************************
     * Relations
     **********************************************/
    public function api()
    {
        return $this->belongsTo(Api::class);
    }

    public function calls(){
        $this->hasMany(ApiCall::class);
    }
}
