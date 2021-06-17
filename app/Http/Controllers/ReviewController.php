<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    private $view = 'admin.review.';

    public function index()
    {
        $reviews = Review::orderBy('created_at', 'desc')->get();

        return view($this->view . 'index', compact('reviews'));
    }

    public function changeStatus($id)
    {
        $review = Review::find($id);

        if ($review->status == 'approved')
            $review->status = 'disapproved';
        else
            $review->status = 'approved';

        $review->update();

        return redirect()->back()->with('success', 'Status successfully changed');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required',
            'review' => 'required'
        ]);

        $review = new Review();
        $review->user_id = Auth::user()->id;
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->description = $request->review;
        $review->status = 'approved';
        $review->save();

        return redirect()->back()->with('success', 'Review successfully made');
    }

    public function show(Review $review)
    {
        return view($this->view . 'show', compact('review'));
    }

    public function edit(Review $review)
    {
        //
    }

    public function update(Request $request, Review $review)
    {
        //
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->back()->with('success', 'Review successfully deleted');
    }
}
