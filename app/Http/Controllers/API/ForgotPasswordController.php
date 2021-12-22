<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\ForgotPassRequest;

class ForgotPasswordController extends Controller
{
    public function sendMail(Request $request)
    {
        $data = User::where('email', $request['email'])->first();
        if ($data) {
            $data->otp = mt_rand(1000000, 9999999);
            $data->save();

            Mail::to($request['email'])->send(new ForgotPasswordMail($data));
            return "Mail Send Successfully....Please Check Your Email !!";
        } else {
            return "Email is not exists.....😔!!";
        }
    }

    public function otpSend(ForgotPassRequest $request)
    {
        $check = User::where('otp', $request->otp)->first();
        if($check){
            $check->password = Hash::make($request->password);
            $check->save();
            return "Password Updated Successfully.......😊";
        } else {
            return "OTP is incorrect.....😔!!";
        }
    }
}
