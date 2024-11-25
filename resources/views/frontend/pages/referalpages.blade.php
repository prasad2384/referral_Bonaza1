@extends('frontend.layout')
@section('title', 'Your Clicks')
@section('content')
@section('style')
/* Ensure the outer table cell does not wrap and handles overflow */
td {
    white-space: nowrap; /* Prevent wrapping within each table cell */
}

/* Container for the inner table */
.inner-table-container {
    overflow-x: auto; /* Add horizontal scroll if inner table overflows */
    white-space: nowrap; /* Prevent wrapping of inner table */
}

/* Styling for the inner table to prevent breaking layout */
.inner-table-container .table {
    width: auto; /* Adjust width as needed */
    table-layout: auto; /* Allow table to use its content size */
    margin: 0; /* Remove default margin */
    border-collapse: collapse; /* Ensure borders collapse for proper display */
}

/* Prevent wrapping inside inner table cells */
.inner-table-container .table td {
    white-space: nowrap; /* Prevent wrapping within inner table cells */
}

@endsection
<section class="position-relative overflow-hidden pb-0 pt-xl-9 profile-section">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5 g-xl-5">
            <!-- Hero Image START -->
            <div class="col-sm-12  col-lg-3 my-auto profile-img">
                <!-- Hero image -->
                @if ($data->logo == '')
                <img src="{{ asset('images/default_user_logo.png') }}" style="height:210px width:210px" alt="profile-img" class="rounded rounded-circle">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                            </svg>
                            Message
                        </a> -->
                        <a class="edit-btn" href="{{ url('user/edit_profile/' . $data->id) }}"><img src="{{ asset('images/img13.png') }}" class="rounded" alt="msg-icon">Edit
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
                    <!-- <img src="{{ asset('images/img-10.png') }}" alt="rating" /> -->
                </p>
                <div class="profile-list">
                    <p class="pl-1">Member Since {{ $data->created_at->format('Y') }} |
                        <span>{{ $referral_links_count }} </span>Referral Codes Created |
                        <span>{{$total_clicks}}
                        </span>Clicks Received |<span> 50 </span> Bonus Received
                    </p>
                    <p class="pl-1 pl-data">{{ $data->about }}</p>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="position-relative overflow-hidden mt-5 pb-0 pt-xl-9 referal-sec">
    <div class="container pt-4 pt-sm-5">
        <div class="row pb-5 mt-5 mb-5 mx-1">
            <div class="d-flex justify-content-between align-items-start">
                <h4 class="heading-underline mb-5">YOUR Refferal Link Activity</h4>
                <a class="btn btn-primary" href="{{route('share.referral.link')}}">Add Refferal Link</a>
            </div>
            <div class="editProfile-table mb-5 table-responsive">
                <table class="table others-click">
                    <thead>
                        <tr>
                            <th scope="col" style="white-space: nowrap; ">DATE</th>
                            <th scope="col" style="white-space: nowrap; ">WEBSITE</th>
                            <th scope="col" style="white-space: nowrap; ">USERNAME (referee)</th>
                            <th scope="col" style="white-space: nowrap; ">EXPECTED PROMO</th>
                            <th scope="col" style="white-space: nowrap; ">APPLIED</th>
                            <th scope="col" style="white-space: nowrap; ">APPLICATION SCREENSHOT</th>
                            <th scope="col" style="white-space: nowrap; ">Payment To User Status</th>
                            <th scope="col" style="white-space: nowrap; ">Mark as Paid</th>
                            <th scope="col" style="white-space: nowrap; ">Payment Screenshot</th>
                            <th scope="col" style="white-space: nowrap; ">Upload payment screenshot</th>
                            <th scope="col" style="white-space: nowrap; ">Payment Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clicked_by_others as $data)
                        <tr>
                            <td style="white-space: nowrap;">{{ $data->created_at }}</td>
                            <td style="white-space: nowrap;">
                            @foreach($referral_links_all as $referral_links)
                                @if($referral_links->id == $data->referral_id)
                                 {{$referral_links->display_name}}  <!--name come from the  website links -->
                                @endif
                                @endforeach</td>
                            <td style="white-space: nowrap;">
                                @foreach($all_users as $users)
                                @if($users->id == $data->referee_user_id)
                                {{ $users->username }}
                                @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($referral_links_all as $referral_links)
                                @if($referral_links->id == $data->referral_id)
                                {{$referral_links->promo_terms}}
                                @endif
                                @endforeach
                            </td>
                            <td style="white-space: nowrap;">{{ $data->expected_payout_by_referar }}</td>
                            <td style="white-space: nowrap;">
                                @if($data->status === 'Pending')
                                <span class="mark-label">Mark As Applied</span>
                                @else
                                {{ $data->status }}
                                @endif
                            </td>
                            <td style="white-space: nowrap;">
                                @if($data->logo)
                                <a href="{{ asset('storage/' . $data->logo) }}" target="_blank">View<br>Screenshot</a>
                                @else
                                <span class="upload-label">Upload Screenshot</span>
                                @endif
                            </td>
                            <td style="white-space: nowrap;">
                                @if($data->logo)
                                <a href="{{ asset('storage/' . $data->logo) }}" target="_blank">View<br>Screenshot</a>
                                @else
                                <span class="upload-label">Upload Screenshot</span>
                                @endif
                            </td>
                            <td class="white-space:nowrap;">
                                <span class="mark-label">Mark As Paid</span>
                            </td>
                            <td class="white-space:nowrap;">
                                @if($data->logo)
                                <a href="{{ asset('storage/' . $data->logo) }}" target="_blank">View<br>Screenshot</a>
                                @else
                                <span class="upload-label">Upload Screenshot</span>
                                @endif
                            </td>
                            <td style="white-space: nowrap;">
                                @if($data->logo)
                                <a href="{{ asset('storage/' . $data->logo) }}" target="_blank">View<br>Screenshot</a>
                                @else
                                <span class="upload-label">Upload Screenshot</span>
                                @endif
                            </td>
                            <td style="white-space: nowrap;">
                                <span class="border-end border-dark pe-1">Payment to platform</span>
                                <span class="border-end border-dark pe-1">Referrer confirmation snapshot</span>
                                <span class="border-end border-dark pe-1">Contact user (#10 below)</span>
                                <span>PView correspondence</span>
                                <!-- <div class="inner-table-container">
                                    <table class="table table-bordered nowrap-table">
                                        <tr>
                                            <td>Payment to platform</td>
                                        </tr>
                                        <tr>
                                            <td>Referrer confirmation snapshot</td>
                                        </tr>
                                        <tr>
                                            <td>Contact user (#10 below)</td>
                                        </tr>
                                        <tr>
                                            <td>View correspondence</td>
                                        </tr>
                                    </table>
                                </div> -->
                                <!-- <table class="table table-bordered nowrap-table">
                                    <tr>
                                        <td>Payment to platform</td>
                                    </tr>
                                    <tr>
                                        <td>Referrer confirmation snapshot</td>
                                    </tr>
                                    <tr>
                                        <td>Contact user (#10 below)</td>
                                    </tr>
                                    <tr>
                                        <td>View correspondence</td>
                                    </tr>
                                </table> -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <!-- <nav aria-label="...">
                    <ul class="pagination" id="pagination">
                    </ul>
                </nav> -->
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
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
        //your clicks
        var table = $('.your-clicks').DataTable({
            "paging": false,
            "lengthChange": false,
            "info": false,
            "searching": false,
            "ordering": true,
            "pagingType": "full_numbers"
        });

        $('#pagination').html($('.dataTables_paginate').html()); // Copy pagination controls from DataTables

        // Handle custom pagination click events
        $('#pagination').on('click', 'a', function(e) {
            e.preventDefault(); // Prevent default action
            var page = $(this).data('dt-page'); // Get page number from data attribute
            if (page) {
                table.page(page - 1).draw('page'); // Navigate to the specified page
            }
        });


        // other-clicks-table
        var table = $('.others-click').DataTable({
            "paging": true,
            "lengthChange": false,
            "info": false,
            "searching": false,
            "ordering": true,
            "pagingType": "full_numbers"
        });

        $('#pagination').html($('.dataTables_paginate').html()); // Copy pagination controls from DataTables

        // Handle custom pagination click events
        $('#pagination').on('click', 'a', function(e) {
            e.preventDefault(); // Prevent default action
            var page = $(this).data('dt-page'); // Get page number from data attribute
            if (page) {
                table.page(page - 1).draw('page'); // Navigate to the specified page
            }
        });
    });
</script>
@endsection