@extends('frontend.layouts.main')


@section('main-content')
    <main>

        <!-- Check for Success Message -->
        @if (session()->has('success'))
        <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if (session()->has('error'))
        <div id="alert-message" class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session()->get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My Account</a>
                        </li>
                        <li class="breadcrumb-item">Wishlist</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class=" section-11 ">
            <div class="container  mt-5">
                <div class="row">
                    <div class="col-md-3">
                        @include('frontend.account.common.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">My Wishlist</h2>
                            </div>
                            <div class="card-body p-4">
                                @if ($wishlists->isEmpty())
                                <div class="row justify-content-center w-100">
                                    <div class="text-center p-5 border rounded bg-light">
                                        <h2 class="text-muted">Your Wishlist is Empty</h2>
                                        <p class="text-secondary mt-3">It looks like you haven't added anything to your wishlist yet. Start shopping now to fill it up!</p>
                                        <a href="{{route("frontend.shop")}}" class="btn btn-dark">Continue Shopping</a>
                                    </div>
                                    
                                </div>
@else
    @foreach ($wishlists as $wishlist)
        <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
            <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{route('frontend.product',$wishlist->product->id)}}"
                    style="width: 10rem;">
                    @if (!empty($wishlist->product->images))
                        @php
                            $images = json_decode($wishlist->product->images, true); // Decoding JSON to array
                        @endphp
                        <img class="card-img-top" src="{{ asset($images[0]) }}"
                             alt="{{ $wishlist->product->name }}">
                    @else
                        <img class="card-img-top" src="{{ asset('images/default-product.jpg') }}"
                             alt="Default Image">
                    @endif
                </a>
                <div class="pt-2">
                    <h3 class="product-title fs-base mb-2">
                        <a href="{{route('frontend.product',$wishlist->product->id)}}">{{ Str::limit($wishlist->product->name, 30) }}</a>
                    </h3>
                    <div class="fs-lg text-accent pt-2">
                        {{ number_format($wishlist->product->price_new, 2) }}
                    </div>
                </div>
            </div>
            <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                <form action="{{ route('account.removeProductWishList', $wishlist->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to remove this item from your wishlist?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger btn-sm" type="submit">
                        <i class="fas fa-trash-alt me-2"></i>Remove
                    </button>
                </form>
            </div>
        </div>
    @endforeach
@endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


{{-- @section('customJs')
<script>
    function removeProduct(id){
        $.ajax({
                url: '{{ route("account.removeProductWishList") }}',
                type: 'POST',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                   if(response.status == true){
                    window.location.href= "{{route('account.wishlist')}}"
                   }
                }
            });
    }
</script>
@endsection --}}