<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('../icon3.png') }}">
        <link href="{{ asset('../style.css') }}" rel="stylesheet">

        <title>{{ config('app.name', 'Flog | Blog') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* App-palette auth page */
            .auth-page {
                background: linear-gradient(140deg, #eafaf3 0%, #d6f9ec 40%, #c7daff 100%);
            }

            .auth-card {
                background: #ffffff;
                border: 1px solid rgba(40, 212, 155, 0.25);
                border-radius: 18px;
                box-shadow: 0 20px 50px rgba(22, 112, 90, 0.16);
            }

            .auth-brand {
                font-family: 'Dancing Script', cursive;
                font-size: 2.4rem;
                font-weight: 700;
                color: #10755a;
            }

            .btn-brand {
                background-color: #28D49B !important;
                color: #fff !important;
                border: 0 !important;
                border-radius: 10px;
                font-weight: 700;
                letter-spacing: 0.03em;
                box-shadow: 0 6px 16px rgba(40, 212, 155, 0.35);
                transition: background-color .2s ease, transform .2s ease, box-shadow .2s ease;
            }
            .btn-brand:hover,
            .btn-brand:focus {
                background-color: #1fbf8a !important;
                box-shadow: 0 8px 22px rgba(40, 212, 155, 0.45);
                transform: translateY(-2px);
            }
            .btn-brand:active {
                background-color: #1aab7c !important;
                transform: translateY(0);
            }

            .input-brand {
                border: 1px solid #d6f0e4;
                border-radius: 10px !important;
                transition: border-color .2s ease, box-shadow .2s ease;
            }
            .input-brand:focus {
                border-color: #28D49B !important;
                box-shadow: 0 0 0 3px rgba(40, 212, 155, 0.18);
            }

            .auth-checkbox {
                accent-color: #28D49B;
            }

            .auth-link {
                color: #16705a;
                transition: color .2s ease;
            }
            .auth-link:hover {
                color: #28D49B;
            }

            .auth-img-ring {
                background: #eafaf3;
                border: 2px solid rgba(40, 212, 155, 0.35);
                border-radius: 9999px;
                padding: 8px;
            }
            .auth-img-ring img {
                border: 3px solid #ffffff;
            }

            .centered {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900">
        <div class="auth-page min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="text-center">
                <a href="/" class="auth-brand d-inline-block text-decoration-none">Flog Blog</a>
            </div>
            <div class="auth-card w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>