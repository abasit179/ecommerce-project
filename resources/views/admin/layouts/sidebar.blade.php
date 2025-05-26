 <!-- sidebar -->
 <div class="sidebar px-4 py-4 py-md-4 me-0">
    <div class="d-flex flex-column h-100">
        <a href="index.html" class="mb-0 brand-icon">
            <span class="logo-icon">
                <i class="bi bi-bag-check-fill fs-4"></i>
            </span>
            <span class="logo-text">eBazar</span>
        </a>
        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1 mt-3">
            <li><a class="m-link active" href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a></li>
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#">
                    <i class="fas fa-gift"></i> <span>Products</span> <span class="fas fa-chevron-down ms-auto text-end fs-6"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="menu-product">
                    <li><a class="ms-link" href="{{route('admin.products.index')}}">Products</a></li>
                    <li><a class="ms-link" href="#">Product Edit</a></li>
                    <li><a class="ms-link" href="product-detail.html">Product Details</a></li>
                    <li><a class="ms-link" href="#">Product Add</a></li>
                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#categories" href="#">
                    <i class="fas fa-th-list"></i> <span>Categories</span> <span class="fas fa-chevron-down ms-auto text-end fs-6"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="categories">
                    <li><a class="ms-link" href="{{route('admin.categories.index')}}">Categories</a></li>
                    {{-- <li><a class="ms-link" href="{{route('categories.create')}}">Add Category</a></li> --}}
                    <li><a class="ms-link" href="{{route('admin.subcategories.index')}}">Sub Categories</a></li>
                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#brands" href="#">
                    <i class="fas fa-th-list"></i> <span>Brands</span> <span class="fas fa-chevron-down ms-auto text-end fs-6"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="brands">
                    <li><a class="ms-link" href="{{route('admin.brands.index')}}">Brands</a></li>
                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-order" href="#">
                <i class="fas fa-receipt"></i> <span>Orders</span> <span class="fas fa-chevron-down ms-auto text-end fs-6"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="menu-order">
                    <li><a class="ms-link" href="{{route('orders.index')}}">Orders List</a></li>
                    <li><a class="ms-link" href="order-details.html">Order Details</a></li>
                    <li><a class="ms-link" href="order-invoices.html">Order Invoices</a></li>
                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-shipping" href="#">
                <i class="fas fa-receipt"></i> <span>Shipping</span> <span class="fas fa-chevron-down ms-auto text-end fs-6"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="menu-shipping">
                    <li><a class="ms-link" href="{{route('admin.shipping.index')}}">Shipping Companies</a></li>
                    <li><a class="ms-link" href="order-details.html">Order Details</a></li>
                    <li><a class="ms-link" href="order-invoices.html">Order Invoices</a></li>
                </ul>
            </li>
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#customers-info" href="#">
                <i class="fas fa-user fs-5"></i> <span>Customers</span> <span class="fas fa-chevron-down ms-auto text-end fs-6"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="customers-info">
                    <li><a class="ms-link" href="{{route('admin.users.index')}}">Customers List</a></li>
                    <li><a class="ms-link" href="customer-detail.html">Customers Details</a></li>
                </ul>
            </li>
        </ul>
       
    </div>
</div>