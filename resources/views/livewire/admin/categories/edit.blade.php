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
            <label for="newImage" class="form-label">Upload Image</label>
            <div class="input-group">
                <label class="mt-2 ml-5 btn btn-outline-danger" for="newImage">
                    <i class="mdi mdi-upload"></i> Select Image
                </label>
                <input type="file" class="form-control d-none" id="newImage" wire:model="newImage">

                <span id="fileName" class="mt-2 ml-4 text-muted" style="margin-left: 15px">
                    @if ($newImage)
                        {{ $newImage->getClientOriginalName() }}
                    @else
                        No file chosen
                    @endif
                </span>
            </div>
            <div wire:loading wire:target="newImage">
                <div class="d-flex align-items-center">
                    <strong class="text-success">Loading...</strong> <!-- Text color green -->
                    <div class="ml-1 spinner-border text-success ms-auto" role="status" aria-hidden="true"></div> <!-- Spinner green -->
                </div>
            </div>



            @error('newImage')
                <span class="error text-danger">{{ $message }}</span>
            @enderror

            @if ($newImage)
            <div class="mt-3 d-flex justify-content-center align-items-center">
                <!-- Show image preview after image upload -->
                <img wire:loading.remove wire:target="categoryImage" src="{{ $newImage->temporaryUrl() }}"
                    class="img-thumbnail" alt="Image Preview" width="150" height="150">
            </div>
            @else
            <div class="mt-3 d-flex justify-content-center align-items-center">
                <!-- Show image preview after image upload -->
                <img  src="{{Storage::url($category->image) }}"
                    class="img-thumbnail" alt="Image Preview" width="150" height="150">
            </div>
            @endif
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" wire:click='refresh' data-bs-dismiss="modal">Close</button>

        <button wire:click="Edit" class="btn btn-primary">
            Save
            <span wire:loading wire:target="Edit" class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
        </button>
    </div>
</div>
