<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    private $view = 'admin.content.';

    public function index()
    {
        $contents = Content::all();

        return view($this->view . 'index', compact('contents'));
    }

    public function edit($id)
    {
        $content = Content::findOrFail($id);

        return view($this->view . 'edit', compact('content'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'heading1' => 'required',
            'image1' => 'max:2000,mimes:jpg,jpeg,png'
        ]);
        $content = Content::findOrFail($id);
        if (in_array($content->id, [2, 3, 4])) {
            $request->validate([
                'content1' => 'required'
            ]);
        }
        if (in_array($content->id, [1, 2])) {
            $request->validate([
                'image2' => 'max:2000,mimes:jpg,jpeg,png'
            ]);
        }
        if ($content->id === 2) {
            $request->validate([
                'content2' => 'required',
                'content3' => 'required',
                'image3' => 'max:2000,mimes:jpg,jpeg,png'
            ]);
        }

        $imagesArray = [];

        if ($request->image1) {
            $imagesArray['image1'] = 'storage/home/' . $this->saveImage($request->image1, null);
        }

        if ($request->image2) {
            $imagesArray['image2'] = 'storage/home/' . $this->saveImage($request->image2, null);
        }

        if ($request->image3) {
            $imagesArray['image3'] = 'storage/home/' . $this->saveImage($request->image3, null);
        }

//        dd($imagesArray);
        $content->update($request->except(['image1', 'image2', 'image3']) + $imagesArray);

        return redirect()->back()->with('success', 'Content successfully updated');
    }

    public function saveImage($inputImage)
    {
        $fileName = $inputImage->getClientOriginalName();
        $imageName = time() . '_' . $fileName;
        $inputImage->storeAs('public/home/', $imageName);

        return $imageName;
    }

    public function show($id)
    {
        $content = Content::findOrFail($id);

        return view($this->view . 'show', compact('content'));
    }
}
