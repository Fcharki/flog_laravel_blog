<x-app-layout>
    <x-slot name="header">
        <h1>Edit Review</h1>
    </x-slot>

    <div class="container">
        <h1>Edit Review</h1>
        <form method="POST" action="{{ route('reviews.update', $review) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control">{{ $review->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update Review</button>
        </form>
    </div>
</x-app-layout>
