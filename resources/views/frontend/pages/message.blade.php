<style>
.row.container-fluid {
    display: flex;
    flex-wrap: nowrap;
}
.chat-list {
    display: flex;
    align-items: center;
    margin-left: 5px;
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
    padding: 10px 0;
}
.user-img {
    border-radius: 50%;
    margin-right: 10px;
    margin-left: 30px;
}
.user-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
</style>
@extends('frontend.layout')
@section('title', 'Messages')
@section('content')
<!-- ======================= Edit Profile START -->
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
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row container-fluid">
            <!-- Sidebar for user list -->
            <div class="col-md-3">
                <div class="card card-bordered">
                    <div class="card-header">
                        <h4 class="card-title"><strong>Users</strong></h4>
                    </div>
                    <div class="ps-container ps-theme-default ps-active-y" id="" style="overflow-y: scroll !important; height:450px !important;">
                            <ul class="user-list">
                                @foreach($userData as $rcd)
                                <li class="a-link chat-list userid" data-id="{{$rcd->id}}">
                                    @if($rcd->logo=='')
                                    <img src="{{ asset('images/default_user_logo.png') }}" class="user-img" height="40px" width="40px">
                                    @else
                                    <img src="{{ asset('images/' . $rcd->logo) }}" alt="" height="40px" width="40px" class="user-img">
                                    @endif
                                    <div style="flex-grow: 1;">
                                        <span style="display: block;">{{ $rcd->firstname }} {{$rcd->lastname}}</span>
                                        <!-- <span style="color: #888;">Last message</span> -->
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                    </div>
                </div>
            </div>
            
            <!-- Chat container -->
            <div class="col-md-9">
            <div class="card card-bordered">
                    <div class="card-header">
                        <img src="{{ asset('images/default_user_logo.png') }}" alt="" height="40px" width="40px" class="user-img" id="chat-head">
                        <h4 class="card-title msg-head"><strong id="user-profile"></strong></h4>
                        <input type="hidden" name="receiver_id" id="receiver_id" value="">
                        <!-- <a class="btn btn-xs btn-secondary" href="#" data-abc="true">Let's Chat </a> -->
                    </div>


                    <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:400px !important;">
                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                            <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                            <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
                        </div>
                    </div>

                    <div class="publisher bt-1 border-light">
                        @if ($data->logo == '')
                        <img src="{{ asset('images/default_user_logo.png') }}" class="avatar avatar-xs" height="35px" width="50px">
                        @else
                        <img src="{{ asset('images/' . $data->logo) }}" height="35px" width="50px">
                        @endif
                        <input class="publisher-input" type="text" placeholder="Write something" id="mgs-send" value="">
                        <!-- <span class="publisher-btn file-group">
                            <i class="fa fa-paperclip file-browser"></i>
                            <input type="file">
                        </span> -->
                        <!-- <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a> -->
                        <a class="publisher-btn text-info send_msg" data-abc="true" id="send_msg"><i class="fa fa-paper-plane"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

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
        $('.userid').click(function() {
            $('.userid').css('background-color', 'white');
            $(this).css('background-color', '#48b0f7');
            let userId = $(this).data('id');
            if (userId != null && userId !== '' && userId > 0) {
                $.ajax({
                    url: "{{ url('get_msg_data') }}/" + userId,
                    type: 'GET',
                    success: function(res) {
                        console.log(res);
                        $('#receiver_id').val(res.userdata.id)
                        let userImage = res.userdata.logo ? "{{ asset('images') }}/" + res.userdata.logo : "{{ asset('images/default_user_logo.png') }}";
                        $("#chat-head").attr("src", userImage);
                        // $("#chat-head").attr("src","{{ asset('images') }}/" + res.userdata.logo);
                        $('#user-profile').html(res.userdata.firstname+" "+ res.userdata.lastname)
                        $('#chat-content').empty();

                        if(res.msgList.length > 0){

                            $('#chat-content').empty();
                            let msg_type_class = '';
                            $.each(res.msgList , function(index, val) {
                                let msg_type_class = '';
                                if(val.sender_id == '{{Auth::id()}}'){
                                    msg_type_class = 'media-chat-reverse';
                                }
                                let date = moment(val.created_at).format('MMMM D, YYYY h:mm A')

                                $('#chat-content').append(`
                                    <div class="media media-chat ${msg_type_class}">
                                        <div class="media-body">
                                            <p>${val.message}</p>
                                            <p class="meta"><time datetime="2018">${date}</time></p>
                                        </div>
                                    </div>
                                `)
                            });
                        }
                    },
                });
            }
        })

        // Trigger a click on the first .userid element
        $('.userid:first').click();

        $('#send_msg').click(function() {
            let message = $('#mgs-send').val();

            let receiver_id = $('#receiver_id').val();
            console.log('Receiver ID:', receiver_id); 
            if(message != ''){
                $('#mgs-send').val('')
                $.ajax({
                    url: "{{url('save_message')}}",
                    type: 'POST',
                    data: {'message':message, 'receiver_id': receiver_id},
                    headers: {
                        'X-CSRF-TOKEN': getCsrfToken() // Add the CSRF token to the request header
                    },
                    success: function(res) {
                        let date = moment().format('MMMM D, YYYY h:mm A')
                        $('#chat-content').append(`
                            <div class="media  media-chat media-chat-reverse">
                                <div class="media-body">
                                    <p>${message}</p>
                                    <p class="meta"><time datetime="2018">${date}</time></p>
                                </div>
                            </div>
                        `) 
                    },
                });
            }
        });
    });
</script>

@endsection