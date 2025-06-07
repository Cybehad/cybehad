<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet">

    <!-- Styles -->
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #6366f1;
            --dark: #1e293b;
            --light: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            transition: all 0.3s ease;
        }

        .dark body {
            background-color: #0f172a;
            color: #e2e8f0;
        }

        .gradient-bg {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .mobile-menu.open {
            max-height: 500px;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased">
    <!-- Navigation -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">Cybehad</span>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#"
                        class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Services</a>
                    <a href="#"
                        class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Solutions</a>
                    <a href="#"
                        class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Blog</a>
                    <a href="#"
                        class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">About</a>
                    <a href="#"
                        class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 font-medium transition">Contact</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-4">
                    @guest
                    <a href="{{ route('login') }}" wire:navigate
                        class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition whitespace-nowrap">Sign
                        In</a>
                    <a href="{{ route('register') }}" wire:navigate
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-md transition">Register</a>
                    @endguest
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center focus:outline-none">
                            <svg class="w-8 h-8 rounded-full border-2 border-indigo-600 dark:border-indigo-400 bg-indigo-100 dark:bg-indigo-700 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2a1 1 0 001 1h14a1 1 0 001-1v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                            <svg class="w-4 h-4 ml-1 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 z-50"
                            x-transition>
                            <a href="{{ route('settings.profile', auth()->id()) }}" wire:navigate
                                class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Profile
                            </a>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6m-6 0v6m0 0H7m6 0h6" />
                                </svg>
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex items-center w-full text-left px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <svg class="w-5 h-5 mr-2 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                        {{-- <a href="{{ route('profile.show', auth()->id()) }}" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                            {{ auth()->user()->name }}
                        </a>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <button type="submit" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                Logout
                            </button>
                        </form> --}}
                    @endauth
                <!-- Dark Mode Toggle Button -->
                <button id="dark-mode-toggle" type="button" class="md:ml-4 md:mr-0 text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none transition" aria-label="Toggle dark mode">
                    <svg id="dark-mode-icon-sun" class="w-6 h-6 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 3v1m0 16v1m8.66-13.66l-.71.71M4.05 19.07l-.71.71M21 12h-1M4 12H3m16.95 7.07l-.71-.71M4.05 4.93l-.71-.71M12 7a5 5 0 100 10 5 5 0 000-10z" />
                    </svg>
                    <svg id="dark-mode-icon-moon" class="w-6 h-6 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
                    </svg>
                </button>
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden text-gray-600 dark:text-gray-300 focus:outline-none">
                    <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="mobile-menu md:hidden bg-white dark:bg-gray-800">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="#"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-700">Services</a>
                    <a href="#"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-700">Solutions</a>
                    <a href="#"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-700">Blog</a>
                    <a href="#"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-700">About</a>
                    <a href="#"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-700">Contact</a>
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('login') }}" wire:navigate
                            class="block w-full px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Sign
                            In</a>
                        <a href="{{ route('register') }}" wire:navigate
                            class="block w-full px-3 py-2 mt-2 rounded-md text-base font-medium text-center text-white bg-indigo-600 hover:bg-indigo-700">Get
                            Started</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative gradient-bg text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-900/30 to-purple-900/30"></div>
        </div>
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                    Crafting Digital Experiences That Matter
                </h1>
                <p class="text-xl sm:text-2xl text-indigo-100 max-w-2xl mx-auto mb-10">
                    We build innovative software solutions that help businesses thrive in the digital age.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#"
                        class="px-8 py-3 font-medium text-indigo-600 bg-white rounded-lg hover:bg-gray-50 transition duration-300">
                        Explore Our Work
                    </a>
                    <a href="#"
                        class="px-8 py-3 font-medium text-white border border-white rounded-lg hover:bg-white/10 transition duration-300">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
        <div
            class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white dark:from-gray-900 to-transparent">
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-sm font-semibold tracking-wider text-indigo-600 uppercase">What We Offer</span>
                <h2 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                    Our Comprehensive Services
                </h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    We provide end-to-end digital solutions tailored to your business needs.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
                    <div
                        class="w-14 h-14 flex items-center justify-center bg-indigo-50 dark:bg-gray-700 rounded-lg mb-6">
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Web Development</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Custom, responsive websites built with modern technologies to ensure performance and
                        scalability.
                    </p>
                </div>

                <!-- Service 2 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
                    <div
                        class="w-14 h-14 flex items-center justify-center bg-indigo-50 dark:bg-gray-700 rounded-lg mb-6">
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">Mobile App Development</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Native and cross-platform mobile applications designed for iOS and Android platforms.
                    </p>
                </div>

                <!-- Service 3 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden p-8">
                    <div
                        class="w-14 h-14 flex items-center justify-center bg-indigo-50 dark:bg-gray-700 rounded-lg mb-6">
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">UI/UX Design</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Beautiful, intuitive interfaces that enhance user experience and drive engagement.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-sm font-semibold tracking-wider text-indigo-600 uppercase">Why Choose Us</span>
                <h2 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                    Key Differentiators
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-md p-8">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-indigo-50 dark:bg-gray-700 rounded-lg p-3">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="ml-4 text-lg font-semibold text-gray-900 dark:text-white">Data-Driven Approach</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">
                        We leverage analytics to make informed decisions and continuously optimize your digital
                        solutions.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-md p-8">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-indigo-50 dark:bg-gray-700 rounded-lg p-3">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="ml-4 text-lg font-semibold text-gray-900 dark:text-white">Enterprise Security</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">
                        Your data is protected with industry-leading security protocols and encryption standards.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-md p-8">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 bg-indigo-50 dark:bg-gray-700 rounded-lg p-3">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                        </div>
                        <h3 class="ml-4 text-lg font-semibold text-gray-900 dark:text-white">Future-Proof Solutions</h3>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">
                        Our architectures are designed to scale seamlessly as your business grows and evolves.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-sm font-semibold tracking-wider text-indigo-600 uppercase">From Our Blog</span>
                <h2 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                    Latest Articles
                </h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Insights, tutorials, and industry trends from our team of experts.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredPosts as $post)
                    <article class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                        @if($post->image)
                            <div class="h-48 overflow-hidden">
                                <img src="{{ asset($post->image) }}" alt="{{ $post->title }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $post->readingStats?->estimated_reading_time ?? 5 }} min read</span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-3">
                                <a href="{{ route('posts.show', $post) }}"
                                    class="hover:text-indigo-600 dark:hover:text-indigo-400 transition">
                                    {{ Str::limit($post->title, 60) }}
                                </a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                {{ Str::limit($post->excerpt, 120) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <a href="{{ route('posts.show', $post) }}"
                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium text-sm transition">
                                    Read more →
                                </a>
                                <div class="flex items-center">
                                    <div class="flex -space-x-2">
                                        <img class="w-8 h-8 rounded-full border-2 border-white dark:border-gray-800"
                                            src="{{ $post->user->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) . '&background=random' }}"
                                            alt="{{ $post->user->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('posts.index') }}"
                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition">
                    View All Articles
                </a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800/50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                    Browse By Category
                </h2>
                <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                    Explore our content organized by topics and technologies.
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($popularCategories as $category)
                    <a href="{{ route('posts.category', $category) }}"
                        class="group card-hover bg-white dark:bg-gray-800 rounded-lg p-4 text-center shadow-sm transition">
                        <div
                            class="mx-auto h-12 w-12 flex items-center justify-center rounded-full bg-indigo-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400 mb-3 group-hover:bg-indigo-100 dark:group-hover:bg-gray-600 transition">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4">
                                </path>
                            </svg>
                        </div>
                        <h3
                            class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                            {{ $category->name }}
                        </h3>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">{{ $category->posts_count }} posts</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-sm font-semibold tracking-wider text-indigo-600 uppercase">Testimonials</span>
                <h2 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                    What Our Clients Say
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <img class="w-12 h-12 rounded-full" src="https://randomuser.me/api/portraits/women/43.jpg"
                            alt="Sarah Johnson">
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900 dark:text-white">Sarah Johnson</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">CTO, TechCorp</p>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">
                        "The team at Cybehad transformed our digital presence with their innovative approach and
                        technical expertise. Our engagement metrics have doubled since launch."
                    </p>
                </div>

                <!-- Testimonial 2 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <img class="w-12 h-12 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg"
                            alt="Michael Chen">
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900 dark:text-white">Michael Chen</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Product Manager, InnovateCo</p>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">
                        "Working with Cybehad was a game-changer for our mobile app. Their attention to detail and user
                        experience focus resulted in a 40% increase in user retention."
                    </p>
                </div>

                <!-- Testimonial 3 -->
                <div class="card-hover bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <img class="w-12 h-12 rounded-full" src="https://randomuser.me/api/portraits/women/65.jpg"
                            alt="Emily Rodriguez">
                        <div class="ml-4">
                            <h4 class="font-semibold text-gray-900 dark:text-white">Emily Rodriguez</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Director of Digital, GlobalRetail</p>
                        </div>
                    </div>
                    <div class="flex mb-3">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">
                        "Cybehad's technical articles helped our team solve complex challenges. Their expertise is
                        unmatched in the industry."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-indigo-600 dark:bg-indigo-700">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                <div class="md:flex">
                    <div
                        class="md:flex-shrink-0 md:w-1/3 bg-indigo-500 dark:bg-indigo-600 flex items-center justify-center p-8">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="p-8 md:w-2/3">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Stay Updated</h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-6">Subscribe to our newsletter for the latest
                            articles, tutorials, and company news.</p>

                        @if(session('success'))
                            <div
                                class="mb-4 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-100 rounded-lg">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <input type="email" name="email" placeholder="Your email address" required
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit"
                                class="w-full px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition">
                                Subscribe
                            </button>
                        </form>
                        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                            We respect your privacy. Unsubscribe at any time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gray-900 text-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Transform Your Digital Presence?</h2>
            <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-8">
                Let's discuss how we can help you achieve your business goals with cutting-edge technology solutions.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('contact') }}"
                    class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition">
                    Get in Touch
                </a>
                <a href="{{ route('services') }}"
                    class="px-8 py-3 bg-white hover:bg-gray-100 text-gray-900 font-medium rounded-lg transition">
                    Explore Services
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Cybehad</h3>
                    <p class="mb-4">
                        Building innovative digital solutions that drive business growth and enhance user experiences.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                                </path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z">
                                </path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Home</a></li>
                        <li><a href="#" class="hover:text-white transition">Services</a></li>
                        <li><a href="#" class="hover:text-white transition">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Services</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Web Development</a></li>
                        <li><a href="#" class="hover:text-white transition">Mobile App Development</a></li>
                        <li><a href="#" class="hover:text-white transition">UI/UX Design</a></li>
                        <li><a href="#" class="hover:text-white transition">Cloud Solutions</a></li>
                        <li><a href="#" class="hover:text-white transition">DevOps</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Contact Us</h3>
                    <address class="not-italic">
                        <p class="mb-2">William Street</p>
                        <p class="mb-2">Kampala, Uganda</p>
                        <p class="mb-2">Email: infor@cybehad.com</p>
                        <p>Phone: +256 705 767569</p>
                    </address>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-12 pt-8 text-center text-sm">
                <p>&copy; {{ date('Y') }} Cybehad. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('open');

            const icon = this.querySelector('svg');
            const closeIcon = this.querySelector('svg + svg');

            if (menu.classList.contains('open')) {
                icon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                icon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
        });

        // Dark mode toggle (if you want to add a toggle button)
        // On page load, set dark mode based on localStorage
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else if (localStorage.getItem('theme') === 'light') {
            document.documentElement.classList.remove('dark');
        }
        document.getElementById('dark-mode-toggle').addEventListener('click', function () {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
    </script>

    @livewireScripts
</body>

</html>
