@extends('frontend.layout')
@section('title', 'Edit Profile');
@section('style')
    .errors{
    font-weight:bold;
    color:red;
    }
@endsection
@section('content')
    <div class="container mt-5 pt-5 ">
        <form id="submit_form" method="POST" action="{{url('user/update_profile/'.$data->id)}}" enctype="multipart/form-data" data-id="{{ $data->id }}">
            @csrf
            @method('POST')
            <div class="row p-5">
                @if ($data->logo)
                    <div class=" text-center mb-4">
                        <label class="fw-bold d-block">Profile Image</label>
                        <img src="{{ asset('images/' . $data->logo) }}" width="80px" alt="User Logo">
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold mb-2">First Name</label>
                        <input type="text" name="firstname" value="{{ $data->firstname }}" class="form-control"
                            id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold mb-2">Last Name</label>
                        <input type="text" name="lastname" value="{{ $data->lastname }}" class="form-control"
                            id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold mb-2">User Name</label>
                        <input type="text" name="username" value="{{ $data->username }}" class="form-control"
                            id="">
                        @error('username')<span style="font-weight:bold; color:red">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold mb-2">Email</label>
                        <input type="email" name="email" value="{{ $data->email }}" class="form-control"
                            id="">
                        @error('email')<span style="font-weight:bold; color:red">{{$message}}</span>@enderror

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold mb-2">Phone</label>
                        <input type="text" name="phone" value="{{ $data->phone }}" class="form-control"
                            id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold mb-2">Upload Profile Image</label>
                        <input type="file" name="logo" class="form-control" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold mb-2">About</label>
                        <textarea name="about" class="form-control" id="" cols="30" rows="3">{{ $data->about }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="" class="fw-bold mb-2">Address</label>
                        <textarea name="address" class="form-control" id="" cols="30" rows="3">{{ $data->address }}</textarea>
                    </div>
                </div>

            </div>
            <button class="btn btn-primary float-end mb-5">
                Update Profile
            </button>
        </form>
    </div>
@endsection
@section('scripts')
    <!-- Ensure jQuery is loaded first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jquery-validation -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        if (typeof $.fn.validate !== 'undefined') {
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
            $('#submit_form').validate({
                errorClass: 'errors',
                ignore: [],
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
                    phone: {
                        required: true,
                        minlength: 10,
                    },
                    username: {
                        required: true,
                        minlength: 5,
                        maxlength: 32,
                        alphanumeric: true,
                    },
                    logo: {
                        required: false,
                        accept: "image/*"
                    },
                    about: {
                        required: true,
                    },
                    address: {
                        required: true,
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
                    phone: {
                        required: "Please enter your phone number",
                        minlength: "Please Enter valid phone number"
                    },
                    username: {
                        required: "Please enter your username",
                        minlength: "Username must be at least 5 characters long",
                        maxlength: "Username must be no more than 32 characters long",
                        alphanumeric: "Username can only contain letters and numbers",
                    },

                    logo: {
                        required: "Please upload file.",
                        accept: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
                    },
                    about: {
                        required: "Please enter your description"
                    },
                    address: {
                        required: "Please enter your address"
                    }
                },
                submitHandler: function(form, event) {
                    form.submit();
                    // $('#error_email').text('');
                    // $('#error_username').text('');
                    // event.preventDefault();
                    // var formData = new FormData(form);
                    // var id = $(form).data('id');
                    // $.ajax({
                    //     type: "Post",
                    //     url: '/user/update_profile/' + id,
                    //     data: formData,
                    //     contentType: false,
                    //     processData: false,
                    //     success: function(response) {
                    //         console.log(response);
                    //         if (response.errors) {
                    //             if (response.errors && response.errors.email && response.errors
                    //                 .email[
                    //                     0]) {
                    //                 $('#error_email').text(response.errors.email[0]);
                    //             }
                    //             if (response.errors && response.errors.username && response.errors
                    //                 .username[0]) {
                    //                 $('#error_username').text(response.errors.username[0]);
                    //             }
                    //         } else {
                    //             form.reset();
                    //             Swal.fire({
                    //                 icon: 'success',
                    //                 title: 'Success',
                    //                 text: response.message,
                    //                 toast: true,
                    //                 position: 'top-end',
                    //                 showConfirmButton: false,
                    //                 timer: 4000,
                    //                 timerProgressBar: true,
                    //                 didOpen: (toast) => {
                    //                     toast.addEventListener('mouseenter', Swal
                    //                         .stopTimer)
                    //                     toast.addEventListener('mouseleave', Swal
                    //                         .resumeTimer)
                    //                 }
                    //             });
                    //             setInterval(() => {
                    //                 window.location.href = '/user/profile_dashboard';
                    //             }, 4000);
                    //         }
                    //     },
                    //     error: function(error) {
                    //         console.log(error);
                    //     }
                    // })
                }
            });
        } else {
            console.error('jQuery validation plugin is not loaded');
        }
    </script>
@endsection
