@extends('frontend.layout')
@section('title', 'How It Works')
@section('content')
    <!-- Referral Codes Section START -->
<section class="about mt-5 p-5">
    <div class="container">
        <div class="row g-4 align-items-xl-center">
            <div class="col-lg-5">
                <img src="{{ asset('images/img8.png') }}" alt="referral-img" />
            </div>
            <div class="col-lg-7 about-content">
                <h3>Let others use your referral codes</h3>
                <p>
                    Neatly organize all your referral codes on your
                    Invitation profile. People searching for deals will
                    be able to discover your posts. You are going to
                    earn rewards.
                </p>
                <button class="button-primary mt-3">
                    GET STARTED, IT'S FREE
                </button>
            </div>
        </div>
    </div>
</section>
<!-- Referral Codes Section END -->
<!-- Bonus Section START -->
<section class="about pt-5">
    <div class="container">
        <div class="row g-4 align-items-xl-center">
            <div class="col-lg-7 about-content">
                <h3>Never miss another signup bonus.</h3>
                <p>
                    When signing up to a new service or purchasing
                    something online, the browser extension shows you
                    the best referral deals posted by your friends and
                    the community.
                </p>
            </div>
            <div class="col-lg-5">
                <img src="{{ asset('images/img4.png') }}" alt="referral-img" />
            </div>
        </div>
    </div>
</section>
<!-- Bonus Section END -->
<!-- Tribe Section START -->
<section class="about pt-5">
    <div class="container">
        <div class="row g-4 align-items-xl-center">
            <div class="col-lg-5">
                <img src="{{ asset('images/img5.png') }}" alt="referral-img" />
            </div>
            <div class="col-lg-7 about-content">
                <h3>Build your tribe</h3>
                <p>
                    Follow your friends, exchange referrals, promote
                    products you love, discuss creative ways to earn
                    online, cash in cryptos and earn valuable rewards on
                    autopilot.
                </p>
                <button class="button-primary mt-3">GET STARTED</button>
            </div>
        </div>
    </div>
</section>
<!-- Tribe Section END -->
<!-- Game Section START -->
<section class="about pt-5 pb-5">
    <div class="container">
        <div class="row g-4 align-items-xl-center">
            <div class="col-lg-7 about-content">
                <h3>Step up your referral game</h3>
                <p>
                    Track your progress on your dashboard and climb up
                    the leaderboard. Boost your posts visibility by
                    being active in the community and on-boarding other
                    users.
                </p>
            </div>
            <div class="col-lg-5">
                <img src="{{ asset('images/img6.jfif') }}" alt="referral-img" />
            </div>
        </div>
    </div>
</section>
<!-- Game Section END -->
@endsection
