@extends('admin.layouts.main')

@section('main-content')
    <div class="container">
        <h1 class="my-4">Edit Shipping Company</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.shipping.update', $shippingCompany->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Shipping Company Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $shippingCompany->name }}" required>
            </div>

            <div class="form-group">
                <label for="price">Shipping Price:</label>
                <input type="number" name="charge" id="charge" class="form-control" value="{{ $shippingCompany->charge }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Shipping Company</button>
        </form>
    </div>
@endsection
