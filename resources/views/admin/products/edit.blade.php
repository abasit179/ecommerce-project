@extends('admin.layouts.main')

@section('main-content')
    <div class="container-xxl">
        <div class="row align-items-center mb-4">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Edit Product</h3>
                    <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Update</button>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3 mb-3">
                <!-- Pricing Info -->
                <div class="col-xl-4 col-lg-4">
                    <div class="sticky-lg-top">
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Pricing Info</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <label class="form-label">Product Price Old</label>
                                        <input type="text" class="form-control" name="price_old" value="{{ old('price_old', $product->price_old) }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Product Price New</label>
                                        <input type="text" class="form-control" name="price_new" value="{{ old('price_new', $product->price_new) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Visibility Status -->
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Visibility Status</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="1" {{ old('status', $product->status) == '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="0" {{ old('status', $product->status) == '0' ? 'checked' : '' }}>
                                    <label class="form-check-label">Inactive</label>
                                </div>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Tags</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group demo-tagsinput-area">
                                    <div class="form-line">
                                        <input type="text" class="form-control" data-role="tagsinput" name="tags" value="{{ old('tags', $product->tags) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categories and Subcategories -->
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Categories</h6>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Categories Select</label>
                                <select class="form-select" id="category-select" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="card-body">
                                <label class="form-label">Sub-Categories Select</label>
                                <select class="form-select" id="subcategory-select" name="sub_category_id">
                                    {{-- <option value="">Select Subcategory</option> --}}
                                    <!-- Subcategories will be populated here via AJAX -->
                                </select>
                            </div>
                        </div>

                        <!-- Brand -->
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Brand</h6>
                            </div>
                            <div class="card-body">
                                <label class="form-label">Select Brand</label>
                                <select class="form-select" name="brand_id">
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Inventory Info -->
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                <h6 class="m-0 fw-bold">Inventory Info</h6>
                            </div>
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <label class="form-label">SKU</label>
                                        <input type="text" class="form-control" name="sku" value="{{ old('sku', $product->sku) }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Total Stock Quantity</label>
                                        <input type="text" class="form-control" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Information -->
                <div class="col-xl-8 col-lg-8">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold">Basic Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row g-3 align-items-center">
                                <div class="col-md-6">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $product->name) }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Product Description</label>
                                    <textarea id="editor" name="description" class="form-control" rows="5" placeholder="Enter Product Description Here">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Existing Images Section -->
                    <div id="existing-images">
                        @foreach (json_decode($product->images) as $image)
                            <div class="image-container">
                                <img src="{{ asset($image) }}" class="img-thumbnail" style="width: 100px;">
                                <button type="button" class="btn btn-danger delete-image" data-image="{{ $image }}">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </div>
                        @endforeach
                    </div>


                    <!-- Images Upload -->
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold">Images</h6>
                        </div>
                        <div class="card-body">
                            <label class="form-label">Product Images Upload</label>
                            <small class="d-block text-muted mb-2">Only portrait or square images, 2MB max and 2000px max-height.</small>
                            <div id="image-container">
                                <div class="image-field row">
                                    <div class="col-md-10 col-10 col-sm-10">
                                        <input type="file" name="images[]" class="form-control mb-2" accept="image/*">
                                    </div>
                                    <div class="col-md-2 col-2 col-sm-2">
                                        <button type="button" class="btn btn-success add-image"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="card">
                        <div class="card-body">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Update Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const categorySelect = document.getElementById('category-select');
    const subcategorySelect = document.getElementById('subcategory-select');

    function fetchSubcategories(categoryId) {
        fetch(`/admin/subcats/${categoryId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.subcategories) {
                    // subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                    let selectedSubcategoryId = '{{ old('sub_category_id', $product->sub_category_id) }}';

                    data.subcategories.forEach(subcategory => {
                        const option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.name;

                        if (subcategory.id === selectedSubcategoryId) {
                            option.selected = true;
                        }

                        subcategorySelect.appendChild(option);
                    });

                    // If the selected subcategory wasn't in the fetched list, clear the selection
                    if (selectedSubcategoryId && !subcategorySelect.querySelector(`option[value="${selectedSubcategoryId}"]`)) {
                        subcategorySelect.value = '';
                    }
                } else {
                    console.error('Unexpected data format:', data);
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Failed to fetch subcategories. Please try again.');
            });
    }

    categorySelect.addEventListener('change', function () {
        const categoryId = categorySelect.value;
        if (categoryId) {
            fetchSubcategories(categoryId);
        } else {
            subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
        }
    });

    // Initialize subcategories if a category is already selected
    if (categorySelect.value) {
        fetchSubcategories(categorySelect.value);
    }

    // Add image field
    document.querySelector('#image-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('add-image')) {
            const newImageField = document.createElement('div');
            newImageField.classList.add('image-field', 'row', 'mb-2');
            newImageField.innerHTML = `
                <div class="col-md-10 col-10 col-sm-10">
                    <input type="file" name="images[]" class="form-control mb-2" accept="image/*">
                </div>
                <div class="col-md-2 col-2 col-sm-2">
                    <button type="button" class="btn btn-danger remove-image"><i class="fa fa-trash"></i></button>
                </div>
            `;
            document.querySelector('#image-container').appendChild(newImageField);
        }
    });

    // Remove image field
    document.querySelector('#image-container').addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-image')) {
            e.target.closest('.image-field').remove();
        }
    });

    // Handle image deletion
    document.querySelector('#existing-images').addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-image')) {
            const imageUrl = e.target.getAttribute('data-image');

            if (confirm('Are you sure you want to delete this image?')) {
                fetch(`/admin/products/delete-image`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({ image: imageUrl }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        e.target.closest('.image-container').remove();
                    } else {
                        alert('Failed to delete image.');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('Failed to delete image. Please try again.');
                });
            }
        }
    });
});
</script>
@endsection
