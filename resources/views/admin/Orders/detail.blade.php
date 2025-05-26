@extends('admin.layouts.main')

@section('main-content')
    <!-- Body: Body -->
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div
                        class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Order Details: #Order-{{ $order->id }}</h3>
                        <div class="col-auto d-flex btn-set-task w-sm-100 align-items-center">
                            <select class="form-select" aria-label="Default select example">
                                <option selected="">Select Order Id</option>
                                <option value="1">Order-78414</option>
                                <option value="2">Order-78415</option>
                                <option value="3">Order-78416</option>
                                <option value="4">Order-78417</option>
                                <option value="5">Order-78418</option>
                                <option value="6">Order-78419</option>
                                <option value="7">Order-78420</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
                <div class="col">
                    <div class="alert-success alert mb-0">
                        <div class="d-flex align-items-center">
                            <div class="avatar rounded no-thumbnail bg-success text-light"><i
                                    class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></div>
                            <div class="flex-fill ms-3 text-truncate">
                                <div class="h6 mb-0">Order Created at</div>
                                <span
                                    class="small">{{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="alert-danger alert mb-0">
                        <div class="d-flex align-items-center">
                            <div class="avatar rounded no-thumbnail bg-danger text-light"><i class="fa fa-user fa-lg"
                                    aria-hidden="true"></i></div>
                            <div class="flex-fill ms-3 text-truncate">
                                <div class="h6 mb-0">Name</div>
                                <span class="small">{{ $order->first_name }} {{ $order->last_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="alert-warning alert mb-0">
                        <div class="d-flex align-items-center">
                            <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-envelope fa-lg"
                                    aria-hidden="true"></i></div>
                            <div class="flex-fill ms-3 text-truncate">
                                <div class="h6 mb-0">Email</div>
                                <span class="small">{{ $order->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="alert-info alert mb-0">
                        <div class="d-flex align-items-center">
                            <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-phone-square fa-lg"
                                    aria-hidden="true"></i></div>
                            <div class="flex-fill ms-3 text-truncate">
                                <div class="h6 mb-0">Contact No</div>
                                <span class="small">{{ $order->mobile }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row g-3 mb-3 row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-3 row-deck">
                <div class="col">
                    <div class="card auth-detailblock">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Delivery Address</h6>
                            <a href="#" class="text-muted">Edit</a>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    @if (!$order->apartment == null)
                                        <label class="form-label col-6 col-sm-5">Block Number:</label>
                                        <span><strong>{{ $order->apartment }}</strong></span>
                                    @endif

                                </div>
                                <div class="col-12">
                                    <label class="form-label col-6 col-sm-5">Address:</label>
                                    <span><strong>{{ $order->address }}</strong></span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label col-6 col-sm-5">Zip Code:</label>
                                    <span><strong>{{ $order->zip }}</strong></span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label col-6 col-sm-5">Phone:</label>
                                    <span><strong>{{ $order->mobile }}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Billing Address</h6>
                            <a href="#" class="text-muted">Edit</a>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    @if (!$order->apartment == null)
                                        <label class="form-label col-6 col-sm-5">Block Number:</label>
                                        <span><strong>{{ $order->apartment }}</strong></span>
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label class="form-label col-6 col-sm-5">Address:</label>
                                    <span><strong>{{ $order->address }}</strong></span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label col-6 col-sm-5">Zip Code:</label>
                                    <span><strong>{{ $order->zip }}</strong></span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label col-6 col-sm-5">Phone:</label>
                                    <span><strong>{{ $order->mobile }}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Invoice Deatil</h6>
                            <a href="#" class="text-muted">Download</a>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label col-6 col-sm-5">Number:</label>
                                    <span><strong>#78414</strong></span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label col-6 col-sm-5">Seller GST :</label>
                                    <span><strong>AFQWEPX17390VJ</strong></span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label col-6 col-sm-5">Purchase GST :</label>
                                    <span><strong>NVFQWEPX1730VJ</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row g-3 mb-3">
                <div class="col-xl-12 col-xxl-8">
                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Order Summary</h6>
                        </div>
                        <div class="card-body">
                            <div class="product-cart">
                                <div class="checkout-table table-responsive">
                                    <table id="myCartTable" class="table display dataTable table-hover align-middle"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="product">Product Image</th>
                                                <th>Product Name</th>
                                                <th class="quantity">Quantity</th>
                                                <th class="price">Price</th>
                                                <th class="price">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderItems as $item)
                                                <tr>
                                                    <td>
                                                        @if (!empty($item->product->images))
                                                            @php
                                                                $images = json_decode($item->product->images, true); // Decoding JSON to array
                                                            @endphp
                                                            <img class="card-img-top avatar rounded lg"
                                                                src="{{ asset($images[0]) }}"
                                                                alt="{{ $item->product->name }} ">
                                                        @else
                                                            <img class="card-img-top"
                                                                src="{{ asset('images/default-product.jpg') }}"
                                                                alt="Default Image">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <h6 class="title">{{ Str::limit($item->name, 30) }}</h6>
                                                    </td>
                                                    <td>
                                                        {{ $item->qty }}
                                                    </td>
                                                    <td>
                                                        <p class="price">{{ number_format($item->price, 2) }}</p>
                                                    </td>
                                                    <td>
                                                        <p class="price">{{ number_format($item->total, 2) }}</p>

                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <div
                                    class="checkout-coupon-total checkout-coupon-total-2 d-flex flex-wrap justify-content-end">
                                    <div class="checkout-total">
                                        <div class="single-total">
                                            <p class="value">Subotal Price:</p>
                                            <p class="price">{{ number_format($order->subtotal, 2) }}</p>
                                        </div>
                                        <div class="single-total">
                                            <p class="value">Shipping Cost (+):</p>
                                            <p class="price">FREE</p>
                                        </div>
                                        {{-- <div class="single-total">
                                        <p class="value">Tax(18%):</p>
                                        <p class="price">$198.00</p>
                                    </div> --}}
                                        <div class="single-total total-payable">
                                            <p class="value">Total Payable:</p>
                                            <p class="price">{{ number_format($order->grand_total, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-xxl-4">
                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Status Orders</h6>
                        </div>
                        <div class="card-body">
                            <!-- Form HTML -->
                            <form action="{{ route('orders.update', $order->id) }}" method="post" id="orderForm">
                                @csrf
                                @method('PUT') <!-- For PUT request to update the record -->

                                <div class="row g-3 align-items-center">
                                    <div class="col-md-12">
                                        <label class="form-label">Order ID</label>
                                        <input type="text" readonly class="form-control"
                                            value="#order-{{ $order->id }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Order Status</label>
                                        <select class="form-select" name="status" id="status"
                                            aria-label="Order Status">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                                Shipped</option>
                                            <option value="delivered"
                                                {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Quantity</label>
                                        <input type="text" readonly class="form-control"
                                            value="{{ $totalQuantity }}">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Order Transaction</label>
                                        <select class="form-select" name="payment_status" id="payment_status"
                                            aria-label="Payment Status">
                                            <option value="not paid"
                                                {{ $order->payment_status == 'not paid' ? 'selected' : '' }}>Not Paid
                                            </option>
                                            <option value="paid"
                                                {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="comment" class="form-label">Comment</label>
                                        <textarea readonly class="form-control" id="comment" rows="4" placeholder="No Comment">{{ $order->notes ?? 'No Comment' }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4 text-uppercase">Submit</button>
                            </form>

                           

                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
        </div>
    </div>
@endsection
