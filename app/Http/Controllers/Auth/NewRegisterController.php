<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCodeMail;
use App\Models\PendingUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mews\Captcha\Facades\Captcha;

class NewRegisterController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:5|confirmed',
            'captcha'=> 'required|captcha',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $email_check = User::where('email', '=', $request->get('email'))->count();
        
        if ($email_check == 1) {
            return redirect()->route('login')->with('alert', 'You Alredy Register Please Login');
        }

        $email_check_pending_user = PendingUser::where('email', '=', $request->get('email'))->first();
        $verification_code = Str::random(6); // Generate a 6-digit random code
        $expires_at = now()->addMinutes(3);  // Set the expiration time to 3 minutes from now
        if ($email_check_pending_user) {
            $email_check_pending_user->firstname = $request->get('firstname');
            $email_check_pending_user->lastname = $request->get('lastname');
            $email_check_pending_user->password = Hash::make($request->get('password'));
            $email_check_pending_user->usertype = $request->get('usertype'); // Set the usertype to 'user'
            $email_check_pending_user->verification_code = $verification_code;
            $email_check_pending_user->verification_expires_at = $expires_at;
            $email_check_pending_user->save(); // Save the updated record
            Mail::to($email_check_pending_user->email)->send(new VerificationCodeMail($verification_code));
            return redirect()->route('verification.notice')
                ->with([
                    'message' => 'We have sent a verification code to your email. Please enter it to complete your registration.',
                    'email' => $email_check_pending_user->email,
                    'verification_expires_at' => $email_check_pending_user->verification_expires_at
                ]);
        } else {
            $pendingUser = PendingUser::create([
                'firstname' => $request->get('firstname'),
                'lastname' => $request->get('lastname'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'usertype' => $request->get('usertype'), // 
                'verification_code' => $verification_code,
                'verification_expires_at' => $expires_at,
            ]);
            Mail::to($pendingUser->email)->send(new VerificationCodeMail($verification_code));
            return redirect()->route('verification.notice')
                ->with([
                    'message' => 'We have sent a verification code to your email. Please enter it to complete your registration.',
                    'email' => $pendingUser->email,
                    'verification_expires_at' => $pendingUser->verification_expires_at
                ]);
        }
    }
}
