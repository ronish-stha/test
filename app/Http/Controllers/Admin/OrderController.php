<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $view = 'admin.order.';

    public function index() {
        $orders = Order::all();

        return view($this->view . 'index', compact('orders'));
    }

    public function newOrders() {
        $orders = Order::where('status', 'unchecked')->get();

        foreach ($orders as $order) {
            $order->status = 'unapproved';
            $order->update();
        }

        $uncheckedOrderCount = 0;

        return view('admin.order.new_index', compact('orders', 'uncheckedOrderCount'));
    }

    public function deliver($id) {
        $order = Order::find($id);
        $order->status = 'on delivery';
        $order->update();

        return redirect()->route('order.index')->with('success', 'Order successfully set for delivery');
    }

    public function approve($id) {
        $order = Order::find($id);
        $order->status = 'approved';
        $order->update();

        return redirect()->back()->with('success', 'Order successfully approved and moved to orders');
    }



    public function show($id) {
        $order = Order::where('id', $id)->first();

        return view($this->view . 'show', compact('order'));
    }
}
