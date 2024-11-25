@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('alert'))
            <div class="alert alert-warning" role="alert">
                {{ session('alert') }}
            </div>
            @endif
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('storeregisterdata') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="" class="col-md-4 col-form-label text-md-end">{{__('Usertype')}}</label>
                            <div class="col-md-6">
                                <select class="form-control" name="usertype" id="usertype">
                                    <option value="">---------Select User--------</option>
                                    <option value="user">Referrer</option>
                                    <option value="referee">Referee</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 mb-1">
                            <label for="captcha" class="col-md-4 col-form-label text-md-end">{{ __('Captcha') }}</label>

                            <div class="col-md-6">
                                <div class="captcha">
                                    <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror mb-2" placeholder="Enter the Captha" name="captcha" required>
                                    <span id="captcha-error" class="text-danger" style="display: none;">The enter Captcha is Invalid</span>
                                    <div class="d-flex align-items-center">

                                        <span class="d-block"> {!! captcha_img() !!} </span>
                                        <button type="button" id="btn-refresh" class="btn btn-success btn-sm btn-refresh mx-2">
                                            <i class="fa fa-refresh" id="refresh"></i>
                                        </button>
                                    </div>
                                </div>

                                @error('captcha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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
    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 && value != "";
    }, "No space please and don't leave it empty");
    $.validator.addMethod("noDigits", function(value, element) {
        return this.optional(element) || !/\d/.test(value);
    }, "No digits allowed");
    $.validator.addMethod("noSpecialChars", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\s]*$/.test(value);
    }, "No special characters allowed");
    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
    }, "Only letters and numbers are allowed");
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
                firstname: {
                    required: true,
                    noSpace: true,
                    noDigits: true,
                    noSpecialChars: true,
                },
                lastname: {
                    required: true,
                    noSpace: true,
                    noSpecialChars: false,
                    noDigits: true,
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                },
                usertype: {
                    required: true
                }
            },
            messages: {
                firstname: {
                    required: "Please enter your first name",
                },
                lastname: {
                    required: "Please enter your last name",
                },
                email: {
                    required: "Please enter your email",
                    email: "Invalid email address"
                },
                password: {
                    required: "Please enter your password",
                    minlength: "Your password must be at least 5 characters long"
                },
                password_confirmation: {
                    required: "Please confirm your password",
                    equalTo: "Password and confirmation do not match"
                },
                usertype: {
                    required: "Please select a user type"
                }
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
                // Optional: Display a confirmation alert before submitting
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Please confirm the details before submitting!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, submit it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    });
</script>
@endsection