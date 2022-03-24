<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


class EmailVerificationController extends Controller
{
    public function sendVerificationEmail(Request $request)
    {
        if($request->user()->hasVerifiedEmail())
            return ["message" => 'Email confirmado'];
        
        $request->user()->sendEmailVerificationNotification();
        return ["status" => "Email de verificacion enviado"];
    }

    public function verify(EmailVerificationRequest $request)
    {
        if($request->user()->hasVerifiedEmail()){
            return ["message" => "Email verificado exitosamente"];
        }

        if($request->user()->markEmailAsVerified()){
            event(new Verified($request->user()));
        }

        return ["message"=> "El email ya estaba verificado"];
    }
}
