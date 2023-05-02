<?php

namespace App\Listeners;

use App\Events\AdDelete;
use App\Events\AdDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteAdPictures
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
        
        $imagePaths = [
            public_path('ad_images/'.$event->ad->image1),
            public_path('ad_images/'.$event->ad->image2),
            public_path('ad_images/'.$event->ad->image3)
        ];

        
        foreach ($imagePaths as $path) {
            if (is_file($path)) {
                unlink($path);
            }
        }
    }
}
