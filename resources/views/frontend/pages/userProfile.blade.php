@extends('frontend.layout')
@section('title', 'Profile')
@section('content')
<!-- ======================= Edit Profile START -->
<section class="position-relative overflow-hidden pb-0 pt-xl-9 profile-section">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5 g-xl-5">
            <!-- Hero Image START -->
            <div class="col-sm-12  col-lg-3 my-auto profile-img">
                <!-- Hero image -->
                @if ($data_user->logo == '')
                <img src="{{ asset('images/default_user_logo.png') }}" style="height:210px; width:210px" alt="profile-img" class="rounded rounded-circle">
                @else
                <img src="{{ asset('images/' . $data_user->logo) }}">
                @endif
            </div>
            <!-- Hero Image END -->
            <div class="col-sm-12 col-lg-9 profile-details">
                <div class="d-md-flex d-block profile-info">
                    <div class="profile-data">
                        <h2>Hi {{ $data_user->firstname }} {{ $data_user->lastname }}</h2>
                        <h4 class="d-flex">
                            <span class="user-select-none">localhost:8000/user_profile/{{ $data_user->id }} </span><img src="{{ asset('images/img-9.png') }}" class="rounded" id="copyImage" alt="box-icon">
                            <span class="notification rounded-pill fs-6 p-2 d-none bg-black text-white" id="notification"> copied!</span>
                        </h4>

                    </div>

                    <div class="profile-btn">
                        <!-- <a class="edit-btn mx-3" href="{{ url('user/user_message/' . $data_user->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Message
                        </a> -->
                        <a class="edit-btn" href="{{ url('user/edit_profile/' . $data_user->id) }}"><img src="{{ asset('images/img13.png') }}" class="rounded" alt="msg-icon">Edit
                            profile
                        </a>
                    </div>
                </div>
                <p>
                    @for($i=0;$i< 5; $i++)
                        @if($i < $average_rating)
                        <span class="star">&#9733;</span>
                        @else
                        <span class="empty-star">&#9734;</span>
                        @endif
                        @endfor
                        <!-- <img src="{{ asset('images/img-10.png') }}" alt="rating" /> --></p>
                <div class="profile-list">
                    <p class="pl-1">Member Since {{ $data_user->created_at->format('Y') }} |
                        <span>{{ $referral_links_count }} </span>Referral Codes Created |
                        <span>{{$total_clicks}}
                        </span>Clicks Received |<span> 50 </span> Bonus Received
                    </p>
                    <p class="pl-1 pl-data">{{ $data_user->about }}</p>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ======================= Edit Profile END -->
<!-- ======================= Edit Profile body START -->
<section class="position-relative overflow-hidden pb-0 mt-5 pt-xl-9 referal-sec">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5 mt-5 mb-5 mx-1">
            <div class="d-flex justify-content-between align-items-start">
                <h4 class="heading-underline mb-5 text-uppercase"> {{ $data_user->firstname }}’S REFERRALS</h4>
                <!-- <a class="btn btn-primary" href="{{route('share.referral.link')}}">Add Refferal Link</a> -->
            </div>
            <div class="editProfile-table mb-5 table-responsive">
                <table class="table your-clicks">
                    <thead>
                        <tr>
                            <th scope="col">WEBSITE</th>
                            <th scope="col">OFFER AMOUNT</th>
                            <th scope="col">REFFERED ON</th>
                            <th scope="col">TRANSATION RATING</th>
                            <th scope="col">TRANASCTION COMMENTS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($referral_links as $referral_link)
                        <tr>
                            <td><img src="{{ asset('images/' . $referral_link->logo) }}" alt="name">
                            </td>
                            <td>${{ $referral_link->expected_payout_by_referar }}</td>
                            <td>{{ \Carbon\Carbon::parse($referral_link->created_at)->format('d-m-Y') }}</td>

                            <td>
                                @php
                                $totalRating = 0;
                                $ratingCount = 0;
                                @endphp
                                @foreach($all_ratings as $rating)
                                @if($referral_link->id == $rating->referral_link_id)
                                @php
                                $totalRating += $rating->rating; // Assuming the rating column is 'rating'
                                $ratingCount++;
                                @endphp
                                @endif
                                @endforeach
                                @php
                                $averageRating = $ratingCount > 0 ? ceil($totalRating / $ratingCount) : 0;
                                $fullStars = $averageRating; // Number of full stars to display
                                $emptyStars = 5 - $fullStars; // Number of empty stars to display
                                @endphp
                                @if($ratingCount > 0)
                                @for($i = 0; $i < $fullStars; $i++)
                                    <span class="star">&#9733;</span> <!-- Full Star -->
                                    @endfor

                                    @for($i = 0; $i < $emptyStars; $i++)
                                        <span class="empty-star">&#9734;</span> <!-- Empty Star -->
                                        @endfor
                                        @else
                                        @for($i=1;$i<=5;$i++)
                                            <span class="empty-star">&#9734;</span>
                                            @endfor
                                            @endif
                            </td>
                            <td>
                                @php
                                $displayedReferrerIds = [];
                                $messageDisplayed = false;
                                @endphp

                                @foreach($user_review as $review)
                                @if($review->user_id == $data_user->id && $review->referral_link_id == $referral_link->id)
                                @if(!in_array($review->referrer_id, $displayedReferrerIds))
                                {{$review->message}}
                                @php
                                $displayedReferrerIds[] = $review->referrer_id;
                                $messageDisplayed = true;
                                @endphp
                                @endif
                                @endif
                                @endforeach

                                @if(!$messageDisplayed)
                                Lorem ipsum dolor sit amet consectetur.
                                @endif
                                <!-- Lorem ipsum dolor sit amet consectetur. -->
                            </td>


                        </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="12" class="text-center">Referral Link Not Found</td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- ======================= Edit Profile body START -->

