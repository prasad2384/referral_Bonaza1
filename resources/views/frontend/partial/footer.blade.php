 <!-- footer section START-->
 @php
     use Illuminate\Support\Facades\Route;
 @endphp
 <footer class="mt-5">

     @if (Route::currentRouteName() !== 'user_profile')
         <div class="container-fluid py-5 pre-footer">
             <div class="row">
                 <div class="text-center py-5">
                     <h2 class="mb-2">
                         Why don't you post your links here too?
                     </h2>
                     <h3>
                         List the products you love. Get rewarded.<br />
                         <span><i>It's quick & free.</i></span>
                     </h3>
                     @if (Route::currentRouteName() !== 'terms_condition' && Route::currentRouteName() !== 'referral_code')
                         <a href="/login" class="button-primary-light mt-3">
                             LOGIN NOW
                         </a>
                     @else
                         <button class="button-primary-light mt-3 mx-2"><img
                                 src="{{ asset('images/img-18.png') }}" alt="google" />continue with
                             google</button>
                         <button class="button-primary-dark mt-3 mx-2">explore feAtures</button>
                     @endif
                 </div>
             </div>
         </div>
     @endif
     <div class="container">
         <div class="row">
             <div class="d-md-flex justify-content-between align-items-center text-center text-lg-start py-4 footer">
                 <p class="mb-0">Copyright © ReferralCodes 2024</p>
                 <ul class="mb-0">
                     <li><a href="{{url('/faq')}}"> FAQ </a></li>
                     <li><a href="#"> About Us </a></li>
                     <li><a href="#"> Contact Admin </a></li>
                 </ul>
             </div>
         </div>
     </div>
 </footer>
