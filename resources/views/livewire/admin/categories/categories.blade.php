<div class="content-wrapper">
    <div class="fieldset-border">
        <legend class="fieldset-legend">Categories Table</legend>

        <button type="button" data-bs-toggle="modal" data-bs-target="#AddCategory"
            class="btn btn-success btn-icon-text add-category-button">
            <i class="mdi mdi-plus"></i> Add Category
        </button>

        <div class="mt-3 shadow-sm card">
            <div class="card-body">
                <div class="table-responsive">
                    <!-- Success Message -->
                    @if (session()->has('message'))
                        {{-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div> --}}
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
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-center">Image</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="text-center">{{ $category->id }}</td>
                                        <td class="text-center">{{ $category->name }}</td>
                                        <td class="text-center">{{ $category->description }}</td>
                                        <td class="text-center align-middle">
                                            <img src="{{ Storage::url($category->image) }}"
                                                class="img-fluid rounded-circle" alt="Category Image"
                                                style="width: 100px; height: 100px;">
                                        </td>
                                        <td class="text-center">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#editCategory"
                                                wire:click="editCategory({{ $category->id }})"
                                                class="border btn btn-primary btn-sm">
                                                Edit
                                            </button>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCategory"
                                                wire:click="deleteCategory({{ $category->id }})"
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
    <!-- Add Category Modal -->
    <div wire:ignore.self class="modal fade" id="AddCategory" tabindex="-1" aria-labelledby="AddCategoryLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Create Category</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @livewire('admin.categories.create')
            </div>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div wire:ignore.self class="modal fade" id="deleteCategory" tabindex="-1" aria-labelledby="AddCategoryLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Confirm Deletion</h5>
                    <button type="button" class="close" wire:click='refresh' data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($category_id)
                    @livewire('admin.categories.delete', [$category_id])
                @endif
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div wire:ignore.self class="modal fade" id="editCategory" tabindex="-1" aria-labelledby="AddCategoryLabel" aria-hidden="true">

        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalFormTitle">Edit Category</h5>
                    <button type="button" class="close" wire:click='refresh' data-bs-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($category_id)
                    @livewire('admin.categories.edit', [$category_id])
                @endif
            </div>
        </div>
    </div>
</div>
