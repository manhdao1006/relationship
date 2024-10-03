<?php

namespace App\Listeners;

use App\Events\OrderSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderSuccessNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderSuccess $event): void
    {
        $data = $event->data;

        Mail::send('mail', $data, function (Message $message) {
            $message->from('manhdao1006@gmail.com', 'Manh Dao');
            $message->to('abc@gmail.com', 'ABC');
            $message->subject('Đặt hàng thành công');        
        });
    }
}
