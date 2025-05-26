@extends('admin.layouts.main')

@section('main-content')
    <!-- Body: Body -->
    <div class="body d-flex py-3">
        <div class="container-xxl">
            @if (session()->has('message'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session()->get('message') }}
                    </div>
                @endif

                @if(session()->has('danger'))
                    <div class="alert alert-danger" id="success-alert">
                        {{session()->get('danger')}}
                    </div>
                    @endif

            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Products</h3>
                        <div class="btn-group group-link btn-set-task w-sm-100">
                            <a href="{{ route('admin.products.add') }}" class="btn active d-inline-flex align-items-center"
                                aria-current="page"><i class="icofont-wall px-2 fs-5"></i>Add Product</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end  -->
            <div class="row g-3 mb-3">
                <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-3">
                    <div class="sticky-lg-top">
                        <div class="card mb-3">
                            <div class="reset-block">
                                <div class="filter-title">
                                    <h4 class="title">Filter</h4>
                                </div>
                                <div class="filter-btn">
                                    <a class="btn btn-primary" href="#">Reset</a>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="categories">
                                <div class="filter-title">
                                    <a class="title" data-bs-toggle="collapse" href="#category" role="button"
                                        aria-expanded="true">Categories</a>
                                </div>
                                <div class="collapse show" id="category">
                                    <div class="filter-search">
                                        <form action="#">
                                            <input type="text" placeholder="Search" class="form-control">
                                            <button><i class="lni lni-search-alt"></i></button>
                                        </form>
                                    </div>
                                    <div class="filter-category">
                                        <ul class="category-list">
                                            <li><a href="#" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    aria-expanded="false" class="collapsed">Game accessories</a>
                                                <ul id="collapseOne" class="sub-category collapse" data-parent="#category">
                                                    <li><a href="#">PlayStation 4</a></li>
                                                    <li><a href="#">Oculus VR</a></li>
                                                    <li><a href="#">Remote</a></li>
                                                    <li><a href="#">Lighting Keyborad</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="collapsed" href="#" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseTwo">Bags</a>
                                                <ul id="collapseTwo" class="sub-category collapse" data-parent="#category">
                                                    <li><a href="#">School Bags</a></li>
                                                    <li><a href="#">Traveling Bags</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="collapsed" href="#" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseThree">Flower Port</a>
                                                <ul id="collapseThree" class="sub-category collapse"
                                                    data-parent="#category">
                                                    <li><a href="#">Woodan Port</a></li>
                                                    <li><a href="#">Pattern Port</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="collapsed" href="#" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseFour">Watch</a>
                                                <ul id="collapseFour" class="sub-category collapse" data-parent="#category">
                                                    <li><a href="#">Wall Clock</a></li>
                                                    <li><a href="#">Smart Watch</a></li>
                                                    <li><a href="#">Rado Watch</a></li>
                                                    <li><a href="#">Fasttrack Watch</a></li>
                                                    <li><a href="#">Noise Watch</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="collapsed" href="#" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseFive">Accessories</a>
                                                <ul id="collapseFive" class="sub-category collapse" data-parent="#category">
                                                    <li><a href="#">Note Diaries</a></li>
                                                    <li><a href="#">Fold Diaries</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="size-block">
                                <div class="filter-title">
                                    <a class="title" data-bs-toggle="collapse" href="#size" role="button"
                                        aria-expanded="true">Select Size</a>
                                </div>
                                <div class="collapse show" id="size">
                                    <div class="filter-size" id="filter-size-1">
                                        <ul>
                                            <li>XS</li>
                                            <li>S</li>
                                            <li class="">M</li>
                                            <li>L</li>
                                            <li>XL</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="color-block">
                                <div class="filter-title">
                                    <a class="title" data-bs-toggle="collapse" href="#color" role="button"
                                        aria-expanded="false">Select Color</a>
                                </div>
                                <div class="collapse show" id="color">
                                    <div class="filter-color">
                                        <ul>
                                            <li>
                                                <div class="color-check">
                                                    <p><span style="background-color: #4114e4;"></span>
                                                        <strong>Blue</strong>
                                                    </p>

                                                    <input type="checkbox" id="color-1">
                                                    <label for="color-1"><span></span></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="color-check">
                                                    <p><span style="background-color: #E14C7B;"></span>
                                                        <strong>Red</strong>
                                                    </p>

                                                    <input type="checkbox" id="color-2">
                                                    <label for="color-2"><span></span></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="color-check">
                                                    <p><span style="background-color: #7CB637;"></span>
                                                        <strong>Green</strong>
                                                    </p>

                                                    <input type="checkbox" id="color-3">
                                                    <label for="color-3"><span></span></label>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="color-check">
                                                    <p><span style="background-color: #161359;"></span>
                                                        <strong>Dark</strong>
                                                    </p>

                                                    <input type="checkbox" id="color-4">
                                                    <label for="color-4"><span></span></label>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="price-range-block">
                                <div class="filter-title">
                                    <a class="title" data-bs-toggle="collapse" href="#pricingTwo" role="button"
                                        aria-expanded="false">Pricing Range</a>
                                </div>
                                <div class="collapse show" id="pricingTwo">
                                    <div class="price-range">
                                        <div class="price-amount flex-wrap">
                                            <div class="amount-input mt-1">
                                                <label class="fw-bold">Minimum Price</label>
                                                <input type="text" id="minAmount2" class="form-control">
                                            </div>
                                            <div class="amount-input mt-1">
                                                <label class="fw-bold">Maximum Price</label>
                                                <input type="text" id="maxAmount2" class="form-control">
                                            </div>
                                        </div>
                                        <div id="slider-range2"
                                            class="slider-range noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="rating-block">
                                <div class="filter-title">
                                    <a class="title" data-bs-toggle="collapse" href="#rating" role="button"
                                        aria-expanded="false">Select Rating</a>
                                </div>
                                <div class="collapse show" id="rating">
                                    <div class="filter-rating">
                                        <ul>
                                            <li>
                                                <div class="rating-check">
                                                    <input type="checkbox" id="rating-5">
                                                    <label for="rating-5"><span></span>

                                                    </label>
                                                    <p>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="rating-check">
                                                    <input type="checkbox" id="rating-4">
                                                    <label for="rating-4"><span></span></label>
                                                    <p>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="rating-check">
                                                    <input type="checkbox" id="rating-3">
                                                    <label for="rating-3"><span></span></label>
                                                    <p>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="rating-check">
                                                    <input type="checkbox" id="rating-2">
                                                    <label for="rating-2"><span></span></label>
                                                    <p>
                                                        <i class="icofont-star"></i>
                                                        <i class="icofont-star"></i>
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="rating-check">
                                                    <input type="checkbox" id="rating-1">
                                                    <label for="rating-1"><span></span></label>
                                                    <p>
                                                        <i class="icofont-star"></i>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-8 col-xl-8 col-xxl-9">
                    <div
                        class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-3">
                        @if ($products->isEmpty())
                            <p>No products found.</p>
                        @else
                            @foreach ($products as $product)
                                <div class="col">
                                    <div class="card">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="product-item active">
                                                    @if ($product->images)
                                                        @php
                                                            $images = json_decode($product->images);
                                                        @endphp
                                                        <img src="{{ asset('images/' . $images[0]) }}" alt="product"
                                                            class="img-fluid w-100">
                                                    @else
                                                        <img src="assets/images/product/product-1.jpg" alt="product"
                                                            class="img-fluid w-100">
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="product-content p-3">
                                                <a href="{{ route('products.show', $product->id) }}"
                                                    class="fw-bold">{{ $product->title }} </a>
                                                <p class="text-muted">{{ Str::limit($product->description, 100) }}</p>
                                                <span
                                                    class="d-block fw-bold fs-5 text-secondary"><s>${{ $product->original_price }}</s></span>
                                                <span
                                                    class="d-block fw-bold fs-5 text-secondary">${{ $product->discounted_price }}</span>
                                                <a href="{{url('admin/product/edit', $product->id)}}" class="btn btn-primary mt-3">Edit </a>
                                                <a href="{{url('admin/product/delete', $product->id)}}" class="btn btn-danger mt-3">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <nav class="justify-content-end d-flex">
                                <ul class="pagination">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row end  -->
        </div>
    </div>




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(function() {
                    successAlert.style.display = 'none';
                }, 2000); // 2000
            }
        });
    </script>
@endsection
