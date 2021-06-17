<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sale;
use App\Models\Review;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $sales = Sale::where('status', 'approved')->get();
        $categories = Category::all();
        $products = Product::all();
        $banners = Banner::all();
        $reviews = Review::all();
        $customers = User::where('id', '!=', '1')->get();

        return view('admin.dashboard',
            compact('sales', 'categories', 'products', 'banners', 'reviews', 'customers'));
    }
}
