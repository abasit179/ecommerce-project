@extends('admin.layouts.main')

@section('main-content')
    <!-- Body: Body -->
    <div class="body d-flex py-3">
        <div class="container-xxl">
          <div class="row align-items-center">
            <div class="border-0 mb-4">
              <div
                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap"
              >
                <h3 class="fw-bold mb-0">Product List</h3>
                <a
                  href="#"
                  class="btn btn-primary py-2 px-5 btn-set-task w-sm-100"
                  ><i class="icofont-plus-circle me-2 fs-6"></i> Add
                  Product</a
                >
              </div>
            </div>
          </div>
          <!-- Row end  -->
          <div class="row g-3 mb-3">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-9">
              <div class="card mb-3 bg-transparent p-2">
                  @foreach($products as $product)
                  
                <div class="card border-0 mb-1">
                  <div
                    class="form-check form-switch position-absolute top-0 end-0 py-3 px-3"
                  >
                    <div
                      class="btn-group"
                      role="group"
                      aria-label="Basic outlined example"
                    >
                      <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-secondary"
                        ><i class="fas fa-edit text-success"></i
                      ></a>
                      <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline">
                        @csrf
                       @method('DELETE')
                        <button
                          type="submit"
                          class="btn btn-outline-secondary deleterow"
                        >
                          <i
                            class="fas fa-trash text-danger"
                            onclick="return confirm('Are you sure you want to delete this category?')"
                          ></i>
                        </button>
                      </form>
                    </div>
                  </div>
                  <div
                    class="card-body d-flex align-items-center flex-column flex-md-row"
                  >
                    <a href="#">
                      @if (!empty($product->images))
                                            @php
                                                $images = json_decode($product->images, true); // Decoding JSON to array
                                            @endphp
                                            <img class="card-img-top w120 rounded " src="{{ asset($images[0]) }}"
                                                alt="{{ $product->name }}">
                                        @else
                                            <img class="card-img-top" src="{{ asset('images/default-product.jpg') }}"
                                                alt="Default Image">
                                        @endif
                    </a>
                    <div
                      class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100"
                    >
                      <a href="product-detail.html"
                        ><h6 class="mb-3 fw-bold">{{ Str::limit($product->name,20)  }}</h6></a
                      >
                      <div
                        class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start"
                      >
                        <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2" >
                          <div class="text-muted small">Price</div>
                          <strong>{{ $product->price_new }}</strong>
                        </div>
                        <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2" style="width: 200px">
                          <div class="text-muted small">SKU</div>
                          <strong>{{ Str::limit($product->sku,20) }}</strong>
                        </div>
                        <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                          <div class="text-muted small">Stock QTY</div>
                          @if ($product->stock_quantity <= 0)
                          <td><span class="badge bg-danger">Out of Stock</span></td>
                          @else
                          <strong>{{ $product->stock_quantity }}</strong>
                          @endif
                        </div>
                        <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                          <div class="text-muted small">Status</div>
                          @if ($product->status == 1)
                          <td><span class="badge bg-success">Active</span></td>
                          @else  
                          <td><span class="badge bg-danger">Deactive</span></td>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
              <div class="row g-3 mb-3">
                <div class="col-md-12">
                    {{$products->withQueryString()->links('pagination::bootstrap-5')}}
                </div>
              </div>
            </div>
          </div>
          <!-- Row end  -->
        </div>
      </div>
@endsection
