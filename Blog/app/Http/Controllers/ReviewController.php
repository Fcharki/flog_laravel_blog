<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Review;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Events\ReviewCreated;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $review = $post->reviews()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
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

        $request->validate([
            'content' => 'required|string',
        ]);

        $review->update([
            'content' => $request->input('content'),
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

