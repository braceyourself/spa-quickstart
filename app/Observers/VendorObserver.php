<?php

namespace App\Observers;


use App\FRC\Vendor;
use Illuminate\Support\Facades\Log;

class VendorObserver
{
    public function creating(Vendor $vendor){
        Log::info("Creating vendor",$vendor->toArray());
    }
    /**
     * Handle the vendor "created" event.
     *
     * @param  \App\Vendor  $vendor
     * @return void
     */
    public function created(Vendor $vendor)
    {
        //
    }

    /**
     * Handle the vendor "updated" event.
     *
     * @param  \App\Vendor  $vendor
     * @return void
     */
    public function updated(Vendor $vendor)
    {
        //
    }

    /**
     * Handle the vendor "deleted" event.
     *
     * @param  \App\Vendor  $vendor
     * @return void
     */
    public function deleted(Vendor $vendor)
    {
        //
    }

    /**
     * Handle the vendor "restored" event.
     *
     * @param  \App\Vendor  $vendor
     * @return void
     */
    public function restored(Vendor $vendor)
    {
        //
    }

    /**
     * Handle the vendor "force deleted" event.
     *
     * @param  \App\Vendor  $vendor
     * @return void
     */
    public function forceDeleted(Vendor $vendor)
    {
        //
    }
}
