@extends('admin.layout')
@section('title')
    Update Referral Website
@endsection
@section('style')
        .errors {
            color: red;
        }
        .form-group {
            margin-bottom: 15px;
        }
@endsection
@section('content')
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title float-left mt-1">Update Referral Website</h3>
                </div>
                <div class="card-body">
                    <form id="Referral_form" action="{{url('admin/referral_web_site/'. $data->id)}}" method="POST" enctype="multipart/form-data" data-id="{{ $data->id }}">
                        @csrf
                        @method('PUT')
                        @if ($data->logo)
                            <div class="text-center mb-4">
                                <img src="{{ asset('images/' . $data->logo) }}" width="80px" alt="Logo">
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        <option value="">------------Select Category-------</option>
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ $cat->id == $data->category_id ? 'selected' : '' }}>{{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>User ID</label>
                                    <select name="user_id" class="form-control" id="user_id">
                                        <option value="">------------Select User-------</option>
                                        @foreach ($user as $userItem)
                                            <option value="{{ $userItem->id }}"
                                                {{ $userItem->id == $data->user_id ? 'selected' : '' }}>{{ $userItem->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Referral URL</label>
                                    <input type="url" name="referral_url" id="referral_url" class="form-control"
                                        placeholder="Enter URL" value="{{ $data->referral_url }}">
                                </div>
                            </div> -->
                            <!-- <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Canonicalized Name</label>
                                    <input type="text" name="display_name" id="display_name" class="form-control"
                                        placeholder="Enter Website Name" value="{{ $data->canonicalized_name }}">
                                </div>
                            </div> -->
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Canonicalized Name</label>
                                    <input type="text" name="canonicalized_name" id="canonicalized_name"
                                        class="form-control" placeholder="Enter Canonicalized Name"
                                        value="{{ $data->canonicalized_name }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Upload Logo</label>
                                    <input type="file" name="logo" class="form-control" id="logo">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Promo Terms</label>
                                    <input type="text" name="promo_terms" id="promo_terms" class="form-control"
                                        placeholder="Enter Promo Terms" value="{{ $data->promo_terms }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Promo URL</label>
                                    <input type="url" name="promo_terms_url" id="promo_terms_url" class="form-control"
                                        placeholder="Enter Promo URL" value="{{ $data->promo_terms_url }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Promo Expiration Date</label>
                                    <input type="date" name="promo_expiration_date" id="promo_expiration_date"
                                        class="form-control" value="{{ $data->promo_expiration_date }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Expected Payout</label>
                                    <input type="number" name="expected_payout" id="expected_payout" class="form-control"
                                        placeholder="Enter Payout" value="{{ $data->expected_payout }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Referee Share Percentage</label>
                                    <input type="number" name="referee_share_percentage" id="referee_share_percentage"
                                        class="form-control" placeholder="Enter Referee Share Percentage"
                                        value="{{ $data->referee_share_percentage }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Referral Share Percentage</label>
                                    <input type="number" name="referral_share_percentage" id="referral_share_percentage"
                                        class="form-control" placeholder="Enter Referral Share Percentage"
                                        value="{{ $data->referral_share_percentage }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Platform Percentage</label>
                                    <input type="number" name="platform_percentage" id="platform_percentage"
                                        class="form-control" placeholder="Enter Platform Percentage"
                                        value="{{ $data->platform_percentage }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Expected Days</label>
                                    <input type="number" name="expected_days" id="expected_days" class="form-control"
                                        placeholder="Enter Expected Days" value="{{ $data->expected_days }}">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="">---------Select Status------</option>
                                        <option value="Pending" {{ $data->status == 'Pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="Active" {{ $data->status == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="Expired" {{ $data->status == 'Expired' ? 'selected' : '' }}>Expired
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-sm float-right mt-2">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.container-fluid -->
        </div>
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
                // referral_url: {
                //     required: true,
                //     url: true
                // },
                display_name: {
                    required: true
                },
                canonicalized_name: {
                    required: false,
                },
                logo: {
                    required: false,
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
                // referral_url: {
                //     required: "Please enter the referral URL.",
                //     url: "Please enter a valid URL."
                // },
                display_name: {
                    required: "Please enter the website name."
                },
                promo_terms: {
                    required: "Please enter the promo terms."
                },
                promo_terms_url: {
                    required: "Please enter the promo URL.",
                    url: "Please enter a valid URL."
                },
                promo_expiration_date: {
                    required: "Please enter the promo expiration date."
                },
                expected_payout: {
                    required: "Please enter the expected payout."
                },
                referee_share_percentage: {
                    required: "Please enter the referee share percentage.",
                    digits: "Please enter a valid number."
                },
                referral_share_percentage: {
                    required: "Please enter the referral share percentage.",
                    digits: "Please enter a valid number."
                },
                platform_percentage: {
                    required: "Please enter the platform percentage.",
                    digits: "Please enter a valid number."
                },
                expected_days: {
                    required: "Please enter the expected days.",
                    digits: "Please enter a valid number."
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function() {
                $('#Referral_form')[0].submit();
            }
          
        });
    </script>
@endsection