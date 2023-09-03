<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\SendEmailVerificationOTPNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function verify(Request $request) {
        $user  = User::where('email',$request->user()->email)
            ->where('otp', $request->otp)
            ->first();

        if ($user){
            if (!$user->hasVerifiedEmail()) {
                $user->markEmailAsVerified();
            }else{
                return response()->json(["message" => "Email already verified."], 400);
            }

            $user->otp = null;
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Email verified Successfully',
                'access_token' => $user->createToken("API TOKEN")->plainTextToken,
                'user' => new UserResource($user)
            ], 200);
        }else{
            return response()->json([
                'status' => 'failure',
                'errors' => ['otp' => ["Invalid OTP"]],
            ], 422);
        }

    }

    public function resend() {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(["message" => "Email already verified."], 400);
        }
        //Generate OTP
        $otp = rand(1000,9999);

        $user = auth()->user();
        $user->otp = $otp;
        $user->save();
        $user->notify(new SendEmailVerificationOTPNotification());
        return response()->json(["message" => "OTP resent to your email"]);
    }
}
