<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductDeleteEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */

    public $user_id;
    public $product_id;

    public $is_product_delete;
    public function __construct($user_id, $product_id, $is_product_delete)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->is_product_delete = $is_product_delete;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('product-delete-channel.' . $this->user_id),
        ];
    }


    public function broadcastWith(): array
    {
        return [
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'is_product_delete' => $this->is_product_delete,
        ];
    }
}
