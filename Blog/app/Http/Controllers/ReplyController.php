<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use App\Events\ReplyCreated;
use App\Models\Review;
use App\Models\Reply;

class ReplyController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request, Review $review)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $reply = $review->replies()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
    
        // Fire the event that will trigger the notification
        event(new ReplyCreated($reply));
    
        return redirect()->back()->with('status', 'Reply added!');
    }
    
    


    public function edit(Reply $reply)
    {
        $this->authorize('update', $reply);

        return view('replies.edit', compact('reply'));
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);

        $request->validate([
            'content' => 'required|string',
        ]);

        $reply->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('status', 'Reply updated!');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
    
        $reply->delete();
    
        return redirect()->back()->with('status', 'Reply deleted!');
    }
}

