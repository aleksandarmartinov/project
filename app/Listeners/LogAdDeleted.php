<?php

namespace App\Listeners;

use App\Events\AdDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogAdDeleted
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
    public function handle(AdDeleted $event)
    {
        logger('This Ad is deleted :' . $event->ad->title);
    }
}
