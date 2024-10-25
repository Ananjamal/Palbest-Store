<div>
    <div class="modal-body">
        <!-- Product Name -->
        <div class="form-group mb-3">
            <label for="productName" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="productName" placeholder="Enter product name" wire:model.defer="productName">
            @error('productName')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Category Selection -->
        <div class="mb-3 input-container">
            <label for="categories" class="text-dark">Choose a Category:</label>
            <select class="form-select text-dark" id="categories" wire:model="category_id">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Product Description -->
        <div class="form-group mb-3">
            <label for="productDescription" class="form-label">Product Description</label>
            <textarea class="form-control" id="productDescription" rows="3" placeholder="Enter product description" wire:model.defer="productDescription"></textarea>
            @error('productDescription')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Product Price -->
        <div class="form-group mb-3">
            <label for="productPrice" class="form-label">Product Price</label>
            <input type="number" class="form-control" id="productPrice" placeholder="Enter product price" wire:model.defer="productPrice">
            @error('productPrice')
                <span class="error text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Product Sizes -->
        <div class="form-group mb-4">
            <label class="form-label fw-bold">Product Sizes</label>
            <div class="d-flex flex-wrap">
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" wire:model="productSize" value="S" id="sizeSmall" {{ in_array('S', $productSize) ? 'checked' : '' }}>
                    <label class="form-check-label" for="sizeSmall">Small (S)</label>
                </div>
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" wire:model="productSize" value="M" id="sizeMedium" {{ in_array('M', $productSize) ? 'checked' : '' }}>
                    <label class="form-check-label" for="sizeMedium">Medium (M)</label>
                </div>
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" wire:model="productSize" value="L" id="sizeLarge" {{ in_array('L', $productSize) ? 'checked' : '' }}>
                    <label class="form-check-label" for="sizeLarge">Large (L)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="productSize" value="XL" id="sizeXL" {{ in_array('XL', $productSize) ? 'checked' : '' }}>
                    <label class="form-check-label" for="sizeXL">Extra Large (XL)</label>
                </div>
            </div>
        </div>

        <!-- Product Colors -->
        <div class="form-group mb-4">
            <label class="form-label fw-bold">Product Colors</label>
            <div class="d-flex flex-wrap">
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" wire:model="productColor" value="Red" id="colorRed" {{ in_array('Red', $productColor) ? 'checked' : '' }}>
                    <label class="form-check-label" for="colorRed">
                        <span class="color-box" style="display: inline-block; width: 20px; height: 20px; background-color: red; border: 1px solid #ccc; border-radius: 3px; margin-right: 5px;"></span>
                        Red
                    </label>
                </div>
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" wire:model="productColor" value="Blue" id="colorBlue" {{ in_array('Blue', $productColor) ? 'checked' : '' }}>
                    <label class="form-check-label" for="colorBlue">
                        <span class="color-box" style="display: inline-block; width: 20px; height: 20px; background-color: blue; border: 1px solid #ccc; border-radius: 3px; margin-right: 5px;"></span>
                        Blue
                    </label>
                </div>
                <div class="form-check me-3">
                    <input class="form-check-input" type="checkbox" wire:model="productColor" value="Green" id="colorGreen" {{ in_array('Green', $productColor) ? 'checked' : '' }}>
                    <label class="form-check-label" for="colorGreen">
                        <span class="color-box" style="display: inline-block; width: 20px; height: 20px; background-color: green; border: 1px solid #ccc; border-radius: 3px; margin-right: 5px;"></span>
                        Green
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="productColor" value="Black" id="colorBlack" {{ in_array('Black', $productColor) ? 'checked' : '' }}>
                    <label class="form-check-label" for="colorBlack">
                        <span class="color-box" style="display: inline-block; width: 20px; height: 20px; background-color: black; border: 1px solid #ccc; border-radius: 3px; margin-right: 5px;"></span>
                        Black
                    </label>
                </div>
            </div>
        </div>

        <!-- Product Image Upload -->
        <div class="form-group mb-3">
            <label for="productImage" class="form-label">Upload Image</label>
            <div class="input-group">
                <label class="btn btn-outline-danger" for="newImage">
                    <i class="mdi mdi-upload"></i> Select Image
                </label>
                <input type="file" class="form-control d-none" id="newImage" wire:model="newImage">

                <span id="fileName" class="ml-4 mt-2 text-muted" style="margin-left: 15px">
                    @if ($newImage)
                        {{ $newImage->getClientOriginalName() }}
                    @else
                        No file chosen
                    @endif
                </span>
            </div>
            <div wire:loading wire:target="newImage">
                <div class="d-flex align-items-center">
                    <strong class="text-success">Loading...</strong>
                    <div class="spinner-border text-success ms-auto ml-1" role="status" aria-hidden="true"></div>
                </div>
            </div>

            @error('newImage')
                <span class="error text-danger">{{ $message }}</span>
            @enderror

            @if ($newImage)
                <div class="mt-3 d-flex justify-content-center align-items-center">
                    <img wire:loading.remove wire:target="productImage" src="{{ $newImage->temporaryUrl() }}" class="img-thumbnail" alt="Image Preview" width="150" height="150">
                </div>
            @elseif ($currentImage)
                <div class="mt-3 d-flex justify-content-center align-items-center">
                    <img src="{{ Storage::url($currentImage) }}" class="img-thumbnail" alt="Current Image" width="150" height="150">
                </div>
            @endif
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-between">
        <button type="button" wire:click='refresh' class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button wire:click="editProduct" class="btn btn-primary">
            Save
            <span wire:loading wire:target="editProduct" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>
    </div>
</div>
