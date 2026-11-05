<?php

namespace App\Http\Controllers;

use App\Events\ReplyCreated;
use App\Models\Reply;
use App\Models\Review;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Review $review)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $reply = $review->replies()->create([
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        // Fire the event that will trigger the notification
        event(new ReplyCreated($reply));

        return redirect()->back()->with('success', 'Reply added!');
    }

    public function edit(Reply $reply)
    {
        $this->authorize('update', $reply);

        return view('replies.edit', compact('reply'));
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);

        $validated = $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $reply->update([
            'content' => $validated['content'],
        ]);

        return redirect()->back()->with('success', 'Reply updated!');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);

        $reply->delete();

        return redirect()->back()->with('success', 'Reply deleted!');
    }
}
