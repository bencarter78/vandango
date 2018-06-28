<?php

namespace App\Listeners\Apply;

use Illuminate\Support\Facades\Cache;
use App\Events\Apply\StartWasIdentified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FlushPipelineCache implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  StartWasIdentified $event
     * @return void
     */
    public function handle(StartWasIdentified $event)
    {
        $group = str_slug($event->applicant->programme_type);
        Cache::forget("pipeline.all");
        Cache::forget("pipeline.$group");
    }
}
