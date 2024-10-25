<div>
    <div class="modal-body">
        <div class="form-group">
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryName" placeholder="Enter category name"
                wire:model.defer="categoryName">
            @error('categoryName')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="categoryDescription" class="form-label">Category Description</label>
            <textarea class="form-control" id="categoryDescription" rows="3" placeholder="Enter category description"
                wire:model.defer="categoryDescription"></textarea>
            @error('categoryDescription')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="categoryImage" class="form-label">Upload Image</label>
            <div class="input-group">
                <label class="btn btn-outline-danger ml-5 mt-2" for="categoryImage">
                    <i class="mdi mdi-upload"></i> Select Image
                </label>
                <input type="file" class="form-control d-none" id="categoryImage" wire:model="categoryImage">

                <span id="fileName" class="ml-4 mt-2 text-muted" style="margin-left: 15px">
                    @if ($categoryImage)
                        {{ $categoryImage->getClientOriginalName() }}
                    @else
                        No file chosen
                    @endif
                </span>
            </div>
            <div wire:loading wire:target="categoryImage">
                <div class="d-flex align-items-center">
                    <strong class="text-success">Loading...</strong> <!-- Text color green -->
                    <div class="spinner-border text-success ms-auto ml-1" role="status" aria-hidden="true"></div> <!-- Spinner green -->
                </div>
            </div>



            @error('categoryImage')
                <span class="error text-danger">{{ $message }}</span>
            @enderror

            @if ($categoryImage)
                <div class="mt-3 d-flex justify-content-center align-items-center">
                    <!-- Show image preview after image upload -->
                    <img wire:loading.remove wire:target="categoryImage" src="{{ $categoryImage->temporaryUrl() }}"
                        class="img-thumbnail" alt="Image Preview" width="150" height="150">
                </div>
            @endif
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

        <button wire:click="CreateCategory" class="btn btn-primary">
            Save
            <span wire:loading wire:target="CreateCategory" class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
        </button>

    </div>
</div>
