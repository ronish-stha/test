<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // $users = User::where('id', '!=', '1')->get();
        $users = User::all();
        $customers = null;
        foreach ($users as $user) {
            if ($user->roles->first()->title == 'customer') {
                $customers[] = $user;
            }
        }

        return view('admin.customer.index', compact('customers'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $customer = User::where('id', $id)->first();

        return view('admin.customer.show', compact('customer'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
