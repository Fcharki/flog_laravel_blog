<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            @if ($user->avatar)
                <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="mt-2 rounded-full avatar-image" id="current-avatar">
            @endif
            <x-input-label for="avatar" :value="__('Avatar')" />
            <input id="avatar" name="avatar" type="file" class="mt-1 block w-full" accept="image/*" onchange="previewImage(event)"/>
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            <img id="image-preview" style="display:none;" class="mt-2 rounded-full avatar-image"/>
            <p id="image-error" class="mt-2 text-red-600" style="display:none;">{{ __('Image size should be less than 2048 KB.') }}</p>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="occupation" :value="__('Occupation')" />
            <x-text-input id="occupation" name="occupation" type="text" class="mt-1 block w-full" :value="old('occupation', $user->occupation)" required autofocus autocomplete="occupation" />
            <x-input-error class="mt-2" :messages="$errors->get('occupation')" />
        </div>
        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <x-textarea id="body" name="bio" class="mt-1 block w-full" required autofocus autocomplete="bio">{{ old('bio', $user->bio) }}</x-textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="p-3 search-btn">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<style>
    .avatar-image {  
        /* set both the width and height of the image to be equal and use 
        object-fit: cover to ensure the image content fits properly within the circle(fully rounded).  */
        width: 200px;
        height: 200px;
        object-fit: cover;  
        border-radius: 50%;
    }
</style>

<script>
    function previewImage(event) { // js function to preview the profile photo using fileReader object
        const file = event.target.files[0];
        const img = document.getElementById('image-preview');
        const currentAvatar = document.getElementById('current-avatar');
        const error = document.getElementById('image-error');

        if (file.size > 2048 * 1024) {
            error.style.display = 'block';
            img.style.display = 'none';
            currentAvatar.style.display = 'block';
        } else {
            error.style.display = 'none';
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                img.style.display = 'block';
                if (currentAvatar) {
                    currentAvatar.style.display = 'none';
                }
            };
            reader.readAsDataURL(file);
        }
    }
</script>
