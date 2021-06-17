<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
//use Spatie\Activitylog\Models\Activity;

class CategoryController extends Controller
{
    public function index()
    {
        $mainCategories = Category::where('parent_id', null)->orderBy('created_at', 'desc')->get();
        $subCategories = Category::where('parent_id', '!=', null)->orderBy('created_at', 'DESC')->get();

        return view('admin.category.index', compact('mainCategories', 'subCategories'));
    }

    public function store(Request $request)
    {
       $request->validate([
           'title' => 'required',
           'category' => 'required'
       ]);

       $category = new Category();
       $category->title = $request->title;


      if ($request->subcategory_1 && $request->subcategory_1 != 0) {
            $category->parent_id = $request->subcategory_1;
        } else {
            $category->parent_id = $request->category;
        }

      $parentId = $category->parent_id;
      $parentCategory = Category::find($parentId);
      $category->real_depth = $parentCategory->real_depth + 1;

       $category->save();

//      $activity = Activity::all()->last();
//      dd($activity);

       return redirect()->back()->with('success', 'Category successfully added');
    }

    public function show(Category $category) {
//        dd($category->getChildren());
        return view('admin.category.show', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $category->title = $request->title;
        $category->update();

        return redirect()->back()->with('success', 'Category successfully updated');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category successfully deleted');
    }

    public function getSubCategory($id) {
        $category = Category::find($id);

        return response()->json($category->getChildren());
    }
}

/*$category = new Category();
$category->title = 'FirstCategory';
$category->save();

$newCategory = new Category([
    'title' => 'anotherChildCategory'
]);

$oldCategory = Category::find(1);

$oldCategory->addChild($newCategory);

//        $oldestCategory = Category::find(1);

dd($oldCategory->getChildren());*/
