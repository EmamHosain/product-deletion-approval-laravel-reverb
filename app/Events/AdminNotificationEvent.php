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

class AdminNotificationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $product_id;
    public $admin_id;
    public $user_id;
    public function __construct($product_id, $admin_id, $user_id)
    {
        $this->product_id = $product_id;
        $this->admin_id = $admin_id;
        $this->user_id = $user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('admin-notification-channel.' . $this->admin_id),
        ];
    }

    /**
     * Summary of broadcastWith
     * @return array{product_id: mixed, user_id: mixed}
     */
    public function broadcastWith()
    {
        return [
            'admin_id' => $this->admin_id,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
        ];
    }
}
