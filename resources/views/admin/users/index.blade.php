@extends('admin.layouts.main')

@section('main-content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Customers List</h3>
                        <a href="{{ route('admin.users.create') }}"
                            class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"><i
                                class="fas fa-plus-circle me-2 fs-8"></i> Add User</a>

                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row clearfix g-3">
                <div class="col-sm-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Customers</th>
                                        <th>Register Date</th>
                                        <th>Mail</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td><strong>#CS-{{ $user->id }}</strong></td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $user->id) }}">
                                                    <span class="fw-bold ms-1">{{ $user->name }}</span>
                                                </a>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($user->created_at)->format('d M, Y') }}
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            @if ($user->status == 1)
                                                <td><span class="badge bg-success">Active</span></td>
                                            @else
                                                <td><span class="badge bg-danger">Inactive</span></td>
                                            @endif
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                                        class="btn btn-outline-secondary"><i
                                                            class="fas fa-edit text-success"></i></a>
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-outline-secondary deleterow"><i
                                                                class="fas fa-trash text-danger"
                                                                onclick="return confirm('Are you sure you want to delete this user?')"></i></button>
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
            </div><!-- Row End -->
        </div>
    </div>
@endsection
