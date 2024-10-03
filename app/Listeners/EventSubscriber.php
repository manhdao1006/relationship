<?php

namespace App\Listeners;

use App\Events\Event1;
use App\Events\Event2;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Events\Dispatcher;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class EventSubscriber
{
    /**
     * Handle user login events.
     */
    public function handleEvent1(Event1 $event): void {
        Log::debug(__CLASS__ . " - " . __FUNCTION__);
    }
 
    /**
     * Handle user logout events.
     */
    public function handleEvent2(Event2 $event): void {
        Log::debug(__CLASS__ . " - " . __FUNCTION__);
    }
 
    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            Event1::class => 'handleEvent1',
            Event2::class => 'handleEvent2',
        ];
    }
}
