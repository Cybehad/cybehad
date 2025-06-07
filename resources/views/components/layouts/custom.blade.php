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

    @vite([ 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="antialiased">
    <!-- Navigation --> <!-- Navigation -->
    <header class="sticky top-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    <img src={{ Vite::asset('resources/img/cybehad.svg') }}  height="30" width="30"/>
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
                        <div x-data="{ open: false }" class="relative" @click.away="open ? open = false : ''">
                            <button @click="open = !open" class="flex items-center focus:outline-none">
                                <x-codicon-account
                                    class="w-8 h-8 rounded-full border-indigo-600 dark:border-indigo-400 bg-indigo-100 dark:bg-gray-800 text-indigo-600 dark:text-indigo-400" />
                                <svg class="w-4 h-4 ml-1 text-gray-500 dark:text-gray-300" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 z-50"
                                x-transition>
                                <a href="{{ route('dashboard') }}" wire:navigate
                                    class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <x-codicon-dashboard class="size-5 mr-4" />
                                    Dashboard
                                </a>
                                <a href="{{ route('settings.profile', auth()->id()) }}" wire:navigate
                                    class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <x-codicon-settings class="size-5 mr-4" />
                                    Settings
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="flex items-center w-full text-left px-4 py-2 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <x-codicon-arrow-left class="size-5 mr-4" />
                                        Logout
                                    </button>
                                </form>
                                <hr class="my-2 border-t border-gray-200 dark:border-gray-700">
                                <!-- Dark Mode Toggle Button -->
                                <button
                                    type="button"
                                    x-data="{ dark: localStorage.getItem('theme') === 'dark' || (localStorage.getItem('theme') === null && window.matchMedia('(prefers-color-scheme: dark)').matches) }"
                                    x-init="$watch('dark', val => { document.documentElement.classList.toggle('dark', val); localStorage.setItem('theme', val ? 'dark' : 'light') })"
                                    @click="dark = !dark"
                                    class="px-4 py-2 text-gray-600 flex dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none transition"
                                    aria-label="Toggle dark mode"
                                >
                                    <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!dark">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 3v1m0 16v1m8.66-13.66l-.71.71M4.05 19.07l-.71.71M21 12h-1M4 12H3m16.95 7.07l-.71-.71M4.05 4.93l-.71-.71M12 7a5 5 0 100 10 5 5 0 000-10z" />
                                    </svg>
                                    <svg class="w-6 h-6 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="dark">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" />
                                    </svg>
                                    <span x-text="dark ? 'Dark' : 'Light'"></span>
                                </button>
                            </div>
                        </div>
                    @endauth
                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button"
                        class="md:hidden text-gray-600 dark:text-gray-300 focus:outline-none">
                        <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
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
                        @guest
                            <a href="{{ route('login') }}" wire:navigate
                                class="block w-full px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Sign
                                In</a>
                            <a href="{{ route('register') }}" wire:navigate
                                class="block w-full px-3 py-2 mt-2 rounded-md text-base font-medium text-center text-white bg-indigo-600 hover:bg-indigo-700">Get
                                Started</a>
                        @endguest
                        @auth
                            <a href="{{ route('settings.profile', auth()->id()) }}" wire:navigate
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Profile</a>
                            <a href="{{ route('dashboard') }}"
                                class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full px-3 py-2 mt-2 rounded-md text-base font-medium text-center text-white bg-indigo-600 hover:bg-indigo-700">
                                    Logout
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        {{ $slot }}
    </main>
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
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"></path>
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
                        <p class="mb-2">123 Tech Street</p>
                        <p class="mb-2">San Francisco, CA 94107</p>
                        <p class="mb-2">Email: info@cybehad.com</p>
                        <p>Phone: (123) 456-7890</p>
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
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
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
        // You'll need to add the button in your HTML and implement the logic
    </script>

    @livewireScripts
</body>
</html>

