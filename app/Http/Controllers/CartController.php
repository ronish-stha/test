<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return view('frontend.pages.cart');
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

        $product = Product::find($request->id);
        $price = $product->price;
        if ($product->discount) {
            $price = round($product->price - (($product->discount / 100) * $product->price));
        }

        $duplicates = Cart::instance('cart')->search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === (int)$request->id;
        });

        if (!$duplicates->isEmpty()) {
            return redirect()->route('cart.index')->with('success', 'Item is already in your cart');
        }

        // Cart::add('id', 'name', 'quantity', 'price', [ 'additionalFields' => 'brand'  ]))

        Cart::instance('cart')->add(
            $product->id,
            $product->name,
            $quantity,
            $price,
            [
                'color' => $request->color,
                'size' => $request->size
            ]
        )->associate('App\Models\Product');

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
