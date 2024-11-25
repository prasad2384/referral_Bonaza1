@php
use Illuminate\Support\Facades\Route;
@endphp
@if (!Auth::check())
<!-- Header START -->
<header class="header-sticky header-absolute">
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-lg nav-section">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img class="light-mode-item navbar-brand-item" src="{{ asset('images/logo.PNG') }}" alt="logo" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav menu-item mb-2 mb-lg-0">
                    <!-- Nav item -->
                    <li class="nav-item">
                        <a class="nav-link" href="">Share referrals</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('how_it_works') }}">how it works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">browse referrals</a>
                    </li>
                    <!-- Nav item -->
                </ul>
                @auth
                @if(Auth::user()->usertype == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-light create-btn mb-0">
                    <i class="bi bi-person-circle me-1"></i>Admin Dashboard
                </a>
                @elseif(Auth::user()->usertype == 'user')
                <a href="{{ route('user.profile_dashboard') }}" class="btn btn-sm btn-light create-btn mb-0">
                    <i class="bi bi-person-circle me-1"></i>Profile Dashboard
                </a>
                @endif
                @else
                <a href="{{ route('register') }}" class="btn btn-sm btn-light create-btn mb-0">
                    <i class="bi bi-person-circle me-1"></i>Create Account / Login
                </a>
                @endauth
                
            </div>
        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
<!-- Header END -->
@elseif(Auth::user()->usertype == 'user')
<!-- Header START -->
<header class="header-sticky header-absolute">
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-lg nav-section ">
        <div class="container justify-content-between align-items-center d-flex">
            <a class="navbar-brand" href="/"><img class="light-mode-item navbar-brand-item" src="{{ asset('images/logo.PNG') }}" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar d-flex align-items-center justify-content-evenly w-100">
                <a class="text-reset text-decoration-none" href="{{route('profile_dashboard')}}">Home</a>
                <a class="text-reset text-decoration-none" href="{{route('referral_pages_dashboard')}}">Referral links</a>
                <a class="text-reset text-decoration-none" href="{{route('click_dashboard')}}">Click Activity</a>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <div class="dropdown">
                    <button class="dropdown-toggle bg-transparent border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @php
                        $user = auth()->user();
                        @endphp
                        @if (isset($user) && $user->logo != '')
                        <img src="{{ asset('images/'.$user->logo) }}" alt="profile-img" class="rounded-circle img-fluid  tc-card-img ">
                        @else
                        <img src="{{ asset('images/default_user_logo.png') }}" alt="profile-img" class="rounded-circle img-fluid  tc-card-img ">
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start text-center p-0" style="text-align: center;">
                        <li class="p-0">
                            <a class="dropdown-item text-center p-0" href="{{ url('messages') }}"> Inbox </a>
                        </li>
                        <li class="p-0">
                            <a class="dropdown-item text-center p-0" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
<!-- Header END -->
 @elseif(Auth::user()->usertype == 'referee')
 <header class="header-sticky header-absolute">
    <!-- Logo Nav START -->
    <nav class="navbar navbar-expand-lg nav-section ">
        <div class="container justify-content-between align-items-center d-flex">
            <a class="navbar-brand" href="/"><img class="light-mode-item navbar-brand-item" src="{{ asset('images/logo.PNG') }}" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar d-flex align-items-center justify-content-evenly w-100">
                <a class="text-reset text-decoration-none" href="{{route('referee_dashboard')}}">Referee Dashboard</a>
                <!-- <a class="text-reset text-decoration-none" href="{{route('referral_pages_dashboard')}}">Referral links</a> -->
                <!-- <a class="text-reset text-decoration-none" href="{{route('click_dashboard')}}">Click Activity</a> -->
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <div class="dropdown">
                    <button class="dropdown-toggle bg-transparent border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @php
                        $user = auth()->user();
                        @endphp
                        @if (isset($user) && $user->logo != '')
                        <img src="{{ asset('images/'.$user->logo) }}" alt="profile-img" class="rounded-circle img-fluid  tc-card-img ">
                        @else
                        <img src="{{ asset('images/default_user_logo.png') }}" alt="profile-img" class="rounded-circle img-fluid  tc-card-img ">
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start text-center p-0" style="text-align: center;">
                        <li class="p-0">
                            <a class="dropdown-item text-center p-0" href="{{ url('messages') }}"> Inbox </a>
                        </li>
                        <li class="p-0">
                            <a class="dropdown-item text-center p-0" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Logo Nav END -->
</header>
@endif