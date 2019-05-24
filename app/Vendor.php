<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
