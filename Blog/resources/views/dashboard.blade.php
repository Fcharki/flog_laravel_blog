<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <!-- Dashboard Title -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight p-3">
                {{ __('Dashboard') }}
            </h2>

            <!-- Notification Bell Icon  -->
            <div id="notifications" class="relative flex items-center  bg-gray-200 rounded-full p-2">
                <i class="fa fa-bell cursor-pointer text-2xl p-1" id="notification-bell"></i>
                <!-- Increased icon size using text-2xl -->
                <span id="notification-count" class="absolute top-0 right-0 translate-x-2/4 translate-y-2/4 bg-red-600 text-white rounded-full text-xs px-2">{{ auth()->user()->unreadNotifications->count() }}</span>
            </div>
        </div>
<!-- Notification List  -->
<div id="notification-list" class="absolute right-0 mt-2 w-80 bg-white shadow-lg rounded-lg p-4 hidden">
    @if(auth()->user()->unreadNotifications->isEmpty())
        <div class="text-gray-500">No new notifications</div>
    @else
        @foreach (auth()->user()->unreadNotifications as $notification)
            <div class="p-2 mb-2 bg-gray-100 rounded">
                <a href="{{ route('posts.show', $notification->data['post_id']) }}" class="hover:underline">
                    {{ $notification->data['message'] }}
                </a>
                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="text-sm text-blue-500 hover:underline">Mark as read</button>
                </form>
            </div>
        @endforeach
    @endif
</div>

    </x-slot>

    <div class="py-12">
        @include('layouts.flash-messages')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Create Post Button -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('posts.create') }}" class="p-3 search-btn">+ Create Post</a>
                </div>
            </div>

            <!-- User's Posts -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-lg font-semibold display-6 mb-4">Your Posts:</h1>
                    <h1 id="post-count" class="text-md font-semibold mb-4">You have {{ $numberOfPosts }} posts on your dashboard.</h1>
                    @if($posts->isNotEmpty())
                    <ul class="list-disc pl-5">
                        @foreach($posts as $post)
                            <li id="post-{{ $post->id }}" class="mb-2 card p-3">
                                <img class="card-img-top rounded-top-4" src="{{ Storage::url($post->image) }}" alt="Card image cap" style="width: 100%; height: 200px; object-fit: cover;">
                                <a href="{{ route('posts.show', $post->id) }}" class="text-gray-900-600 hover:underline card-title h5 fw-600 mt-2">{{ $post->title }}</a>
                                <p class="text-gray-600 card-body">{!! $post->excerpt !!}</p>
                                
                                <!-- Form for Update -->
                                <div>
                                    <form action="{{ route('posts.edit', $post->id) }}" method="GET" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn rounded-3 m-1 search-btn text-light p-2" style="background-color:#88AB2B;">Edit Post</button>
                                    </form>

                                    <!-- Form for Delete -->
                                    <form id="delete-form-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="search-btn delete-btn btn rounded-3 text-light m-1 p-2" style="background-color:#8a78ee;" onclick="deletePost('{{ $post->id }}')">Delete Post</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    @else
                        <p>No posts found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    
function deletePost(postId) {
    if (confirm('Are you sure you want to delete this post?')) {
        const form = document.getElementById('delete-form-' + postId);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams(new FormData(form)).toString(),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Remove the post element from the view
                document.getElementById('post-' + postId).remove();
                
                // Update the post count
                const postCountElement = document.getElementById('post-count');
                const currentCount = parseInt(postCountElement.textContent.match(/\d+/)[0], 10);
                postCountElement.textContent = `You have ${currentCount - 1} posts on your dashboard.`;
            } else {
                alert('Failed to delete the post: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the post.');
        });
    }
}

</script>
<script>
    document.getElementById('notification-bell').addEventListener('click', function() {
        const notificationList = document.getElementById('notification-list');
        notificationList.classList.toggle('hidden');
    });
</script>
<script>
   $(document).ready(function() {
    const unreadNotificationCount = parseInt($('#notification-count').text(), 10);
    
    if (unreadNotificationCount > 0) {
        $('#notification-bell').hover(
            function() {
                // Create and show the tooltip if there are unread notifications
                $(this).after('<span id="notification-tooltip" class="absolute bg-gray-200 text-gray-800 p-2 rounded">You have unread notifications</span>');
            },
            function() {
                // Remove the tooltip when the mouse leaves
                $('#notification-tooltip').remove();
            }
        );
    }
});

</script>
