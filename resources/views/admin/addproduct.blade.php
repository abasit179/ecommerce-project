@extends('admin.layouts.main')

@section('main-content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                @if (session()->has('error'))
                    <div class="alert alert-danger" id="error-alert">
                        {{ session()->get('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" id="validation-alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (isset($product))
                    <h5 class="card-title mb-4">Update Product</h5>
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                    @else
                        <h2>Add New Product</h2>
                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                @endif

                <div class="form-group mb-3">
                    <label for="title" class="font-weight-bold">Product Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="{{ $product->title ?? old('title') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="description" class="font-weight-bold">Product Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4" required>{{ $product->description ?? old('description') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="category" class="font-weight-bold">Category</label>
                    <select class="form-control" id="category" name="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="original_price" class="font-weight-bold">Original Price</label>
                    <input type="number" class="form-control" id="original_price" name="original_price"
                        value="{{ $product->original_price ?? old('original_price') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="discounted_price" class="font-weight-bold">Discounted Price</label>
                    <input type="number" class="form-control" id="discounted_price" name="discounted_price"
                        value="{{ $product->discounted_price ?? old('discounted_price') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="sizes" class="font-weight-bold">Available Sizes</label>
                    <input type="text" class="form-control" id="sizes" name="sizes"
                        value="{{ $product->sizes ?? old('sizes') }}" placeholder="e.g., S, M, L, XL">
                </div>


                <div class="form-group mb-3">
                    <label for="images" class="font-weight-bold">Product Images</label>
                    <input type="file" class="form-control" id="images" name="images[]" multiple>
                    <div class="mt-2" id="image-preview">
                        @if (isset($product) && $product->images)
                            <p>Current Images:</p>
                            @foreach (json_decode($product->images) as $image)
                                <div class="image-container">
                                    <img src="{{ asset('images/' . $image) }}" width="100" height="100"
                                        class="mr-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-image"
                                        data-image="{{ $image }}">Remove</button>
                                    <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="additional_info" class="font-weight-bold">Additional Information</label>
                    <textarea class="form-control" id="additional_info" name="additional_info" rows="2">{{ $product->additional_info ?? old('additional_info') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Featured Product</label>
                    <input type="checkbox" id="is_featured" name="is_featured" value="1"
                        {{ isset($product) && $product->is_featured ? 'checked' : '' }}>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">On Sale</label>
                    <input type="checkbox" id="is_on_sale" name="is_on_sale" value="1"
                        {{ isset($product) && $product->is_on_sale ? 'checked' : '' }}>
                </div>

                <button type="submit"
                    class="btn btn-primary">{{ isset($product) ? 'Update Product' : 'Submit' }}</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // Handle alerts
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 2000); // 2000 milliseconds
            }

            var errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 2000); // 2000 milliseconds
            }

            var validationAlert = document.getElementById('validation-alert');
            if (validationAlert) {
                setTimeout(function() {
                    validationAlert.style.display = 'none';
                }, 2000); // 2000 milliseconds
            }
        });
    </script>




@endsection
