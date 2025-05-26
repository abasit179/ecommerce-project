@extends('admin.layouts.main')

@section('main-content')
    <!-- Body: Body -->
    <div class="body d-flex py-3">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Products Add</h3>
                            <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Save</button>
                        </div>
                    </div>
                </div>
                <!-- Row end  -->

                <div class="row g-3 mb-3">
                    <div class="col-xl-4 col-lg-4">
                        <div class="sticky-lg-top">
                            <!-- Pricing Info -->
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                    <h6 class="m-0 fw-bold">Pricing Info</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-md-12">
                                            <label class="form-label">Product Price Old</label>
                                            <input type="text" class="form-control" name="price_old" value="{{ old('price_old') }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Product Price New</label>
                                            <input type="text" class="form-control" name="price_new" value="{{ old('price_new') }}">
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
                                        <input class="form-check-input" type="radio" name="status" value="1" {{ old('status') == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label">Deactive</label>
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
                                            <input type="text" class="form-control" data-role="tagsinput" name="tags" value="{{ old('tags') }}">
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
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="card-body">
                                    <label class="form-label">Sub-Categories Select</label>
                                    <select class="form-select" id="subcategory-select" name="sub_category_id">
                                        <option value="">Select Subcategory</option>
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
                                            <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
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
                                            <input type="text" class="form-control" name="sku" value="{{ old('sku') }}">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Total Stock Quantity</label>
                                            <input type="text" class="form-control" name="stock_quantity" value="{{ old('stock_quantity') }}">
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
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Product Description</label>
                                        <textarea id="editor" name="description" class="form-control" rows="5" placeholder="Enter Product Description Here">{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>
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
                                            <button type="button" class="btn btn-secondary add-image"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row end  -->
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Add more image fields
    $('#image-container').on('click', '.add-image', function() {
        let newImageField = `
            <div class="image-field mb-2 row">
                <div class="col-md-10 col-10 col-sm-10">
                    <input type="file" name="images[]" class="form-control mb-2" accept="image/*">
                </div>
                <div class="col-md-2 col-2 col-sm-2">
                    <button type="button" class="btn btn-danger remove-image"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        `;
        $('#image-container').append(newImageField);
    });

    // Remove image fields
    $('#image-container').on('click', '.remove-image', function() {
        $(this).closest('.image-field').remove();
    });
    
    // Handle category change and fetch subcategories
    $('#category-select').on('change', function() {
        var categoryId = $(this).val();
        var $subcategorySelect = $('#subcategory-select');
        $subcategorySelect.empty();
        $subcategorySelect.append('<option value="">Select Subcategory</option>');

        if (categoryId) {
            $.ajax({
                url: '{{ url("admin/get-subcategories") }}/' + categoryId,
                method: 'GET',
                success: function(response) {
                    $subcategorySelect.empty(); // Clear previous options
                    $subcategorySelect.append('<option value="">Select Subcategory</option>');
                    $.each(response, function(index, subcategory) {
                        $subcategorySelect.append(
                            '<option value="' + subcategory.id + '">' + subcategory.name + '</option>'
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching subcategories:', error);
                }
            });
        }
    });
});
</script>

@endsection