<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DocumentDisapproved;
use App\Mail\DocumentVerified;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SellerController extends Controller
{
    public function index()
    {
        $users = User::all();
        $sellers = null;
        foreach ($users as $user) {
            if ($user->roles->first()->title == 'seller') {
                $sellers[] = $user;
            }
        }

        return view('admin.seller.index', compact('sellers'));
    }

    public function show($id)
    {
        $seller = User::where('id', $id)->first();

        return view('admin.seller.show', compact('seller'));
    }

    public function verify(Request $request, $id)
    {
        $status = null;
        $seller = $user = User::find($id);
        if ($request->status == 'Approve')
            $status = true;
        else {
            $status = false;
            $seller->document = false;
        }

        $seller->status = $status;
        $seller->verified = $status;
        $seller->update();

        if ($status) {
            Mail::to($seller->email)->send(new DocumentVerified($user));

            return redirect()->back()->with('success', 'Seller successfully verified');
        } else {
            Mail::to($seller->email)->send(new DocumentDisapproved($user));

            return redirect()->back()->with('success', 'Seller disapproved');
        }
    }
}
