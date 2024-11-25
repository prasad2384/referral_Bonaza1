@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('alert'))
            <div class="alert alert-danger" role="alert">
                {{ session('alert') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    {{ __('Login') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->
                        <!-- CAPTCHA Section -->
                        <div class="row mb-3 mb-1">
                            <label for="captcha" class="col-md-4 col-form-label text-md-end">{{ __('Captcha') }}</label>

                            <div class="col-md-6">
                                <div class="captcha">
                                    <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror mb-2" placeholder="Enter the Captha" name="captcha" required>
                                    <span id="captcha-error" class="text-danger" style="display: none;">The enter Captcha is Invalid</span>
                                    <div class="d-flex align-items-center">
                                        <span> {!! captcha_img() !!} </span>
                                        <button type="button" id="btn-refresh" class="btn btn-success btn-sm btn-refresh mx-2">
                                            <i class="fa fa-refresh" id="refresh"></i>
                                        </button>
                                    </div>
                                </div>

                                
                            </div>
                        </div>

                        <div class="row mb-0 mt-2">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jquery-validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $('#btn-refresh').click(function() {
        $.ajax({
            type: 'GET',
            url: 'refreshcaptcha',
            success: function(data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
    $(document).ready(function() {
        if ($('#captcha').hasClass('is-invalid')) {
            $('#captcha-error').show(); // Show the error message
        } else {
            $('#captcha-error').hide(); // Hide the error message
        }
        $('#captcha').on('input', function() {
            $('#captcha-error').hide(); // Hide the error message
        });
        $('form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                },
                captcha: {
                    required: true,
                   
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    required: "Please enter your password",
                },
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                if (element.prop('type') === 'checkbox') {
                    error.insertAfter(element.siblings('label'));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            },
            submitHandler: function(form) {
            
                    form.submit(); // Submit the form if validation is successful
            }
        });
    });
</script>
@endsection