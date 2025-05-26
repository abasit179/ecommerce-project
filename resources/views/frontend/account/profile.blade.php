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
        <section class="section-5 pt-3 pb-3 mb-3 bg-white">
            <div class="container">
                <div class="light-font">
                    <ol class="breadcrumb primary-color mb-0">
                        <li class="breadcrumb-item"><a class="white-text" href="{{ route('account.profile') }}">My
                                Account</a>
                        </li>
                        <li class="breadcrumb-item">Personal Information</li>
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
                                <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                            </div>

                            <form action="" name="profileForm" id="profileForm" method="post">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name"
                                                placeholder="Enter Your Name" value="{{ $user->name }}"
                                                class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email"
                                                placeholder="Enter Your Email" value="{{ $user->email }}"
                                                class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone">Phone</label>
                                            <input type="text" name="phone" id="phone"
                                                placeholder="Enter Your Phone" value="{{ $user->phone }}"
                                                class="form-control">
                                            <p></p>
                                        </div>

                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-dark">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        @if ($customerAddress)

                        <div class="card mt-5">
                            <div class="card-header">
                                <h2 class="h5 mb-0 pt-2 pb-2">Address Information</h2>
                            </div>

                            <form action="" method="post" id="addressForm" name="addressForm">

                                <div class="card-body p-4">
                                    <div class="row">

                                        <div class="mb-3">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control"
                                                placeholder="First Name" value="{{ $customerAddress->first_name ?? '' }}">
                                            <p></p>
                                        </div>


                                        <div class="mb-3">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control"
                                                placeholder="Last Name" value="{{ $customerAddress->last_name ?? '' }}">
                                            <p></p>

                                        </div>



                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                placeholder="Email" value="{{ $customerAddress->email ?? '' }}">
                                            <p></p>

                                        </div>



                                        <div class="mb-3">
                                            <label for="country">Country</label>
                                            <select name="country" id="country" class="form-control">
                                                <option value="">Select a Country</option>
                                                <option value="pakistan"
                                                    {{ !empty($customerAddress) && $customerAddress->country == 'pakistan' ? 'selected' : '' }}>
                                                    Pakistan</option>

                                            </select>
                                            <p></p>

                                        </div>



                                        <div class="mb-3">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{ $customerAddress->address ?? '' }}</textarea>
                                            <p></p>

                                        </div>



                                        <div class="mb-3">
                                            <label for="apartment">Apartment</label>
                                            <input type="text" name="apartment" id="apartment" class="form-control"
                                                placeholder="Apartment, suite, unit, etc. (optional)"
                                                value="{{ $customerAddress->apartment ?? '' }}">


                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="city">City</label>
                                                <input type="text" name="city" id="city" class="form-control"
                                                    placeholder="City" value="{{ $customerAddress->city ?? '' }}">
                                                <p></p>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="state">State</label>
                                                <input type="text" name="state" id="state" class="form-control"
                                                    placeholder="State" value="{{ $customerAddress->state ?? '' }}">
                                                <p></p>

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="zip">Zip</label>
                                                <input type="text" name="zip" id="zip" class="form-control"
                                                    placeholder="Zip" value="{{ $customerAddress->zip ?? '' }}">
                                                <p></p>

                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="mobile">Mobile</label>
                                            <input type="text" name="mobile" id="mobile" class="form-control"
                                                placeholder="Mobile No." value="{{ $customerAddress->mobile ?? '' }}">
                                            <p></p>

                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn-dark btn">Update</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


