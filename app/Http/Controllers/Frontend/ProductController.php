<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use App\Models\Volume;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $view = 'frontend.product.';

    public function index()
    {
//        $products = Product::all();
        $categories = Category::all();
//        $subCategories = Category::where('real_depth', 1)->get();

        return view($this->view . 'index-all', compact('categories'));
    }

    public function categoryProduct($id)
    {
        /*$category = Category::find(2);
        dd($category->categories->pluck('id'));*/
        $selectedCategory = Category::with('products.country')->find($id);
        $subCategories = $selectedCategory->getDescendants();
        $parentCategory = $selectedCategory->parent;
        $sellers = User::with('sellerDetail')->where([
            'status' => true,
            'verified' => true,
            'user_type_id' => 3
        ])->get();
//        $allProducts = Product::all();
//        $categories = Category::where('real_depth', 0)->get();
//        $subCategories = Category::where('real_depth', 1)->get();
//        $childCategories = Category::where('parent_id', $id)->where('real_depth', 2)->get();
//        $products = [];

        /*foreach ($allProducts as $product) {
            if ($product->category_id == $id || optional($product->category)->parent_id == $id || optional($product->category->parent)->parent_id == $id) {
                $products[] = $product;
            }
        }*/

//        return view('frontend.pages.vendor', compact('products', 'subCategories', 'selectedCategory', 'categories', 'childCategories'));
        if (!$selectedCategory->parent_id)
            return view('frontend.product.category-index', compact('selectedCategory', 'subCategories'));

        $category = Category::with(['products.country', 'volumes'])->find(2);
        $productIds = $category->getRelation('products')->pluck('id');
        $volumes = array_unique($category->volumes->sortBy('volume')->pluck('volume')->toArray());
        $countryIds = $category->products->pluck('country_id');
        $countries = Country::whereIn('id', $countryIds)->get();
        $sellers = User::with('sellerDetail')->where('user_type_id', 3)->where('status', true)->where('verified', true)->get();

        return view('frontend.product.index', compact('selectedCategory', 'subCategories', 'parentCategory', 'sellers', 'countries', 'volumes', 'sellers'));

        $volumes = Volume::with('product')->whereIn('volume', $categoryVolumes)->whereIn('product_id', $productIds)->get();


        dd($volumes);
//        dd($category->products);
        $countryIds = $category->products->pluck('country_id');
        $countries = Country::whereIn('id', $countryIds)->get();
        foreach ($countries as $country) {
//            dd($country->products);
            dd($country->productVariants);
        }
        $countryIds = $category->products->pluck('country_id');
        dd($category->getRelations('products.country'));
        dd($category);
        dd($category, $category->countries);
        return view('frontend.product.index', compact('selectedCategory', 'subCategories', 'parentCategory', 'sellers'));
//        return view('frontend.product.index', compact('products', 'subCategories', 'selectedCategory', 'categories', 'childCategories', 'parentCategory'));
    }

    public function show($categoryId, $productId)
    {
        $product = Product::find($productId);
        $volumes = Volume::where('product_id', $product->id)->orderBy('volume')->orderBy('quantity')->get();
        $products = Product::limit(4)->get();

        return view($this->view . 'show', compact('product', 'products', 'volumes'));
    }

    public function getSellerProductVariants($productId, $volumeId)
    {
        $productVariants = ProductVariant::where('product_id', $productId)->where('volume_id', $volumeId)->get();

        $html = view($this->view . 'product-sellers', compact('productVariants'))->render();

        return response()->json(['status' => true, 'html' => $html]);
    }

    public function search()
    {
        $products = [];
        $subCategories = Category::where('real_depth', 1)->get();
        $sellers = User::with('sellerDetail')->where([
            'status' => true,
            'verified' => true,
            'user_type_id' => 3
        ])->get();

        return view($this->view . 'search', compact('products', 'subCategories', 'sellers'));
    }

    public function productSearch(Request $request)
    {
        $request->validate([
            'search_field' => 'required'
        ]);

        $products = Product::where('name', 'like', $request->search_field . '%')->get();
        $subCategories = Category::where('real_depth', 1)->get();
        $sellers = User::with('sellerDetail')->where([
            'status' => true,
            'verified' => true,
            'user_type_id' => 3
        ])->get();

        return view($this->view . 'search', compact('products', 'subCategories', 'sellers'));
    }

    public function sellerProducts($id)
    {
        $user = User::with('products', 'sellerDetail')->where([
            'id' => $id,
            'user_type_id' => 3,
            'status' => true,
            'verified' => true
        ])->firstOrFail();
        $products = $user->products;

        return view($this->view . 'seller', compact('user', 'products'));
    }

    public function filter(Request $request)
    {
//        dd($request->all());
        $category = Category::with('categories', 'products')->find($request->category_id);
        $subCategoryIds = $category->categories->pluck('id')->toArray();
        $categoryIds = $subCategoryIds;
        array_push($categoryIds, $category->id);
        $filterType = $request->name;
        $value = $request->value;
        $products = [];
        $productIds = null;
        if ($filterType == 'country') {
            $country = Country::find($value);
            $products = Product::whereIn('category_id', $categoryIds)->where('country_id', $country->id)->get();
        }

        if ($filterType == 'store') {
            $seller = User::where('id', $value)->first();
            $productVariants = $seller->productVariants;
            foreach ($productVariants as $productVariant) {
                $productIds[] = $productVariant->product_id;
            }
            if ($productIds)
                $products = Product::whereIn('id', $productIds)->whereIn('category_id', $categoryIds)->get();
        }

        if ($filterType == 'volume') {
            $volumeIds = Volume::where('volume', '<=', $value)->pluck('id');
            if ($volumeIds) {
                $productVariants = ProductVariant::whereIn('volume_id', $volumeIds)->get();
                foreach ($productVariants as $productVariant) {
                    $productIds[] = $productVariant->product_id;
                }
                if ($productIds)
                    $products = Product::whereIn('id', $productIds)->whereIn('category_id', $categoryIds)->get();
            }
        }

        if ($filterType == 'price') {

        }

        if ($filterType == 'rating') {

        }

        $html = view($this->view . 'product-filter', compact('products'))->render();

        return response()->json(['html' => $html, 'status' => true]);
    }
}
