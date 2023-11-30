<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Listed Shipments</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order Placed On</th>
                            <th>Ordered By</th>
                            <th>Source City</th>
                            <th>Destination City</th>
                            <th>Distance (Km)</th>
                            <th>Fleet Type</th>
                            <th>Weight (Kg)</th>
                            <th>Load By</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop through your orders data --}}
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->order_placed_on }}</td>
                                <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                <td>{{ $order->source_city }}</td>
                                <td>{{ $order->destination_city }}</td>
                                <td>{{ $order->distance }}</td>
                                <td>{{ $order->required_fleet_type }}</td>
                                <td>{{ $order->weight }}</td>
                                <td>{{ $order->load_by }}</td>
                                <td>₹ {{ $order->price }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    <button wire:click="updateOrderStatus({{ $order->id }})" type="button" class="btn btn-primary"
                                    @if($order->status === 'Cancelled') disabled @endif>
                                    @if($order->status === 'Open')
                                        Accept
                                    @elseif($order->status === 'Accepted')
                                        Cancel
                                    @elseif($order->status === 'Cancelled')
                                        Cancel
                                    @endif
                                </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
