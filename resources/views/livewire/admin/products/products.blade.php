<div class="content-wrapper">
    <div class="fieldset-border">
        <legend class="fieldset-legend">Products Table</legend>

        <button type="button" data-bs-toggle="modal" data-bs-target="#AddProduct" class="btn btn-success btn-icon-text add-category-button">
            <i class="mdi mdi-plus"></i> Add Product
        </button>

        <div class="mt-3 shadow-sm card">
            <div class="card-body">
                <div class="table-responsive">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Great!</strong> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops!</strong> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table align-middle table-hover table-striped custom-table">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center">{{ $product->id }}</td>
                                    <td class="text-center">{{ $product->name }}</td>
                                    <td class="text-center">{{ $product->description }}</td>
                                    <td class="text-center align-middle">
                                        <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded-circle" alt="Product Image" style="width: 100px; height: 100px;">
                                    </td>
                                    <td class="text-center">${{ $product->price }}</td>

                                    <!-- Display sizes -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center flex-wrap">
                                            @foreach (json_decode($product->size, true) as $size)
                                                <span class="badge bg-primary me-1">{{ $size }}</span>
                                            @endforeach
                                        </div>
                                    </td>

                                    <!-- Display colors -->
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center flex-wrap">
                                            @foreach (json_decode($product->color, true) as $color)
                                                <span class="badge" style="background-color: {{ $color }}; color: white;" class="me-1">{{ ucfirst($color) }}</span>
                                            @endforeach
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#editProduct" wire:click="editProduct({{ $product->id }})" class="border btn btn-primary btn-sm">Edit</button>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteProduct" wire:click="deleteProduct({{ $product->id }})" class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div

    <!-- Modals -->
    <!-- Add Product Modal -->
    <div wire:ignore.self class="modal fade" id="AddProduct" tabindex="-1" aria-labelledby="AddCategoryLabel" aria-hidden="true">


        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Create Product</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @livewire('admin.products.create')
            </div>
        </div>
    </div>

    <!-- Delete Product Modal -->
    <div wire:ignore.self class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="AddCategoryLabel" aria-hidden="true">


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Confirm Deletion</h5>
                    <button type="button" class="close" wire:click='refresh' data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($product_id)
                    @livewire('admin.products.delete', [$product_id])
                @endif
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div wire:ignore.self class="modal fade" id="editProduct" tabindex="-1" aria-labelledby="AddCategoryLabel" aria-hidden="true">


        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Edit Product</h5>
                    <button type="button" class="close" wire:click='refresh' data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($product_id)
                    @livewire('admin.products.edit', [$product_id])
                @endif
            </div>
        </div>
    </div>
</div>
