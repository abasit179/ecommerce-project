@extends('admin.layouts.main')

@section('main-content')
    <div class="container">
        <h1 class="my-4">Shipping Companies</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.shipping.create') }}" class="btn btn-primary mb-3">Add New Shipping Company</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Company Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shippingCompanies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->charge }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <a href="{{ route('admin.shipping.edit', $company->id) }}" class="btn btn-outline-secondary"><i class="fas fa-edit text-success"></i></a>
                                <form action="{{ route('admin.shipping.destroy', $company->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" class="btn btn-outline-secondary deleterow"><i class="fas fa-trash text-danger" onclick="return confirm('Are you sure you want to delete this category?')"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
