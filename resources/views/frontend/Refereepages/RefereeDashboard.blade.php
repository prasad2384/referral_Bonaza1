@extends('frontend.layout')
@section('title','Referee Dashboard')
@section('style')
.errors{
color:red;
font-weight:bold;
}
.star {
display: inline-block; /* Ensures the border is around the star */
color: var(--bs-secondary); /* Bootstrap's tertiary color */
font-size: 2rem;
cursor: pointer;
<!-- border: 1px solid black; /* Apply border directly to the star */ -->
line-height: 1; /* Ensures no extra space inside the border */
}

.star:hover,
.star.active {
color: gold;
}
@endsection
@section('content')
<section class="position-relative overflow-hidden pb-0 pt-xl-9 profile-section">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5 g-xl-5">
            <!-- Hero Image START -->
            <div class="col-sm-12  col-lg-3 my-auto profile-img">
                <!-- Hero image -->
                @if ($data->logo == '')
                <img src="{{ asset('images/default_user_logo.png') }}" style="height:210px; width:210px" alt="profile-img" class="rounded rounded-circle">
                @else
                <img src="{{ asset('images/' . $data->logo) }}">
                @endif
            </div>
            <!-- Hero Image END -->
            <div class="col-sm-12 col-lg-9 profile-details">
                <div class="d-md-flex d-block profile-info">
                    <div class="profile-data">
                        <h2>Hi {{ $data->firstname }} {{ $data->lastname }}</h2>
                        <h4 class="d-flex">
                            <span class="user-select-none">localhost:8000/user_profile/{{ $data->id }} </span><img src="{{ asset('images/img-9.png') }}" class="rounded" id="copyImage" alt="box-icon">
                            <span class="notification rounded-pill fs-6 p-2 d-none bg-black text-white" id="notification"> copied!</span>
                        </h4>

                    </div>

                    <div class="profile-btn">
                        <!-- <a class="edit-btn mx-3" href="{{ url('user/user_message/' . $data->id) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            Message
                        </a> -->
                        <a class="edit-btn" href="{{ url('referee/edit_profile/' . $data->id) }}"><img src="{{ asset('images/img13.png') }}" class="rounded" alt="msg-icon">Edit
                            profile
                        </a>
                    </div>
                </div>
                <p>
                    @for($i=1;$i<=5;$i++)
                    <span class="empty-star">&#9734;</span>
                    @endfor
                    <!-- <img src="{{ asset('images/img-10.png') }}" alt="rating" /> -->
                </p>
                <div class="profile-list">
                    <p class="pl-1">Member Since {{ $data->created_at->format('Y') }} |
                        <span>{{$clicked_by_me}}
                        </span>Clicks Received |<span> 50 </span> Bonus Received
                    </p>
                    <p class="pl-1 pl-data">{{ $data->about }}</p>
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
                <h4 class="heading-underline mb-5 text-uppercase"> {{ $data->firstname }}’S clicks</h4>
                <!-- <a class="btn btn-primary" href="{{route('share.referral.link')}}">Add Refferal Link</a> -->
            </div>
            <div class="editProfile-table mb-5 table-responsive">
                <table class="table your-clicks">
                    <thead>
                        <tr>
                            <th scope="col" style="white-space: nowrap;">WEBSITE</th>
                            <th scope="col" style="white-space: nowrap;">DATE</th>
                            <th scope="col" style="white-space: nowrap;">USERNAME</th>
                            <th scope="col" style="white-space: nowrap;">EXPECTED PROMO</th>
                            <th scope="col" style="white-space: nowrap;">APPLIED</th>
                            <th scope="col" style="white-space: nowrap;">Add Feedback</th>
                            <th scope="col" style="white-space: nowrap;">APPLICATION SCREENSHOT</th>
                            <th scope="col" style="white-space: nowrap;">Upload application screenshot</th>
                            <th scope="col" style="white-space: nowrap;">Referrer marked as payment sent</th>
                            <th scope="col" style="white-space: nowrap;">Referrer payment confirmation snapshot</th>
                            <th scope="col" style="white-space: nowrap;">Mark as payment received</th>
                            <th scope="col" style="white-space: nowrap;">Contact user</th>
                            <th scope="col" style="white-space: nowrap;">View correspondence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($referee_links_click_data as $referee_click)
                        <tr>
                            <td style="white-space: nowrap;">
                                @foreach($referral_links as $links)
                                @if($links->id == $referee_click->referral_id)

                                {{$links->display_name}}
                                @endif
                                @endforeach
                            </td>
                            <td style="white-space: nowrap;">{{$referee_click->date_pst}}</td>
                            <td style="white-space: nowrap;">
                                @foreach($all_users as $user)
                                @if($user->id == $referee_click->referrer_user_id)
                                {{$user->username}}
                                @endif
                                @endforeach
                            </td>

                            <td style="white-space: nowrap;">
                                @foreach($referral_links as $links)
                                @if($links->id == $referee_click->referral_id)

                                {{$links->promo_terms}}
                                @endif
                                @endforeach
                            </td>

                            <td style="white-space: nowrap;">
                                @foreach($referral_links as $links)

                                @if($links->id === $referee_click->referral_id)
                                @if($links->status === 'Pending')
                                <span class="mark-label">Mark As Applied</span>
                                @else
                                {{ $links->status }}
                                @endif
                                @endif
                                @endforeach
                            </td>
                            <td style="white-space: nowrap;">
                                @if($referee_click->rating_status==1)
                                Thank You For Feedback
                                @else
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ratingModal" data-referral_link_id="{{$referee_click->referral_id}}" data-referrer_user_id="{{$referee_click->referrer_user_id}}" data-click_id="{{$referee_click->id}}">
                                    Add Feedback
                                </button>
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- model code -->
<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="ratingModalLabel">Rate Your Experience</h5>

                <button type="button" class="close float-end" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url('referee/save_ratings')}}" method="POST" id="feedbackForm">
                @csrf
                <div class="modal-body">
                    <!-- Rating Section -->
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <div class="rating text-center d-block">
                            <div class="rw-ui-container"></div>
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                        </div>
                        <input type="hidden" id="rating" name="rating">
                        <input type="hidden" name="referral_link_id">
                        <input type="hidden" name="referrer_user_id">
                        <input type="hidden" name="click_id">
                    </div>
                    <!-- Message Section -->
                    <div class="form-group">
                        <label for="message">Your Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Write your feedback here..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- model code end  -->
