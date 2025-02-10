<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flog | Blog</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&family=Pacifico&display=swap" rel="stylesheet">
    <link href="{{ asset('../style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('../icon3.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    @vite('resources/js/app.js')
    <style>
        .login-btn { font-weight: 500; }
        .login-btn:hover {color: orange;font-weight: 500;}
        .signup-btn, .signup-btn:hover {color: #43dba9; border: 2px solid #62f8c6;font-weight: 500;}
        .card-btn, .card-btn:hover { background-color: #28D49B;}
        .search-btn {background-color: #28D49B;color: white;border: none;padding: 0.5rem 1rem;cursor: pointer;}
        .search-results { margin-top: 20px;}
        .search-results .card {margin-bottom: 10px; }
        .dash{background-color: #28D49B;padding:10px;color: #fff !important;font-weight: 400;}
          @media (max-width: 767.98px) {
        .dash{
            padding: 0.5rem 0.8rem; /* Smaller padding on smaller screens */
            font-size: 0.875rem; /* Adjust font size if needed */
        }
    }

        /* Custom styles for card-container to handle responsive design */
        .card-container {
            display: flex;
            flex-wrap: wrap;
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
            .intro-text {
                font-size:20px;
            }
        }
        .search-input {
            padding: 9px;
        }

        /* categories dropdown styling */
        .dropdown-menu {
        max-height: 0; /* Initially hidden */
        overflow: hidden; /* Hide overflowing content */
        transition: max-height 0.5s ease-out; /* Smooth transition for height */
        padding: 40px;
        border: 2px solid #c9d1da;
        border-radius: 6px;

    }

    .dropdown-menu.show {
        max-height: 1000px; /* Arbitrary large value to ensure full visibility */
        padding: 20px; /* Restore padding when shown */
    }

    .dropdown-item {
        background-color: #f8f9fa;
        border: 2px solid #bcccde;
        border-radius: 8px;
        padding: 8px;
        text-align: center;
        font-weight: 500;
        margin: 4px;
        display: block;
    }

    .dropdown-item:hover {
        background-color: #62f8c6;
        color: #000000;
    }

    </style>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg mx-3 shadow-sm navbar-light bg-white p-4 pb-0">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('../flog-logo.png') }}" class="d-inline-block align-top" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown p-1">
                        <a class="nav-link dropdown-toggle px-3 me-4" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu p-3" style="background-color:#fff;" aria-labelledby="categoryDropdown" id="categoryMenu">
            <div id="visibleCategories">
                @foreach($visibleCategories as $category)
                    <li>
                        <a href="{{ route('category.posts', ['categoryId' => $category->id]) }}" class="dropdown-item">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </div>
            
            <div id="moreCategories" style="display: none;">
                @foreach($hiddenCategories as $category)
                    <li>
                        <a href="{{ route('category.posts', ['categoryId' => $category->id]) }}" class="dropdown-item">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </div>
                <li class="dropdown-item">
                    <button class="btn btn-link text-decoration-none" type="button" id="toggleMoreCategories" aria-expanded="false">
                        More Categories
                    </button>
                </li>
            </ul>
                    </li>
                <li class="nav-item">
                    @auth
                    <a style="background-color:#8b78f9;" class="nav-link  fw-500 rounded-md-3 mt-2 search-btn dash mx-4 fs-6 inline-flex items-center px-3 border border-transparent text-sm leading-4 font-medium  text-gray-500  hover:text-gray-700 focus:outline-none" href="{{ url('/dashboard') }}">Dashboard <span class="visually-hidden">(current)</span></a>
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
@include('layouts.flash-messages')
    <div class="bg-green p-4 rounded shadow-sm">
        <h2 class="display-4 mb-4 text-center attractive-title mb-4 text-shadow">Flog <span class="color-greener">Blog</span></h2>
        <p class="mb-4 text-center intro-text h5 text-muted">Spark your curiosity where thoughts and ideas around things actually matter</p>
        <div class="d-flex justify-content-center">
            <form action="{{ route('search') }}" method="GET" class="p-3 d-flex flex-column flex-md-row w-75">
                <input class="form-control search-input me-md-2 mb-2 mb-md-0" type="search" name="query" value="{{ request()->input('query') }}" placeholder="Search a topic within our great articles">
                <button class="search-btn px-3 w-50 w-md-auto" type="submit">Search</button>
            </form>
        </div>

        <!-- Show 'No results found' only if a search query is present and no results are found -->
        @if(request()->input('query'))
            @if(isset($posts) && $posts->isEmpty())
                <p class="text-center mt-3">No results found for "{{ request()->input('query') }}"</p>
            @endif
        @endif
    </div>

    <!-- Search Results Section -->
    @if(request()->input('query') && isset($posts) && $posts->count() > 0)
    <div class="search-results">
        <h3 class="fw-500 text-muted text-center text-md-start mb-3">Search Results</h3>
        <div class="row card-container">
            @foreach($posts as $post)
                <div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-4">
                    <div class="card rounded-4 shadow-sm w-100">
                        <img class="card-img-top rounded-top-4 p-1 border-1" src="{{ Storage::url($post->image) }}" alt="Card image cap" style="width: 100%; height: 150px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{!! $post->excerpt !!}</p>
                            <div class="mt-auto">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn read-btn card-btn mb-3">Read article</a>
                                <p><img 
                                src="{{ Storage::url($post->user->avatar) }}" 
                                alt="{{ $post->user->name }}" 
                                class="rounded-circle border-2 border-black" 
                                style="width: 40px; height: 40px; margin-right: 10px;">
                                {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                                </p> 
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

<!-- Recent Posts Section -->
<div class="row justify-content-center align-items-center mt-4 pt-5">
    @if($recentPosts->count() > 0)
        <h3 class="fw-500 text-muted text-center text-md-start mb-4">Recent Posts</h3>
        <div class="row card-container">
            @foreach($recentPosts as $post)
                <div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-4">
                    <div class="card rounded-4 shadow-sm w-100">
                        <img class="card-img-top rounded-top-4 p-1 border-1 img-fluid" 
                             src="{{ Storage::url($post->image) }}" 
                             style="width: 100%; height: 200px; object-fit: cover;" 
                             alt="Card image cap">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{!! $post->excerpt !!}</p>
                            <div class="mt-auto">
                                <a href="{{ route('posts.show', $post->id) }}" 
                                   class="btn read-btn card-btn mb-3">Read article</a>
                                <p>
                                    <img src="{{ Storage::url($post->user->avatar) }}" 
                                         alt="{{ $post->user->name }}" 
                                         class="rounded-circle border-2 border-black" 
                                         style="width: 40px; height: 40px; object-fit: cover; margin-right: 10px;">
                                    {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                                </p> 
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="display-6 text-dark text-center my-5">No posts published yet</div>
    @endif
</div>

</main>
<div class="container my-5 pt-4"> 
    <footer class="text-center text-shadow rounded-3 text-lg-start text-dark" style="background-color: #c7daff">
        <div class="container p-4 pb-0">
            <section class="">
                <div class="row">
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                         <h2 class="attractive-title brand-color mb-3">F<span class="text-dark">log</span></h2>
                        <h6 class="text-muted">Share inspiring stories, insightful <br>tips, and diverse perspectives</h6>
                    </div>
                    <hr class="w-100 clearfix d-md-none" />
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Company</h6>
                        <h6><a href="{{ route("aboutUs") }}" class="text-dark text-muted text-decoration-none">About Us</a></h6>
                    </div>
                    <hr class="w-100 clearfix d-md-none" />
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Support</h6>
                        <h6><a href="{{ route("help") }}" class="text-dark text-muted text-decoration-none">Help</a></h6>
                    </div>
                    <hr class="w-100 clearfix d-md-none" />
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 text-center">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Socials</h6>
                        <div class="d-flex justify-content-center">
                            <p class="mb-0"><a href="#"><i class="fab fa-facebook mx-2 fs-3 fs-md-4" style="color:black;"></i></a></p>
                            <p class="mb-0"><a href="#"><i class="fab fa-instagram mx-2 fs-3 fs-md-4" style="color:black;"></i></a></p>
                            <p class="mb-0"><a href="#"><i class="fab fa-github mx-2 fs-3 fs-md-4" style="color:black;"></i></a></p>
                            <p class="mb-0"><a href="#"><i class="fab fa-stack-overflow mx-2 fs-3 fs-md-4" style="color:black;"></i></a></p>
                        </div>
                    </div>
                </div>
            </section>
            <hr class="my-3">
            <section class="p-5 pt-0">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-6 text-center">
                        <div class="p-3 copyright">
                            © 2024 Copyright :
                            <a class="text-dark text-decoration-none text-center copyright h5" href="/">Flog.com</a> | Fadma Charki
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <img src="{{ asset('../footer-image.png') }}" class="img-fluid" width="200" height="200" alt="logo">
                    </div>
                </div>
            </section>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleMoreCategories');
    const visibleCategories = document.getElementById('visibleCategories');
    const moreCategories = document.getElementById('moreCategories');
    const dropdownMenu = document.getElementById('categoryMenu');

    // Function to toggle categories
    function toggleCategories() {
        if (moreCategories.style.display === 'none' || moreCategories.style.display === '') {
            visibleCategories.style.display = 'none';
            moreCategories.style.display = 'block';
            toggleButton.textContent = 'Less Categories';
        } else {
            visibleCategories.style.display = 'block';
            moreCategories.style.display = 'none';
            toggleButton.textContent = 'More Categories';
        }
    }

    // Add event listener for toggle button
    toggleButton.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default action
        toggleCategories(); // Toggle categories

        // Stop event propagation to prevent Bootstrap dropdown from closing
        event.stopPropagation();
    });

    // Prevent the dropdown from closing when interacting with the dropdown content
    dropdownMenu.addEventListener('click', function(event) {
        event.stopPropagation();
    });
});

</script>



</body>
</html>
