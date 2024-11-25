<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCodeMail;
use App\Models\PendingUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    public function showVerifyForm()
    {
        $email = session('email');
        return view('auth.verify', compact('email'));
    }

    public function verifyemailcode(Request $request)
    {
        $email = $request->get('email');
        $verification_code = $request->get('verification_code');
        $pendingUser = PendingUser::where('email', $email)->first();

        if (!$pendingUser) {
            // If no pending user found with this email
            return response()->json(['success' => false, 'message' => 'Email not found']);
            // return redirect()->route('verification.notice')->with(['message'=>'Email not found']);
        }
        if ($pendingUser->verification_code !== $verification_code) {
            return response()->json(['success' => false, 'message' => 'Invalid verification code']);
            // return redirect()->route('verification.notice')->with(['message'=>'Invalid Verification code']);

        }
        // Check if the verification code is still valid based on the expiry time

        $currentTime = now(); // Current time

        $expiresAt = $pendingUser->verification_expires_at; // Expiry timestamp from the database

        if ($currentTime->greaterThan($expiresAt)) {
            return response()->json(['error' => true, 'message' => 'Verification code expired']);
        }
        $user = new User();
        $user->firstname = $pendingUser->firstname;
        $user->lastname = $pendingUser->lastname;
        $user->email = $pendingUser->email;
        $user->password = $pendingUser->password;
        $user->usertype = $pendingUser->usertype;
        $user->email_verified_at = now();
        $user->save();
        $pendingUser->delete();
        Auth::login($user);
        return response()->json(['success' => true, 'message' => 'Verification successful', 'usertype' => $user->usertype]);
    }

    public function resend_verification_email(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Retrieve the pending user by email
        $pendingUser = PendingUser::where('email', '=', $request->get('email'))->first();

        // Check if the user exists
        if ($pendingUser) {
            // Generate a new verification code and update the expiration time
            $verification_code = Str::random(6); // Generate a 6-character random code
            $expires_at = now()->addMinutes(3);  // Set the expiration time to 3 minutes from now

            // Update the pending user's verification code and expiration time
            $pendingUser->verification_code = $verification_code;
            $pendingUser->verification_expires_at = $expires_at;
            $pendingUser->save();

            // Send the verification code via email
            Mail::to($pendingUser->email)->send(new VerificationCodeMail($verification_code));

            // Redirect to the verification notice page with a success message

            return response()->json([
                'success' => true,
                'message' => 'We have sent a new verification code to your email. Please enter it to complete your registration.',
            ]);
            // return redirect()->route('verification.notice')
            //     ->with([
            //         'message' => 'We have sent a new verification code to your email. Please enter it to complete your registration.',
            //         'email' => $pendingUser->email,
            //         'verification_expires_at' => $pendingUser->verification_expires_at
            //     ]);
        } else {
            // Redirect to the registration page if the email is not registered
            return response()->json([
                'success' => false,
                'message' => 'Enter email Not found in register.',
                'redirect' => route('register')  // Optionally include a redirect URL
            ]);
            // return redirect()->route('register')->with('alert', 'Your email is not registered. Please register first and then complete your verification.');
        }
    }

    // public function redirectTo($user){
    //     $usertype= $user->usertype;
    //     echo"<script>console.log($usertype);</script>";
    //     switch ($usertype) {
    //         case 'admin':
    //             return RouteServiceProvider::HOMEADMIN;
    //             break;
    //         case 'user':
    //             return RouteServiceProvider::HOMEUSER;
    //             break;
    //         default:
    //             return '/';
    //             break;
    //     }
    // }
}
