<?php

namespace App\Http\Controllers;

use App\Events\ReviewCreated;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $review = $post->reviews()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        // Fire the event that will trigger the notification
        event(new ReviewCreated($review));

        return redirect()->back()->with('success', 'Review added!');
    }

    public function edit(Review $review)
    {
        $this->authorize('update', $review);

        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $validated = $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $review->update([
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Review updated!');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();

        return redirect()->back()->with('success', 'Review deleted!');
    }
}
