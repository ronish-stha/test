<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    private $view = 'admin.banner.';

    public function index()
    {
        $promotions = Banner::whereIn('id', [1, 2, 3])->get();
        $banners = Banner::whereNotIn('id', [1, 2, 3])->orderBy('created_at', 'desc')->get();

        return view($this->view . 'index', compact('banners', 'promotions'));
    }

    public function create()
    {
        return view($this->view . 'create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|max:2000',
            'type' => 'required'
        ]);

        $banner = new Banner();
        $banner->type = $request->type;
        $banner->title = $request->title;
        $banner->caption = $request->caption;
        $banner->image = $this->saveImage($request->image);
        $banner->save();

        return redirect()->route('banner.index')->with('success', 'Banner successfully created');
    }

    public function saveImage($inputImage)
    {
        $fileName = $inputImage->getClientOriginalName();
        $imageName = time() . '_' . $fileName;
        $inputImage->storeAs('public/banner/', $imageName);

        return $imageName;
    }

    public function show(Banner $banner)
    {
        return view($this->view . 'show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view($this->view . 'edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        if ($banner->id != 1 && $banner->id != 2 && $banner->id != 3) {
            $request->validate([
                'image' => 'max:2000',
                'type' => 'required',
            ]);
        }

        $banner->type = $request->type;
        $banner->title = $request->title;
        $banner->caption = $request->caption;
        if ($request->image) {
            $banner->image = $this->saveImage($request->image);
        }

        $banner->update();

        return redirect()->route('banner.index')->with('success', 'Banner successfully updated');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();

        return redirect()->back()->with('success', 'Banner successfully deleted');
    }
}
