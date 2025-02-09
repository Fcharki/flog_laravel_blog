<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ asset('../icon3.png') }}">
              <link href="{{ asset('../style.css') }}" rel="stylesheet">

        <title>{{ config('Flog Blog | Authentication', 'Flog | Blog') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
        <style>
            
    .bg-green {
        background-color: #c7dfff;
    }
    .border-purple {
        border: 1px solid #10bb82;
        box-shadow: 0 1px   #c7dfff;
       
        padding: 8px;
        background-color:#43DBA9 ;
    }
    .centered{
    display: flex; 
        justify-content: center;
        align-items: center;
    }
    .image-end{
        display: flex;
        justify-content: end;
    }
    .search-btn {background-color: #28D49B;color: white;border: none;padding: 0.5rem 1rem;cursor: pointer;}
    
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 ">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0  bg-green ">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
