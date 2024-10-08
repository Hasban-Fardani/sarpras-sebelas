<?php

namespace App\Observers;

use App\Models\RequestItem;

class RequestItemObserver
{
    /**
     * Handle the RequestItem "created" event.
     */
    public function created(RequestItem $requestItem): void
    {
        //
    }

    /**
     * Handle the RequestItem "updated" event.
     */
    public function updated(RequestItem $requestItem): void
    {
        //
    }

    /**
     * Handle the RequestItem "deleted" event.
     */
    public function deleted(RequestItem $requestItem): void
    {
        //
    }

    /**
     * Handle the RequestItem "restored" event.
     */
    public function restored(RequestItem $requestItem): void
    {
        //
    }

    /**
     * Handle the RequestItem "force deleted" event.
     */
    public function forceDeleted(RequestItem $requestItem): void
    {
        //
    }
}
