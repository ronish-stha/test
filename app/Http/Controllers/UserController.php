<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function customerSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'address' => 'required',
            'phone' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput([
                'tab' => 'nav-signup',
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);
        }

        $customer = new User();
        $customer->first_name = $request->first_name;
        $customer->last_name = $request->last_name;
        $customer->email = $request->email;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;
        $customer->district = $request->district;
        $customer->zone = $request->zone;
        $customer->phone = $request->phone;
        $customer->phone2 = $request->phone2;
        $customer->user_type_id = 3;
        $customer->save();

        $customerRole = Role::where('title', 'customer')->first();
        $customer->roles()->attach($customerRole);

        VerifyUser::create([
            'user_id' => $customer->id,
            'token' => sha1(time())
        ]);

        Mail::to($customer->email)->send(new VerificationMail($customer));

        return redirect()->back()->withInput(['tab' => 'nav-signup'])->with('success', 'Registered Successfully. Please check your email for verification');

//        return redirect()->route('login')->with('success', 'Successfully Registered');
    }

    public function customerLogin(LoginFormRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::whereEmail($email)->first();
        if ($user) {
            if (!$user->status)
                return redirect()->back()->with('fail', 'Your account has not been activated  yet');
        }


        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->back()->with(['fail' => 'Email and password do not match']);
        }

        $requestedUri = Session::get('requestedUri');
        if ($requestedUri)
            return redirect($requestedUri);

        if (Auth::user()->hasRole('Seller')) {
            Auth::logout();

            return redirect()->back()->with('fail', 'Sellers cannot login from here');
        }


        if (Auth::check()) {
            if (Auth::user()->hasRole('Customer')) {
                if ($request->checkout) {
                    return redirect()->route('checkout');
                }

                return redirect()->route('account');
            }
        }
    }

    public function getAdminLogin()
    {
        return view('admin.login');
    }

    public function postAdminLogin(LoginFormRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->back()->with(['fail' => 'Email and password do not match']);
        }

        if (Auth::check()) {
            if (Auth::user()->hasRole('Admin')) {
                $requestedUri = Session::get('requestedUri');
                if ($requestedUri)
                    return redirect($requestedUri);

                return redirect()->route('dashboard');
            }
        }

        return redirect()->route('admin.login');
    }

    public function adminLogout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('index');
    }

    public function password()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);

        $user = User::find(auth()->user()->id);
        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('fail', 'Old password does not match');
        }

        $user->password = bcrypt($request->new_password);
        $user->update();

        return redirect()->back()->with('success', 'Password changed successfully');
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email,' . Auth::User()->id,
            'first_name' => 'required',
            'last_name' => 'required',
        ]);

        $user = User::find(Auth::User()->id);
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->update();

        return redirect()->back()->with('success', 'Credentials updated successfully');
    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        $userType = $route = null;
        if ($verifyUser) {
            $user = $verifyUser->user;
            if (!$user->status) {
                $user->status = 1;
                $user->email_verified_at = Carbon::now();
                $userType = $user->user_type_id;
                $user->update();
                $status = 'You email has been verified successfully. You can now login';
            } else
                $status = 'Your email has already been verified';
        } else {
            if ($userType == 3)
                $route = 'signup';
            else
                $route = 'seller.login';
            return redirect()->route($route)->with('fail', 'Sorry your email could no be identified');
        }

        if ($userType == 3)
            $route = 'signup';
        else
            $route = 'seller.login';

        return redirect()->route($route)->with('success', $status);
    }
}
