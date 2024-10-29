<div>
    <div class="card rounded-3">

        <div class="card-body p-4">
            @if ($orderItems->isEmpty())
                <p class="text-muted text-center">No order details available.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Discount</th>

                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr class="hover-row">
                                    <td class="text-center align-middle">{{ ++$counter }}</td>
                                    <td class="text-center align-middle">
                                        <img src="{{ Storage::url($item->product->image) }}" class="rounded-circle"
                                            height="100px" width="100px" alt="Item Image">
                                    </td>
                                    
                                    <td class="text-center align-middle">{{ $item->product->name }}</td>
                                    <td class="text-center align-middle">${{ number_format($item->product->price, 2) }}
                                    </td>
                                    <td class="text-center align-middle">{{ $item->size ?? 'N/A' }}</td> <!-- Size -->
                                    <td class="text-center align-middle">{{ $item->color ?? 'N/A' }}</td> <!-- Color -->
                                    <td class="text-center align-middle">{{ $item->quantity }}</td>
                                    <td class="text-center align-middle">${{ number_format($item->order->discount, 2) }}

                                    <td class="text-center align-middle">
                                        ${{ number_format($item->product->price * $item->quantity, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
