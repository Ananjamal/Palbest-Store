<div class="content-wrapper">
    <div class="fieldset-border">
        <legend class="fieldset-legend">Orders Table</legend>

        <div class="mt-3 shadow-sm card">
            <div class="card-body">
                <div class="table-responsive">
                    <!-- No Orders Message -->
                    @if ($orders->isEmpty())
                        <div class="mt-4 text-center alert alert-info">
                            There are no orders yet. <a href="{{ route('shop') }}" class="text-primary">Continue
                                shopping</a>
                        </div>
                    @else
                        <!-- Orders Table -->
                        <table class="table align-middle table-hover table-striped custom-table">
                            <thead class="bg-light text-muted">
                                <tr class="text-center">
                                    <th>Date</th>
                                    <th>Order #</th>
                                    <th>Name</th>
                                    <th>Total Price</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Complete Order</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $item)
                                    <tr class="text-center align-middle">
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->shippingDetail->shipping_first_name }}</td>
                                        <td>$ {{ number_format($item->total_amount, 2) }}</td>
                                        <td>
                                            <button wire:click="orderDetails({{ $item->id }})"
                                                data-bs-toggle="modal" data-bs-target="#orderDetails"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-info-circle"></i> Details
                                            </button>
                                        </td>
                                        <td>
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
                                        <td>
                                            <button wire:click="completeOrder({{ $item->id }})"
                                                data-bs-toggle="modal" data-bs-target="#completeOrder"
                                                class="btn btn-success btn-sm">
                                                <i class="fas fa-check-circle"></i> Complete
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

    <div wire:ignore.self class="modal fade" id="orderDetails" tabindex="-1" aria-labelledby="orderDetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                    <button type="button" wire:click='refresh' class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                @if ($order_id)
                    @livewire('admin.orders.order-details', [$order_id])
                @else
                    <p class="text-muted text-center">No order details available.</p>
                @endif

            </div>
        </div>
    </div>

    <!-- Complete Order Modal -->
    <div wire:ignore.self class="modal fade" id="completeOrder" tabindex="-1" aria-labelledby="completeOrderModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="completeOrderModalLabel">Confirm Completion</h5>
                    <button type="button" wire:click='refresh' class="btn-close btn-close-white"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($order_id)
                        @livewire('admin.orders.complete-order', [$order_id])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
