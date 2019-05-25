<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Collection apis
 */
class Vendor extends Model
{
    protected $fillable = [
        'name'
    ];
    /**********************************************
     * Relations
     **********************************************/
    public function apis(){
        return $this->hasMany(Api::class);
    }


    public function get($path){
        $endpont = $this->apis->endpoints->where('path',$path)->first();
        return $this->apis()->first()->get($endpont);
    }

}
