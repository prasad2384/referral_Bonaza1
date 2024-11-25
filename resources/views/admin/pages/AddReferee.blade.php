@extends('admin.layout')
@section('title','Add Referee')
@section('style')
.errors{
color:red;
}
@endsection
@section('content')
<section class="content mt-3">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title float-left mt-1">Add Referee</h3>
            </div>
            <div class="card-body">
                <form id="submit_form" method="POST" action="{{url('admin/referee')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class=" col-sm-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control"
                                    placeholder="Enter First Name" value="{{old('firstname')}}">
                            </div>
                        </div>
                        <div class=" col-sm-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control"
                                    placeholder="Enter Last Name" value="{{old('lastname')}}">
                            </div>
                        </div>
                        <div class=" col-sm-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="email" value="{{old('email')}}" class="form-control" placeholder="Enter Email">
                                @error('email') <span class="text-danger font-weight-bold error-email">{{$message}}</span>@enderror

                                <!-- <span style="color:red" id="error_email"></span> -->
                            </div>
                        </div>
                        <div class=" col-sm-6">
                            <div class="form-group">
                                <label>Phone No</label>
                                <input type="number" name="phone" id="phone" class="form-control"
                                    placeholder="Enter Phone No" value="{{old('phone')}}">
                            </div>
                        </div>
                        <div class=" col-sm-6">
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Enter User Name" value="{{old('username')}}">
                                @error('username') <span class="text-danger font-weight-bold error-username">{{$message}}</span>@enderror
                                <!-- <span style="color:red" id="error_username"></span> -->
                            </div>
                        </div>
                        <div class=" col-sm-6">
                            <div class="form-group">    
                                <label for="exampleInputFile">Upload pic</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control p-1" name="logo"
                                        class="custom-file-input" id="logo">
                                </div>
                            </div>
                        </div>
                        <div class=" col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Enter Password" value="{{old('password')}}">
                            </div>
                        </div>
                        <div class=" col-sm-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control" id="">
                                    <option value="">---------Select Status------</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Removed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">About</label>
                                <textarea name="about" class="form-control" id="about" cols="30" rows="1">{{old('about')}}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm float-right mt-2">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
</section>
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
                password: {
                    required: true
                },
                phone: {
                    required: false,
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
                password: {
                    required: "Please enter your password"
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
                }
            },
            // errorElement: 'p',
            // errorPlacement: function(error, element) {
            //     error.addClass('invalid-feedback display-4 font-weight-bold');
            //     element.closest('.form-group').append(error);
            // },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                $('#submit_form')[0].submit();
            }

            // submitHandler: function(form, event) {
            //     $('#error_email').text('');
            //     $('#error_username').text('');
            //     var formData = new FormData(form);
            //     console.log(formData);
            //     event.preventDefault();
            //     $.ajax({
            //         type: "Post",
            //         url: '/admin/users',
            //         data: formData,
            //         contentType: false,
            //         processData: false,
            //         success: function(response) {
            //             console.log(response);
            //             if (response.errors) {
            //                 if (response.errors && response.errors.email && response.errors
            //                     .email[
            //                         0]) {
            //                     $('#error_email').text(response.errors.email[0]);
            //                 }
            //                 if (response.errors && response.errors.username && response.errors
            //                     .username[0]) {
            //                     $('#error_username').text(response.errors.username[0]);
            //                 }
            //             } else {
            //                 form.reset();
            //                 Swal.fire({
            //                     icon: 'success',
            //                     title: 'Success',
            //                     text: response.message,
            //                     toast: true,
            //                     position: 'top-end',
            //                     showConfirmButton: false,
            //                     timer: 4000,
            //                     timerProgressBar: true,
            //                     didOpen: (toast) => {
            //                         toast.addEventListener('mouseenter', Swal
            //                             .stopTimer)
            //                         toast.addEventListener('mouseleave', Swal
            //                             .resumeTimer)
            //                     }
            //                 });
            //                 setInterval(() => {
            //                     window.location.href = '/admin/users';
            //                 }, 4000);
            //             }
            //         },
            //         error: function(error) {
            //             console.log(error);
            //         }
            //     })

            // }
        });
    } else {
        console.error('jQuery validation plugin is not loaded');
    }
</script>
<script>
    $(document).ready(function() {
        // Remove error and invalid class when user types in email field
        $('#email').on('input', function() {
            $('.error-email').remove();
        });

        // Remove error and invalid class when user types in username field
        $('#username').on('input', function() {
            $('.error-username').remove();
        });

        // Handle other input fields similarly if needed
    });
    $('#logo').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').text(fileName);
    });
</script>
@endsection