<?php

namespace App\Http\Controllers\Seller;

use App\Models\Role;
use App\Models\User;
use App\Models\VerifyUser;
use App\Models\SellerDetail;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SellerRegisterFormRequest;

class AuthController extends Controller
{
    public function register(SellerRegisterFormRequest $request)
    {
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all() + [
                'user_type_id' => 2
            ]);
        $sellerDetail = new SellerDetail();
        $sellerDetail->user_id = $user->id;
        $sellerDetail->store_name = $request->store_name;
        $sellerDetail->save();

        $sellerRole = Role::where('title', 'seller')->first();
        $user->roles()->attach($sellerRole);

        VerifyUser::create([
            'user_id' => $user->id,
            'token' => sha1(time())
        ]);

        Mail::to($user->email)->send(new VerificationMail($user));

        return redirect()->back()->with('success', 'Registered Successfully. Please check your email for verification');
    }

    public function login(LoginFormRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::whereEmail($email)->first();
        if ($user) {
            if (!$user->status)
                return redirect()->back()->with('fail', 'Your account has not been activated  yet');
        }

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->back()->with(['error' => 'Name and password do not match']);
        }

        if (Auth::check()) {
            if (Auth::user()->hasRole('Seller')) {
                if (Auth::user()->verified && Auth::user()->status) {
                    $requestedUri = Session::get('requestedUri');
                    if ($requestedUri)
                        return redirect($requestedUri);

                    return redirect()->route('seller.dashboard');
                } else
                    return redirect()->route('seller.verify');
            }
        }

        return redirect()->route('seller.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('seller.login');
    }
}
