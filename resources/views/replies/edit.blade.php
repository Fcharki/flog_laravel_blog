<x-app-layout>
    <x-slot name="header">
        <h1>Edit Reply</h1>
    </x-slot>

    <div class="container">
        <h1>Edit Reply</h1>
        <form method="POST" action="{{ route('replies.update', $reply) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">Content</label>
                <textarea name="content" id="content" class="form-control">{{ $reply->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update Reply</button>
        </form>
    </div>
</x-app-layout>
