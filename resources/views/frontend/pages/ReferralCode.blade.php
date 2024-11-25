@extends('frontend.layout')
@section('title', 'Referral Code')
@section('content')
<!-- ======================= Edit Profile START -->

<section class="position-relative overflow-hidden pb-0 pt-xl-9 profile-section text-center">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5 g-5 g-xl-5">
            <div class="name-img">
                <img src="{{ asset('images/'. $referral_links_data->logo) }}" alt="">
            </div>
            <h2>{{ $referral_links_data->canonicalized_name }}</h2>
        </div>
    </div>
</section>

<section class="position-relative overflow-hidden pb-0 pt-xl-9 referralcode-section text-center">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5 g-5 g-xl-5 pt-5">
            <div class="refferal-box">
                <h5>Offer URL</h5>
                <!-- Form to handle click activity -->
                <form id="clickActivityForm" action="{{url('/click_activity_data') }}" method="POST">
                    @csrf
                    <input type="hidden" name="referral_id" value="{{ $referral_links_data->id }}">
                    <input type="hidden" name="referee_user_id" value="{{ $user->id }}"> 
                    <input type="hidden" name="referrer_user_id" value="{{ $referral_links_data->user_id }}"> 
                    <input type="hidden" name="click_timestamps" id="clickTimestamps">
                    <input type="hidden" name="date_pst" id="datePst" value="">
                    <input type="hidden" name="referee_confirmation_status" value="opened">
                    <input type="hidden" name="referrer_paid_platform_fee" value="not_yet">
                    <input type="hidden" name="referrer_paid_referee" value="not_yet">
                    <input type="hidden" name="transaction_comments" value="this is good promo code">
                    <input type="hidden" name="transaction_ratings" value="4">
                    <input type="hidden" name="referral_url" value="{{$referral_links_data->referral_url}}">    
                 
                  <button type="button" id="click_activity_data_send" class="btn mb-3 btn-secondary btn-success btn-light">
                        Click Here
                    </button>
                </form>

                @foreach ($category as $cat)
                @if ($cat->id == $referral_links_data->category_id)
                <h6 class="category">Category: {{ $cat->name }} | Expires On : {{ $referral_links_data->promo_expiration_date }}</h6>
                @endif
                @endforeach

                <p>Terms & Conditions : {{$referral_links_data->promo_terms}}</p>

                <div class="offer-box d-flex mt-5">
                    <img src="{{ asset('images/img16.png') }}" alt="">
                    <h3 class="offer mb-0">Offer Amount: {{ $referral_links_data->expected_payout_by_referar }}</h3>
                </div>
                <h3 class="status mb-5">Status: {{ $referral_links_data->status }}</h3>
                <a href="{{ $referral_links_data->referral_url }}">
                    <button class="button-primary">Continue to {{ $referral_links_data->canonicalized_name }}</button>
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('click_activity_data_send').addEventListener('click', function(e) {
        // Set current timestamp
       
        document.getElementById('clickTimestamps').value = Math.floor(Date.now() / 1000);

        // Submit the form
        document.getElementById('clickActivityForm').submit();
    });


    document.addEventListener('DOMContentLoaded', function() {
        // Get the current date
        var currentDate = new Date();

        // Format the date as YYYY-MM-DD (ISO 8601 format)
        var formattedDate = currentDate.toISOString().split('T')[0];

        // Set the value of the hidden input field
        document.getElementById('datePst').value = formattedDate;
    });
</script>

<!-- ======================= Edit Profile END -->
@endsection