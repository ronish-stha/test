<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\BannerAd;
use App\Models\BannerAdEmail;
use App\Models\Content;
use App\Models\Country;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Mail\ContactMail;
use App\Models\Volume;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;


class IndexController extends Controller
{
    public $view = 'frontend.pages.';

    public function index()
    {
        $products = Product::all();
        $categories = Category::where('real_depth', 0)->with('products')->get();
        $contents = Content::all()->toArray();
        $currentDate = Carbon::now()->toDateString();
        $bannerAd = BannerAd::where('status', 1)->whereDate('expiry_date', '>=', $currentDate)->first();

        return view('frontend.pages.index',
            compact('products', 'categories', 'contents', 'bannerAd'));
    }

    public function showProduct($id)
    {
        $product = Product::where('id', $id)->with('category')->first();
        $reviews = Review::where('product_id', $id)->get();
        $relatedProducts = Product::where('id', '!=', $id)->limit(4)->get();
        $totalRating = 0;
        $overallRating = 0;
        $reviewCount = count($reviews);

        foreach ($reviews as $review)
            $totalRating += $review->rating;

        if ($reviewCount != 0)
            $overallRating = (int)round($totalRating / count($reviews));

        return view('frontend.pages.productsingle', compact('product', 'overallRating', 'reviews', 'relatedProducts', 'reviewCount'));
    }


    public function products()
    {
        $products = Product::all();
        $categories = Category::where('real_depth', 0)->get();
        $subCategories = Category::where('real_depth', 1)->get();

        return view($this->view . 'products', compact('products', 'subCategories', 'categories'));
    }

    public function about()
    {
        return view('frontend.about');
    }


    public function categories()
    {
        $categories = Category::all();

        return view('frontend.category', compact('categories'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'description' => 'required',
        ]);

        try {
            Mail::to('stharonish@gmail.com')->send(new ContactMail($request));
        } catch (\exception $e) {
            return redirect()->back()->with('fail', 'Sorry something went wrong');
        }

        return redirect()->back()->with('success', 'Message sent successfully');
    }

    public function location(Request $request) {
        $request->validate([
            'location' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        Session::put('location', $request->location);
        Session::put('lat', $request->lat);
        Session::put('lng', $request->lng);

        return redirect()->route('products');
    }

    public function redeemOffer(Request $request, $id) {
        $bannerAd = BannerAd::find($id);
        $redeemedBannerAdEmail = BannerAdEmail::where('banner_ad_id', $bannerAd->id)->where('email', $request->email)->first();
        if ($redeemedBannerAdEmail) {
            return response()->json(['status' => false, 'msg' => 'The offer has already been redeemed for this email']);
        }
        $bannerAdEmail = new BannerAdEmail();
        $bannerAdEmail->email = $request->email;
        $bannerAdEmail->banner_ad_id = $bannerAd->id;
        $bannerAdEmail->status = 0;
        $bannerAdEmail->save();

        return response()->json(['status' => true, 'msg' => 'Offer redeemed successfully']);
    }

    public function redeemCoupon(Request $request) {
        if (!$request->code)
            return response()->json(['status' => false, 'msg' => 'Please enter a coupon code']);

        $bannerAd = $coupon = BannerAd::where('code', $request->code)->first();

        if (!$bannerAd) {
            return response()->json(['status' => false, 'msg' => 'Coupon does not exist']);
        }

        $currentDate = Carbon::now()->format("Y-m-d");
        if ($currentDate > $bannerAd->expiry_date) {
            return response()->json(['status' => false, 'msg' => 'Coupon code has already expired']);
        }

        if (!auth()->user()) {
            return response()->json(['status' => false, 'msg' => 'You need to be logged in to redeem coupon']);
        }

        if (auth()->user()) {
            $bannerAdEmail = BannerAdEmail::where('banner_ad_id', $coupon->id)->where('email', auth()->user()->email)->first();

            if ($bannerAdEmail->status) {
                return response()->json(['status' => false, 'msg' => 'The coupon has already been redeemed']);
            }

            if (!$bannerAdEmail) {
                return response()->json(['status' => false, 'msg' => 'The code has not been redeemed for this user']);
            }

            $existingCoupon = session()->get('coupon');
            if ($existingCoupon) {
                session()->put('discount', $coupon->discount);
                session()->put('coupon', $coupon);
                session()->put('couponUser', $bannerAdEmail);

                if ($existingCoupon->id == $coupon->id) {
                    return response()->json(['status' => false, 'msg' => 'The coupon is currently being applied']);
                }
            }

            session()->put('discount', $coupon->discount);
            session()->put('coupon', $coupon);
            session()->put('couponUser', $bannerAdEmail);

            return response()->json(['status' => true]);
        }
    }
}
