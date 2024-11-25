@extends('frontend.layout')
@section('title','All Websites')
@section('content')
<section class="pt-5 pb-5 banking-section mt-5 pt-5">
    <div class="container pb-5 mt-5">
        <div class="d-flex pb-4 banking-header">
            <h3 class="text-center">{{ $category->name }}</h3>
        </div>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6 g-4">
            @foreach ($referral_website as $website_data)
            <a href="{{ url('website_details/' . $website_data->id) }}" class="col text-decoration-none">
                <div class="rounded p-4 banking-box">
                    <img src="{{ asset('images/' . $website_data->logo) }}" alt="{{ $website_data->canonicalized_name }}" />
                    <h5 class="pt-3">{{ $website_data->canonicalized_name }}</h5>
                    <h6>${{ $website_data->expected_payout }}</h6>
                </div>
            </a>
            <!-- Item -->
            @endforeach()
        </div>
    </div>
</section>
@endsection