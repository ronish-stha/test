<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;

class FrontendController extends Controller
{
    public $view = 'frontend.pages.';

    public function index()
    {
        $products = Product::all();
        $categories = Category::where('real_depth', 0)->with('products')->get();

        /*   $fashionCategory = $fashion->getChildren()->shuffle();
           foreach ($fashionCategory as $cat) {
               dd($cat->getChildren());
           }
           $beautyCategory = $beauty->getChildren()->shuffle();
           $boutiqueCategory = $boutique->getChildren()->shuffle();*/


        return view('frontend.pages.index',
            compact('products', 'categories'));
    }

    public function showProduct($id) {
        $product = Product::where('id', $id)->with('category')->first();
        $reviews = Review::where('product_id', $id)->get();
        $relatedProducts = Product::where('id', '!=', $id)->limit(4)->get();
        $totalRating = 0;
        $overallRating = 0;
        $reviewCount = count($reviews);

        foreach ($reviews as $review)
            $totalRating += $review->rating;

        if ($reviewCount != 0)
            $overallRating = (int)round($totalRating/count($reviews));

        return view('frontend.pages.productsingle', compact('product', 'overallRating', 'reviews', 'relatedProducts', 'reviewCount'));
    }

    public function categoryProduct($id) {
        $selectedCategory = Category::find($id);
        $allProducts = Product::all();
        $categories = Category::where('real_depth', 0)->get();
        $subCategories = Category::where('real_depth', 1)->get();
        $childCategories = Category::where('parent_id', $id)->where('real_depth', 2)->get();
        $products = [];

        foreach ($allProducts as $product) {
            if ($product->category_id == $id || optional($product->category)->parent_id == $id || optional($product->category->parent)->parent_id == $id) {
                $products[] = $product;
            }
        }

        return view($this->view . 'products', compact('products', 'subCategories', 'selectedCategory', 'categories', 'childCategories'));
    }

    public function products() {
        $products = Product::all();
        $categories = Category::where('real_depth', 0)->get();
        $subCategories = Category::where('real_depth', 1)->get();

        return view($this->view . 'products', compact('products', 'subCategories', 'categories'));
    }

    public function about() {
        return view('frontend.about');
    }

    public function search(Request $request) {
        $request->validate([
            'search_field' => 'required'
        ]);

        $products = Product::where('name', 'like', $request->search_field . '%')->get();
        $subCategories = Category::where('real_depth', 1)->get();


        return view('frontend.search', compact('products', 'subCategories'));
    }

    public function categories() {
        $categories = Category::all();

        return view('frontend.category', compact('categories'));
    }

    public function contact(Request $request) {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        try {
            Mail::to('stharonish@gmail.com')->send(new ContactMail($request));
        } catch(\exception $e) {
            return redirect()->back()->with('fail', 'Sorry something went wrong');
        }

        return redirect()->back()->with('success', 'Message sent successfully');
    }
}
