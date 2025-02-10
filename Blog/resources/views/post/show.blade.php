<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} | Flog</title>
    <link href="{{ asset('../style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('../icon3.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.0/dist/echo.iife.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/8.0.0/pusher.min.js"></script>
    @vite('resources/js/app.js')
    <style>
        .login-btn { font-weight: 500; }
        .login-btn:hover { color: orange; font-weight: 500; }
        .signup-btn, .signup-btn:hover { color: #43dba9; border: 2px solid #62f8c6; font-weight: 500; }
        .search-btn { background-color: #43dba9; color: white; border: none; padding: 0.5rem 1rem; cursor: pointer; }
        .search-btn:hover { background-color: #43dba9; color: white; }
        .dash { background-color: #28D49B; padding: 10px; color: #fff !important; font-weight: 400; }
        @media (max-width: 767.98px) {.dash {
                padding: 0.5rem 0.8rem; /* Smaller padding on smaller screens */
                font-size: 0.875rem; /* Adjust font size if needed */ }}
        .like-btn {background: none;border: none;color: red;font-size: 1.5rem;cursor: pointer;margin-bottom: 15px;}
        .like-count {font-size: 1rem;margin-bottom: 15px;}
        .delete-btn {background: none;border: none;color: #2ac28f;font-size: 1.2rem;cursor: pointer;}
        .edit-btn {background: none;border: none;color: #007bff;font-size: 1.2rem;cursor: pointer;}
        .edit-form {display: none;}
        .card-container {display: flex;flex-wrap: wrap;}
        .card {display: flex;flex-direction: column;justify-content: space-between;}
        .card-body {flex: 1 1 auto;}
        .card-container .col-lg-4 {flex: 0 0 33.33333%;max-width: 33.33333%;}

        /* 2 columns for medium screens (tablets) */
        @media (max-width: 991px) {.card-container .col-md-4 {
                flex: 0 0 50%;
                max-width: 50%;}}

        /* 1 column for small screens (phones) */
        @media (max-width: 767px) {.card-container .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;}}

        /* like button styling */ 
        .empty-heart {color: red;font-size: 1.5rem;}

        .filled-heart {color: red;font-size: 1.5rem;}

        /* tiny mce content responsiveness */

        /* for images */
        img { max-width: 100%;height: auto;}

        /* for tables */
        table {width: 100%;max-width: 100%;overflow-x: auto;display: block;}

        /* for videos */
        .embed-responsive {position: relative;display: block;width: 100%;padding: 0;overflow: hidden;padding-bottom: 56.25%;}

        .embed-responsive iframe,
        .embed-responsive object,
        .embed-responsive embed {position: absolute;top: 0;left: 0;width: 100%;height: 100%;}

        .lead {font-size: 1.125rem; /* or any other relative unit */}
        .hidden { display: none; }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header>
<div id="user-data" data-user-id="{{ Auth::id() }}"></div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mx-3 p-2 pb-2">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('../flog-logo.png') }}" class="d-inline-block align-top" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    @auth
                    <a style="background-color:#8b78f9;" class="nav-link fw-500 rounded-2 search-btn dash px-3 mt-0 me-2  fs-6" href="{{ url('/dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    @else
                    <a class="nav-link rounded-1 btn login-btn mx-4 px-3 py-2" href="{{ route('login') }}">Log in</a>
                </li>
                <li class="nav-item">
                    @if (Route::has('register'))
                    <a class="nav-link rounded-1 btn mx-4 px-3 py-2 signup-btn" href="{{ route('register') }}">Sign up</a>
                    @endif
                    @endauth
                </li>
            </ul>
        </div>
    </nav>
</header>
<main class="container my-4 col-lg-8">
    @include('layouts.flash-messages')
<div class="bg-white p-4 rounded shadow-sm mt-3 me-4">
        <h1 class="display-4 mb-4 fw-600 h1">{{ $post->title }}</h1>
        <img src="{{ Storage::url($post->image) }}" style="width: 100%; height: 300px; object-fit: cover;" alt="Post image" class="img-fluid mb-4">
        <div class="lead col-md-11">{!! $post->body !!}</div>
        <p class="text-muted">
            <img src="{{ Storage::url($post->user->avatar) }}" alt="{{ $post->user->name }}" class="rounded-circle mx-2 border-2 border-black" style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
            <span>Written By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</span>
        </p>
        <button class="btn mt-2 fw-600" id="more-about-btn" style="color:#F60195">More about {{ $post->user->name }}</button>
        <div id="article-owner-details" class="hidden mt-3 row col-md-9 col-sm-12">
            <p><strong>Occupation:</strong> {{ $post->user->occupation }}</p>
            <p><strong>Bio:</strong> {{ $post->user->bio }}</p>
        </div>
        <form method="POST" action="{{ route('posts.like', $post) }}" id="like-form">
            @csrf
            <button type="button" class="like-btn" onclick="toggleLike('{{ $post->id }}')">
                <i class="far fa-heart empty-heart {{ $post->isLikedByUser() ? 'd-none' : '' }}"></i>
                <i class="fas fa-heart filled-heart {{ $post->isLikedByUser() ? '' : 'd-none' }}"></i>
            </button>
            <span class="like-count me-1">{{ $post->likes_count }} {{ $post->likes_count > 1 ? 'Likes' : 'Like' }}</span>
        </form>
        <a href="{{ url('/') }}" class="btn search-btn rounded-3 p-2" style="background-color:#2ac28f;">Back to Posts</a>
    </div>
    <!-- Reviews Section -->
    <div class="bg-white p-4 rounded shadow-sm mt-3 me-4">
        <h2 class="h4 mb-4">Reviews ({{ $post->reviews->count() }})</h2>
        @foreach ($post->reviews as $review)
            <div class="border-bottom mb-3 pb-3">
                <p><strong>{{ $review->user->name }}</strong> - {{ $review->created_at->format('M d, Y') }}</p>
                <p class="review-content">{{ $review->content }}</p>
                
                <!-- Edit and Delete Buttons for Review -->
                @if (Auth::check() && Auth::user()->id == $review->user_id)
                <button class="edit-btn mb-3" onclick="toggleEditForm('review', '{{ $review->id }}')"><i class="fas fa-edit"></i><span class="mx-1 text-dark text-muted">Edit review</span></button>
                <form method="POST" action="{{ route('reviews.destroy', $review) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn mb-3" onclick="return confirm('Are you sure you want to delete this review?');"><i class="fas fa-trash-alt text-danger"></i><span class="mx-1 text-dark text-muted">Delete review</span></button>
                </form>
                @endif

                <!-- Edit Review Form -->
                <form method="POST" action="{{ route('reviews.update', $review) }}" class="edit-form" id="edit-review-form-{{ $review->id }}">
                    @csrf
                    @method('PUT')
                    <textarea name="content" rows="2" class="form-control mb-2">{{ $review->content }}</textarea>
                    <button type="submit" class="btn search-btn rounded-4 p-2 px-3 me-2 mb-2" style="background-color:#34ACD6;">Update Review</button>
                    <button type="button" class="btn btn-secondary rounded-4 p-2 me-2 mb-2" onclick="toggleEditForm('review', '{{ $review->id }}')">Cancel</button>
                </form>

                <!-- Replies Section -->
                <div class="ml-4">
                <h3 class="h5 mb-2">Replies ({{ $review->replies->count() }})</h3>
                    @foreach ($review->replies as $reply)
                        <div class="border-bottom mb-2 pb-2">
                            <p><strong>{{ $reply->user->name }}</strong> - {{ $reply->created_at->format('M d, Y') }}</p>
                            <p class="reply-content">{{ $reply->content }}</p>
                            
                            <!-- Edit and Delete Buttons for Reply -->
                            @if (Auth::check() && Auth::user()->id == $reply->user_id)
                            <button class="edit-btn mb-2" onclick="toggleEditForm('reply', '{{ $reply->id }}')"><i class="fas fa-edit"></i><span class="mx-1 text-dark text-muted">Edit reply</span></button>
                            <form method="POST" action="{{ route('replies.destroy', $reply) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn mb-2" onclick="return confirm('Are you sure you want to delete this reply?');"><i class="fas fa-trash-alt text-danger"></i><span class="mx-1 text-dark text-muted">Delete reply</span></button>
                            </form>
                            @endif

                            <!-- Edit Reply Form -->
                            <form method="POST" action="{{ route('replies.update', $reply) }}" class="edit-form" id="edit-reply-form-{{ $reply->id }}">
                                @csrf
                                @method('PUT')
                                <textarea name="content" rows="2" class="form-control mb-2">{{ $reply->content }}</textarea>
                                <button type="submit" class="btn search-btn  rounded-4 p-2" style="background-color:#34ACD6;">Update Reply</button>
                                <button type="button" class="btn btn-secondary  rounded-4 p-2" onclick="toggleEditForm('reply', '{{ $reply->id }}')">Cancel</button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <!-- Add Reply Form -->
                @auth
                <form method="POST" action="{{ route('replies.store', ['review' => $review->id]) }}" class="mt-2">
                    @csrf
                    <textarea name="content" rows="2" class="form-control mb-2" placeholder="Add your reply..."></textarea>
                    <button type="submit" class="btn search-btn rounded-4 p-2" style="background-color:#88AB2B;">Add Reply</button>
                </form>

                @endauth
            </div>
        @endforeach

        <!-- Add Review Form -->
        @auth
            <form method="POST" action="{{ route('reviews.store', $post->id) }}">
                @csrf
                <textarea name="content" rows="3" class="form-control mb-2" placeholder="Add your review..."></textarea>
                <button type="submit" class="btn search-btn p-2 rounded-4" style="background-color:#F60195;">Add Review</button>
            </form>
        @endauth
    </div>
</main>
<footer class="bg-white text-center py-3 mt-4 border-top">
    <div class="container">
        <p class="mb-0"> &copy; 2024 Flog Blog. All rights reserved.</p>
    </div>
</footer>
<script type="module" src="{{ mix('resources/js/main.js') }}"></script>

<script>
    function toggleEditForm(type, id) {
        const formId = `edit-${type}-form-${id}`;
        const form = document.getElementById(formId);
        if (form) {
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    }

    document.getElementById('more-about-btn').addEventListener('click', function() {
        const details = document.getElementById('article-owner-details');
        if (details.classList.contains('hidden')) {
            details.classList.remove('hidden');
            this.textContent = 'Less about {{ $post->user->name }}';
        } else {
            details.classList.add('hidden');
            this.textContent = 'More about {{ $post->user->name }}';
        }
    });


 function toggleLike(postId) {
    $.post(`/posts/${postId}/like`, {_token: $('input[name=_token]').val()}, function(response) {
        // Update the like count and the heart icon
        $('.like-count').text(response.likes_count + (response.likes_count > 1 ? ' Likes' : ' Like'));
        if (response.is_liked) {
            $('.empty-heart').addClass('d-none');
            $('.filled-heart').removeClass('d-none');
        } else {
            $('.empty-heart').removeClass('d-none');
            $('.filled-heart').addClass('d-none');
        }
    }).fail(function(error) {
        console.error('Error:', error);
        // Optionally show an error message to the user
    });
}

</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script type="module" src="{{ mix('resources/js/main.js') }}"></script>
</body>
</html>
