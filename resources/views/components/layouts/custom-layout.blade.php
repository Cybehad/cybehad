<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'My App')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <style>
        .bg-hero {
            background-image: url('https://source.unsplash.com/1920x1080/?technology,software');
            background-size: cover;
            background-position: center;
        }

        .mobile-menu {
            display: none;
            position: absolute;
            top: 64px;
            left: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 50;
        }

        .mobile-menu.active {
            display: block;
            text-align: center;
        }

        .testimonial-card {
            display: flex;
            flex-direction: column;
            min-height: 250px;
            /* Adjust as needed */
        }

        .testimonial-content {
            flex-grow: 1;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#ddd]">
    <x-header />
    <main>
        @yield('content')
    </main>
    <x-footer />
    @livewireScripts
    @stack('scripts')
</body>

</html>
