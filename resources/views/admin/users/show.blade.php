@extends('admin.layouts.main')

@section('main-content')
    <!-- Body: Body -->
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Customer Detail</h3>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row g-3 mb-xl-3">
                <div class="col-xxl-4 col-xl-12 col-lg-12 col-md-12">
                    <div
                        class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-1 row-deck g-3">
                        <div class="col">
                            <div class="card profile-card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Profile</h6>
                                </div>
                                <div class="card-body d-flex profile-fulldeatil flex-column">
                                    <div class="profile-block text-center w220 mx-auto">
                                        <a href="#">
                                            <img src="{{ asset('admin/assets/images/profile_av.svg') }}" alt=""
                                                class="avatar xl rounded img-thumbnail shadow-sm">
                                        </a>
                                        <div
                                            class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                            <span class="text-muted small">ID : #CS-{{ $user->id }}</span>
                                        </div>
                                    </div>
                                    <div class="profile-info w-100">
                                        <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center"> {{ $user->name }}</h6>
                                        {{-- <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span> --}}
                                        {{-- <p class="mt-2">Duis felis ligula, pharetra at nisl sit amet, ullamcorper fringilla mi. Cras luctus metus non enim porttitor sagittis. Sed tristique scelerisque arcu id dignissim.</p> --}}
                                        <div class="row g-2 pt-2">
                                            <div class="col-xl-12">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-phone"></i>
                                                    <span class="ms-2">{{ $user->phone }}</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-envelope"></i>
                                                    <span class="ms-2">{{ $user->email }}</span>
                                                </div>
                                            </div>
                                            {{-- <div class="col-xl-12">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-birthday-cake"></i>
                                                <span class="ms-2">19/03/1980</span>
                                            </div>
                                        </div> --}}
                                        @if ($user->address)
                                            <div class="col-xl-12">
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-address-book"></i>
                                                    <span class="ms-2">{{ $user->address->address }}</span>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Status Report</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-4">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0">54</h6>
                                                <span class="small text-muted">Product Visit</span>
                                            </div>
                                            <div class="progress" style="height: 2px;">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuemin="0"
                                                    aria-valuemax="100" aria-valuenow="87" data-transitiongoal="87"
                                                    style="width: 87%;"></div>
                                            </div>
                                        </li>
                                        <li class="mb-4">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0">27</h6>
                                                <span class="small text-muted">Product Buy</span>
                                            </div>
                                            <div class="progress" style="height: 2px;">
                                                <div class="progress-bar bg-info" role="progressbar" aria-valuemin="0"
                                                    aria-valuemax="100" aria-valuenow="34" data-transitiongoal="34"
                                                    style="width: 34%;"></div>
                                            </div>
                                        </li>
                                        <li class="mb-4">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0">102</h6>
                                                <span class="small text-muted">Comment on Product</span>
                                            </div>
                                            <div class="progress" style="height: 2px;">
                                                <div class="progress-bar bg-primary" role="progressbar" aria-valuemin="0"
                                                    aria-valuemax="100" aria-valuenow="14" data-transitiongoal="14"
                                                    style="width: 14%;"></div>
                                            </div>
                                        </li>
                                        <li class="mb-0">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0">1024 Hours</h6>
                                                <span class="small text-muted">Total spent time</span>
                                            </div>
                                            <div class="progress" style="height: 2px;">
                                                <div class="progress-bar bg-danger" role="progressbar" aria-valuemin="0"
                                                    aria-valuemax="100" aria-valuenow="67" data-transitiongoal="67"
                                                    style="width: 67%;"></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12">
                    @if ($user->address)
                        <div class="row g-3 mb-3 row-cols-1 row-cols-md-1 row-cols-lg-2 row-deck">
                            <div class="col">
                                <div class="card auth-detailblock">
                                    <div
                                        class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h6 class="mb-0 fw-bold ">Delivery Address</h6>
                                        {{-- <a href="#" class="text-muted">Edit</a> --}}
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                @if (!$user->address->apartment == null)
                                                    <label class="form-label col-6 col-sm-5">Block Number:</label>
                                                    <span><strong>{{ $user->address->apartment }}</strong></span>
                                                @endif

                                            </div>
                                            <div class="col-12">
                                                <label class="form-label col-6 col-sm-5">Address:</label>
                                                <span><strong>{{ $user->address->address }}</strong></span>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label col-6 col-sm-5">Zip Code:</label>
                                                <span><strong>{{ $user->address->zip }}</strong></span>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label col-6 col-sm-5">Phone:</label>
                                                <span><strong>{{ $user->address->mobile }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div
                                        class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h6 class="mb-0 fw-bold ">Billing Address</h6>
                                        <a href="#" class="text-muted">Edit</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                @if (!$user->address->apartment == null)
                                                    <label class="form-label col-6 col-sm-5">Block Number:</label>
                                                    <span><strong>{{ $user->address->apartment }}</strong></span>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label col-6 col-sm-5">Address:</label>
                                                <span><strong>{{ $user->address->address }}</strong></span>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label col-6 col-sm-5">Zip Code:</label>
                                                <span><strong>{{ $user->address->zip }}</strong></span>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label col-6 col-sm-5">Phone:</label>
                                                <span><strong>{{ $user->address->mobile }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <p class="px-3">No Addrss found for this user.</p>
                    @endif


                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Customer Order</h6>
                        </div>
                        @if ($user->orders->isNotEmpty())
                            <div class="card-body">
                                <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Payment Status</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->orders as $order)
                                            <tr>
                                                <td><a
                                                        href="{{ route('orders.detail', $order->id) }}"><strong>#Order-{{ $order->id }}</strong></a>
                                                </td>
                                                <td>{{ $order->user->name }}</td>
                                                <td>{{ $order->user->email }}</td>
                                                <td>
                                                    @if ($order->payment_status == 'not paid')
                                                        <span class="badge bg-danger">Not Paid</span>
                                                    @else
                                                        <span class="badge bg-success">Paid</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    {{ number_format($order->grand_total, 2) }}
                                                </td>
                                                <td>
                                                    @if ($order->status == 'pending')
                                                        <span class="badge bg-danger">Pending</span>
                                                    @elseif ($order->status == 'shipped')
                                                        <span class="badge bg-info">Shipped</span>
                                                    @else
                                                        <span class="badge bg-success">Delivered</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="px-3">No orders found for this user.</p>
                        @endif
                    </div>
                </div>
            </div><!-- Row end  -->
        </div>
    </div>
@endsection
