@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Email') }}</div>

                <div class="card-body">
                    <form id="verification-form">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ session('email') ?? old('email') }}" required autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3" id="Verify_section">
                            <label for="verification_code" class="col-md-4 col-form-label text-md-end">{{ __('Verification Code') }}</label>

                            <div class="col-md-6">
                                <input id="verification_code" type="text" class="form-control @error('verification_code') is-invalid @enderror" name="verification_code" value="{{ old('verification_code') }}" required autocomplete="verification_code" autofocus>

                                @error('verification_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="verify_btn" >
                                    {{ __('Verify') }}
                                </button>
                                <!-- <span id="timer" class="ml-2 bg-warning p-2 rounded text-black  mx-5 text-end"></span> Timer will be displayed here -->
                            </div>
                        </div>
                        <div class="row mb-0 mt-3">
                        <div class="col-md-6 offset-md-4">
                            <button id="resend-button" class="btn btn-secondary" >
                                {{ __('Resend Verification Code') }}
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
    $(document).ready(function() {
        $('#resend-button').hide();
        $('#Verify_section').show();

        $('#verification-form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                verification_code: {
                    required: function() {
                    return $('#verify_btn').is(':visible');
                },
                    required: true,
                    minlength: 6,
                    maxlength: 6
                }
            },
            messages: {
                email: {
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                verification_code: {
                    required: "Please enter the verification code",
                    minlength: "Verification code must be 6 digits",
                    maxlength: "Verification code must be 6 digits"
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
                if ($('#verify_btn').is(':visible')) {
                    verifycode(event); // Call verifycode function if verify_btn is visible
                } else if ($('#resend-button').is(':visible')) {
                    resendCode(event); // Call resendCode function if resend-button is visible
                }
                // verifycode(); // Call your existing function for form submission
            }
        });
    })

    function verifycode(e) {
        e.preventDefault();
        $.ajax({
            url: '/verify-email-code',
            type: 'POST',
            data: $('#verification-form').serialize(),
            success: function(response) {
                if (response.success) {
                    if (response.usertype == 'user' || response.usertype == 'referee')
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        }).then(() => {

                            if (response.usertype === 'user') {
                                window.location.href = '/user/profile_dashboard';
                            } else if (response.usertype === 'admin') {
                                window.location.href = '/admin/dashboard';
                            } else if (response.usertype === 'referee') {
                                window.location.href = '/referee/referee_dashboard';
                            } else {
                                window.location.href = '/'
                            }

                        });
                } else {
                    if (response.error) {
                        Swal.fire({
                            icon: 'danger',
                            title: 'Danger',
                            text: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                toast.addEventListener('mouseleave', Swal.resumeTimer);
                            }
                        });
                        $('#resend-button').show();
                        $('#Verify_section').hide();
                        $('#verify_btn').hide();
                    }
                    Swal.fire({
                        icon: 'warning',
                        title: 'Warning',
                        text: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                }

            },
            error: function(xhr) {}
        });
    }

    function resendCode(e) {
        e.preventDefault();
        var email = $('#email').val();
        if (!email) {
            alert('Please enter the valid email address');
        }
        $.ajax({
            url: '/resend-verification-email',
            type: 'POST',
            data: $('#verification-form').serialize(),
            success: function(response) {
                if (response.success) {
                    // Display success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    });
                    $('#verify_btn').show();
                    $('#Verify_section').show();
                    $('#resend-button').hide();
                    $('#verification_code').val('');
                    // Optionally redirect to the specified URL
                    // if (response.redirect) {
                    //     window.location.href = response.redirect;
                    // }
                } else {
                    // Display error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer);
                            toast.addEventListener('mouseleave', Swal.resumeTimer);
                        }
                    }).then(() => {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    });
                }
            },
            error: {

            }

        });
    }

    @if(session('message'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('message')}}',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    @endif
</script>
@endsection