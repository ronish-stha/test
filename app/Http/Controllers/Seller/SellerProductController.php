<?php

namespace App\Http\Controllers\Seller;

use App\Http\Requests\ProductVariantEditFormRequest;
use App\Models\Image;
use App\Models\ProductVariant;
use App\Models\SellerProductVariant;
use App\Models\SellerVolume;
use App\Models\Volume;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SellerProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SellerProductController extends Controller
{
    private $view = 'seller.products.';

    public function index()
    {
        $sellerProducts = SellerProduct::where('user_id', Auth::user()->id)->get();
        $sellerProductVariants = SellerProductVariant::where('user_id', Auth::user()->id)->where('status', 0)->get();
        $productVariants = ProductVariant::where('user_id', Auth::user()->id)->get();
        $counter = count($sellerProductVariants) + count($productVariants);

        return view($this->view . 'index', compact('sellerProducts', 'sellerProductVariants', 'productVariants', 'counter'));
    }

    public function create()
    {
        $volumes = Volume::all();
        $categories = Category::all();
//        $categories = Category::where('real_depth', 0)->get();

        return view($this->view . 'create', compact('categories', 'volumes'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);

        return view($this->view . 'create-old', compact('product'));
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

    public function productVolumeTable(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'category' => 'required'
        ]);
        // return
        $sellerProduct = new SellerProduct();
        $sellerProduct->name = $request->name;
        $sellerProduct->brand = $request->brand;
        $sellerProduct->category_id = $request->category;
        $sellerProduct->user_id = Auth::user()->id;
        $sellerProduct->status = 'incomplete';
        $sellerProduct->save();

        foreach ($request->volume as $key => $volume) {
            $sellerVolume = new SellerVolume();
            $sellerVolume->volume = $volume;
            $sellerVolume->quantity = $request->quantity[$key];
            $sellerVolume->seller_product_id = $sellerProduct->id;
            $sellerVolume->save();
        }

        $sellerVolumes = SellerVolume::where('seller_product_id', $sellerProduct->id)->get();
        $html = view('seller.products.product-variant-table', compact('sellerProduct', 'sellerVolumes'))->render();

        return response()->json(['status' => true, 'html' => $html, 'id' => $sellerProduct->id]);
    }

    public function oldProductVolumeTable(Request $request)
    {
        $product = Product::find($request->product_id);
        $volumes = [];

        foreach ($request->volume as $key => $requestVolume) {
            $volume = Volume::where('product_id', $product->id)->where('volume', $requestVolume)->where('quantity', $request->quantity[$key])->first();
            if (!$volume) {
                $volume = new Volume();
                $volume->volume = $requestVolume;
                $volume->quantity = $request->quantity[$key];
                $volume->product_id = $product->id;
                $volume->save();
            }
            $volumes[] = $volume;
        }

        $html = view('seller.products.product-variant-table-old', compact('product', 'volumes'))->render();

        return response()->json(['status' => true, 'html' => $html, 'id' => $product->id]);
    }

    public function storeOld(Request $request)
    {

        // validation
        $product = Product::find($request->product_id);

        // creating seller product if admin activation is needed to activate the new bunch of product variants by admin
        $sellerProduct = new SellerProduct();
        $sellerProduct->name = $product->name;
        $sellerProduct->brand = $product->brand;
        $sellerProduct->category_id = $product->category_id;
        $sellerProduct->image = $product->image;
        $sellerProduct->status = 'complete';
        $sellerProduct->image = $product->image;
        $sellerProduct->user_id = Auth::user()->id;
        $sellerProduct->description = $product->description;
        $sellerProduct->product_id = $product->id;
        $sellerProduct->save();

        foreach ($request->price as $key => $price) {
            $productVariant = new ProductVariant();
            $productVariant->name = $request->name[$key];
            $productVariant->volume_id = $request->volume_id[$key];
            $productVariant->product_id = $request->product_id;
            $productVariant->seller_product_id = $sellerProduct->id;
            $productVariant->quantity = $request->quantity[$key];
            $productVariant->price = $request->price[$key];
            $productVariant->user_id = Auth::user()->id;

            // change this to 1 if admin activation for existing is not needed
            if ($request->images) {
                if (isset($request->images[$key])) {
                    $image = $this->saveImage($request->images[$key], null);
                    $productVariant->image = 'storage/product/' . $image;
                    $volume = Volume::find($request->volume_id[$key]);
                    $volume->image = 'storage/product/' . $image;
                    $volume->update();
                }
            }
            $productVariant->status = 0;
            $productVariant->save();
            $productVariant->sku = $request->sku[$key] . $productVariant->id;
            $productVariant->update();
        }

        return redirect()->route('seller-product.index')->with('success', 'New Product Added Successfully');
    }

    public function store(Request $request)
    {
        // validation
        // create seller product variants
        $sellerProduct = SellerProduct::find($request->seller_product_id);
        $sellerProduct->description = $request->description;
        if ($request->hasFile('image')) {
            $image = $this->saveImage($request->image, null);
            $sellerProduct->image = 'storage/product/' . $image;
        }
        $sellerProduct->update();

        foreach ($request->price as $key => $price) {
            $sellerProductVariant = new SellerProductVariant();
            $sellerProductVariant->name = $request->name[$key];
            $sellerProductVariant->seller_volume_id = $request->seller_volume_id[$key];
            $sellerProductVariant->seller_product_id = $request->seller_product_id;
            $sellerProductVariant->quantity = $request->quantity[$key];
            $sellerProductVariant->price = $request->price[$key];
            $sellerProductVariant->user_id = Auth::user()->id;
            $sellerProductVariant->save();

            $sellerProductVariant->sku = $request->sku[$key] . $sellerProductVariant->id;
            if ($request->images) {
                if (isset($request->images[$key])) {
                    $image = $this->saveImage($request->images[$key], null);
                    $sellerProductVariant->image = 'storage/product/' . $image;
                    $sellerVolume = SellerVolume::find($request->seller_volume_id[$key]);
                    $sellerVolume->image = 'storage/product/' . $image;
                    $sellerVolume->update();
                }
            }
            $sellerProductVariant->update();
        }

        $sellerProduct = SellerProduct::find($request->seller_product_id);
        $sellerProduct->status = 'Complete';
        $sellerProduct->update();


        /*if ($request->hasFile('cover_image')) {
            $coverImage = $this->saveImage($request->cover_image, null);
            $product->cover_image = 'storage/product/' . $coverImage;
        }

        $product->save();

        if ($request->image) {
            foreach ($request->image as $image) {
                $this->saveImage($image, $product->id);
            }
        }*/

        return redirect()->route('seller-product.index')->with('success', 'New Product Added Successfully');
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->with('images')->first();

        return view($this->view . 'show')->with('product', $product);
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->with('category', 'images')->first();
//        dd($product->category->parent->parent);
        $categories = Category::where('real_depth', 0)->with('parent')->get();
        $subCategories1 = Category::where('real_depth', 1)->with('parent')->get();
        $subCategories2 = Category::where('real_depth', 2)->with('parent')->get();
        $categoryDepth = $product->category->real_depth;

        return view($this->view . 'edit', compact('product', 'categories', 'subCategories1', 'subCategories2', 'categoryDepth'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->brand = $request->input('brand');
        $product->code = $request->input('code');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->description = $request->input('description');
        $product->available = $request->input('available');
        $product->discount = $request->input('discount');
        $product->featured = $request->has('featured');
        $product->volume = $request->volume;

        if ($request->subcategory_2 && $request->subcategory_2 != 0) {
            $product->category_id = $request->subcategory_2;
        } elseif ($request->subcategory_1 && $request->subcategory_1 != 0) {
            $product->category_id = $request->subcategory_1;
        } else {
            $product->category_id = $request->category;
        }

        if ($request->hasFile('cover_image')) {
            $coverImage = $this->saveImage($request->cover_image, null);
            $product->cover_image = 'storage/product/' . $coverImage;
        }

        if ($request->image) {
            foreach ($request->image as $image) {
                $this->saveImage($image, $product->id);
            }
        }

        $product->update();

        return redirect('admin/products')->with('success', ' Product Information updated Successfully');
    }

    public function destroy($id, Request $request)
    {
        $request->validate([
            'type' => 'required'
        ]);

        if ($request->type == 'productvariant') {
            $productVariant = ProductVariant::find($id);
            $sellerProductVariant = SellerProductVariant::where('product_variant_id', $productVariant->id)->first();
            $sellerProduct = SellerProduct::find($productVariant->seller_product_id);
            if ($sellerProductVariant)
                $sellerProductVariant->delete();
            $productVariant->delete();

            if ($sellerProduct) {
                if (!count($sellerProduct->productVariants) && !count($sellerProduct->sellerProductVariants)) {
                    $sellerProduct->delete();
                }
            }
        }

        if ($request->type == 'sellerproductvariant') {
            $sellerProductVariant = SellerProductVariant::find($id);
            $sellerProduct = SellerProduct::find($sellerProductVariant->seller_product_id);
            $sellerVolume = SellerVolume::find($sellerProductVariant->seller_volume_id)->first();
            $sellerVolume->delete();
            $sellerProductVariant->delete();

            if (!count($sellerProduct->productVariants) && !count($sellerProduct->sellerProductVariants)) {
                $sellerProduct->delete();
            }
        }

        return redirect()->back()->with('success', 'Product deleted successfully');
    }

    public function selectProductType()
    {
        $products = Product::all();
        $sellerProductIds = SellerProduct::where('user_id', Auth::user()->id)->pluck('product_id')->toArray();

        return view($this->view . 'product-type', compact('products', 'sellerProductIds'));
    }

    public function viewSellerProductVariant($id)
    {
        $sellerProductVariant = SellerProductVariant::findOrFail($id);
        $this->authorize('isSeller', $sellerProductVariant);
        if ($sellerProductVariant->status)
            return redirect()->back();

        return view($this->view . 'show-seller-product-variant', compact('sellerProductVariant'));
    }

    public function viewProductVariant($id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $this->authorize('isSeller', $productVariant);

        return view($this->view . 'show-product-variant', compact('productVariant'));
    }

    public function editSellerProductVariant($id)
    {
        $sellerProductVariant = SellerProductVariant::findOrFail($id);
        $this->authorize('isSeller', $sellerProductVariant);
        if ($sellerProductVariant->status)
            return redirect()->back()->with('fail', 'This product cannot be edited');

        return view($this->view . 'edit-seller-product-variant', compact('sellerProductVariant'));
    }

    public function editProductVariant($id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $this->authorize('isSeller', $productVariant);

        return view($this->view . 'edit-product-variant', compact('productVariant'));
    }

    public function updateSellerProductVariant(ProductVariantEditFormRequest $request, $id)
    {
        $sellerProductVariant = SellerProductVariant::findOrFail($id);
        $this->authorize('isSeller', $sellerProductVariant);
        $oldSellerVolume = $sellerProductVariant->sellerVolume;
        $sellerProductId = $sellerProductVariant->seller_product_id;
        $sellerProductVariant->name = $request->name;
        if ($sellerProductVariant->status)
            return redirect()->back()->with('fail', 'This product cannot be edited');
        $existingSellerVolume = SellerVolume::where('quantity', $request->quantity)->where('volume', $request->volume)->where('seller_product_id', $sellerProductId)->first();

        if ($existingSellerVolume) {
            if ($existingSellerVolume->id != $oldSellerVolume->id) {
                // return back if existing volume already exists
                return redirect()->back()->with('fail', 'A product with this Quantity x Volume already exists. Please enter a different Quantity x Volume');
            }
        } else {
            // create new seller volume
            $sellerVolume = new SellerVolume();
            $sellerVolume->quantity = $request->quantity;
            $sellerVolume->volume = $request->volume;
            $sellerVolume->seller_product_id = $sellerProductId;
            $sellerVolume->image = $oldSellerVolume->image;
            $sellerVolume->save();
            // update seller product variant
            if ($sellerProductVariant->name == $request->name) {
                $sellerProductVariant->name = $sellerProductVariant->sellerProduct->name . ' ' . $sellerVolume->quantity . 'x' . $sellerVolume->volume . 'ml';
            }
            $sellerProductVariant->seller_volume_id = $sellerVolume->id;
            $sellerProductVariant->update();
            // delete old seller volume
            $oldSellerVolume->delete();
        }

        $sellerProductVariant->price = $request->price;
        $sellerProductVariant->available = $request->available;
        $sellerProductVariant->update();

        return redirect()->back()->with('success', 'Product successfully updated');
    }

    public function updateProductVariant(ProductVariantEditFormRequest $request, $id)
    {
        $productVariant = ProductVariant::findOrFail($id);
        $this->authorize('isSeller', $productVariant);
        $oldVolume = $productVariant->parentVolume;
        $productId = $productVariant->product_id;
        $productVariant->name = $request->name;
        $existingVolume = Volume::where('quantity', $request->quantity)->where('volume', $request->volume)->where('product_id', $productId)->first();
        if ($existingVolume) {
            if ($existingVolume->id != $oldVolume->id) {
                $productVariantsIds = ProductVariant::where('user_id', $productVariant->user_id)->where('product_id', $productId)->pluck('volume_id')->toArray();
                if (in_array($existingVolume->id, $productVariantsIds)) {
                    // return back if existing volume already exists
                    return redirect()->back()->with('fail', 'A product with this Quantity x Volume already exists. Please enter a different Quantity x Volume');
                } else {
                    $productVariant->volume_id = $existingVolume->id;
                }
            }
        } else {
            // create new volume
            $volume = new Volume();
            $volume->quantity = $request->quantity;
            $volume->volume = $request->volume;
            $volume->image = $oldVolume->image;
            $volume->product_id = $productId;
            $volume->save();
            // update product variant
            if ($productVariant->name == $request->name) {
                $productVariant->name = $productVariant->product->name . ' ' . $volume->quantity . 'x' . $volume->volume . 'ml';
            }
            $productVariant->volume_id = $volume->id;
            $productVariant->update();
            // delete old volume
//            $oldVolume->delete();
        }


        $productVariant->price = $request->price;
        $productVariant->available = $request->available;
        $productVariant->update();

        return redirect()->back()->with('success', 'Product successfully updated');
    }

    public function bulkDelete(Request $request) {
        $request->validate([
            'select' => 'required'
        ]);

        foreach ($request->select as $variant) {
            $array = explode("-", $variant, 2);
            $type = $array[0];
            $id = $array[1];
            if ($type == 'productvariant') {
                $productVariant = ProductVariant::find($id);
                $sellerProductVariant = SellerProductVariant::where('product_variant_id', $productVariant->id)->first();
                $sellerProduct = SellerProduct::find($productVariant->seller_product_id);
                if ($sellerProductVariant)
                    $sellerProductVariant->delete();
                $productVariant->delete();

                if ($sellerProduct) {
                    if (!count($sellerProduct->productVariants) && !count($sellerProduct->sellerProductVariants)) {
                        $sellerProduct->delete();
                    }
                }
            }

            if ($type == 'sellerproductvariant') {
                $sellerProductVariant = SellerProductVariant::find($id);
                $sellerProduct = SellerProduct::find($sellerProductVariant->seller_product_id);
                $sellerVolume = SellerVolume::find($sellerProductVariant->seller_volume_id)->first();
                $sellerVolume->delete();
                $sellerProductVariant->delete();

                if (!count($sellerProduct->productVariants) && !count($sellerProduct->sellerProductVariants)) {
                    $sellerProduct->delete();
                }
            }
        }

        return redirect()->back()->with('success', 'Products successfully deleted');
    }
}
