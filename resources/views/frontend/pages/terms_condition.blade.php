@extends('frontend.layout')
<<<<<<< HEAD
    @section('title', 'Terms Condition' )=======@section('title', 'Website Details' );>>>>>>> 1161f75192897428684bef57735b97ca2de790f5
    @section('content')
    <!-- ======================= Hero section START -->
    <section class="position-relative overflow-hidden pb-0 pt-xl-9 terms-section">
        <div class="container pt-4 pt-sm-5">
            <div class="row pb-5 g-5 g-xl-5">
                <!-- Hero Image START -->
                <div class="col-sm-12 col-lg-3 tc-profile-img">
                    <!-- Hero image -->
                    <div class="tc-profile-btn">
                        <button class="tc-btn"><img src="{{asset('images/'. $data->logo)}}" class="rounded" alt="name"></button>
                    </div>
                </div>
                <!-- Hero Image END -->
                <div class="col-sm-12 col-lg-9 tc-profile-details">
                    <div class="d-flex tc-profile-info">
                        <div class="profile-data">
                            <h2>{{$data->canonicalized_name}}</h2>
                        </div>
                    </div>
                    <div class="profile-list">
                        <p class="pl-1 pl-data"> {{$data->promo_terms}}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- ======================= Hero section  END -->
    <!-- ======================= TC body START -->
    <section class="position-relative overflow-hidden pb-0 pt-xl-9 tc-sec">
        <div class="container pt-4 pt-sm-5">
            <h4 class="heading-underline ml-5">{{$data->canonicalized_name}}</h4>
            <div class="row flex-column mt-3 pb-5 g-4 g-xl-5">
                @foreach ($referral_links_data as $refer_url)
                @if($refer_url->offer_id == $data->id )
                <div class="card tc-card">
                    <div class="d-flex container d-flex flex-row py-4 tc-card-data">
                        @foreach($all_user as $selected_username)
                        @if($refer_url->user_id == $selected_username->id)
                        @php
                        // Fetch all ratings for the user
                        $user_ratings = App\Models\Ratings::where('user_id', $selected_username->id)->get();

                        // Calculate total and average rating
                        $totalRating = $user_ratings->sum('rating');
                        $ratingCount = $user_ratings->count();
                        $averageRating = $ratingCount > 0 ? ceil($totalRating / $ratingCount) : 0;
                        @endphp
                        <img src="{{ asset('images/' . ($selected_username->logo ?? 'default_user_logo.png')) }}" alt="profile-img" class="rounded-circle img-fluid tc-card-img">
                        <h5 class="px-3">{{$selected_username->firstname}}
                            <br>
                            <!--star-->
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $averageRating)
                                <span class="star">&#9733;</span> <!-- Full Star -->
                                @else
                                <span class="empty-star">&#9734;</span> <!-- Empty Star -->
                                @endif
                                @endfor
                                <!--<img src="{{asset('images/img-10.png')}}" alt="rating" />-->
                        </h5>
                        @endif
                        @endforeach
                        <h4 class="px-5">50 Points</h4>
                        <a href="{{url('referral_code/' . $refer_url->id)}}"><button type="button" class="button-primary tc-card-btn">Refer Now</button></a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </section>
    @endsection