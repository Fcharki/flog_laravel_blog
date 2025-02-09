<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Flog | Help Center</title>
    <link href="{{ asset('../style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('../icon3.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Platypi:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-btn { font-weight: 500; }
        .login-btn:hover { color: orange; font-weight: 500; }
        .signup-btn, .signup-btn:hover { color: #43dba9; border: 2px solid #62f8c6; font-weight: 500; }
        .search-btn { background-color: #43dba9; color: white; border: none; padding: 0.5rem 1rem; cursor: pointer; }
        .search-btn:hover { background-color: #43dba9; color: white; }
        .dash { background-color: #28D49B; padding: 10px; color: #fff !important; font-weight: 400; }
        @media (max-width: 767.98px) {
            .dash {
                padding: 0.5rem 0.8rem; /* Smaller padding on smaller screens */
                font-size: 0.875rem; /* Adjust font size if needed */
                
            }
            }
        .help-title {
            word-spacing: 3px;
            font-weight: 600;
            font-family: "Platypi", serif;
            font-size: 60px;
        }
        
        @media only screen and (max-width: 600px) {
            .help-title {
            word-spacing: 3px;
            font-weight: 600;
            font-family: "Platypi", serif;
            font-size: 40px;
        }
  }
        .help-text {
            font-size: 25px;
            word-spacing: 3px;
            line-height: 45px;
        }
        .text-container {
            border-radius: 25px;
            padding : 15px;
            width: 90%;
            background-image: linear-gradient(to right, #39e39d, #52f2af, #52f2af, #52f2af, #62f8c6, #94C6E6);

        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light  mx-3  shadow-sm bg-white p-2 pb-2">
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
                    <a style="background-color:#8b78f9;" class="nav-link fw-500 rounded-2 search-btn dash px-3 me-5 fs-6" href="{{ url('/dashboard') }}">Dashboard</a>
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
<main>
    <div class="container my-5 pt-4" style="min-height: 60vh;">
        <div class="row">
            <div class="col-12">
                <div class="mt-3 col-10 text-container">
                    <h2 class="help-title">What can we help you in ?</h2>
                <p class="help-text p-2">Contact us at <a class="text-decoration-none" href="mailto:fadmaproco@gmail.com">Flog Center</a></p>
                
            </div>
        </div>
    </div>
    </div>
</main>
<footer class="bg-white text-center py-3 mt-4 border-top">
    <div class="container">
        <p class="mb-0"> &copy; 2024 Flog Blog. All rights reserved.</p>
    </div>
</footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
