<?php

namespace App\Listeners;

use App\Events\AdDelete;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogDeletedAd
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AdDelete $event)
    {
        logger('Ad with a id' . $event->ad->id . 'and Title:' . $event->ad->title . 'is deleted!');
    }
}
