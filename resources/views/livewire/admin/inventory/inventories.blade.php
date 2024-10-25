<div class="content-wrapper">
    <div class="fieldset-border">
        <legend class="fieldset-legend">Inventory Table</legend>

        {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#AddCategory"
            class="btn btn-success btn-icon-text add-category-button">
            <i class="mdi mdi-plus"></i> Add Category
        </button> --}}

        <div class="mt-3 shadow-sm card">
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Success Message -->
                    @if (session()->has('success'))
                        {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> --}}
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Great!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                                    <th class="text-center">Product ID</th>
                                    <th class="text-center">Product Name</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Product Image</th>

                                    <th class="text-center">Stock Quantity</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventory as $item)
                                    <tr>
                                        <td class="text-center align-middle">{{ $item->product->id }}</td>
                                        <td class="text-center align-middle">{{ $item->product->name }}</td>
                                        <td class="text-center align-middle">{{ $item->product->category->name }}</td>
                                        <td class="text-center align-middle">
                                            <img src="{{ Storage::url($item->product->image) }}"
                                                class="img-fluid rounded-circle border" alt="Product Image"
                                                style="width: 90px; height: 90px; object-fit: cover;">
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($item->stock <= 0)
                                            <span class="badge bg-danger text-white py-1 px-3"
                                                    style="font-size: 1.1rem;">Out Of Stock</span>
                                            @else
                                                <span class="badge bg-success text-white py-1 px-3"
                                                    style="font-size: 1.1rem;">{{ $item->stock }} In Stock</span>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#editStock"
                                                wire:click="editStock({{ $item->product->id }})"
                                                class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center"
                                                style="width: 38px; height: 38px;">
                                                <i class="fa-solid fa-pen-to-square"></i>
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
    <!-- Add Category Modal -->
    <div wire:ignore.self class="modal fade" id="editStock" tabindex="-1" aria-labelledby="AddCategoryLabel"
        aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Edit Stock</h5>
                    <button type="button" class="close" wire:click='refresh' data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($product_id)
                    @livewire('admin.inventory.update-stock', [$product_id])
                @endif

            </div>
        </div>
    </div>

</div>
