<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Sale::where('status', '!=', 'approved')->get();

        return view('admin.order.index', compact('orders'));
    }

    public function newOrders() {
        $orders = Sale::where('status', 'unchecked')->get();

        foreach ($orders as $order) {
            $order->status = 'unapproved';
            $order->update();
        }

        $uncheckedOrderCount = 0;

        return view('admin.order.new_index', compact('orders', 'uncheckedOrderCount'));
    }

    public function deliver($id) {
        $sale = Sale::find($id);
        $sale->status = 'on delivery';
        $sale->update();

        return redirect()->route('order.index')->with('success', 'Order successfully set for delivery');
    }

    public function approve($id) {
        $sale = Sale::find($id);
        $sale->status = 'approved';
        $sale->update();

        return redirect()->back()->with('success', 'Order successfull approved and moved to sales');
    }



    public function show($id) {
        $sale = Sale::where('id', $id)->where('status', '!=', 'approved')->first();

        if (!$sale) {
            return redirect()->back();
        }

        return view('admin.sales.show', compact('sale'));
    }
}
