@extends('frontend.layouts.main')

@section('main-content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header bg-dark text-primary">
                        <h3 class="card-title">Thank You for Your Order!</h3>
                    </div>
                    <div class="card-body">
                        <p class="lead">Your order has been placed successfully. Our team is preparing it for shipment.</p>
                        <p><strong>Your Order ID is: {{ $id }}</strong></p>
                        <p>We will notify you once your order is dispatched. If you have any questions, please contact our support team.</p>
                        <a href="{{ route('frontend.shop') }}" class="btn btn-dark mt-3">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
