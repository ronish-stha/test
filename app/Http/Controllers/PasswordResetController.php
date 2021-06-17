<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\PasswordReset;
use Illuminate\Http\Request;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function getResetLinkForm()
    {
        return view('frontend.account.forgot_password');
    }

    public function sendResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('fail', 'User with this email does not exist');
        }

        $token = str_random(64);

        try {
            Mail::to($user->email)->send(new PasswordResetMail($token));
        } catch (\exception $e) {
            return redirect()->back()->with('fail', 'Sorry something went wrong');
        }

        $passwordReset = PasswordReset::where('user_id', $user->id)->first();
        if (!$passwordReset) {
            $passwordReset = new PasswordReset();
        }
        $passwordReset->token = $token;
        $passwordReset->user_id = $user->id;
        $passwordReset->save();

        return redirect()->back()->with('success', 'We have e-mailed your password reset link');
    }

    public function getResetPasswordForm($token) {
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset) {
            return redirect()->route('password')->with('fail', 'The token does not exist');
        }

        return view('frontend.account.reset_password', compact('token'));
    }

    public function reset(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        $user = User::where('email', $request->email)->first();
        $passwordReset = PasswordReset::where('token', $request->token)->first();

        if (!$user) {
            return redirect()->back()->with('fail', 'User does not exist');
        }

        if ($user->passwordReset) {
            if ($user->passwordReset->token != $request->token) {
                return redirect()->back()->with('fail', 'Password reset token is invalid');
            }
        } else {
            return redirect()->back()->with('fail', 'Password reset token is invalid');
        }

        $user->password = bcrypt($request->password);
        $user->update();

        $passwordReset->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset successfully');
    }
}
