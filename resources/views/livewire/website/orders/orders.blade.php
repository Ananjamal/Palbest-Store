<div>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>My Orders</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('/') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>My Orders</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Orders Section Begin -->
    <section class="py-5 orders spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="p-4 text-center bg-white rounded shadow-sm orders__table">
                        @if ($orders->isEmpty())
                            <div class="mt-4 text-center alert alert-info">
                                There are no orders yet. <a href="{{ route('shop') }}" class="text-primary">Continue
                                    shopping</a>
                            </div>
                        @else
                        <table class="table table-borderless" style="width: 100%; font-size: 14px;">
                            <thead>
                                <tr class="text-center text-uppercase text-muted border-bottom">
                                    <th scope="col">Date</th>
                                    <th scope="col">Order #</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Cancel Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr class="text-center align-middle border-bottom">
                                        <td class="align-middle">{{ $item->created_at }}</td>
                                        <td class="align-middle">{{ $item->id }}</td>
                                        <td class="align-middle">{{ $item->shippingDetail->shipping_first_name }}</td>
                                        <td class="align-middle">$ {{ number_format($item->total_amount, 2) }}</td>
                                        <td class="align-middle">
                                            <button wire:click="orderDetails({{ $item->id }})"
                                                data-bs-toggle="modal" data-bs-target="#orderDetails"
                                                class="btn btn-info btn-sm"
                                                style="font-size: 14px; padding: 6px 10px;">
                                                <i class="fas fa-info-circle"></i> Details
                                            </button>
                                        </td>
                                        <td class="align-middle">
                                            @if ($item->status == 'pending')
                                                <span class="badge bg-warning text-dark"
                                                    style="font-size: 14px; padding: 8px 16px; border-radius: 5px;">{{ $item->status }}</span>
                                            @elseif ($item->status == 'canceled')
                                                <span class="badge bg-danger"
                                                    style="font-size: 14px; padding: 8px 16px; border-radius: 5px;">{{ $item->status }}</span>
                                            @elseif ($item->status == 'delivered')
                                                <span class="badge bg-success"
                                                    style="font-size: 14px; padding: 8px 16px; border-radius: 5px;">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <button wire:click="cancelOrder({{ $item->id }})"
                                                data-bs-toggle="modal" data-bs-target="#cancelOrder"
                                                class="btn btn-danger btn-sm"
                                                style="font-size: 14px; padding: 6px 10px;">
                                                <i class="fas fa-times"></i> Cancel
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Orders Section End -->

    <!-- Order Details Modal Begin -->
    <div wire:ignore.self class="modal fade" id="orderDetails" tabindex="-1" aria-labelledby="orderDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                    <button type="button" wire:click='refresh' class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                @if ($order_id)
                    @livewire('website.orders.order-details', [$order_id])
                @else
                    <p class="text-muted text-center">No order details available.</p>
                @endif

            </div>
        </div>
    </div>

    <!-- Order Details Modal End -->
    <div wire:ignore.self class="modal fade" id="cancelOrder" tabindex="-1" aria-labelledby="cancelOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <!-- Header Section -->
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="cancelOrderModalLabel">Confirm Cancellation</h5>
                    <button type="button" wire:click='refresh' class="btn-close btn-close-white"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body Section -->
                @if ($order_id)
                    @livewire('website.orders.cancel-order', [$order_id])
                @endif
            </div>


        </div>
    </div>
</div>

<!-- Order Details Modal End -->
</div>