<!-- ======================= Edit Profile body START -->

<!-- ======================= Edit Profile body END -->

<!-- <section class="position-relative overflow-hidden pb-0 pt-xl-9 comment-section">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5 mt-5 mb-5">
            <h4 class="heading-underline">RATINGS & COMMENTS</h4>
            <div class="row ">
                <div class="col-lg-4">
                    <div class="d-flex rating-img">
                        <img src="{{ asset('images/img-10.png') }}" alt="rating-img">
                        <h5>10 Average Ratings</h5>
                    </div>
                    <img src="{{ asset('images/img14.png') }}" alt="referral-img">
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
                    <div class="pt-5 pb-5 rating-content">
                        <h5>Latest Ratings</h5>
                        <div class="pt-4 d-flex">
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
                    </div>
                    <div class="pt-5 pb-5 rating-content">
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
                    </div>
                </div>

            </div>
        </div>
    </div>
</section> -->
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jquery-validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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
    document.getElementById('copyImage').addEventListener('click', function() {
        const url = `localhost:8000/user_profile/{{ $data->id }}`;

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
    $(document).ready(function() {
        $('#ratingModal').on('show.bs.modal', function(event) {
            $('#feedbackForm').validate().resetForm();
            $('#feedbackForm')[0].reset();
            $('.star').removeClass('active');
            $('#rating').val('');
            var button = $(event.relatedTarget); // Button that triggered the modal
            var referralLinkId = button.data('referral_link_id'); // Extract info from data-* attributes
            var referrerUserId = button.data('referrer_user_id');
            var click_id = button.data('click_id');
            var modal = $(this);
            modal.find('input[name="referral_link_id"]').val(referralLinkId); // Set the value of the hidden input
            modal.find('input[name="referrer_user_id"]').val(referrerUserId);
            modal.find('input[name="click_id"]').val(click_id);
        });
        $('.star').on('click', function() {
            var ratingValue = $(this).data('value');

            // Optional: Reset all stars to default color
            // $('.star').css('color', 'white').css('background-color', 'black');

            // Highlight selected stars up to the clicked one
            $('.star').each(function() {
                if ($(this).data('value') <= ratingValue) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            });

            // Update hidden input value
            $('#rating').val(ratingValue);

            // Trigger validation update for the rating field
            $('#feedbackForm').validate().element('#rating');

            // Log selected rating for debugging
            console.log('Selected Rating: ' + ratingValue);
        });

        $("#feedbackForm").validate({
            errorClass: 'errors',
            ignore: [],
            // Specify validation rules
            rules: {
                rating: {
                    required: true, // Ensure rating is selected
                },
                message: {
                    required: true, // Ensure message is filled
                    minlength: 20 // Set a minimum length for the message
                }
            },
            // Specify validation error messages
            messages: {
                rating: {
                    required: "Please select a rating"
                },
                message: {
                    required: "Please enter your feedback",
                    minlength: "Your feedback must be at least 20 characters long"
                }
            },
            // Submit the form only if it is valid
            submitHandler: function(form) {
                form.submit();
            }
        });

        // $('#ratingModal').on('shown.bs.modal', function() {
        //     $('#feedbackForm').validate().resetForm();
        //     $('#feedbackForm')[0].reset();
        //     $('.star').removeClass('active');
        //     $('#rating').val('');
        // });


    });
</script>

@endsection