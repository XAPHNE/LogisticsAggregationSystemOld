<?php

namespace App\Http\Livewire;

use App\Http\Middleware\Authenticate;
use Livewire\Component;
use App\Models\Order;

class CustomerLanding extends Component
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
    public function mount()
    {
        // Fetch the logged-in user
        $user = auth()->user();

        // Set the orderPlacedBy property with the user's id
        $this->orderPlacedBy = $user->id;
    }
    public function render()
    {
        // Fetch orders placed by the logged-in user from the database
        $orders = Order::where('order_placed_by', $this->orderPlacedBy)->get();

        return view('livewire.customer-landing', ['orders' => $orders]);
    }

    public function submitForm() {
        // Add your validation logic here

        // Calculate the price based on the distance (multiplying by 4)
        $this->price = $this->distance * 4;

        // Get the current date and time
        $currentDateTime = now();

        // Calculate the date 2 days from now
        $loadByDate = now()->addDays(2);

        // Assuming you have an "orders" table in the database
        // Create a new order
        Order::create([
            'order_placed_by' => auth()->id(),
            'source_city' => $this->sourceCity,
            'destination_city' => $this->destinationCity,
            'distance' => $this->distance,
            'required_fleet_type' => $this->requiredFleetType,
            'weight' => $this->weight,
            'order_placed_on' => $currentDateTime,
            'load_by' => $loadByDate,
            'price' => $this->price,
        ]);

        // Add a success message or redirect as needed
        session()->flash('message', 'Order created successfully!');
    }
}
