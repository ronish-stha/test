<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class LayoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(6);
        return view('user.layouts.index', compact('products'));
    }

    public function singingbowl()
    {
        $products = Product::where('category_id', 1)->orderBy('created_at', 'desc')->paginate(6);
        $categories = Category::all();
        return view('user.productList', compact('products', 'categories'));
    }

    public function thangkas()
    {
        $products = Product::where('category_id', 2)->orderBy('created_at', 'desc')->paginate(6);
        return view('user.productList', compact('products'));
    }

    public function clothes()
    {
        $products = Product::where('category_id', 3)->orderBy('created_at', 'desc')->paginate(6);
        return view('user.productList', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $relatedProducts = Product::where('id', '!=', $id)->get();
        return view('user.layouts.show', compact('product', 'relatedProducts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
