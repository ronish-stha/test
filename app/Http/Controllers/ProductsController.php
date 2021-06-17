<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('real_depth', 0)->get();

        return view('admin.products.create', compact('categories'));
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'thumbnail' => 'max:2000',
            'image' => 'max:4',
            'image.*' => 'max:2000'
        ]);

        //create product
        $product = new Product();
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->code = $request->code;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->available = !$request->available ? 'yes' : $request->available;
        $product->featured = $request->has('featured');
        $product->discount = $request->discount;
        $product->volume = $request->volume;

        if ($request->set_color && $request->set_color == 'yes') {
            if (!$request->color) {
                return redirect()->back()->with('fail', 'Please select colors');
            } else {
                $product->color = json_encode($request->color);
            }
        }

        if ($request->set_size && $request->set_size == 'yes') {
            if (!$request->size) {
                return redirect()->back()->with('fail', 'Please select sizes');
            } else {
                $product->size = json_encode($request->size);
            }
        }

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

        $product->save();

        if ($request->image) {
            foreach ($request->image as $image) {
                $this->saveImage($image, $product->id);
            }
        }

        return redirect('admin/products')->with('success', 'New Product Added Successfully');
    }

    public function show($id)
    {
        $product = Product::where('id', $id)->with('images')->first();

        return view('admin.products.show')->with('product', $product);
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->with('category', 'images')->first();
//        dd($product->category->parent->parent);
        $categories = Category::where('real_depth', 0)->with('parent')->get();
        $subCategories1 = Category::where('real_depth', 1)->with('parent')->get();
        $subCategories2 = Category::where('real_depth', 2)->with('parent')->get();
        $categoryDepth = $product->category->real_depth;

        return view('admin.products.edit', compact('product', 'categories', 'subCategories1', 'subCategories2', 'categoryDepth'));
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


    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect('admin/products')->with('success', 'Product deleted successfully');
    }

}
