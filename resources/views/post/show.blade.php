@extends('layouts.master')

@section('title', $post->title . ' | Flog')

@section('styles')
<style>
    :root {
        --accent: #2ac28f;
        --accent-dark: #20a879;
        --text: #1f2937;
        --muted: #6b7280;
        --border: #e8ecef;
        --soft: #f7faf9;

        --like: #ef4444;
        --like-light: #fff5f5;

        --review: #2563eb;
        --review-dark: #1d4ed8;
        --review-light: #eff6ff;

        --reply: #8b5cf6;
        --reply-dark: #7c3aed;
        --reply-light: #f5f3ff;

        --update: #f59e0b;
        --update-dark: #d97706;

        --cancel: #6b7280;
        --cancel-dark: #4b5563;

        --delete: #ef4444;
        --edit: #2563eb;
    }

    body {
        background: #f5f7f8;
        color: var(--text);
    }

    .show-main {
        max-width: 900px;
        margin: 0 auto;
    }

    /* =========================
       Main Article
    ========================= */

    .article-card {
        background: #fff;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, .04);
        box-shadow: 0 10px 35px rgba(0, 0, 0, .06);
    }

    .article-header {
        padding: 42px 46px 28px;
    }

    .article-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        line-height: 1.1;
        letter-spacing: -1.5px;
        font-weight: 800;
        margin-bottom: 28px;
        color: #17201d;
    }

    .article-cover {
        width: 100%;
        height: 460px;
        object-fit: cover;
        display: block;
    }

    .article-body {
        padding: 40px 46px;
    }

    .article-content {
        font-size: 1.12rem;
        line-height: 1.85;
        color: #374151;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .article-content h2,
    .article-content h3 {
        color: #17201d;
        margin-top: 2.2rem;
        margin-bottom: 1rem;
        font-weight: 750;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 14px;
    }

    .article-content table {
        width: 100%;
        max-width: 100%;
        display: block;
        overflow-x: auto;
    }

    .embed-responsive {
        position: relative;
        display: block;
        width: 100%;
        padding-bottom: 56.25%;
        overflow: hidden;
        border-radius: 14px;
    }

    .embed-responsive iframe,
    .embed-responsive object,
    .embed-responsive embed {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
    }

    /* =========================
       Author
    ========================= */

    .author-box {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 35px;
        padding: 18px;
        background: var(--soft);
        border: 1px solid var(--border);
        border-radius: 16px;
    }

    .author-avatar {
        width: 54px;
        height: 54px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid #fff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .1);
    }

    .author-name {
        font-weight: 700;
        color: #17201d;
    }

    .author-date {
        color: var(--muted);
        font-size: .9rem;
    }

    .about-btn {
        border: 0;
        background: transparent;
        color: var(--accent-dark);
        font-weight: 700;
        padding: 0;
        margin-top: 4px;
        cursor: pointer;
    }

    .about-btn:hover {
        text-decoration: underline;
    }

    #article-owner-details {
        margin-top: 12px;
        padding: 16px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 12px;
    }

    /* =========================
       Like
    ========================= */

    .engagement {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 28px;
        padding-bottom: 28px;
        border-bottom: 1px solid var(--border);
    }

    .like-btn {
        width: 46px;
        height: 46px;
        border: 1px solid #fecaca;
        background: var(--like-light);
        border-radius: 50%;
        color: var(--like);
        font-size: 1.25rem;
        cursor: pointer;
        transition: .2s ease;
    }

    .like-btn:hover {
        background: #fee2e2;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(239, 68, 68, .15);
    }

    .like-btn:disabled {
        opacity: .6;
        cursor: wait;
        transform: none;
    }

    .like-count {
        color: var(--muted);
        font-size: .95rem;
        font-weight: 600;
    }

    /* =========================
       Reviews Section
    ========================= */

    .reviews-section {
        margin-top: 42px;
    }

    .reviews-section-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 15px;
        margin-bottom: 24px;
    }

    .reviews-title {
        margin: 0;
        font-size: 1.55rem;
        font-weight: 800;
        color: #17201d;
    }

    .reviews-subtitle {
        margin: 5px 0 0;
        color: var(--muted);
        font-size: .9rem;
    }

    /* =========================
       Review Card
    ========================= */

    .review-card {
        position: relative;
        margin-bottom: 22px;
        padding: 22px;
        background: #fff;
        border: 1px solid #e5e9e7;
        border-radius: 18px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, .035);
    }

    .review-card:hover {
        border-color: #d8dfdc;
    }

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 15px;
    }

    .review-user {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .review-avatar {
        width: 44px;
        height: 44px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
    }

    .review-user-name {
        display: block;
        font-weight: 750;
        color: #1f2937;
        line-height: 1.2;
    }

    .review-date {
        display: block;
        margin-top: 3px;
        color: var(--muted);
        font-size: .78rem;
    }

    .review-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .review-body {
        margin-top: 17px;
        padding-top: 16px;
        border-top: 1px solid #f0f2f1;
    }

    .review-content {
        margin: 0;
        color: #374151;
        line-height: 1.7;
        overflow-wrap: anywhere;
    }

    /* =========================
       Edit / Delete
    ========================= */

    .edit-btn,
    .delete-btn {
        background: none;
        border: 0;
        cursor: pointer;
        font-size: .86rem;
        padding: 4px;
        text-decoration: none;
    }

    .edit-btn {
        color: var(--edit);
    }

    .edit-btn:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }

    .delete-btn {
        color: var(--delete);
    }

    .delete-btn:hover {
        color: #dc2626;
    }

    /* =========================
       Replies Container
    ========================= */

    .replies-container {
        margin-top: 22px;
        padding: 18px;
        background: var(--reply-light);
        border: 1px solid #ddd6fe;
        border-left: 4px solid var(--reply);
        border-radius: 14px;
    }

    .replies-header {
        display: flex;
        align-items: center;
        gap: 9px;
        margin-bottom: 15px;
    }

    .replies-icon {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #ede9fe;
        color: var(--reply-dark);
        border-radius: 8px;
        font-size: .8rem;
    }

    .replies-title {
        margin: 0;
        color: #5b21b6;
        font-size: .88rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .04em;
    }

    /* =========================
       Individual Reply
    ========================= */

    .reply-item {
        padding: 15px;
        margin-bottom: 11px;
        background: #fff;
        border: 1px solid #e9e5ff;
        border-radius: 12px;
    }

    .reply-item:last-of-type {
        margin-bottom: 0;
    }

    .reply-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 12px;
    }

    .reply-user {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .reply-avatar {
        width: 34px;
        height: 34px;
        object-fit: cover;
        border-radius: 50%;
    }

    .reply-user-name {
        display: block;
        font-size: .88rem;
        font-weight: 750;
        color: #374151;
    }

    .reply-date {
        display: block;
        margin-top: 2px;
        color: var(--muted);
        font-size: .73rem;
    }

    .reply-content {
        margin: 11px 0 8px 43px;
        color: #4b5563;
        line-height: 1.6;
        font-size: .92rem;
        overflow-wrap: anywhere;
    }

    .reply-actions {
        margin-left: 43px;
    }

    /* =========================
       Reply Form
    ========================= */

    .reply-form {
        margin-top: 15px;
        padding: 15px;
        background: #fff;
        border: 1px dashed #c4b5fd;
        border-radius: 12px;
    }

    .reply-form-label {
        display: block;
        margin-bottom: 8px;
        color: #6d28d9;
        font-size: .82rem;
        font-weight: 700;
    }

    /* =========================
       Add Review Card
    ========================= */

    .add-review-card {
        margin-top: 28px;
        padding: 23px;
        background: #f8fbff;
        border: 1px solid #dbeafe;
        border-radius: 18px;
    }

    .add-review-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 17px;
    }

    .add-review-icon {
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #dbeafe;
        color: var(--review);
        border-radius: 11px;
    }

    .add-review-title {
        margin: 0;
        font-size: 1.05rem;
        font-weight: 800;
        color: #1e3a8a;
    }

    .add-review-subtitle {
        margin: 3px 0 0;
        color: var(--muted);
        font-size: .82rem;
    }

    /* =========================
       Forms
    ========================= */

    .comment-form textarea,
    .reply-form textarea,
    .edit-form textarea {
        width: 100%;
        border: 1px solid #dfe5e2;
        border-radius: 11px;
        padding: 13px 15px;
        resize: vertical;
        box-shadow: none;
        background: #fff;
    }

    .comment-form textarea:focus,
    .reply-form textarea:focus,
    .edit-form textarea:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(42, 194, 143, .12);
        outline: none;
    }

    .review-form-footer,
    .reply-form-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 12px;
    }

    /* =========================
       Add Review Button
    ========================= */

    .btn-review {
        background: var(--review);
        border: none;
        color: #fff;
        font-weight: 700;
        border-radius: 10px;
        padding: 10px 18px;
        transition: .2s ease;
    }

    .btn-review:hover {
        background: var(--review-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    /* =========================
       Post Reply Button
    ========================= */

    .btn-reply {
        background: var(--reply);
        border: none;
        color: #fff;
        font-weight: 700;
        border-radius: 10px;
        padding: 9px 16px;
        transition: .2s ease;
    }

    .btn-reply:hover {
        background: var(--reply-dark);
        color: #fff;
        transform: translateY(-1px);
    }

    /* =========================
       Update Button
    ========================= */

    .btn-update {
        background: var(--update);
        border: none;
        color: #fff;
        font-weight: 700;
        border-radius: 10px;
        padding: 9px 16px;
        transition: .2s ease;
    }

    .btn-update:hover {
        background: var(--update-dark);
        color: #fff;
    }

    /* =========================
       Cancel Button
    ========================= */

    .btn-cancel {
        background: var(--cancel);
        border: none;
        color: #fff;
        font-weight: 600;
        border-radius: 10px;
        padding: 9px 16px;
        transition: .2s ease;
    }

    .btn-cancel:hover {
        background: var(--cancel-dark);
        color: #fff;
    }

    /* =========================
       Button Loading State
    ========================= */

    .btn-review:disabled,
    .btn-reply:disabled,
    .btn-update:disabled {
        opacity: .65;
        cursor: wait;
        transform: none;
    }

    /* =========================
       Edit Forms
    ========================= */

    .edit-form {
        display: none;
        margin-top: 15px;
        padding: 15px;
        background: #fffaf0;
        border: 1px solid #fde68a;
        border-radius: 12px;
    }

    /* =========================
       AJAX Message
    ========================= */

    .ajax-message {
        margin-top: 10px;
        padding: 9px 13px;
        border-radius: 9px;
        font-size: .88rem;
        display: none;
    }

    .ajax-message.error {
        display: block;
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    /* =========================
       Back Button
    ========================= */

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 28px 0 45px;
        padding: 11px 18px;
        border-radius: 12px;
        background: #fff;
        border: 1px solid var(--border);
        color: #374151;
        text-decoration: none;
        font-weight: 600;
        transition: .2s ease;
    }

    .back-btn:hover {
        color: var(--accent-dark);
        border-color: var(--accent);
        transform: translateX(-2px);
    }

    /* =========================
       Responsive
    ========================= */

    @media (max-width: 768px) {

        .show-main {
            padding: 0 14px;
        }

        .article-header,
        .article-body {
            padding: 28px 22px;
        }

        .article-cover {
            height: 280px;
        }

        .article-title {
            font-size: 2.15rem;
        }

        .article-content {
            font-size: 1rem;
        }

        .reviews-section-header {
            display: block;
        }

        .review-card {
            padding: 17px;
        }

        .review-header,
        .reply-header {
            gap: 10px;
        }

        .replies-container {
            padding: 13px;
        }

        .reply-content,
        .reply-actions {
            margin-left: 0;
        }

        .review-actions {
            flex-shrink: 0;
        }

        .add-review-card {
            padding: 18px;
        }
    }

    @media (max-width: 480px) {

        .review-header {
            flex-direction: column;
        }

        .review-actions {
            align-self: flex-end;
        }

        .reply-header {
            flex-direction: column;
        }

        .reply-actions {
            margin-top: 5px;
        }

        .article-cover {
            height: 230px;
        }
    }
</style>
@endsection

@section('content')

<div class="show-main">

    <article class="article-card my-4">

        {{-- =========================
             Article Header
        ========================== --}}
        <div class="article-header">

            <h1 class="article-title">
                {{ $post->title }}
            </h1>
        </div>
        <div class="article-body">
            
            {{-- =========================
                 Article Content
            ========================== --}}
            <div class="article-content">
                {!! $post->body !!}
            </div>
            {{-- =========================
                 Author
            ========================== --}}
            <div class="author-box">

                <img
                    src="{{ image_url($post->user->avatar) }}"
                    alt="{{ $post->user->name }}"
                    class="author-avatar"
                >
                <div>
                    <div class="author-name">
                        {{ $post->user->name }}
                    </div>

                    <div class="author-date">
                        Published on {{ $post->created_at->format('M d, Y') }}
                    </div>

                    <button
                        type="button"
                        class="about-btn"
                        id="more-about-btn"
                    >
                        Get to know {{ $post->user->name }}
                    </button>

                </div>

            </div>


            {{-- Author Details --}}
            <div
                id="article-owner-details"
                style="display:none;"
            >
                <p class="mb-0">
                    {{ $post->user->occupation }}, {{ $post->user->bio }}
                </p>
            </div>


            {{-- =========================
                 Like
            ========================== --}}
            <div class="engagement">

                <form
                    method="POST"
                    action="{{ route('posts.like', $post) }}"
                    id="like-form"
                >

                    @csrf

                    <button
                        type="button"
                        class="like-btn"
                        onclick="toggleLike('{{ $post->id }}')"
                        aria-label="Like post"
                    >

                        <i
                            class="far fa-heart empty-heart {{ $post->isLikedByUser() ? 'd-none' : '' }}"
                        ></i>

                        <i
                            class="fas fa-heart filled-heart {{ $post->isLikedByUser() ? '' : 'd-none' }}"
                        ></i>

                    </button>

                    <span class="like-count">
                        {{ $post->likes_count }}
                        {{ $post->likes_count === 1 ? 'Like' : 'Likes' }}
                    </span>

                </form>

            </div>


            {{-- =========================
                 Reviews Section
            ========================== --}}
            <section
                class="reviews-section"
                id="reviews-section"
            >

                {{-- Reviews Header --}}
                <div class="reviews-section-header">

                    <div>

                        <h2 class="reviews-title">
                            Reviews ({{ $post->reviews->count() }})
                        </h2>

                        <p class="reviews-subtitle">
                            Read what people think about this post.
                        </p>

                    </div>

                </div>


                {{-- =========================
                     Reviews
                ========================== --}}
                @forelse($post->reviews as $review)

                    <article class="review-card">

                        {{-- Review Header --}}
                        <div class="review-header">

                            <div class="review-user">

                                <img
                                    src="{{ image_url($review->user->avatar) }}"
                                    alt="{{ $review->user->name }}"
                                    class="review-avatar"
                                >

                                <div>

                                    <span class="review-user-name">
                                        {{ $review->user->name }}
                                    </span>

                                    <span class="review-date">
                                        {{ $review->created_at->format('M d, Y') }}
                                    </span>

                                </div>

                            </div>


                            {{-- Review Owner Actions --}}
                            @if(Auth::check() && Auth::user()->id == $review->user_id)

                                <div class="review-actions">

                                    <button
                                        type="button"
                                        class="edit-btn"
                                        onclick="toggleEditForm(
                                            'review',
                                            '{{ $review->id }}'
                                        )"
                                        aria-label="Edit review"
                                    >
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </button>


                                    <form
                                        method="POST"
                                        action="{{ route('reviews.destroy', $review) }}"
                                        style="display:inline;"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-btn"
                                            onclick="return confirm(
                                                'Are you sure you want to delete this review?'
                                            );"
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            @endif

                        </div>


                        {{-- =========================
                             Review Body
                        ========================== --}}
                        <div class="review-body">

                            <p class="review-content">
                                {{ trim($review->content) }}
                            </p>

                        </div>


                        {{-- =========================
                             Edit Review
                        ========================== --}}
                        <form
                            method="POST"
                            action="{{ route('reviews.update', $review) }}"
                            class="edit-form"
                            id="edit-review-form-{{ $review->id }}"
                        >

                            @csrf
                            @method('PUT')

                            <textarea
                                name="content"
                                rows="3"
                                class="form-control"
                                required
                            >{{ trim($review->content) }}</textarea>

                            <div class="mt-2">

                                <button
                                    type="submit"
                                    class="btn-update me-2"
                                >
                                    <i class="fas fa-check me-1"></i>
                                    Update
                                </button>

                                <button
                                    type="button"
                                    class="btn-cancel"
                                    onclick="toggleEditForm(
                                        'review',
                                        '{{ $review->id }}'
                                    )"
                                >
                                    Cancel
                                </button>

                            </div>

                        </form>


                        {{-- =========================
                             Replies
                        ========================== --}}
                        <div class="replies-container">

                            <div class="replies-header">

                                <span class="replies-icon">
                                    <i class="fas fa-reply"></i>
                                </span>

                                <h3 class="replies-title">
                                    Replies ({{ $review->replies->count() }})
                                </h3>

                            </div>


                            {{-- Existing Replies --}}
                            @foreach($review->replies as $reply)

                                <div
                                    id="reply-{{ $reply->id }}"
                                    class="reply-item"
                                >

                                    <div class="reply-header">

                                        <div class="reply-user">

                                            <img
                                                src="{{ image_url($reply->user->avatar) }}"
                                                alt="{{ $reply->user->name }}"
                                                class="reply-avatar"
                                            >

                                            <div>

                                                <span class="reply-user-name">
                                                    {{ $reply->user->name }}
                                                </span>

                                                <span class="reply-date">
                                                    {{ $reply->created_at->format('M d, Y') }}
                                                </span>

                                            </div>

                                        </div>


                                        {{-- Reply Owner Actions --}}
                                        @if(Auth::check() && Auth::user()->id == $reply->user_id)

                                            <div class="reply-actions">

                                                <a
                                                    href="#"
                                                    class="edit-btn me-2"
                                                    onclick="
                                                        event.preventDefault();
                                                        toggleEditForm(
                                                            'reply',
                                                            '{{ $reply->id }}'
                                                        );
                                                    "
                                                >
                                                    <i class="fas fa-edit"></i>
                                                    Edit
                                                </a>


                                                <form
                                                    method="POST"
                                                    action="{{ route('replies.destroy', $reply) }}"
                                                    style="display:inline;"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="delete-btn"
                                                        onclick="return confirm(
                                                            'Are you sure you want to delete this reply?'
                                                        );"
                                                    >
                                                        <i class="fas fa-trash-alt"></i>
                                                        Delete
                                                    </button>

                                                </form>

                                            </div>

                                        @endif

                                    </div>


                                    {{-- Reply Content --}}
                                    <p class="reply-content">
                                        {{ trim($reply->content) }}
                                    </p>


                                    {{-- =========================
                                         Edit Reply
                                    ========================== --}}
                                    <form
                                        method="POST"
                                        action="{{ route('replies.update', $reply) }}"
                                        class="edit-form"
                                        id="edit-reply-form-{{ $reply->id }}"
                                    >

                                        @csrf
                                        @method('PUT')

                                        <textarea
                                            name="content"
                                            rows="2"
                                            class="form-control"
                                            required
                                        >{{ trim($reply->content) }}</textarea>

                                        <div class="mt-2">

                                            <button
                                                type="submit"
                                                class="btn-update me-2"
                                            >
                                                <i class="fas fa-check me-1"></i>
                                                Update
                                            </button>

                                            <button
                                                type="button"
                                                class="btn-cancel"
                                                onclick="toggleEditForm(
                                                    'reply',
                                                    '{{ $reply->id }}'
                                                )"
                                            >
                                                Cancel
                                            </button>

                                        </div>

                                    </form>

                                </div>

                            @endforeach


                            {{-- =========================
                                 Add Reply
                            ========================== --}}
                            @auth

                                <form
                                    method="POST"
                                    action="{{ route('replies.store', ['review' => $review->id]) }}"
                                    class="reply-form ajax-reply-form"
                                >

                                    @csrf

                                    <label class="reply-form-label">
                                        <i class="fas fa-reply me-1"></i>
                                        Reply to this review
                                    </label>

                                    <textarea
                                        name="content"
                                        rows="2"
                                        class="form-control"
                                        placeholder="Write your reply..."
                                        required
                                    ></textarea>

                                    <div class="ajax-message"></div>

                                    <div class="reply-form-footer">

                                        <button
                                            type="submit"
                                            class="btn-reply"
                                        >
                                            <i class="fas fa-paper-plane me-1"></i>
                                            Post Reply
                                        </button>

                                    </div>

                                </form>

                            @endauth

                        </div>

                    </article>

                @empty

                    <div class="text-center py-4">

                        <div class="mb-2 text-muted">
                            <i class="far fa-comment-dots fa-2x"></i>
                        </div>

                        <p class="text-muted mb-0">
                            No reviews yet. Be the first to share your thoughts.
                        </p>

                    </div>

                @endforelse


                {{-- =========================
                     Add Review
                ========================== --}}
                @auth

                    <div class="add-review-card">

                        <div class="add-review-header">

                            <span class="add-review-icon">
                                <i class="fas fa-comment-alt"></i>
                            </span>

                            <div>

                                <h3 class="add-review-title">
                                    Share your thoughts
                                </h3>

                                <p class="add-review-subtitle">
                                    Tell others what you think about this post.
                                </p>

                            </div>

                        </div>


                        <form
                            method="POST"
                            action="{{ route('reviews.store', $post->id) }}"
                            class="ajax-review-form"
                        >

                            @csrf

                            <textarea
                                name="content"
                                rows="4"
                                class="form-control"
                                placeholder="Write your review..."
                                required
                            ></textarea>


                            <div class="ajax-message"></div>


                            <div class="review-form-footer">

                                <button
                                    type="submit"
                                    class="btn-review"
                                >
                                    <i class="fas fa-paper-plane me-1"></i>
                                    Add Review
                                </button>

                            </div>

                        </form>

                    </div>

                @endauth

            </section>

        </div>

    </article>


    {{-- =========================
         Back Button
    ========================== --}}
    <a
        href="{{ url('/') }}"
        class="back-btn"
    >
        <i class="fas fa-arrow-left"></i>
        Back to Posts
    </a>

