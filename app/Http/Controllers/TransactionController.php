<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Mail\VerificationMail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\SellerOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\ExpressCheckout;

class TransactionController extends Controller
{
    public function checkout()
    {
        if (Cart::instance('cart')->count() == 0) {
            return redirect()->route('index');
        }

        $discount = Session::get('discount');
        $discountAmount = Session::get('discountAmount');
        $serviceCharge = Session::get('serviceCharge');
        $total = Session::get('total');

        return view('frontend.pages.checkout', compact('discount', 'discountAmount', 'serviceCharge', 'total'));
    }

    public function postCheckout(Request $request)
    {
        $discountPercentage = Session::get('discount');
        $discountAmount = Session::get('discountAmount');
        $serviceChargePercentage = 10;
        $serviceCharge = Session::get('serviceCharge');
        $couponUser = Session::get('couponUser');
        $total = Session::get('total');
        if ($request->payment_type !== 'paypal') {
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->subtotal = $total ? $total : str_replace(',', '', Cart::instance('cart')->total());
            $order->total = $total ? $total : str_replace(',', '', Cart::instance('cart')->total());
            $order->note = $request->note;
            $order->status = 'new';
            $order->payment_type = $request->payment_type;
            $order->discount = $discountAmount ? $discountAmount : 0;
            $order->discount_percentage = $discountPercentage ? $discountPercentage : 0;
            $order->service_charge = $serviceCharge ? $serviceCharge : 0;
            $order->service_charge_percentage = $serviceChargePercentage ? $serviceChargePercentage : 0;
            $order->save();

            $sellerOrderIds = [];
//
            foreach (Cart::instance('cart')->content() as $productVariant) {
                $key = null;
                if (count($sellerOrderIds) > 0) {
                    // checking if a seller's product variant has already been added to the order list
                    $key = array_search($productVariant->model->user_id, $sellerOrderIds);
                }
                if (!$key) {
                    $sellerOrder = new SellerOrder();
                    $sellerOrder->user_id = $productVariant->model->user_id;
                    $sellerOrder->subtotal = $productVariant->subtotal;
                    $sellerOrder->total = $productVariant->subtotal;
                    $sellerOrder->order_id = $order->id;
                    $sellerOrder->save();
                } else {
                    $sellerOrder = SellerOrder::find($key);
                    $sellerOrder->total += $productVariant->subtotal;
                    $sellerOrder->update();
                }
                $sellerOrderIds[$sellerOrder->id] = $productVariant->model->user_id;
                $orderDetail = new OrderDetail();
                $orderDetail->product_variant_id = $productVariant->id;
                $orderDetail->order_id = $order->id;
                $orderDetail->quantity = $productVariant->qty;
                $orderDetail->total = $productVariant->subtotal;
                $orderDetail->user_id = Auth::user()->id;
                $orderDetail->seller_id = $productVariant->model->user_id;
                $orderDetail->seller_order_id = $sellerOrder->id;
                $orderDetail->save();
            }

            $sellerOrders = SellerOrder::where('order_id', $order->id)->get();
            foreach ($sellerOrders as $sellerOrder) {
                $sellerTotal = $sellerOrder->total;
                if ($discountPercentage) {
                    $sellerDiscountAmount = ($discountPercentage / 100) * $sellerTotal;
                    $sellerTotal -= $sellerDiscountAmount;
                    $sellerOrder->discount_percentage = $discountPercentage;
                    $sellerOrder->discount = $sellerDiscountAmount;
                }
                if ($serviceChargePercentage) {
                    $sellerServiceChargeAmount = ($serviceChargePercentage / 100) * $sellerTotal;
                    $sellerTotal += $sellerServiceChargeAmount;
                    $sellerOrder->service_charge_percentage = $serviceChargePercentage;
                    $sellerOrder->service_charge = $sellerServiceChargeAmount;
                }
                $sellerOrder->total = $sellerTotal;
                $sellerOrder->update();
            }


            if ($couponUser) {
                $couponUser->status = true;
                $couponUser->save();
            }
            Session::forget('discount');
            Session::forget('discountAmount');
            Session::forget('serviceCharge');
            Session::forget('couponUser');
            Session::forget('total');
            Cart::destroy();

            Mail::to(auth()->user()->email)->send(new InvoiceMail($order));

            return view('frontend.pages.payment-success', compact('order'));
        } else {
            $data = [];
            $data['items'] = [
                [
                    'name' => Auth::user()->first_name . ' ' . Auth::user()->last_name,
                    'price' => $total ? $total : Cart::instance('cart')->total(),
                    'desc'  => 'Payment',
                    'qty' => 1
                ]
            ];

            $data['invoice_id'] = 1;
            $data['invoice_description'] = "Order Invoice";
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $data['total'] = $total ? $total : Cart::instance('cart')->total();

            $provider = new ExpressCheckout;

            $response = $provider->setExpressCheckout($data);

            $response = $provider->setExpressCheckout($data, true);

            return redirect($response['paypal_link']);
        }
    }

