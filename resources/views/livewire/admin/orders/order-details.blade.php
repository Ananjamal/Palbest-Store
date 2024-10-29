<div>
    <div class="card rounded-3">
        <div class="card-body p-4">
            @if ($orderItems->isEmpty())
                <p class="text-muted text-center fs-4">No order details available.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center fs-5">#</th>
                                <th class="text-center fs-5">Image</th>
                                <th class="text-center fs-5">Product Name</th>
                                <th class="text-center fs-5">Price</th>
                                <th class="text-center fs-5">Size</th>
                                <th class="text-center fs-5">Color</th>
                                <th class="text-center fs-5">Quantity</th>
                                <th class="text-center fs-5">Discount</th>
                                <th class="text-center fs-5">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr class="hover-row">
                                    <td class="text-center align-middle fs-5">{{ ++$counter }}</td>
                                    <td class="text-center align-middle">
                                        <img src="{{ Storage::url($item->product->image) }}" class="rounded-circle img-fluid"
                                             style="width: 120px; height: 120px;" alt="Item Image">
                                    </td>
                                    <td class="text-center align-middle fs-5">{{ $item->product->name }}</td>
                                    <td class="text-center align-middle fs-5">${{ number_format($item->product->price, 2) }}</td>
                                    <td class="text-center align-middle fs-5">{{ $item->size ?? 'N/A' }}</td>
                                    <td class="text-center align-middle fs-5">{{ $item->color ?? 'N/A' }}</td>
                                    <td class="text-center align-middle fs-5">{{ $item->quantity }}</td>
                                    <td class="text-center align-middle fs-5">${{ number_format($item->order->discount, 2) }}</td>
                                    <td class="text-center align-middle fs-5">
                                        ${{ number_format($item->product->price * $item->quantity, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
