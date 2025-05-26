@extends('frontend.layouts.main')

@section('main-content')
    <main>
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.shop') }}">Shop</a></li>
                        <li class="breadcrumb-item">{{ Str::limit($product->name, '20') }}</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="section-7 pt-3 mb-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner bg-light">
                                @php
                                    $images = json_decode($product->images, true);
                                @endphp
                                @foreach ($images as $key => $image)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img class="w-100 h-100" src="{{ asset($image) }}" alt="Image">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                            </a>
                            <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                            </a>
                        </div>

                    </div>
                    <div class="col-md-7">
                        <div class="bg-light right">
                            <h1>{{ $product->name }}</h1>
                            <div class="d-flex mb-3">
                                <div class="text-primary mr-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <small class="{{ $i < $product->rating ? 'fas fa-star' : 'far fa-star' }}"></small>
                                    @endfor
                                </div>
                                <small class="pt-1">({{ $product->reviews_count }} Reviews)</small>
                            </div>
                            <h2 class="price text-secondary"><del>${{ $product->price_old }}</del></h2>
                            <h2 class="price">${{ $product->price_new }}</h2>

                            <p>{!! Str::limit(strip_tags($product->description), 300, '...') !!}</p>

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

                    <div class="col-md-12 mt-5">
                        <div class="bg-light">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="shipping-tab" data-bs-toggle="tab"
                                        data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping"
                                        aria-selected="false">Shipping & Returns</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                        type="button" role="tab" aria-controls="reviews"
                                        aria-selected="false">Reviews</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <p>{!! $product->description !!}</p>
                                </div>
                                <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                    <p>Shipping details will be added here.</p>
                                </div>
                                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                    <!-- Display Reviews Here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-5 section-8">
            <div class="container">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
                <div class="col-md-12">
                    <div id="related-products" class="carousel">
                        @foreach ($relatedProducts as $product)
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                    <a href="{{ route('frontend.product', $product->id) }}" class="product-img">
                                        @php
                                            // Decode the images stored in JSON format
                                            $images = json_decode($product->images, true);
                                            // Use the first image or provide a default image if none exists
                                            $imagePath = !empty($images)
                                                ? asset($images[0])
                                                : asset('uploads/products/default.jpg');
                                        @endphp
                                        <img class="card-img-top" src="{{ $imagePath }}" alt="{{ $product->name }}">
                                    </a>
                                    @if ($product->stock_quantity > 0)
                                    <a class="whishlist" href="javascript:void(0);" onclick="addToWishlist({{ $product->id }})">
                                        <i class="far fa-heart"></i>
                                    </a>
                                    @endif

                                    <div class="product-action">
                                        <a class="btn btn-dark" href="javascript:void(0);" onclick="addToCart({{ $product->id }})">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link"
                                        href="{{ route('frontend.product', $product->id) }}">{{ Str::limit($product->name, '40') }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>${{ $product->price_new }}</strong></span>
                                        @if ($product->price_old)
                                            <span class="h6 text-underline"><del>${{ $product->price_old }}</del></span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection


@section('customJs')
    
@endsection
