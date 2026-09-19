@extends('layouts.master')

@section('title', 'Posts in ' . $category . ' | Flog')

@section('styles')
<style>
/* =========================
   CATEGORY PAGE — page-specific only
   (navbar/footer CSS lives in layouts.partials.styles)
========================== */

/* Card grid: 3 → 2 → 1 columns */
.card-container {
    display: flex;
    flex-wrap: wrap;
}

.card-container .col-lg-4 {
    flex: 0 0 33.33333%;
    max-width: 33.33333%;
}

@media (max-width: 991px) {
    .card-container .col-md-4 {
        flex: 0 0 50%;
        max-width: 50%;
    }
}

@media (max-width: 767px) {
    .card-container .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
@endsection

@section('content')
<div class="container my-5">
    <h2 class="mb-4 fw-500">Posts in "{{ $category }}"</h2>
    <div class="row card-container">
        @forelse($posts as $post)
            <div class="col-md-4 col-lg-4 d-flex align-items-stretch mb-4">
                <div class="card w-100">
                    @if($post->image)
                        <img src="{{ image_url($post->image) }}" class="card-img-top"
                             style="width: 100%; height: 150px; object-fit: cover;"
                             alt="Card image cap">
                    @else
                        <img src="/path/to/default/image.jpg" class="card-img-top"
                             alt="Default Image">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{!! $post->excerpt !!}</p>
                        <div class="mt-auto">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn search-btn rounded-4 p-2"
                               style="background-color:#28D49B;">
                                Read article
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-center">No posts available in this category yet.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
@endpush
