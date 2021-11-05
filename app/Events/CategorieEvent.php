<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CategorieEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $categorieShow;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($categorieShow)
    {
        $this->categorieShow = $categorieShow;
        $this->message  = "Categories send";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['categorie-event'];
    }
    public function broadcastAs()
    {
        return 'categorie-event';
    }
}
