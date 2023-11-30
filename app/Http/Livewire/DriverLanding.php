<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\User;

use Livewire\Component;

class DriverLanding extends Component
{
    public $orderPlacedBy;
    public $sourceCity;
    public $destinationCity;
    public $distance;
    public $requiredFleetType;
    public $weight;
    public $orderPlacedOn;
    public $loadBy;
    public $price;
    public $status;
    public function render()
    {
        // Fetch orders from the database
        // Fetch orders placed by the logged-in user from the database
        $orders = Order::join('users', 'orders.order_placed_by', '=', 'users.id')
            ->select(
                'orders.id',
                'orders.order_placed_on',
                'users.first_name',
                'users.last_name',
                'orders.source_city',
                'orders.destination_city',
                'orders.distance',
                'orders.required_fleet_type',
                'orders.weight',
                'orders.load_by',
                'orders.price',
                'orders.status'
            )
            ->get();

        // Pass the orders data to the view
        return view('livewire.driver-landing', ['orders' => $orders]);
    }

    public function updateOrderStatus($orderId)
    {
        $order = Order::find($orderId);

        // Check the current status and update accordingly
        if ($order->status === 'Open') {
            $order->update(['status' => 'Accepted']);
        } elseif ($order->status === 'Accepted') {
            $order->update(['status' => 'Cancelled']);
        }
    }
}