<!-- ======================= Edit Profile body END -->

<section class="position-relative overflow-hidden pb-0 pt-xl-9 comment-section">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5 mt-5 mb-5">
            <h4 class="heading-underline">RATINGS & COMMENTS</h4>
            <div class="row">
                <div class="col-lg-4 pe-5">
                    <div class="d-flex align-items-center mb-2">
                        <div class="d-flex rating-img">
                            @for($i = 0; $i < 5; $i++)
                                @if($i < $average_rating)
                                <span class="star">&#9733;</span> <!-- Full Star -->
                                @else
                                <span class="empty-star">&#9734;</span> <!-- Empty Star -->
                                @endif
                                @endfor
                        </div>
                        <h5 class="mb-0 ms-2">{{ $total_ratings }} Average Ratings</h5>
                    </div>


                    <!-- this is rating code  -->

                    <div class="row bg-white pt-2">
                        <div class="col-md-12 d-flex align-items-center  mb-2">
                            <p class=" mb-0 ms-1 me-2 text-primary" style="font-size: 15px;">5 star</p>

                            <div class="progress mx-2" style="height: 25px; width:60%">
                                <div class="progress-bar bg-warning" role="progressbar" style="width:{{ $percentages['5_star'] }}%" aria-valuenow="{{ $percentages['5_star'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="mx-2 text-primary">{{ round($percentages['5_star'], 2) }}%</span>
                        </div>
                    </div>
                    <div class="row bg-white">
                        <div class="col-md-12 d-flex align-items-center mb-2">
                            <p class="text-primary mb-0 ms-1 me-2" style="font-size: 15px;">4 star</p>
                            <div class="progress  mx-2" style="height: 25px; width:60%;">
                                <div class="progress-bar bg-warning" role="progressbar" style="width:{{ $percentages['4_star'] }}%" aria-valuenow="{{ $percentages['4_star'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="mx-2 text-primary">{{ round($percentages['4_star'], 2) }}%</span>
                        </div>
                    </div>
                    <div class="row bg-white">
                        <div class="col-md-12 d-flex align-items-center mb-2">
                            <p class="text-primary mb-0 ms-1 me-2" style="font-size: 15px;">3 star</p>
                            <div class="progress  mx-2" style="height: 25px; width:60%">
                                <div class="progress-bar bg-warning" role="progressbar" style="width:{{ $percentages['3_star'] }}%" aria-valuenow="{{ $percentages['3_star'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="mx-2 text-primary">{{ round($percentages['3_star'], 2) }}%</span>
                        </div>
                    </div>
                    <div class="row bg-white">
                        <div class="col-md-12 d-flex align-items-center mb-2">
                            <p class="text-primary mb-0 ms-1 me-2" style="font-size: 15px;">2 star</p>
                            <div class="progress  mx-2" style="height: 25px; width:60%">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percentages['2_star'] }}%" aria-valuenow="{{ $percentages['2_star'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="mx-2 text-primary" style="font-size: 15px;">{{ round($percentages['2_star'], 2) }}%</span>
                        </div>
                    </div>
                    <div class="row bg-white">
                        <div class="col-md-12 d-flex align-items-center mb-2">
                            <p class="text-primary mb-0 ms-1 me-2" style="font-size: 15px;">1 star</p>
                            <div class="progress  mx-2" style="height: 25px; width:60%">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $percentages['1_star'] }}%" aria-valuenow="{{ $percentages['1_star'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="mx-2 text-primary fs-6">{{ round($percentages['1_star'], 2) }}%</span>
                        </div>
                    </div>


                    <!-- this is the end of rating code  -->
                    <!-- <img src="{{ asset('images/img14.png') }}" alt="referral-img"> -->
                </div>
                <div class="col-lg-8">
                    <div class="rating-content">
                        <h5>User Reviews</h5>
                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                            printer
                            took a galley of type and scrambled it to make a type specimen book.</p>
                        <div class="d-flex pb-5 rating-labels">
                            <span><i class="fa-solid fa-circle-check"></i>Ease Of Use</span>
                            <span><i class="fa-solid fa-circle-check"></i>Good Value</span>
                            <span><i class="fa-solid fa-circle-check"></i>Would Recommend</span>
                        </div>
                    </div>
                    @foreach($user_review as $review)
                    <div class="pt-5 pb-5 rating-content">
                        <h5>Latest Ratings</h5>
                        <div class="pt-4 d-flex">
                            <div class="row  g-xl-5">
                                <div class=" col-lg-3 pr-0 rating-profile-img">
                                    @foreach($user_referee as $referee)
                                    @if($referee->id == $review->referee_id)
                                    @if($referee->logo == '')

                                    <img src="{{ asset('images/default_user_logo.png') }}" alt="profile-img">
                                    @else
                                    <img src="{{ asset('images/'.$referee->logo) }}" alt="profile-img">

                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-lg-9 px-2 rating-profile-details">
                                    <div class="d-flex rating-profile-info">
                                        <div class="rating-profile-data">
                                            <h5 class="m-0">
                                                @foreach($user_referee as $referee)
                                                @if($referee->id == $review->referee_id)
                                                {{$referee->firstname}} {{$referee->lastname}}
                                                @endif
                                                @endforeach
                                            </h5>
                                        </div>
                                    </div>
                                    <p class="" style="margin-bottom: 10px;">
                                        @for($i=1;$i<=5;$i++)
                                        <span class="empty-star">&#9734;</span>
                                        @endfor
                                        <!-- <img src="{{ asset('images/img-10.png') }}" alt="rating"> -->
                                    </p>
                                    <p class="mb-3 review-label">Reviewed on {{ $review->created_at->format('d F Y') }}</p>
                                </div>

                            </div>
                        </div>
                        <p>{{$review->message}}</p>
                        <span>Verified User : Yes</span>
                    </div>
                    @endforeach
                    <div class="mt-2">

                        {{$user_review->links()}}
                    </div>
                    <!-- <div class="pt-5 pb-5 rating-content">
                        <div class="d-flex">
                            <div class="row  g-xl-5">
                                <div class=" col-lg-3 pr-0 rating-profile-img">
                                    <img src="{{ asset('images/img15.png') }}" alt="profile-img">
                                </div>
                                <div class="col-lg-9 px-2 rating-profile-details">
                                    <div class="d-flex rating-profile-info">
                                        <div class="rating-profile-data">
                                            <h5>Andrew Marsh</h5>
                                        </div>
                                    </div>
                                    <p class="mb-0"><img src="{{ asset('images/img-10.png') }}" alt="rating">
                                    </p>
                                    <p class="mb-3 review-label">Reviewed on 29 April 2024</p>
                                </div>

                            </div>
                        </div>
                        <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                            printer
                            took a galley of type and scrambled it to make a type specimen book.</p>
                        <span>Verified User : Yes</span>
                    </div> -->
                </div>

            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    document.getElementById('copyImage').addEventListener('click', function() {
        const url = `localhost:8000/user_profile/{{ $data_user->id }}`;

        // Create a temporary input to hold the text
        const tempInput = document.createElement('input');
        tempInput.value = url;
        document.body.appendChild(tempInput);

        // Select the text and copy it
        tempInput.select();
        document.execCommand('copy');

        // Remove the temporary input
        document.body.removeChild(tempInput);

        // Show the notification
        const notification = document.getElementById('notification');
        notification.classList.remove('d-none');

        // Hide the notification after 2 seconds
        setTimeout(() => {
            notification.classList.add('d-none');
        }, 2000);
    });

    @if(session('message'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('message') }}',
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

    $(document).ready(function() {
        //your clicks
        var table = $('.your-clicks').DataTable({
            "paging": true,
            "lengthChange": false,
            "info": false,
            "searching": false,
            "ordering": true,
            "pagingType": "full_numbers"
        });

        // $('#pagination').html($('.dataTables_paginate').html()); // Copy pagination controls from DataTables

        // // Handle custom pagination click events
        // $('#pagination').on('click', 'a', function(e) {
        //     e.preventDefault(); // Prevent default action
        //     var page = $(this).data('dt-page'); // Get page number from data attribute
        //     if (page) {
        //         table.page(page - 1).draw('page'); // Navigate to the specified page
        //     }
        // });

    });
</script>
@endsection