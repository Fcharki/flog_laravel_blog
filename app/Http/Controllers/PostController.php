<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Notifications\PostLiked;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the user's posts.
     *
     * @return View
     */
    public function dashboard()
    {
        $user = Auth::user();
        $posts = $user->posts()->latest()->get(); // Get user's posts
        $numberOfPosts = $posts->count(); // Get number of posts

        return view('dashboard', ['posts' => $posts, 'numberOfPosts' => $numberOfPosts]);
    }

    /**
     * Get common data for the home page.
     */
    private function getCommonHomePageData(): array
    {
        return [
            'recentPosts' => Post::query()->with('user')->latest()->paginate(9),
        ];
    }

    public function getHomePagePosts()
    {
        $commonData = $this->getCommonHomePageData();

        return view('home', $commonData);
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'query' => 'nullable|string|max:100',
        ]);

        $query = trim($validated['query'] ?? '');
        $escapedQuery = addcslashes($query, '%_\\');

        $posts = Post::query()
            ->with('user')
            ->where(function ($builder) use ($escapedQuery) {
                $builder->where('title', 'like', "%{$escapedQuery}%")
                    ->orWhere('body', 'like', "%{$escapedQuery}%");
            })
            ->latest()
            ->paginate(9)
            ->withQueryString();

        $commonData = $this->getCommonHomePageData();
        $commonData['posts'] = $posts;
        $commonData['query'] = $query;

        return view('home', $commonData);
    }

    public function create()
    {
        $categories = Category::all();

        return view('post.create', compact('categories'));
    }

    public function show($id)
    {
        $post = Post::query()
            ->with(['user', 'reviews.user', 'reviews.replies.user'])
            ->withCount('likes')
            ->withExists(['likes as is_liked_by_user' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
            ->findOrFail($id);

        $relatedPosts = Post::query()
            ->where('user_id', $post->user_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(6)
            ->get();

        return view('post.show', compact('post', 'relatedPosts'));
    }

    public function getPostsByCategory($categoryId)
    {
        $category = Category::find($categoryId);

        if (! $category) {
            return redirect()->route('home')->with('error', 'No posts found for this category.');
        }

        $posts = Post::query()
            ->where('category_id', $category->id)
            ->with('user')
            ->latest()
            ->get();

        return view('post.category', [
            'category' => $category->category_name,
            'posts' => $posts,
            'categoryId' => $category->id,
        ]);
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:200000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validatedData['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            // Store the image
            $pathToImage = $request->file('image')->store('images', 'public');

            // Optimize the image
            ImageOptimizer::optimize(storage_path("app/public/{$pathToImage}"));

            // Save the image path to the validated data
            $validatedData['image'] = $pathToImage;
        }

        // Create the post with the validated data
        Post::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Post added successfully.');
    }

    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return View|Factory
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        $categories = Category::all();

        return view('post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:200000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            // Store the new image
            $pathToImage = $request->file('image')->store('images', 'public');

            // Optimize the image
            ImageOptimizer::optimize(storage_path("app/public/{$pathToImage}"));

            // Save the image path to the validated data
            $validatedData['image'] = $pathToImage;
        } else {
            $validatedData['image'] = $post->image;
        }

        // Update the post with the validated data
        $post->update($validatedData);

        return redirect()->route('dashboard')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        try {
            $post->delete();

            // Return success as JSON response for AJAX request
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Failed to delete post', [
                'post_id' => $post->id,
                'user_id' => Auth::id(),
                'exception' => $e,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete the post. Please try again.',
            ], 500);
        }
    }

    public function like(Request $request, Post $post)
    {
        $user = $request->user();

        $like = $post->likes()->firstOrCreate(['user_id' => $user->id]);

        if ($like->wasRecentlyCreated) {
            $liked = true;

            $post->user->notify(new PostLiked($user, $post));
        } else {
            $like->delete();
            $liked = false;
        }

        return response()->json([
            'likes_count' => $post->likes()->count(),
            'is_liked' => $liked,
        ]);
    }

    public function aboutUs()
    {
        return view('about');
    }

    public function help()
    {
        return view('help');
    }
}
