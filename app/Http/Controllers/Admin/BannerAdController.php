<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\BannerAd;
use App\Models\Content;
use Illuminate\Http\Request;

class BannerAdController extends Controller
{
    private $view = 'admin.banner-ad.';

    public function index()
    {
        $bannerAds = BannerAd::all();

        return view($this->view . 'index', compact('bannerAds'));
    }

    public function create()
    {
        return view($this->view . 'create');
    }

    public function edit($id)
    {
        $bannerAd = BannerAd::findOrFail($id);

        return view($this->view . 'edit', compact('bannerAd'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'heading1' => 'required',
            'code' => 'required|unique:banner_ads,code',
            'status' => 'required',
            'image' => 'required|max:2000'
        ]);

        $data = $request->expiry_date;

        if (!$request->discount && !$request->offer) {
            return redirect()->back()->with('fail', 'Please enter a discount or an offer')->withInput($request->input());
        }

        if (!$request->discount) {
            $request['discount'] = 0;
            $request['type'] = 'offer';
        } else {
            $request['type'] = 'discount';
        }

        if ($request->image) {
            $image = 'storage/banner/' . $this->saveImage($request->image);
        }

        if ($request->status) {
            $activeBanner = BannerAd::where('status', true)->first();
            if ($activeBanner) {
                $activeBanner->status = false;
                $activeBanner->update();
            }
        }

        BannerAd::create($request->except(['image']) + [
                'image' => $image
            ]);

        return redirect()->route('banner-ad.index')->with('success', 'Banner successfully created');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'heading1' => 'required',
            'code' => 'required|unique:banner_ads,code,' . $id,
            'status' => 'required',
            'image' => 'max:2000,mimes:jpg,jpeg,png'
        ]);

        if (!$request->discount && !$request->offer) {
            return redirect()->back()->with('fail', 'Please enter a discount or an offer')->withInput($request->input());
        }

        if (!$request->discount) {
            $request['discount'] = 0;
            $request['type'] = 'offer';
        } else {
            $request['type'] = 'discount';
        }

        $bannerAd = BannerAd::findOrFail($id);
        $imageArray = [];

        if ($request->status) {
            $activeBanner = BannerAd::where('id', '!=', $bannerAd->id)->where('status', true)->first();
            if ($activeBanner) {
                $activeBanner->status = false;
                $activeBanner->update();
            }
        }


        if ($request->image) {
            $imageArray['image'] = 'storage/banner/' . $this->saveImage($request->image, null);
        }

        $bannerAd->update($request->except(['image']) + $imageArray);

        return redirect()->back()->with('success', 'BannerAd successfully updated');
    }

    public function saveImage($inputImage)
    {
        $fileName = $inputImage->getClientOriginalName();
        $imageName = time() . '_' . $fileName;
        $inputImage->storeAs('public/banner/', $imageName);

        return $imageName;
    }

    public function show($id)
    {
        $bannerAd = BannerAd::findOrFail($id);

        return view($this->view . 'show', compact('bannerAd'));
    }
}
