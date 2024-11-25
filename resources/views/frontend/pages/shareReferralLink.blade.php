@extends('frontend.layout')
@section('title', 'Share Referral Link')
@section('style')
.error {
color: red;
font-size: 13px;
}
@endsection
@section('content')
<div class="container mt-5 pt-5">
    <div class="row my-4">
        <div class="col-12"><h3>Add New Referral</h3></div>
    </div>

    <div class="row my-4">
        <div class="col-12">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="toggleOption" id="radioForm" value="form" checked>
                <label class="form-check-label" for="radioForm">Add New Referral</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="toggleOption" id="radioDropdown" value="dropdown">
                <label class="form-check-label" for="radioDropdown">Add New Referral From Existing OFF</label>
            </div>
        </div>
    </div>
    <div id="dropdownSection" style="display:none;">
        <!-- <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Select Option
            </button>
            <ul class="dropdown-menu">
                @foreach($referral_links_data as $website_name)
                <li><a class="dropdown-item" href="#" data-id="{{$website_name->id}}">{{$website_name->canonicalized_name}}</a></li>
                @endforeach
            </ul>
            
        </div> -->
        <div class="col-3">
            <label for="referral_links">Choose Referral Link</label>
            <select class="form-select" name="referral_links" id="referral_links">
                <option value="">Select option</option>
                @foreach($referral_links_data as $website_name)
                <option value="{{$website_name->id}}">{{$website_name->display_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div id="formSection">
        <form id="referralForm" action="{{ route('save.referral.link') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="">
            <div class="row ">
                @if(session('success'))
                <div class="col-12 session">
                    <div class="alert alert-success">{{ session('success') }}</div>
                </div>
                @endif

                @if (session('error'))
                <div class="col-12 session">
                    <div class="alert alert-danger">{{ session('error') }}</div>
                </div>
                @endif

                @if ($errors->any())
                <div class="col-12 session">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <div class="col-6 mb-3">
                    <label for="category_id">Category</label>
                    <select class="form-select" name="category_id" id="category_id">
                        @foreach($category as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6 mb-3">
                    <label for="referral_url">Referral URL</label>
                    <input type="text" class="form-control" name="referral_url" id="referral_url" value="{{ old('referral_url') }}">
                </div>
                <div class="col-6 mb-3">
                    <label for="display_name">Website Display Name</label>
                    <input type="text" class="form-control" name="display_name" id="display_name" value="{{ old('display_name') }}">
                </div>
                <div class="col-6 mb-3">
                    <label for="logo">Website Logo Picture</label>
                    <input type="file" class="form-control" name="logo" id="logo">
                </div>
                <div class="col-6 mb-3">
                    <label for="promo_terms">Promo Terms</label>
                    <textarea class="form-control" name="promo_terms" id="promo_terms">{{ old('promo_terms') }}</textarea>
                </div>
                <div class="col-6 mb-3">
                    <label for="promo_terms_url">Promo Terms URL</label>
                    <input type="text" class="form-control" name="promo_terms_url" id="promo_terms_url" value="{{ old('promo_terms_url') }}">
                </div>
                <div class="col-6 mb-3">
                    <label for="promo_expiration_date">Promo Expiration Date</label>
                    <input type="date" class="form-control" name="promo_expiration_date" id="promo_expiration_date" value="{{ old('promo_expiration_date') }}">
                </div>
                <div class="col-6 mb-3">
                    <label for="expected_payout_by_website">Expected Dollar Payout from the Website (given directly by the website)</label>
                    <input type="text" class="form-control" name="expected_payout_by_website" id="expected_payout_by_website" value="{{ old('expected_payout_by_website') }}">
                </div>
                <div class="col-6 mb-3">
                    <label for="expected_payout_by_referar">Expected Dollar Payout Shared by the Referrer</label>
                    <input type="text" class="form-control" name="expected_payout_by_referar" id="expected_payout_by_referar" value="{{ old('expected_payout_by_referar') }}">
                </div>
                <div class="col-6 mb-3">
                    <label for="expected_days">Expected Number of Days to Get the Promotion</label>
                    <input type="text" class="form-control" name="expected_days" id="expected_days" value="{{ old('expected_days') }}">
                </div>
                <div class="col-12 mb-3">
                    <input type="submit" value="Submit" class="form-control btn btn-primary" style="width: fit-content;">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('input[name="toggleOption"]').change(function() { // change add/edit form by redio button 
            if ($(this).val() == 'form') {//set form for create 
                $('#formSection').show();
                $('#dropdownSection').hide();
                $('#referralForm').trigger('reset');
                $('#referralForm').attr('action', '{{ route("save.referral.link") }}');
            } else { // set form for update
                $('#formSection').hide();
                $('#dropdownSection').show();
                $('#referralForm').attr('action', '{{ route("update.referral.link") }}');
            }
            
            $('.session').html('');
            $('#referralForm').find('.error').removeClass('error');
            $('#referralForm').find('.valid').removeClass('valid');
        });

        // Handle dropdown item click
        $('#referral_links').change(function() {
            $( '#referralUpdateForm' ).show();
            let websiteId = $(this).val();
            // Fetch the data based on the selected website
            $.ajax({
                url: '/get-referral-link-data/' + websiteId,
                type: 'GET',
                success: function(data) {
                    // Populate the form fields with the data
                    $('#id').val(data.id);
                    $('#category_id').val(data.category_id);
                    $('#referral_url').val(data.referral_url);
                    $('#display_name').val(data.display_name);
                    $('#promo_terms').val(data.promo_terms);
                    $('#promo_terms_url').val(data.promo_terms_url);
                    $('#promo_expiration_date').val(data.promo_expiration_date);
                    $('#expected_payout_by_website').val(data.expected_payout_by_website);
                    $('#expected_payout_by_referar').val(data.expected_payout_by_referar);
                    $('#expected_days').val(data.expected_days);
                    $('input[name="id"]').val(data.id); // Set the hidden ID field

                    $('#formSection').show();
                    $('#dropdownSection').hide();
                },
                error: function() {
                    Swal.fire({
                        position: "center",
                        icon: "error",
                        title: "Somethng went wrong",
                        showConfirmButton: false,
                        timer: 500
                    });
                }
            });
        });

        $('#referralForm-dropdown').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            var formData = new FormData(this);

            $.ajax({
                url: '/update-referral-link', // Update this URL to your update route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Referral link updated successfully!'
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to update referral link.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while updating the referral link.'
                    });
                }
            });
        });
        $("#referralForm").validate({
            rules: {
                category_id: "required",
                referral_url: {
                    required: true,
                    url: true
                },
                display_name: {
                    required: true,
                    maxlength: 255
                },
                logo: {
                    required: true,
                    extension: "jpeg,png,jpg,gif,svg",
                    filesize: 2048000 // 2MB in bytes
                },
                promo_terms: {
                    maxlength: 255
                },
                promo_terms_url: {
                    url: true
                },
                promo_expiration_date: {
                    date: true,
                    promo_expiration_date : true
                },
                expected_payout_by_website: {
                    required: true,
                    number: true
                },
                expected_payout_by_referar: {
                    required: true,
                    number: true
                },
                expected_days: {
                    number: true
                }
            },
            messages: {
                category_id: "Please select a category",
                referral_url: {
                    required: "Please enter a referral URL",
                    url: "Please enter a valid URL"
                },
                display_name: {
                    required: "Please enter a display name",
                    maxlength: "Display name must not exceed 255 characters"
                },
                logo: {
                    required: "Please upload a logo",
                    extension: "Allowed file types: jpeg, png, jpg, gif, svg",
                    filesize: "File size must be less than 2MB"
                },
                promo_terms: {
                    maxlength: "Promo terms must not exceed 255 characters"
                },
                promo_terms_url: {
                    url: "Please enter a valid URL"
                },
                promo_expiration_date: {
                    date: "Please enter a valid date",
                },
                expected_payout_by_website: {
                    required: "Please enter the expected payout from website",
                    number: "Please enter a valid number"
                },
                expected_payout_by_referar: {
                    required: "Please enter the expected payout",
                    number: "Please enter a valid number"
                },
                expected_days: {
                    number: "Please enter a valid number"
                }
            }
        });

        $.validator.addMethod('filesize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, 'File size must be less than {0}');

        $.validator.addMethod("promo_expiration_date", function(value, element) {
            var inputDate = new Date(value);
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Set to midnight to ignore time part
            return inputDate > today;
        }, "Please select a future date.");
    });
</script>
@endsection