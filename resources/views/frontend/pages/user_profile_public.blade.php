@extends('frontend.layout')
@section('title', 'User Profile')
@section('content')
@if (isset($error))
<div class=" pt-5 mt-5">
    <div class="alert alert-danger mt-5">
        {{ $error }}
    </div>
</div>
@else
<!-- ======================= Main Profile START -->
<section class="position-relative overflow-hidden pb-0 pt-xl-9 profile-section">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5  mb-5">
            <!-- Hero Image START -->
            <div class="col-sm-12 col-lg-3 profile-img">
                <!-- Hero image -->
                @if ($data->logo == '')
                <img src="{{ asset('images/default_user_logo.png') }}" alt="profile-img">
                @else
                <img src="{{ asset('images/' . $data->logo) }}" alt="profile-img">
                @endif
            </div>
            <!-- Hero Image END -->
            <div class="col-sm-12 col-lg-9 profile-details">
                <div class="d-flex profile-info">
                    <div class="profile-data">
                        <h2>{{ $data->firstname }} {{ $data->lastname }}</h2>
                        <h4 class="d-flex">
                            <span class="user-select-none">localhost:8000/user_profile/{{ $data->id }} </span><img
                                src="{{ asset('images/img-9.png') }}" class="rounded" id="copyImage" alt="box-icon">
                            <span class="notification rounded-pill fs-6 p-2 d-none bg-black text-white"
                                id="notification"> copied!</span>
                        </h4>
                        {{-- <h4>referralcodes.com/ladygray80<img src="{{ asset('images/img-9.png') }}"
                        class="rounded" alt="box-icon">
                        </h4> --}}
                    </div>
                    <div class="profile-btn">
                        <button class="msg-btn" data-bs-toggle="modal" data-bs-target="#messageModal"><img src="{{ asset('images/message-icon.png') }}" class="rounded"
                                alt="msg-icon">Message</button>
                    </div>
                </div>
                <p>
                    <!-- {{$average_rating}} -->
                    @for($i=0;$i< 5; $i++)
                        @if($i < $average_rating)
                        <span class="star">&#9733;</span>
                        @else
                        <span class="empty-star">&#9734;</span>
                        @endif
                        @endfor

                        <!-- <img src="{{ asset('images/img-10.png') }}" alt="rating" /><span><img
                                    src="{{ asset('images/img-11.png') }}" /></span> -->
                </p>
                <div class="profile-list">
                    <p class="pl-1">Member Since {{ $data->created_at->format('Y') }} |
                        <span>{{ $referral_links_count }} </span>Referral Codes Created | <span>{{$total_clicks}}
                        </span>Clicks Received
                    </p>
                    <p class="pl-2"><span>$500 </span>Bonus Shared | <span>$1500 </span>Bonus Shared In Last 1
                        Year
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ======================= Main Profile END -->
<!-- ======================= Main Profile body START -->
<section class="position-relative overflow-hidden pb-0 pt-xl-9 referal-sec">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5 px-3 mb-5">
            <h4 class="heading-underline mb-5 text-uppercase"> {{ $data->firstname }} {{ $data->lastname }}’
                REFERRALS
            </h4>
            <div class="referral-table mb-5 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">WEBSITE</th>
                            <th scope="col">OFFER AMOUNT</th>
                            <th scope="col">REFERRED ON</th>
                            <th scope="col">TRANSACTION RATING</th>
                            <th scope="col">TRANSACTION COMMENTS</th>
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
                                @if($review->user_id == $data->id && $review->referral_link_id == $referral_link->id)
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
            <div class="px-3 pt-3">{{ $referral_links->links() }}</div>
            {{-- <nav aria-label="...">
                    <ul class="pagination justify-content-end table-pagination">
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item " aria-current="page">
                            <span class="page-link">2</span>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next <span aria-hidden="true">&raquo;</span></a>

                        </li>
                    </ul>
                </nav> --}}
        </div>
    </div>

</section>

<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex">
                <h5 class="modal-title" id="messageModalLabel">Send Message to <b>{{ $data->firstname }} {{ $data->lastname }}</b></h5>
            </div>
            <div class="modal-body">
                <form id="messageForm">
                    <div class="form-group">
                        <!-- <label for="messageInput">type Message</label> -->
                        <textarea class="form-control" id="messageInput" rows="3" placeholder="Type your message here..." name="message"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="sendButton">Send</button>
            </div>
        </div>
    </div>
</div>


<!-- ======================= Main Profile body END -->
@endif
@endsection
@section('scripts')
<script>
    document.getElementById('copyImage').addEventListener('click', function() {

        @if(!empty($data))
        const url = `{{ url('user_profile/' . $data->id) }}`;

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

        // Hide the notification after 1 second
        setTimeout(() => {
            notification.classList.add('d-none');
        }, 1000);
        @endif

    });

    $(document).ready(function() {

        $('#messageModal').on('show.bs.modal', function() {
            $('#sendButton').prop('disabled', true);
        });

        $('#messageModal').on('hide.bs.modal', function() {
            $('#messageInput').val('');
            checkTextarea();
        });

        $('#messageInput').on('input', checkTextarea);

        $('#sendButton').click(function() {
            let message = $('#messageInput').val();
            if (message != '') {
                $.ajax({
                    url: "{{url('save_message')}}",
                    type: 'POST',
                    data: {
                        'message': message,
                        'receiver_id': '{{$data->id}}'
                    },
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken() // Add the CSRF token to the request header
                    },
                    success: function(response) {
                        $('#messageModal').modal('hide')
                        $('#messageInput').val('');
                        Swal.fire({
                            icon: response.type,
                            title: response.type,
                            text: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) { // Unauthenticated

                            alert('Please log in and send a message.');
                            window.location.href = "{{ route('login') }}"; // Redirect to login page
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Something went wrong. Please try again later.',
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
                        }
                    }
                });
            }
        });
    });

    function checkTextarea() { //hide show send message button
        var textarea = $('#messageInput');
        var button = $('#sendButton');

        button.prop('disabled', textarea.val().trim() === '');
    }
</script>
@endsection