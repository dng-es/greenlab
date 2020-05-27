<?php

namespace App\Events;

use App\Product;
use App\Warehouse;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WarehouseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Warehouse $warehouse)
    {
        //actualizar stock del producto dependiendo del tipo
        $product = Product::findOrFail($warehouse->product_id);
        if ($warehouse->type == 'E') $product->amount += $warehouse->amount_real;
        else $product->amount -= $warehouse->amount_real;
        $product->save();
    }
}
