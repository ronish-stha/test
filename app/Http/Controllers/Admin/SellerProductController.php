<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Image;
use App\Models\Volume;
use App\Models\Product;
use App\Models\SellerVolume;
use Illuminate\Http\Request;
use App\Models\SellerProduct;
use App\Models\ProductVariant;
use App\Models\SellerProductVariant;
use App\Http\Controllers\Controller;

class SellerProductController extends Controller
{
    protected $view = 'admin.seller-product.';

    public function index()
    {
        $sellerProducts = SellerProduct::where('status', 'complete')->get();

        return view($this->view . 'index', compact('sellerProducts'));
    }

    public function saveImage($inputImage, $productId)
    {
        $fileName = $inputImage->getClientOriginalName();
        $imageName = time() . '_' . $fileName;

        if ($productId) {
            //Upload Image
            $inputImage->storeAs('public/product/', $imageName);
            $image = new Image();
            $image->product_id = $productId;
            $image->image = 'storage/product/' . $imageName;
//            $image->save();
        } else {
            $inputImage->storeAs('public/product/', $imageName);

            return $imageName;
        }
    }

    public function show($id)
    {
        $sellerProduct = SellerProduct::findorFail($id);
        $product = Product::find($sellerProduct->product_id);
        if ($product) {
            $productVariants = ProductVariant::where('product_id', $product->id)->where('user_id', $sellerProduct->user_id)->where('status', 0)->get();

            return view($this->view . 'show-old', compact('sellerProduct', 'product', 'productVariants'));
        }

        return view($this->view . 'show', compact('sellerProduct', 'product'));
    }

    public function accept(Request $request, $id)
    {
        if ($request->type == 'reject') {
            $sellerProduct = SellerProduct::with('sellerProductVariants')->findOrFail($id);
            $sellerProduct->is_rejected = true;
            $sellerProduct->rejection_message = $request->rejection_message;
            $sellerProduct->update();

            foreach ($sellerProduct->sellerProductVariants as $sellerProductVariant) {
                $sellerProductVariant->is_rejected = true;
                $sellerProductVariant->update();
            }

            return redirect()->route('admin.seller-product.index')->with('success', 'Seller Product successfully rejected');
        }

        $this->validate($request, [
            'name' => 'required',
            'image' => 'max: 2000',
            'images.*' => 'max:2000'
        ]);

        $sellerProduct = SellerProduct::findOrFail($id);
        $sellerId = $sellerProduct->user_id;
        $seller = User::find($sellerId);
        $sellerVolumes = SellerVolume::where('seller_product_id', $sellerProduct->id)->get();
        $sellerProductVariants = SellerProductVariant::where('seller_product_id', $sellerProduct->id)->get();

        // create new product from seller product
        $product = new Product();
        $product->name = $sellerProduct->name;
        $product->brand = $sellerProduct->brand;
        $product->category_id = $sellerProduct->category_id;
        $product->image = $sellerProduct->image;
        if ($request->hasFile('image')) {
            $image = $this->saveImage($request->image, null);
            $product->image = 'storage/product/' . $image;
        }
        $product->save();
        $seller->products()->attach($product);

        $sellerProduct->status = 'accepted';
        $sellerProduct->product_id = $product->id;
        $sellerProduct->image = $product->image;
        $sellerProduct->update();

        // create new volumes from seller product -> volumes
        foreach ($sellerVolumes as $sellerVolume) {
            $volume = new Volume();
            $volume->volume = $sellerVolume->volume;
            $volume->quantity = $sellerVolume->quantity;
            $volume->product_id = $product->id;
            $volume->image = $sellerVolume->image;
            $volume->save();

            $sellerVolume->volume_id = $volume->id;
            $sellerVolume->update();
        }

        // get product -> volumes
        $volumes = Volume::where('product_id', $product->id)->get();

        // create new product variations from product, volume, seller, seller product variant
        foreach ($sellerProductVariants as $sellerProductVariant) {
            $productVariant = new ProductVariant();
            $productVariant->status = 1;
            $productVariant->product_id = $product->id;
            $productVariant->sku = $sellerProductVariant->sku;
            $productVariant->name = $sellerProductVariant->name;
            $productVariant->image = $sellerProductVariant->image;
            $productVariant->price = $sellerProductVariant->price;
            $productVariant->user_id = $sellerProductVariant->user_id;
            $productVariant->quantity = $sellerProductVariant->quantity;
            $productVariant->volume_id = $sellerProductVariant->sellerVolume->volume_id;
            $productVariant->seller_product_id = $sellerProductVariant->seller_product_id;
            $productVariant->save();
            if ($request->images) {
                if (isset($request->images[$sellerProductVariant->id])) {
                    $image = $this->saveImage($request->images[$sellerProductVariant->id], null);
                    $productVariant->image = 'storage/product/' . $image;
                    $volume = Volume::find($sellerProductVariant->sellerVolume->volume_id);
                    $volume->image = 'storage/product/' . $image;
                    $volume->update();
                }
            }
            $productVariant->update();

            $sellerProductVariant->product_variant_id = $productVariant->id;
            $sellerProductVariant->image = $productVariant->image;
            $sellerProductVariant->status = 1;
            $sellerProductVariant->update();
        }
        // creation process

        return redirect()->route('admin.seller-product.index')->with('success', 'Product successfully accepted');
    }

    public function acceptOld(Request $request, $id)
    {
        if ($request->type == 'reject') {
            $sellerProduct = SellerProduct::with('sellerProductVariants', 'productVariants')->findOrFail($id);
            $sellerProduct->is_rejected = true;
            $sellerProduct->rejection_message = $request->rejection_message;
            $sellerProduct->update();

            foreach ($sellerProduct->sellerProductVariants as $sellerProductVariant) {
                $sellerProductVariant->is_rejected = true;
                $sellerProductVariant->update();
            }

            foreach ($sellerProduct->productVariants as $productVariant) {
                $productVariant->is_rejected = true;
                $productVariant->update();
            }

            return redirect()->route('admin.seller-product.index')->with('success', 'Seller Product successfully rejected');
        }

        $this->validate($request, [
            'images.*' => 'max:2000'
        ]);

        $sellerProduct = SellerProduct::findOrFail($id);
        $product = Product::findOrFail($sellerProduct->product_id);
        $seller = User::find($sellerProduct->user_id);
        $seller->products()->attach($product);
        $sellerProduct->status = 'accepted';
        $sellerProduct->update();

        // get product -> volumes
        $volumes = Volume::where('product_id', $product->id)->get();
        $productVariants = ProductVariant::where('product_id', $product->id)->where('user_id', $sellerProduct->user_id)->where('status', 0)->get();

        foreach ($productVariants as $productVariant) {
            $productVariant->status = 1;
            if ($request->images) {
                if (isset($request->images[$productVariant->id])) {
                    $image = $this->saveImage($request->images[$productVariant->id], null);
                    $productVariant->image = 'storage/product/' . $image;
                    $volume = Volume::find($productVariant->volume_id);
                    $volume->image = 'storage/product/' . $image;
                    $volume->update();
                }
            }
            $productVariant->update();
        }

        return redirect()->route('admin.seller-product.index')->with('success', 'Product successfully accepted');
    }
}
