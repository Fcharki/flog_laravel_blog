<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight p-3">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="post-form" action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <x-label for="title" :value="__('Title')" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$post->title" required autofocus />
                        </div>

                        <!-- Body -->
                        <div class="mt-4">
                            <x-label for="body" :value="__('Body')" />
                            <textarea id="body" name="body" class="block mt-1 w-full rounded-md" rows="5" required>{{ old('body', $post->body) }}</textarea>
                        </div>

                        <!-- Image -->
                        <div class="mt-4">
                            <x-label for="image" :value="__('Thumbnail')" />
                            <input id="image" type="file" name="image" accept="image/*" class="block mt-1 w-full" onchange="previewImage(event)" />
                            <p class="text-gray-600 mt-1">Max size: 2MB</p>
                            <!-- Image Preview -->
                            <div class="mt-2">
                                <img id="image-preview" src="{{ $post->image ? asset('storage/' . $post->image) : '#' }}" alt="Image Preview" style="display: '{{ $post->image ? 'block' : 'none' }}'; width: 100%; max-height: 300px; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="mt-4">
                            <x-label for="category_id" :value="__('Category')" />
                            <select name="category_id" id="category_id" class="block mt-1 w-full rounded-md">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4">
                            <x-button class="p-3 search-btn">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for image preview and TinyMCE initialization -->
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('image-preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        }

        // FOR CLOUD TINYMCE 
        // document.addEventListener('DOMContentLoaded', function() {
            // Initialize TinyMCE after DOM is fully loaded
        //     tinymce.init({
        //         selector: 'textarea#body',
        //         plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
        //         toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        //         tinycomments_mode: 'embedded',
        //         tinycomments_author: 'Author name',
        //         mergetags_list: [
        //             { value: 'First.Name', title: 'First Name' },
        //             { value: 'Email', title: 'Email' },
        //         ],
        //         ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
        //     });
        // });

        // FREE VERSION
        document.addEventListener('DOMContentLoaded', function() {
        // TinyMCE initialization
        tinymce.init({
            selector: 'textarea#body',
            license_key: 'gpl', // This acknowledges the open-source license
            plugins: 'lists fullscreen pagebeark wordcount emoticons codesample charmap autosave autoresize autolink visualblocks table anchor link image save preview',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image'
        })});
    </script>

</x-app-layout>
