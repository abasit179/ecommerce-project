@extends('frontend.layouts.main')

@section('main-content')
<main>
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('frontend.home') }}">Home</a></li>
                    <li class="breadcrumb-item">Login</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-10">
        <div class="container">
            @if (session()->has('success'))
                <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="login-form">
                <form action="{{ route('account.authenticate') }}" method="post" name="loginForm" id="loginForm">
                    @csrf
                    <h4 class="modal-title">Login to Your Account</h4>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="{{ old('email') }}" required>
                        <span class="text-danger" id="emailError"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                        <span class="text-danger" id="passwordError"></span>
                    </div>
                    <div class="form-group small">
                        <a href="{{route('password.request')}}" class="forgot-link">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block btn-lg">Login</button>
                </form>
                <div class="text-center small">Don't have an account? <a href="{{ route('account.register') }}">Sign up</a></div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('customJs')
<script type="text/javascript">
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            $.ajax({
                url: '{{ route("account.authenticate") }}',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status) {

                        window.location.href = response.redirect_url;
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
