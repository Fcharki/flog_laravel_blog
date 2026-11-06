<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Email verification is currently disabled. You can use your account without verifying your email address.') }}
    </div>

    <div class="mt-4 flex items-center justify-between">
        <a class="auth-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none" href="{{ route('dashboard') }}">
            {{ __('Continue to dashboard') }}
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="auth-link underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
