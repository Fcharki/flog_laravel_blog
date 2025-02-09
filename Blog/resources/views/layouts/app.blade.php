<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('${APP_NAME}', 'Flog | Blog') }}</title>
    <!-- Place this script in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/26f6ezvkqjx5utvzvyhqeqv06t9dbtwh0hszelix5jab8fu4/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('../icon3.png') }}">
    <!-- Styles -->
    <link href="{{ asset('../style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
         #notification-list {
        z-index: 50; /* Higher z-index to ensure it stays on top */
        max-height: 300px; /* Limit the height */
        overflow-y: auto; /* Add scrolling if there are many notifications */
        }
        #notification-tooltip {
        top: -20px; /* Adjust based on your design */
        right: 0;
        z-index: 10; /* Ensures it appears above other elements */
        display: inline-block;
        white-space: nowrap;
    }
        .login-btn { font-weight: 500; }
        .login-btn:hover {color: orange;font-weight: 500;}
        .signup-btn, .signup-btn:hover {color: #43dba9; border: 2px solid #62f8c6;font-weight: 500;}
        .card-btn, .card-btn:hover { background-color: #28D49B;}
        .search-btn {background-color: #28D49B;color: white;border: none;padding: 0.5rem 1rem;cursor: pointer;}
        .search-results { margin-top: 20px;}
        .search-results .card {margin-bottom: 10px; }
        .dash{background-color: #28D49B;padding:10px;color: #fff !important;font-weight: 400;}
        @media (max-width: 767.98px) {
            .dash{
                padding: 0.5rem 0.8rem; /* Smaller padding on smaller screens */
                font-size: 0.875rem; /* Adjust font size if needed */
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/pusher-js@7.0.3/dist/pusher.min.js"></script> -->

    <!-- <script>
        const beamsClient = new PusherPushNotifications.Client({
            instanceId: '75b26c5e-c45b-4973-8b3b-60c1ade0cdb9',
        });

        beamsClient.start()
            .then(() => beamsClient.addDeviceInterest('hello'))
            .then(() => console.log('Successfully registered and subscribed!'))
            .catch(console.error);
    </script> -->
</body>
</html>
