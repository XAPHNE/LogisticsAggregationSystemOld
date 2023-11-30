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
    public $distance = 0;
    public $requiredFleetType;
    public $weight;
    public $orderPlacedOn;
    public $loadBy;
    public $price = 0;
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

    public function updated($propertyName)
    {
        if ($propertyName === 'sourceCity' || $propertyName === 'destinationCity') {
            $this->calculateDistanceAndPrice();
        }
    }

    // Method to calculate distance and price based on selected cities
    public function calculateDistanceAndPrice()
    {
        $cityDistances = [
            'Barpeta' => [
                'Barpeta' => 0,
                'Bongaigaon' => 50,
                'Dhubri' => 120,
                'Dibrugarh' => 300,
                'Guwahati' => 150,
                'Jorhat' => 230,
                'Lakhimpur' => 180,
                'Silchar' => 280,
            ],
            'Bongaigaon' => [
                'Barpeta' => 50,
                'Bongaigaon' => 0,
                'Dhubri' => 80,
                'Dibrugarh' => 350,
                'Guwahati' => 100,
                'Jorhat' => 180,
                'Lakhimpur' => 130,
                'Silchar' => 230,
            ],
            'Dhubri' => [
                'Barpeta' => 120,
                'Bongaigaon' => 80,
                'Dhubri' => 0,
                'Dibrugarh' => 420,
                'Guwahati' => 200,
                'Jorhat' => 300,
                'Lakhimpur' => 250,
                'Silchar' => 350,
            ],
            'Dibrugarh' => [
                'Barpeta' => 300,
                'Bongaigaon' => 350,
                'Dhubri' => 420,
                'Dibrugarh' => 0,
                'Guwahati' => 500,
                'Jorhat' => 180,
                'Lakhimpur' => 400,
                'Silchar' => 550,
            ],
            'Guwahati' => [
                'Barpeta' => 150,
                'Bongaigaon' => 100,
                'Dhubri' => 200,
                'Dibrugarh' => 500,
                'Guwahati' => 0,
                'Jorhat' => 300,
                'Lakhimpur' => 250,
                'Silchar' => 350,
            ],
            'Jorhat' => [
                'Barpeta' => 230,
                'Bongaigaon' => 180,
                'Dhubri' => 300,
                'Dibrugarh' => 180,
                'Guwahati' => 300,
                'Jorhat' => 0,
                'Lakhimpur' => 150,
                'Silchar' => 400,
            ],
            'Lakhimpur' => [
                'Barpeta' => 180,
                'Bongaigaon' => 130,
                'Dhubri' => 250,
                'Dibrugarh' => 400,
                'Guwahati' => 250,
                'Jorhat' => 150,
                'Lakhimpur' => 0,
                'Silchar' => 300,
            ],
            'Silchar' => [
                'Barpeta' => 280,
                'Bongaigaon' => 230,
                'Dhubri' => 350,
                'Dibrugarh' => 550,
                'Guwahati' => 350,
                'Jorhat' => 400,
                'Lakhimpur' => 300,
                'Silchar' => 0,
            ],
        ];

        // Calculate distance based on selected cities
        $this->distance = $cityDistances[$this->sourceCity][$this->destinationCity] ?? 0;

        // Calculate the price based on distance and weight
        $this->price = ($this->distance * 4) + ($this->weight * 2);
    }

    public function submitForm() {

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
