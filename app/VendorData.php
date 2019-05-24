<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorData extends Model
{
    protected $table = 'vendor_data_archive';
    protected $primaryKey = 'external_uid';
}
