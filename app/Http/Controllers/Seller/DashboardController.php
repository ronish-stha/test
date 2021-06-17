<?php

namespace App\Http\Controllers\Seller;

use App\Mail\VerificationDocumentReceived;
use App\Mail\VerificationDocumentSubmitted;
use App\Mail\VerifyDocumentAdminMail;
use App\Mail\VerifyDocumentSellerMail;
use App\Models\OrderDetail;
use App\Models\Sale;
use App\Models\User;
use App\Models\Image;
use App\Models\Banner;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Services\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SellerDetail;
use App\Models\SellerProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\VerifyFormRequest;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = SellerProduct::where('user_id', Auth::user()->id)->get();
        $reviews = Review::all();
        $orderDetails = OrderDetail::with('productVariant', 'productVariant.product')->where('seller_id', Auth::user()->id)->get();
        $currentYear = Carbon::now()->year;
        $months = $monthsName = $sales = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = 0;
            $monthName = Carbon::create()->month($i)->format('M');
            $monthsName[] = $monthName;
        }
        $analyticsCount = 0;
        $orderDetailsCount = count($orderDetails);
        $productQuantityArray = [];
        $max = 10;
        $productArray = $quantityArray = [];
        if ($orderDetailsCount != 0) {
            foreach ($orderDetails as $orderDetail) {
                if ((int)Helper::getYear($orderDetail->created_at) == $currentYear) {
                    $analyticsCount++;
                    $monthNumber = Helper::getMonthNumber($orderDetail->created_at);
                    $months[$monthNumber] += $orderDetail->total;
                }
                $productVariant = $orderDetail->productVariant;
                $product = $productVariant->product;
                if (!isset($productQuantityArray[$product->id])) {
                    $productQuantityArray[$product->id] = [
                        'name' => $product->name,
                        'quantity' => $orderDetail->quantity,
                    ];
                } else {
                    $productQuantityArray[$product->id]['quantity'] += $orderDetail->quantity;
                }
            }

            foreach ($productQuantityArray as $key => $value) {
                $productArray[] = $value['name'];
                $quantityArray[] = $value['quantity'];
            }

            $max = max($quantityArray);
        }

        if ($analyticsCount) {
            $sales = array_values($months);
            $maxSales = max($sales);
            $months = array_keys($months);
        } else {
            $months = array_keys($months);
            $maxSales = 1000;
        }

        return view('seller.dashboard',
            compact('categories', 'products', 'reviews', 'sales', 'productArray', 'quantityArray', 'orderDetailsCount', 'max', 'sales', 'months', 'maxSales', 'monthsName'));
    }

    public function verify()
    {
        if (Auth::user()->status && Auth::user()->verified)
            return redirect()->route('seller.dashboard');

        return view('seller.pages.verify');
    }

    public function verifySeller(VerifyFormRequest $request)
    {
        $user = Auth::user();
        $sellerDetail = SellerDetail::where('user_id', $user->id)->first();
        $businessRegistration = $this->saveImage($request->business_registration);
        $sellerDetail->update($request->except(['business_registration', '']) + [
                'business_registration' => 'storage/seller/' . $businessRegistration
            ]);
        $user->lat = $request->lat;
        $user->lng = $request->lng;
        $user->document = true;
        $user->update();

        Mail::to($user->email)->send(new VerificationDocumentSubmitted($user));
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new VerificationDocumentReceived($user));

        return redirect()->back()->with('success', 'Form successfully submitted. Our members will go through your document and verify your account shortly. If your criteria does not meet the requirements, you will be informed about it');
    }

    public function saveImage($inputImage)
    {
        $fileName = $inputImage->getClientOriginalName();
        $imageName = time() . '_' . $fileName;
        $inputImage->storeAs('public/seller/', $imageName);

        return $imageName;
    }
}
