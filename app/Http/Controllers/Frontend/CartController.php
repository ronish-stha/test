<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index(Request $request)
    {
        /*Cookie::make('name', 'value', 2);
        request()->cookie()*/
        $total = (int)str_replace(',', '', Cart::instance('cart')->total());
        $discount = Session::get('discount');

        if ($discount) {
            $discount = ($discount / 100) * $total;
            $total = $total - $discount;
            Session::put('discountAmount', $discount);
        }

        // Service Charge = 10%
        $serviceCharge = 0.1 * $total;
        Session::put('serviceCharge', $serviceCharge);
        $total = $total + $serviceCharge;
        Session::put('total', $total);

        return view('frontend.pages.cart', compact('total', 'discount', 'serviceCharge'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if (!$request->quantity) {
            $quantity = 1;
        } else {
            $quantity = $request->quantity;
        }

        $productVariant = ProductVariant::findOrFail($request->product_variant_id);
        $price = $productVariant->price;
        if ($productVariant->discount) {
            $price = round($productVariant->price - (($productVariant->discount / 100) * $productVariant->price));
        }

        $duplicates = Cart::instance('cart')->search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === (int)$request->id;
        });

        if (!$duplicates->isEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Item is already in your cart');
        }

        // Cart::add('id', 'name', 'quantity', 'price', [ 'additionalFields' => 'brand'  ]))
        Cart::instance('cart')->add(
            $productVariant->id,
            $productVariant->name,
            $quantity,
            $price,
            [
                'quantity' => $productVariant->parentVolume->quantity,
                'volume' => $productVariant->parentVolume->volume,
            ]
        )->associate('App\Models\ProductVariant');

        return redirect()->route('cart.index')->with('success', 'Product successfully added to cart');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        Cart::instance('cart')->update($id, $request->quantity);
        session()->flash('success', 'Quantity updated successfully!');

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Cart::instance('cart')->remove($id);

        return redirect()->route('cart.index')->with('success', 'Product has been removed!');
    }

    public function emptyCart()
    {
        Cart::instance('cart')->destroy();

        return redirect()->route('cart.index')->with('success', 'Your cart has been cleared!');
    }
}
