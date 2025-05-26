@extends('frontend.layouts.main')

@section('main-content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('frontend.home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Categories</h2>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                @foreach ($categories as $category)
                                    @if ($category->subcategories->isEmpty())
                                        <a href="{{ route('frontend.shop', $category->name) }}"
                                           class="nav-item nav-link {{ $categorySelected == $category->id ? 'text-primary' : '' }}">{{ $category->name }}</a>
                                    @else
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse{{ $loop->index }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse{{ $loop->index }}">
                                                    {{ $category->name }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $loop->index }}"
                                                 class="accordion-collapse collapse {{ $categorySelected == $category->id ? 'show' : '' }}"
                                                 aria-labelledby="heading{{ $loop->index }}"
                                                 data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="navbar-nav">
                                                        @foreach ($category->subcategories as $subcategory)
                                                            <a href="{{ route('frontend.shop', [$category->name, $subcategory->name]) }}"
                                                               class="nav-item nav-link {{ $subCategorySelected == $subcategory->id ? 'text-primary' : '' }}">{{ $subcategory->name }}</a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Brand</h2>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            @foreach ($brands as $brand)
                                <div class="form-check mb-2">
                                    <input {{ in_array($brand->id, $brandsArray) ? 'checked' : '' }}
                                           class="form-check-input brand-label" name="brand[]" type="checkbox"
                                           value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                                    <label class="form-check-label" for="brand-{{ $brand->id }}">
                                        {{ $brand->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                <div class="ml-2">
                                    <select name="sort" id="sort" class="form-control">
                                        <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest</option>
                                        <option value="price_desc" {{ $sort == 'price_desc' ? 'selected' : '' }}>Price High</option>
                                        <option value="price_asc" {{ $sort == 'price_asc' ? 'selected' : '' }}>Price Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @foreach ($products as $product)
                            <div class="col-md-4">
                                <div class="card product-card">
                                    <div class="product-image position-relative">
                                        <a href="{{ route('frontend.product', $product->id) }}" class="product-img">
                                            @php
                                                $images = json_decode($product->images, true);
                                                $mainImage = $images[0] ?? 'default.jpg';
                                            @endphp
                                            <img class="card-img-top" src="{{ asset($mainImage) }}" alt="{{ $product->name }}">
                                        </a>
                                        @if ($product->stock_quantity > 0)
                                        <a class="whishlist" href="javascript:void(0);" onclick="addToWishlist({{ $product->id }})">
                                            <i class="far fa-heart"></i>
                                        </a>
                                        @endif
                                        <div class="product-action">
                                            @if ($product->stock_quantity > 0)
                                        <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }})">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>
                                        @else
                                        <a class="btn btn-danger" href="javascript:void(0);">
                                             Out Of Stock
                                        </a>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="card-body text-center mt-3">
                                        <a class="h6 link" href="{{ route('frontend.product', $product->id) }}">{{ Str::limit($product->name, 40) }}</a>
                                        <div class="price mt-2">
                                            <span class="h5"><strong>{{ $product->price_new }}</strong></span>
                                            @if ($product->price_old)
                                                <span class="h6 text-underline">
                                                    <del>{{ $product->price_old }}</del>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-md-12 pt-5">

                            {{$products->withQueryString()->links('pagination::bootstrap-5')}}


                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('customJs')
<script>
    $(document).ready(function() {
        // Brands filter
        $(".brand-label").change(function() {
            apply_filters();
        });

        // Handle sorting filter change
        $("#sort").change(function() {
            apply_filters();
        });

        // Function to handle filter application
        function apply_filters() {
            var brands = [];

            // Loop through each checkbox to see if it's checked
            $(".brand-label:checked").each(function() {
                brands.push($(this).val());
            });

            var url = '{{ url()->current() }}?';

            // Brand filter
            if (brands.length > 0) {
                url += '&brand=' + brands.toString();
            }


            // Sorting filter

            var keyword = $("#search").val();

            if(keyword.length > 0){
            url += '&search='+keyword;

            }

            url += '&sort=' + $('#sort').val();

            window.location.href = url;
        }
    });
</script>
@endsection
