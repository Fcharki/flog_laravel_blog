<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $category }} | Flog</title>
    <link href="{{ asset('../style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('../icon3.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-btn { font-weight: 500; }
        .login-btn:hover { color: orange; font-weight: 500; }
        .signup-btn, .signup-btn:hover { color: #43dba9; border: 2px solid #62f8c6; font-weight: 500; }
        .search-btn, .read-btn { background-color: #43dba9; color: white; border: none; padding: 0.5rem 1rem; cursor: pointer; }
        .search-btn:hover, .read-btn:hover { background-color: #43dba9; color: white; }
        .dash { background-color: #28D49B; padding: 10px; color: #fff !important; font-weight: 400; }
        @media (max-width: 767.98px) {
            .dash {
                padding: 0.5rem 0.8rem; /* Smaller padding on smaller screens */
                font-size: 0.875rem; /* Adjust font size if needed */
            }
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            /* gap: 1rem; */
        }
        .card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-body {
            flex: 1 1 auto;
        }


        /* Default to 3 columns for large screens (desktops) */
        .card-container .col-lg-4 {
            flex: 0 0 33.33333%;
            max-width: 33.33333%;
        }

        /* 2 columns for medium screens (tablets) */
        @media (max-width: 991px) {
            .card-container .col-md-4 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        /* 1 column for small screens (phones) */
        @media (max-width: 767px) {
            .card-container .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mx-3  p-4 pb-0">
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
                    <a style="background-color:#8b78f9;" class="nav-link fw-500  px-3 mt-2 mx-4  rounded-2 search-btn dash fs-6" href="{{ url('/dashboard') }}">Dashboard</a>
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
<main class="container my-5">
    <h2 class="mb-4">Posts in "{{ $category }}"</h2>
    <div class="row card-container">
        @forelse($posts as $post)
            <div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-4">
                <div class="card">
                    @if($post->image)
                        <img src="{{ Storage::url($post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                    @else
                        <img src="/path/to/default/image.jpg" class="card-img-top" alt="Default Image">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{!! $post->excerpt !!}</p>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn read-btn  rounded-3">Read More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No posts available in this category yet.</p>
            </div>
        @endforelse
    </div>
</main>
<footer class="bg-white text-center py-3 mt-4 border-top">
    <div class="container">
        <p class="mb-0"> &copy; 2024 Flog Blog. All rights reserved.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>
