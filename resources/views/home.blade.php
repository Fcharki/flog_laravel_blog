@extends('layouts.master')

@section('title', 'Flog | Blog')

@section('styles')
<style>
    .bg-green {
        background-color: #c7daff;
    }

    .search-btn {
        border-radius: 5px;
        background-color: #38ebb0;
        border: none;
        padding: 13px;
        color: #fff;
        cursor: pointer;
        font-weight: 500;
    }
    .search-btn:hover {
        background-color: #28D49B;
    }

    .search-input {
        padding: 9px;
    }

    .search-results {
        margin-top: 20px;
    }
    .search-results .card {
        margin-bottom: 10px;
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
            font-size: 20px;
        }
        .search-form {
            align-items: center;
        }
    }

    .transition-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .transition-card:hover {
        transform: translateY(-5px);
        box-shadow: 5px 10px 20px rgba(0, 0, 0, 0.1) !important;
    }

    .btn.read-btn.card-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: auto;
        min-height: 42px;
        margin-top: 0;
        padding: 0.5rem 1.25rem;
        line-height: inherit;
        white-space: nowrap;
        border: 0;
        border-radius: 6px;
        background-color: #28D49B;
        color: #fff;
        font-weight: 600;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }
    .btn.read-btn.card-btn:hover {
        background-color: #43dba9;
        color: #fff;
        transform: translateY(-1px);
    }

    /* Author + publication date meta line */
    .author-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 0.9rem;
        margin-bottom: 0;
        color: #6b7280;
        font-size: 0.9rem;
    }

    /* Pagination styling */
    .flog-pagination .pagination {
        gap: 6px;
        flex-wrap: wrap;
    }

    .flog-pagination .page-link {
        border: 1px solid #e5e7eb;
        border-radius: 10px !important;
        color: #374151;
        font-weight: 600;
        min-width: 42px;
        text-align: center;
        padding: 0.5rem 0.75rem;
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px rgba(15, 23, 30, 0.05);
    }

    .flog-pagination .page-link:hover {
        background-color: #e6fcf5;
        border-color: #28D49B;
        color: #0d6b49;
        transform: translateY(-2px);
    }

    .flog-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #28D49B, #4be5b2);
        border-color: #28D49B;
        color: #fff;
        box-shadow: 0 4px 12px rgba(40, 212, 155, 0.35);
    }

    .flog-pagination .page-item.disabled .page-link {
        color: #c4c9d1;
        background: #f9fafb;
        border-color: #eef0f3;
        box-shadow: none;
    }

    .flog-pagination .small.text-muted {
        color: #6b7280;
        font-size: 0.9rem;
    }
</style>
@endsection

@section('content')
<div class="container my-5">
    @include('layouts.flash-messages')

    <div class="bg-green p-5 rounded shadow-sm mx-5">
        <h2 class="display-4 mb-4 text-center attractive-title mb-4 text-shadow">Flog <span class="color-greener">Blog</span></h2>
        <p class="mb-4 text-center intro-text h5 text-muted">Spark your curiosity where thoughts and ideas around things actually matter</p>
        <div class="d-flex justify-content-center">
            <form action="{{ route('search') }}" method="GET" class="search-form p-3 d-flex flex-column flex-md-row w-75">
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
                    <div class="card rounded-6 shadow-sm w-100">
                        <img class="card-img-top rounded-top-4 p-1 border-1" src="{{ image_url($post->image) }}" alt="Card image cap" style="width: 100%; height: 150px; object-fit: cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{!! $post->excerpt !!}</p>
                            <div class="mt-auto">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn read-btn card-btn mb-3">Read article</a>
                                <p class="author-meta"><img
                                src="{{ image_url($post->user->avatar) }}"
                                alt="{{ $post->user->name }}"
                                class="rounded-circle border-2 border-black"
                                style="width: 40px; height: 40px; object-fit: cover;">
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
    <div class="row justify-content-center align-items-center mt-4 pt-5 mx-3">
        @if($recentPosts->count() > 0)
            <h3 class="fw-500 text-muted text-center text-md-start mb-4">Recent Posts</h3>
            <div class="row card-container">
                @foreach($recentPosts as $post)
                    <div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-4 p-2 transition-card">
                        <div class="card rounded-4 shadow-sm w-100">
                            <img class="card-img-top rounded-top-4 p-2 img-fluid"
                                 src="{{ image_url($post->image) }}"
                                 style="width: 100%; height: 200px; object-fit: cover;"
                                 alt="Card image cap">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{!! $post->excerpt !!}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('posts.show', $post->id) }}"
                                       class="btn read-btn card-btn my-3">Read article</a>
                                       <hr class="text-muted"/>
                                    <p class="author-meta">
                                        <img src="{{ image_url($post->user->avatar) }}"
                                             alt="{{ $post->user->name }}"
                                             class="rounded-circle border-2 border-black"
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                        {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flog-pagination d-flex justify-content-center mt-4">
                {{ $recentPosts->links('pagination::bootstrap-5') }}
            </div>
        @else
            <div class="display-6 text-dark text-center my-5">No posts published yet</div>
        @endif
    </div>

</div>
@endsection