@section('customJs')
    <script>
        // Select the alert message element
        const alertMessage = document.getElementById('alert-message');

        // Check if the alert message exists
        if (alertMessage) {
            // Set a timeout to hide the alert after 2 seconds (2000 milliseconds)
            setTimeout(() => {
                alertMessage.style.display = 'none';
            }, 2000);
        }



        $("#profileForm").submit(function(event) {
            event.preventDefault();
            $.ajax({
                url: '{{ route('account.updateProfile') }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = '{{ route('account.profile') }}';
                    } else {
                        var errors = response.errors;

                        if (errors.name) {
                            $(" #profileForm #name").addClass('is-invalid').siblings("p").addClass(
                                'invalid-feedback').html(errors.name);
                        } else {
                            $("#profileForm #name").removeClass('is-invalid').siblings("p").removeClass(
                                'invalid-feedback').html(errors.name);
                        }

                        if (errors.email) {
                            $(" #profileForm #email").addClass('is-invalid').siblings("p").addClass(
                                'invalid-feedback').html(errors.email);
                        } else {
                            $("#profileForm #email").removeClass('is-invalid').siblings("p")
                                .removeClass(
                                    'invalid-feedback').html(errors.email);
                        }

                        if (errors.phone) {
                            $("#profileForm #phone").addClass('is-invalid').siblings("p").addClass(
                                'invalid-feedback').html(errors.phone);
                        } else {
                            $("#profileForm #phone").removeClass('is-invalid').siblings("p")
                                .removeClass(
                                    'invalid-feedback').html(errors.phone);
                        }

                    }
                }
            });
        });


        $("#addressForm").submit(function(event) {

            event.preventDefault();

            // $(button[type="submit"]).prop('disabled', true);

            $.ajax({
                url: '{{ route('account.updateAddress') }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    var errors = response.errors;
                    // $(button[type="submit"]).prop('disabled', false);


                    if (response.status == false) {
                        if (errors.first_name) {
                            $("#addressForm #first_name").addClass('is-invalid').siblings("p").addClass(
                                'invalid-feedback').html(errors.first_name);
                        } else {
                            $("#addressForm #first_name").removeClass('is-invalid').siblings("p")
                                .removeClass(
                                    'invalid-feedback').html(errors.first_name);
                        }

                        if (errors.last_name) {
                            $("#addressForm #last_name").addClass('is-invalid').siblings("p").addClass(
                                'invalid-feedback').html(errors.last_name);
                        } else {
                            $("#addressForm #last_name").removeClass('is-invalid').siblings("p")
                                .removeClass(
                                    'invalid-feedback').html(errors.last_name);
                        }

                        if (errors.email) {
                            $("#addressForm #email").addClass('is-invalid').siblings("p").addClass(
                                'invalid-feedback').html(errors.email);
                        } else {
                            $("#addressForm #email").removeClass('is-invalid').siblings("p")
                                .removeClass(
                                    'invalid-feedback').html(errors.email);
                        }
                        if (errors.country) {
                            $("#addressForm #country").addClass('is-invalid').siblings("p").addClass(
                                'invalid-feedback').html(errors.country);
                        } else {
                            $("#addressForm #country").removeClass('is-invalid').siblings("p")
                                .removeClass(
                                    'invalid-feedback').html(errors.country);
                        }

                        if (errors.address) {
                            $("#addressForm #address").addClass('is-invalid').siblings("p").addClass(
                                'invalid-feedback').html(errors.address);
                        } else {
                            $("#addressForm #address").removeClass('is-invalid').siblings("p")
                                .removeClass(
                                    'invalid-feedback').html(errors.address);
                        }

                        if (errors.city) {
                            $("#addressForm #city").addClass('is-invalid').siblings("p").addClass(
                                    'invalid-feedback')
                                .html(errors.city);
                        } else {
                            $("#addressForm #city").removeClass('is-invalid').siblings("p").removeClass(
                                'invalid-feedback').html(errors.city);
                        }

                        if (errors.state) {
                            $("#addressForm #state").addClass('is-invalid').siblings("p").addClass(
                                'invalid-feedback').html(errors.state);
                        } else {
                            $("#addressForm #state").removeClass('is-invalid').siblings("p")
                                .removeClass(
                                    'invalid-feedback').html(errors.state);
                        }

                        if (errors.zip) {
                            $("#addressForm #zip").addClass('is-invalid').siblings("p").addClass(
                                    'invalid-feedback')
                                .html(errors.zip);
                        } else {
                            $("#addressForm #zip").removeClass('is-invalid').siblings("p").removeClass(
                                'invalid-feedback').html(errors.zip);
                        }

                        if (errors.mobile) {
                            $("#addressForm #mobile").addClass('is-invalid').siblings("p").addClass(
                                'invalid-feedback').html(errors.mobile);
                        } else {
                            $("#addressForm #mobile").removeClass('is-invalid').siblings("p")
                                .removeClass(
                                    'invalid-feedback').html(errors.mobile);
                        }
                    } else {
                        window.location.href = "{{ route('account.profile') }}";
                    }


                }
            });
        });
    </script>
@endsection
