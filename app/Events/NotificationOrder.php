<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationOrder implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $msg;
    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($msg,$data)
    {
        $this->msg=$msg;
        $this->data=$data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */


    /*****Nom de la channel*****/
    public function broadcastOn()
    {
        return new Channel('free-channel');
    }

    /*****Nom de l'event******/
    public function broadcastAs(){
        return 'Commande-notification-event';
    }
}
