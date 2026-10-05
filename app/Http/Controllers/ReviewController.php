<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Store a new review or update existing one (SRS: Add/Modify Reviews & Ratings)
    public function store(Request $request)
    {
        $request->validate([
            'item_type'   => 'required|in:music,video',
            'item_id'     => 'required|integer',
            'rating'      => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        // Check if user already has a review for this item
        $existing = Review::where('user_id', Auth::id())
                          ->where('item_type', $request->item_type)
                          ->where('item_id', $request->item_id)
                          ->first();

        if ($existing) {
            // Modify existing review
            $existing->update([
                'rating'      => $request->rating,
                'review_text' => $request->review_text,
            ]);
            $message = 'Your review has been updated!';
        } else {
            // Add new review
            Review::create([
                'user_id'     => Auth::id(),
                'item_type'   => $request->item_type,
                'item_id'     => $request->item_id,
                'rating'      => $request->rating,
                'review_text' => $request->review_text,
            ]);
            $message = 'Your review has been submitted!';
        }

        $redirect = $request->item_type === 'music'
            ? route('music.show', $request->item_id)
            : route('video.show', $request->item_id);

        return redirect($redirect)->with('success', $message);
    }

    // Delete a review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized action.');
        }

        $type   = $review->item_type;
        $itemId = $review->item_id;
        $review->delete();

        $redirect = $type === 'music'
            ? route('music.show', $itemId)
            : route('video.show', $itemId);

        return redirect($redirect)->with('success', 'Review deleted.');
    }
}
