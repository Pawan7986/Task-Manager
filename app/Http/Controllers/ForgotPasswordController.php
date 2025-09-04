<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        $link = url('/reset-password/'.$token.'?email='.$request->email);

        Mail::send('auth.email-forgot-password', ['link' => $link], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password Link');
        });

        return back()->with('status', 'Reset link has been sent to your email!');
    }
}
