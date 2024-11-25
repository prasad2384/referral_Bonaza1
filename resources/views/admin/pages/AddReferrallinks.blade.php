@extends('admin.layout')
@section('title')
Add Referral
@endsection
@section('style')
.errors{
color:red;
}
.form-group{
margin-bottom:15px;
}
@endsection
@section('content')
<section class="content mt-3">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title float-left mt-1">Add Referral Links</h3>
            </div>
            <div class="card-body">
                <form id="Referral_form" action="{{url('admin/referral_links')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="">------------Select Category-------</option>
                                    @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>User ID</label>
                                <select name="user_id" class="form-control" id="user_id">
                                    <option value="">------------Select User-------</option>
                                    @foreach ($user as $user)
                                    <option value="{{ $user->id }}">{{ $user->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Refrell Url</label>
                                <input type="url" name="referral_url" id="referral_url" class="form-control"
                                    placeholder="Enter Url">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Website Name</label>
                                <input type="text" name="display_name" id="display_name" class="form-control"
                                    placeholder="Enter Website Name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Canonicalized Name</label>
                                <input type="text" name="canonicalized_name" id="canonicalized_name"
                                    class="form-control" placeholder="Enter Canonicalized Name">
                                <span style="color:red" id="error_username"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Upload pic</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control p-1" name="logo"
                                        class="custom-file-input" id="logo">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Promo Terms</label>
                                <input type="text" name="promo_terms" id="promo_terms" class="form-control"
                                    placeholder="Enter Promo Terms">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Promo Url</label>
                                <input type="url" name="promo_terms_url" id="promo_terms_url" class="form-control"
                                    placeholder="Enter Promo Url">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Promo Expiration Date</label>
                                <input type="date" name="promo_expiration_date" id="promo_expiration_date"
                                    class="form-control" placeholder="Enter Promo Url">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Expected Payout</label>
                                <input type="number" name="expected_payout" id="expected_payout" class="form-control"
                                    placeholder="Enter Payout">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Offer ID</label>
                                <select name="offer_id" class="form-control" id="offer_id">
                                    <option value="">Select Website</option>
                                    @foreach ($referral_website_data as $website_data)
                                    <option value="{{ $website_data->id }}">
                                        {{ $website_data->canonicalized_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Referee Share Percentage</label>
                                <input type="number" name="referee_share_percentage" id="referee_share_percentage"
                                    class="form-control" placeholder="Enter Referee Payout">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Referral Share Percentage</label>
                                <input type="number" name="referral_share_percentage" id="referral_share_percentage"
                                    class="form-control" placeholder="Enter Referral Payout">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Platform Percentage</label>
                                <input type="number" name="platform_percentage" id="platform_percentage"
                                    class="form-control" placeholder="Enter Platform Payout">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Expected Days</label>
                                <input type="number" name="expected_days" id="expected_days" class="form-control"
                                    placeholder="Enter Expected Days">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="status" class="form-control" id="">
                                    <option value="">---------Select Status------</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Active">Active</option>
                                    <option value="Expired">Expired</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary btn-sm float-right mt-2">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div><!-- /.container-fluid -->
</section>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#Referral_form').validate({
        errorClass: 'errors',
        ignore: [],
        rules: {
            category_id: {
                required: true
            },
            user_id: {
                required: true
            },
            referral_url: {
                required: true,
                url: true
            },
            display_name: {
                required: true
            },
            canonicalized_name: {
                required: false,
            },
            logo: {
                required: true,
                accept: "image/*"
            },
            promo_terms: {
                required: true
            },
            promo_terms_url: {
                required: true,
                url: true,
            },
            promo_expiration_date: {
                required: true,
            },
            expected_payout: {
                required: true
            },
            offer_id: {
                required: true
            },
            referee_share_percentage: {
                required: true,
                digits: true
            },
            referral_share_percentage: {
                required: true,
                digits: true
            },
            platform_percentage: {
                required: true,
                digits: true,
            },
            expected_days: {
                required: true,
                digits: true,
            },
            status: {
                required: true,
            }
        },
        messages: {
            category_id: {
                required: "Please select a category."
            },
            user_id: {
                required: "Please select a user."
            },
            referral_url: {
                required: "Please enter the referral URL.",
                url: "Please enter a valid URL."
            },
            display_name: {
                required: "Please enter a display name."
            },
            canonicalized_name: {
                required: "Please enter a canonicalized name."
            },
            logo: {
                required: "Please upload file.",
                accept: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
            },
            promo_terms: {
                required: "Please enter the promo terms."
            },
            promo_terms_url: {
                required: "Please enter the promo terms URL.",
                url: "Please enter a valid URL for the promo terms."
            },
            promo_expiration_date: {
                required: "Please enter the promo expiration date."
            },
            expected_payout: {
                required: "Please enter the expected payout amount."
            },
            offer_id: {
                required: "Please Select the Website    ."
            },
            referee_share_percentage: {
                required: "Please enter the referee share percentage.",
                digits: "Please enter only digits for the referee share percentage."
            },
            referral_share_percentage: {
                required: "Please enter the referral share percentage.",
                digits: "Please enter only digits for the referral share percentage."
            },
            platform_percentage: {
                required: "Please enter the platform percentage.",
                digits: "Please enter only digits for the platform percentage."
            },
            expected_days: {
                required: "Please enter the expected days.",
                digits: "Please enter only digits for the expected days."
            },
            status: {
                required: "Please select the status."
            }
        },
        // submitHandler: function(form, event) {
        //     event.preventDefault();
        //     var formData = new FormData(form);
        //     $.ajax({
        //         type: "POST",
        //         url: '/admin/referral_links',
        //         data: formData,
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             console.log(response);
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
        //                 window.location.href = '/admin/referral_links';
        //             }, 4000);
        //         },
        //         error: function(error) {
        //             console.log(error);
        //         }
        //     })
        // }
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
    });
</script>
@endsection