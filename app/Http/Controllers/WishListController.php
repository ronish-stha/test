<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishListController extends Controller
{
    public function index(Request $request)
    {
        return view('frontend.wishlist');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $product = Product::find($request->id);
        $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === (int)$request->id;
        });

        if (!$duplicates->isEmpty()) {
            return redirect()->route('wishlist.index')->with('success', 'Item is already in your wishlist');
        }

        Cart::instance('wishlist')->add(
            $product->id,
            $product->name,
            1,
            $product->price
        )->associate('App\Product');


        return redirect()->route('wishlist.index')->with('success', 'Product successfully added to wishlist');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function destroy($id)
    {
        Cart::instance('wishlist')->remove($id);

        return redirect()->route('wishlist.index')->with('success', 'Product has been removed!');
    }

    public function emptyCart()
    {
        Cart::instance('wishlist')->destroy();

        return redirect()->route('wishlist.index')->with('success', 'Your cart has been cleared!');
    }
}