</div>

@endsection


@push('scripts')

<script>

    /*
    |--------------------------------------------------------------------------
    | Get To Know Author
    |--------------------------------------------------------------------------
    */

    (function () {

        const btn =
            document.getElementById('more-about-btn');

        const details =
            document.getElementById('article-owner-details');


        if (!btn || !details) {
            return;
        }


        btn.addEventListener('click', function () {

            const isHidden =
                details.style.display === 'none';


            details.style.display =
                isHidden ? 'block' : 'none';


            btn.textContent =
                isHidden
                    ? 'Show less'
                    : 'Get to know {{ $post->user->name }}';

        });

    })();


    /*
    |--------------------------------------------------------------------------
    | Like Post - AJAX
    |--------------------------------------------------------------------------
    */

    function toggleLike(postId) {

        const token =
            document.querySelector(
                'meta[name="csrf-token"]'
            );


        const csrf =
            token
                ? token.getAttribute('content')
                : '';


        const likeButton =
            document.querySelector('.like-btn');


        if (likeButton) {
            likeButton.disabled = true;
        }


        fetch('/posts/' + postId + '/like', {

            method: 'POST',

            headers: {
                'X-CSRF-TOKEN': csrf,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }

        })

        .then(response => {

            if (!response.ok) {
                throw new Error('Like request failed.');
            }

            return response.json();

        })

        .then(data => {

            const empty =
                document.querySelector('.empty-heart');


            const filled =
                document.querySelector('.filled-heart');


            const count =
                document.querySelector('.like-count');


            if (empty && filled) {

                if (data.is_liked) {

                    empty.classList.add('d-none');
                    filled.classList.remove('d-none');

                } else {

                    filled.classList.add('d-none');
                    empty.classList.remove('d-none');

                }

            }


            if (count) {

                count.textContent =
                    data.likes_count +
                    ' ' +
                    (
                        data.likes_count === 1
                            ? 'Like'
                            : 'Likes'
                    );

            }

        })

        .catch(error => {

            console.error(
                'Like error:',
                error
            );

        })

        .finally(() => {

            if (likeButton) {
                likeButton.disabled = false;
            }

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Toggle Edit Forms
    |--------------------------------------------------------------------------
    */

    function toggleEditForm(type, id) {

        const form =
            document.getElementById(
                'edit-' + type + '-form-' + id
            );


        if (!form) {
            return;
        }


        form.style.display =
            form.style.display === 'block'
                ? 'none'
                : 'block';

    }

    document.addEventListener('submit', function (event) {

        const form =
            event.target;


        const isReviewForm =
            form.classList.contains(
                'ajax-review-form'
            );


        const isReplyForm =
            form.classList.contains(
                'ajax-reply-form'
            );


        if (!isReviewForm && !isReplyForm) {
            return;
        }


        event.preventDefault();


        const submitButton =
            form.querySelector(
                'button[type="submit"]'
            );


        const originalText =
            submitButton
                ? submitButton.innerHTML
                : '';


        const message =
            form.querySelector(
                '.ajax-message'
            );


        if (submitButton) {

            submitButton.disabled = true;

            submitButton.innerHTML =
                '<i class="fas fa-spinner fa-spin me-1"></i>' +
                ' Posting...';

        }


        if (message) {

            message.className =
                'ajax-message';

            message.textContent = '';

        }


        const formData =
            new FormData(form);


        fetch(form.action, {

            method: 'POST',

            body: formData,

            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'text/html, application/xhtml+xml'
            }

        })

        .then(async response => {

            if (!response.ok) {

                const errorText =
                    await response.text();

                throw new Error(
                    errorText ||
                    'Request failed.'
                );

            }

            return response.text();

        })

        .then(html => {

            /*
             * Parse Laravel's returned page.
             */
            const parser =
                new DOMParser();


            const newDocument =
                parser.parseFromString(
                    html,
                    'text/html'
                );

            /*
             * Get updated reviews section.
             */
            const newReviewsSection =
                newDocument.querySelector(
                    '#reviews-section'
                );

            /*
             * Get current reviews section.
             */
            const currentReviewsSection =
                document.querySelector(
                    '#reviews-section'
                );

            /*
             * Replace ONLY reviews.
             *
             * This means the article image
             * does not refresh.
             */
            if (
                newReviewsSection &&
                currentReviewsSection
            ) {

                currentReviewsSection.replaceWith(
                    newReviewsSection
                );


                /*
                 * Scroll smoothly to reviews.
                 */
                newReviewsSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });

            }

        })

        .catch(error => {

            console.error(
                'Review/reply error:',
                error
            );

            if (message) {

                message.className =
                    'ajax-message error';

                message.textContent =
                    'Unable to post your message. Please try again.';

            } else {

                alert(
                    'Unable to post your message. Please try again.'
                );

            }

        })

        .finally(() => {

            /*
             * The form may have been replaced
             * after a successful request.
             */
            if (
                submitButton &&
                document.body.contains(
                    submitButton
                )
            ) {

                submitButton.disabled = false;

                submitButton.innerHTML =
                    originalText;

            }

        });

    });

</script>

@endpush