    public function cancel()
    {
       return redirect()->route('checkout')->with('fai', 'The payment has been cancelled');
    }

    public function success(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        $discountPercentage = Session::get('discount');
        $discountAmount = Session::get('discountAmount');
        $serviceChargePercentage = 10;
        $serviceCharge = Session::get('serviceCharge');
        $couponUser = Session::get('couponUser');
        $total = Session::get('total');

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->subtotal = $total ? $total : str_replace(',', '', Cart::instance('cart')->total());
            $order->total = $total ? $total : str_replace(',', '', Cart::instance('cart')->total());
            $order->status = 'new';
            $order->payment_type = 'Paypal';
            $order->payment_status = true;
            $order->discount = $discountAmount ? $discountAmount : 0;
            $order->discount_percentage = $discountPercentage ? $discountPercentage : 0;
            $order->service_charge = $serviceCharge ? $serviceCharge : 0;
            $order->service_charge_percentage = $serviceChargePercentage ? $serviceChargePercentage : 0;
            $order->save();

            $sellerOrderIds = [];
//
            foreach (Cart::instance('cart')->content() as $productVariant) {
                $key = null;
                if (count($sellerOrderIds) > 0) {
                    // checking if a seller's product variant has already been added to the order list
                    $key = array_search($productVariant->model->user_id, $sellerOrderIds);
                }
                if (!$key) {
                    // create new seller order
                    $sellerOrder = new SellerOrder();
                    $sellerOrder->user_id = $productVariant->model->user_id;
                    $sellerOrder->subtotal = $productVariant->subtotal;
                    $sellerOrder->total = $productVariant->subtotal;
                    $sellerOrder->order_id = $order->id;
                    $sellerOrder->save();
                } else {
                    // update existing seller order
                    $sellerOrder = SellerOrder::find($key);
                    $sellerOrder->total += $productVariant->subtotal;
                    $sellerOrder->update();
                }
                $sellerOrderIds[$sellerOrder->id] = $productVariant->model->user_id;
                $orderDetail = new OrderDetail();
                $orderDetail->product_variant_id = $productVariant->id;
                $orderDetail->order_id = $order->id;
                $orderDetail->quantity = $productVariant->qty;
                $orderDetail->total = $productVariant->subtotal;
                $orderDetail->user_id = Auth::user()->id;
                $orderDetail->seller_id = $productVariant->model->user_id;
                $orderDetail->seller_order_id = $sellerOrder->id;
                $orderDetail->save();
            }

            $sellerOrders = SellerOrder::where('order_id', $order->id)->get();
            foreach ($sellerOrders as $sellerOrder) {
                $sellerTotal = $sellerOrder->total;
                if ($discountPercentage) {
                    $sellerDiscountAmount = ($discountPercentage / 100) * $sellerTotal;
                    $sellerTotal -= $sellerDiscountAmount;
                    $sellerOrder->discount_percentage = $discountPercentage;
                    $sellerOrder->discount = $sellerDiscountAmount;
                }
                if ($serviceChargePercentage) {
                    $sellerServiceChargeAmount = ($serviceChargePercentage / 100) * $sellerTotal;
                    $sellerTotal += $sellerServiceChargeAmount;
                    $sellerOrder->service_charge_percentage = $serviceChargePercentage;
                    $sellerOrder->service_charge = $sellerServiceChargeAmount;
                }
                $sellerOrder->total = $sellerTotal;
                $sellerOrder->update();
            }

            if ($couponUser) {
                $couponUser->status = true;
                $couponUser->save();
            }
            Session::forget('discount');
            Session::forget('discountAmount');
            Session::forget('serviceCharge');
            Session::forget('couponUser');
            Session::forget('total');
            Cart::destroy();

            Mail::to(auth()->user()->email)->send(new InvoiceMail($order));

            return view('frontend.pages.payment-success', compact('order'));
        }

        return redirect()->route('checkout')->with('fail', 'Something went wrong. Please try again.');
    }
}
