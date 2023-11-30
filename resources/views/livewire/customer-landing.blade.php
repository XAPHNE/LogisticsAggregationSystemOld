<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Book a Shipment</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="submitForm" action="{{route('customer.landing')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="sourceCity" class="form-label">Source City:</label>
                    <select wire:model="sourceCity" class="form-select" name="sourceCity">
                        <option>Select</option>
                        <option value="Barpeta">Barpeta</option>
                        <option value="Bongaigaon">Bongaigaon</option>
                        <option value="Dhubri">Dhubri</option>
                        <option value="Dibrugarh">Dibrugarh</option>
                        <option value="Guwahati">Guwahati</option>
                        <option value="Jorhat">Jorhat</option>
                        <option value="Lakhimpur">Lakhimpur</option>
                        <option value="Silchar">Silchar</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="destinationCity" class="form-label">Destination City:</label>
                    <select wire:model="destinationCity" class="form-select">
                        <option>Select</option>
                        <option value="Barpeta">Barpeta</option>
                        <option value="Bongaigaon">Bongaigaon</option>
                        <option value="Dhubri">Dhubri</option>
                        <option value="Dibrugarh">Dibrugarh</option>
                        <option value="Guwahati">Guwahati</option>
                        <option value="Jorhat">Jorhat</option>
                        <option value="Lakhimpur">Lakhimpur</option>
                        <option value="Silchar">Silchar</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="distance" class="form-label">Distance:</label>
                    <input type="number" wire:model="distance" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="requiredFleetType" class="form-label">Required Fleet Type:</label>
                    <select wire:model="requiredFleetType" class="form-select">
                        <option>Select</option>
                        <option value="Truck 4 Wheels">Truck 4 Wheels</option>
                        <option value="Truck 6 Wheels">Truck 6 Wheels</option>
                        <option value="Truck 10 Wheels">Truck 10 Wheels</option>
                        <option value="Truck 18 Wheels">Truck 18 Wheels</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="weight" class="form-label">Weight:</label>
                    <input type="number" wire:model="weight" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    &nbsp;
    <hr>
    &nbsp;
    <div class="card">
        <div class="card-header">
            My Orders
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order Placed On</th>
                            <th>Source City</th>
                            <th>Destination City</th>
                            <th>Distance</th>
                            <th>Fleet Type</th>
                            <th>Weight</th>
                            <th>Load By</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop through your orders data --}}
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_placed_on }}</td>
                                <td>{{ $order->source_city }}</td>
                                <td>{{ $order->destination_city }}</td>
                                <td>{{ $order->distance }}</td>
                                <td>{{ $order->required_fleet_type }}</td>
                                <td>{{ $order->weight }}</td>
                                <td>{{ $order->load_by }}</td>
                                <td>₹ {{ $order->price }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
