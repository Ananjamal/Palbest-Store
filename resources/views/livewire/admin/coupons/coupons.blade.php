<div class="content-wrapper">
    <div class="fieldset-border">
        <legend class="fieldset-legend">Coupons Table</legend>

        <button type="button" data-bs-toggle="modal" data-bs-target="#AddCoupon"
            class="btn btn-success btn-icon-text add-category-button">
            <i class="mdi mdi-plus"></i> Add Coupon
        </button>

        <div class="mt-3 shadow-sm card">
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Success Message -->
                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Great!</strong> {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table align-middle table-hover table-striped custom-table">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Discount</th>
                                    <th class="text-center">Valid_Until</th>
                                    <th class="text-center">Valid_From</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td class="text-center">{{ $coupon->id }}</td>
                                        <td class="text-center">{{ $coupon->code }}</td>
                                        <td class="text-center">{{ $coupon->discount_amount }}$</td>
                                        <td class="text-center">{{ $coupon->valid_from }}</td>
                                        <td class="text-center">{{ $coupon->valid_until }}</td>

                                        <td class="text-center">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#editCoupon"
                                                wire:click="editCoupon({{ $coupon->id }})"
                                                class="border btn btn-primary btn-sm">
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCoupon"
                                                wire:click="deleteCoupon({{ $coupon->id }})"
                                                class="btn btn-danger btn-sm">
                                                Delete
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
    </div>

    <!-- Modals -->
    <!-- Add Coupon Modal -->
    <div wire:ignore.self class="modal fade" id="AddCoupon" tabindex="-1" aria-labelledby="AddCouponLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Create Coupon</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @livewire('admin.coupons.create')
            </div>
        </div>
    </div>

    <!-- Delete Coupon Modal -->
    <div wire:ignore.self class="modal fade" id="deleteCoupon" tabindex="-1" aria-labelledby="DeleteCouponLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Confirm Deletion</h5>
                    <button type="button" class="close" wire:click='refresh' data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($coupon_id)
                    @livewire('admin.coupons.delete', [$coupon_id])
                @endif
            </div>
        </div>
    </div>

    <!-- Edit Coupon Modal -->
    <div wire:ignore.self class="modal fade" id="editCoupon" tabindex="-1" aria-labelledby="EditCouponLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Edit Coupon</h5>
                    <button type="button" class="close" wire:click='refresh' data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($coupon_id)
                    @livewire('admin.coupons.edit', [$coupon_id])
                @endif
            </div>
        </div>
    </div>
</div>
