<?php

namespace App\Http\Controllers\Captcha;
use App\Http\Controllers\Controller;
use Mews\Captcha\Facades\Captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaptchController extends Controller
{
    //
    public function refreshCaptcha(){
        return response()->json(['captcha'=> captcha_img()]);
    }
    
}
