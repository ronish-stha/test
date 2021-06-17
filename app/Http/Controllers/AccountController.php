<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function account()
    {
        if (!Auth::user()) {
            return redirect()->route('index');
        }

        $user = Auth::user();
        $orders = Order::where('user_id', Auth::User()->id)->get();

        return view('frontend.user.account', compact('orders', 'user'));
    }

    public function orderDetail($id)
    {
        $order = Order::findorFail($id);
        $this->authorize('isCustomer', $order);
        $user = Auth::user();

        return view('frontend.user.order-detail', compact('order', 'user'));
    }

    public function orders() {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->get();

        return view('frontend.user.order', compact('user', 'orders'));
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required'
        ]);

        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->update();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updateAddress(Request $request) {
        $request->validate([
            'address' => 'required',
            'city' => 'required',
        ]);

        $user = User::find(Auth::user()->id);
        $user->address = $request->address;
        $user->city = $request->city;
        $user->update();

        return redirect()->back()->with('success', 'Delivery Address updated successfully');
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
}
