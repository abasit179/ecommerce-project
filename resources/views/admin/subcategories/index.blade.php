@extends('admin.layouts.main')

@section('main-content')
   
            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Categorie List</h3>
                                <a href="{{route('admin.subcategories.create')}}" class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i> Add Sub-Category</a>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($subcategories as $subcategory)
                                            <tr>
                                                <td><strong>#{{ $subcategory->id }}</strong></td>
                                                <td>{{ $subcategory->name }}</td>
                                                <td>{{ $subcategory->category->name }}</td>
                                                <td>{{ $subcategory->created_at }}</td>

                                                @if ($subcategory->status == 1)
                                                <td><span class="badge bg-success">Active</span></td>
                                                @else  
                                                <td><span class="badge bg-danger">Deactive</span></td>
                                                @endif
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <a href="{{ route('admin.subcategories.edit', $subcategory) }}" class="btn btn-outline-secondary"><i class="fas fa-edit text-success"></i></a>
                                                        <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-secondary deleterow"><i class="fas fa-trash text-danger" onclick="return confirm('Are you sure you want to delete this Sub category?')"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
 
@endsection