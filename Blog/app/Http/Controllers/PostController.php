<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Notifications\PostLiked;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Illuminate\Support\Facades\Log;


class PostController extends Controller
{
    use AuthorizesRequests;

       /**
 * Display a listing of the user's posts.
 *
 * @return \Illuminate\Contracts\View\View
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
 *
 * @return array
 */
        private function getCommonHomePageData()
        {
            $recentPosts = Post::latest()->take(6)->get();
        
            // Fetch all categories
            $categories = DB::table('categories')->select('id', 'category_name as name')->get();
        
            // Split categories into visible and hidden
            $visibleCategories = $categories->take(10);
            $hiddenCategories = $categories->slice(10);
        
            return compact('recentPosts', 'visibleCategories', 'hiddenCategories');
        }
        

        public function getHomePagePosts()
        {
            $commonData = $this->getCommonHomePageData();
            return view('home', $commonData);
        }

        public function search(Request $request)
        {
            $query = $request->input('query');
            $posts = Post::where('title', 'like', '%' . $query . '%')
                        ->orWhere('body', 'like', '%' . $query . '%')
                        ->get();

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
            $post = Post::findOrFail($id);
            $relatedPosts = Post::where('user_id', $post->user_id)
                                ->where('id', '!=', $post->id)
                                ->latest()
                                ->take(6) // Fetch the latest 6 posts
                                ->get();

            return view('post.show', compact('post', 'relatedPosts'));
        }


        public function getPostsByCategory($categoryId)
        {
            // Fetch the category name using inner join
            $categoryName = DB::table('posts')
                ->join('categories', 'posts.category_id', '=', 'categories.id')
                ->where('posts.category_id', $categoryId)
                ->select('categories.category_name')
                ->first();
        
            if (!$categoryName) {
                return redirect()->route('home')->with('error', 'Category not found.');
            }
        
            // Fetch posts associated with the category
            $posts = Post::where('category_id', $categoryId)->get();
        
            // Check if no posts were found for the category
            if ($posts->isEmpty()) {
                return redirect()->route('home')->with('error', 'No posts found for this category.');
            }
        
            // Pass data to the view
            return view('post.category', [
                'category' => $categoryName->category_name,
                'posts' => $posts,
                'categoryId' => $categoryId,
            ]);
        }        


        /**
         * Store a newly created post in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * 
         */
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
        
            return redirect()->route("dashboard")->with('success', 'Post added successfully.');
        }
        


    /**
     * Show the form for editing the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
        public function edit($id)
        {
            $post = Post::findOrFail($id);
            $categories = Category::all(); 
            return view('post.edit', compact('post', 'categories'));
        }

        public function update(Request $request, Post $post)
{
    $this->authorize('update', $post);

    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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

    return redirect()->route("dashboard")->with('success', 'Post updated successfully.');
}

                

        /**
         * Remove the specified post from storage.
         *
         * @param  \App\Models\Post  $post
         * 
         */
        public function destroy(Post $post)
        {
            $this->authorize('delete', $post);

            try {
                $post->delete();
                // Return success as JSON response for AJAX request
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                // Return error as JSON response for AJAX request
                return response()->json(['success' => false, 'message' => 'Failed to delete post: ' . $e->getMessage()]);
            }
        }


        public function like(Request $request, Post $post)
        {
            $user = Auth::user();
            $like = $post->likes()->where('user_id', $user->id);
        
            if ($like->exists()) {
                // User has already liked the post; unlike it
                $like->delete();
                $liked = false;
            } else {
                // User has not liked the post; like it
                $post->likes()->create(['user_id' => $user->id]);
                $liked = true;
                
                // Trigger notification
                $post->user->notify(new PostLiked($user, $post));
                
                // Broadcast event
                event(new \App\Events\PostLiked($user, $post));
            }
        
            // Recalculate the likes count after like/unlike
            $likeCount = $post->likes()->count();
        
            return response()->json([
                'likes_count' => $likeCount,
                'is_liked' => $liked
            ]);
        }
             
    public function aboutUs ()
    {
        return view ('about');
    }

    public function help ()
    {
        return view ('help');
    }
    
}