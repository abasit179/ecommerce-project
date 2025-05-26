@extends('frontend.layouts.main')

@section('main-content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Register</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-10">
        <div class="container">
            <div class="login-form">
                <form action="{{ route('account.processRegister') }}" method="post" name="registrationForm" id="registrationForm">
                    @csrf
                    <h4 class="modal-title">Register Now</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" id="name" name="name" value="{{ old('name') }}">
                        <span class="text-danger" id="nameError"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" id="email" name="email" value="{{ old('email') }}">
                        <span class="text-danger" id="emailError"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Phone" id="phone" name="phone" value="{{ old('phone') }}">
                        <span class="text-danger" id="phoneError"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        <span class="text-danger" id="passwordError"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm Password" id="cpassword" name="password_confirmation">
                        <span class="text-danger" id="cpasswordError"></span>
                    </div>
                    <div class="form-group small">
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg" value="Register">Register</button>
                </form>
                
                <div class="text-center small">Already have an account? <a href="{{route('login')}}">Login Now</a></div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('customJs')
<script type="text/javascript">
    $(document).ready(function() {
        $('#registrationForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            $.ajax({
                url: '{{ route("account.processRegister") }}',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        // Redirect to home or another page on successful registration
                        window.location.href = '{{ route("login") }}'; // Update with your route
                    } else {
                        // Clear previous error messages
                        $('.text-danger').text('');

                        // Display new error messages
                        $.each(response.message, function(key, value) {
                            $('#' + key + 'Error').text(value[0]);
                        });
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('An error occurred: ' + textStatus);
                }
            });
        });
    });
</script>
@endsection


