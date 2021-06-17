<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\SellerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    protected $view = 'seller.order.';

    public function index()
    {
        $sellerOrders = SellerOrder::where('user_id', Auth::user()->id)->get();

        return view($this->view . 'index', compact('sellerOrders'));
    }

    public function show($id)
    {
        $sellerOrder = SellerOrder::find($id);
        $this->authorize('isSeller', $sellerOrder);

        return view($this->view . 'show', compact('sellerOrder'));
    }

    public function approve($id, Request $request)
    {
        $sellerOrder = SellerOrder::find($id);
        $this->authorize('isSeller', $sellerOrder);
        foreach ($sellerOrder->orderDetails as $orderDetail) {
            $orderDetail->status = 'approved';
            $orderDetail->update();
        }
        $sellerOrder->status = 'approved';
        $sellerOrder->update();
        $order = $sellerOrder->order;
        $approvalCount = 0;
        $sellerOrdersCount = count($order->sellerOrders);
        foreach ($order->sellerOrders as $sellerOrder) {
            if ($sellerOrder->status == 'approved')
                $approvalCount += 1;
        }
        if ($approvalCount == $sellerOrdersCount) {
            $order->status = 'approved';
            $order->update();
        } else {
            $order->status = 'processing';
            $order->update();
        }

        return redirect()->back()->with('success', 'Order approved successfully');
    }
}
