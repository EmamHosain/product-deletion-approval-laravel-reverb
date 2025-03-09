<?php

namespace App\Events;

use App\Models\User;
use App\Models\Product;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class AdminNotificationEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $product_id;
    public $admin_id;
    public $user_id;
    public $user_name;
    public $product_name;
    public function __construct($product_id, $admin_id, $user_id, $user_name, $product_name)
    {
        $this->product_id = $product_id;
        $this->admin_id = $admin_id;
        $this->user_id = $user_id;
        
        $this->user_name = $user_name;
        $this->product_name = $product_name;

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
            'user_name' => $this->user_name,
            'product_name' => $this->product_name,
        ];
    }
}
