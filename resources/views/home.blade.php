<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? config('app.name') }}</title>
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
    @fluxAppearance
</head>

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#ddd]">
    <nav class="sticky top-0 z-10 py-4 bg-white shadow-md dark:bg-gray-900">
        <div class="container flex items-center justify-between px-6 mx-auto">
            <a href="#" class="text-xl font-bold text-gray-500">Cybehad</a>
            <div class="hidden space-x-6 md:flex">
                <a href="#"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-200 transition duration-300 hover:dark:text-gray-500">Services</a>
                <a href="#" class="dark:text-gray-200 transition duration-300 hover:dark:text-gray-500">About Us</a>
                <a href="#"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-200 transition duration-300 hover:dark:text-gray-500">Contact</a>
                <a href="#"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-200 transition duration-300 hover:dark:text-gray-500">Contact</a>
                <a href="#"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-200 transition duration-300 hover:dark:text-gray-500">Contact</a>
                <a href="#"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-200 transition duration-300 hover:dark:text-gray-500">Contact</a>
                <a href="#" class="dark:text-gray-200 transition duration-300 hover:dark:dark:text-gray-500">Contact</a>
            </div>
            <div class="md:hidden">
                <button id="menu-toggle" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                    <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" class="hidden w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
        <div id="mobile-menu" class="mobile-menu">
            <div class="flex flex-col px-6 py-4 space-y-2">
                <a href="#" class="block text-gray-600 transition duration-300 hover:text-gray-800">Services</a>
                <a href="#" class="block text-gray-600 transition duration-300 hover:text-gray-800">About Us</a>
                <a href="#" class="block text-gray-600 transition duration-300 hover:text-gray-800">Contact</a>
            </div>
        </div>
    </nav>
    <section class="relative py-32 text-white bg-hero dark:bg-gray-900">
        <div class="absolute inset-0 bg-black opacity-40 dark:opacity-70"></div>
        <div class="container relative z-10 px-6 mx-auto text-center">
            <h1 class="mb-6 text-5xl font-bold leading-tight md:text-6xl dark:text-white">Crafting Digital Experiences
            </h1>
            <p class="mb-12 text-xl md:text-2xl dark:text-gray-200">We build innovative software solutions for modern
                businesses.</p>
            <div class="flex justify-center space-x-4">
                <a href="#"
                    class="px-8 py-3 font-medium text-blue-500 transition duration-300 bg-white rounded-lg hover:bg-blue-100 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700">Explore
                    Our Work</a>
                <a href="#"
                    class="px-8 py-3 font-medium transition duration-300 border border-white rounded-lg hover:bg-white hover:text-blue-500 dark:hover:bg-gray-800 dark:hover:text-blue-400 dark:border-gray-600">Contact
                    Us</a>
            </div>
        </div>
    </section>
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="container px-6 mx-auto">
            <h2 class="mb-12 text-3xl font-semibold text-center text-gray-800 dark:text-gray-400">Our Services</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-8 transition duration-300 dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-12 h-12 mx-auto mb-4  text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h6m-6 0a1.5 1.5 0 011.5 1.5v16.5A1.5 1.5 0 0110.5 22.5h7.5a1.5 1.5 0 011.5-1.5V3.75a1.5 1.5 0 01-1.5-1.5h-7.5z" />
                    </svg>
                    <h3 class="mb-2 text-xl font-medium text-center text-gray-800 dark:text-gray-100">Web Development
                    </h3>
                    <p class="text-center text-gray-600 dark:text-gray-300">We build responsive and scalable web
                        applications using the latest technologies.</p>
                </div>
                <div class="p-8 transition duration-300 dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-12 h-12 mx-auto mb-4  text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.568 3h5.864a1.5 1.5 0 011.04.44l4.69 4.69a1.5 1.5 0 01.44 1.04v5.864a1.5 1.5 0 01-.44 1.04l-4.69 4.69a1.5 1.5 0 01-1.04.44H9.568a1.5 1.5 0 01-1.04-.44l-4.69-4.69a1.5 1.5 0 01-.44-1.04V9.568a1.5 1.5 0 01.44-1.04l4.69-4.69a1.5 1.5 0 011.04-.44z" />
                    </svg>
                    <h3 class="mb-2 text-xl font-medium text-center text-gray-800 dark:text-gray-100">Mobile App
                        Development</h3>
                    <p class="text-center text-gray-600 dark:text-gray-300">We create native mobile apps for iOS and
                        Android platforms.</p>
                </div>
                <div class="p-8 transition duration-300 dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-12 h-12 mx-auto mb-4  text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 4.5 4.5 4.5m-4.5-9l4.5 4.5m-9 9l4.5 4.5" />
                    </svg>
                    <h3 class="mb-2 text-xl font-medium text-center text-gray-800 dark:text-gray-100">UI/UX Design</h3>
                    <p class="text-center text-gray-600 dark:text-gray-300">We design intuitive and user-friendly
                        interfaces that enhance user experience.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-12 bg-white dark:bg-gray-900">
        <div class="container mx-auto px-6 text-center">
            <h2 class="mb-8 text-3xl font-bold text-gray-800 dark:text-gray-100">Our Key Features</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="p-6 transition duration-300 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg">
                    <i class="mb-4 text-4xl text-indigo-600 dark:text-indigo-400 fas fa-chart-line"></i> <svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="inline-block w-6 h-6 mb-4 text-indigo-600 dark:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>

                    <h3 class="mb-2 text-xl font-medium text-gray-800 dark:text-gray-100">Data Analytics</h3>
                    <p class="text-gray-600 dark:text-gray-300">Gain valuable insights from your data with our powerful
                        analytics tools.
                    </p>
                </div>
                <div class="p-6 transition duration-300 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="inline-block w-6 h-6 mb-4 text-indigo-600 dark:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>

                    <h3 class="mb-2 text-xl font-medium text-gray-800 dark:text-gray-100">Security</h3>
                    <p class="text-gray-600 dark:text-gray-300">We prioritize the security of your data with advanced
                        encryption and
                        protection measures.</p>
                </div>
                <div class="p-6 transition duration-300 bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="inline-block w-6 h-6 mb-4 text-indigo-600 dark:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h6m-6 0a1.5 1.5 0 011.5 1.5v16.5A1.5 1.5 0 0110.5 22.5h7.5a1.5 1.5 0 011.5-1.5V3.75a1.5 1.5 0 01-1.5-1.5h-7.5z" />
                    </svg>

                    <h3 class="mb-2 text-xl font-medium text-gray-800 dark:text-gray-100">Scalability</h3>
                    <p class="text-gray-600 dark:text-gray-300">Our solutions are designed to scale with your business
                        as you grow.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Featured Blog Posts Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="container px-6 mx-auto">
            <h2 class="mb-12 text-3xl font-semibold text-center text-gray-800 dark:text-gray-100">Latest Blog Posts</h2>
            <div class="grid grid-cols-2 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($featuredPosts as $post)
                    <div
                        class="overflow-hidden transition duration-300 bg-white rounded-lg shadow-md dark:bg-gray-700 hover:shadow-lg">
                        @if($post->image)
                            <img src="{{ asset($post->image) }}" alt="{{ $post->title }}"
                                class="object-cover w-full h-28 md:h-48">
                        @endif
                        <div class="p-6">
                            <div class="flex items-center mb-2 text-sm text-gray-500 dark:text-gray-300">
                                <span>{{ \Carbon\Carbon::parse($post->published_at)->format('d, M, Y') }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $post->category->name }}</span>
                            </div>
                            <h3 class="mb-2 text-xl font-semibold text-gray-800 dark:text-white">
                                <a href="{{ route('posts.show', $post->id) }}"
                                    wire:navigate>{{ Str::limit(value: $post->title, limit: 15, end: '...') }}</a>
                            </h3>
                            <p class="mb-4 text-gray-600 dark:text-gray-300">
                                {{ Str::limit(value: $post->excerpt, limit: 50) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <a href="{{ route('posts.show', $post->id) }}" wire:navigate
                                    class="text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">Read
                                    More</a>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                    <span class="ml-1 text-sm text-gray-600 dark:text-gray-300">
                                        {{ number_format($post->ratings_avg_rating, 1) }} ({{ $post->ratings_count }})
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 text-center">
                <a href="{{ route('posts.index') }}" wire::navigate
                    class="px-6 py-3 font-medium text-white transition duration-300 bg-indigo-600 rounded-lg hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                    View All Posts
                </a>
            </div>
        </div>
    </section>

    <!-- Popular Categories Section -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="container px-6 mx-auto">
            <h2 class="mb-12 text-3xl font-semibold text-center text-gray-800 dark:text-gray-100">Browse By Category
            </h2>
            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6">
                @foreach($popularCategories as $category)
                    <a href="{{ route('posts.category', $category->id) }}" wire:navigate
                        class="p-4 transition duration-300 bg-gray-100 rounded-lg dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700">
                        <div class="text-2xl text-center text-indigo-600 dark:text-indigo-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block w-8 h-8" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <h3 class="mt-2 text-sm font-medium text-center text-gray-800 dark:text-gray-200">
                            {{ $category->name }}
                        </h3>
                        <p class="mt-1 text-xs text-center text-gray-500 dark:text-gray-400">{{ $category->posts_count }}
                            posts</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter Subscription -->
    @if(session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="py-16 bg-indigo-50 dark:bg-gray-800">
        <div class="container px-6 mx-auto">
            <div class="max-w-3xl p-8 mx-auto text-center bg-white rounded-lg shadow-md dark:bg-gray-700">
                <h2 class="mb-4 text-2xl font-bold text-gray-800 dark:text-white">Stay Updated</h2>
                <p class="mb-6 text-gray-600 dark:text-gray-300">Subscribe to our newsletter to receive the latest blog
                    posts and company news.</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST"
                    class="flex flex-col sm:flex-row gap-4">
                    @csrf
                    <input type="email" name="email" placeholder="Your email address" required
                        class="flex-grow px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-600 dark:border-gray-500 dark:text-white">
                    <button type="submit"
                        class="px-6 py-2 font-medium text-white transition duration-300 bg-indigo-600 rounded-lg hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600">
                        Subscribe
                    </button>
                </form>
                <p class="mt-4 text-xs text-gray-500 dark:text-gray-400">We respect your privacy. Unsubscribe at any
                    time.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="container px-6 mx-auto">
            <h2 class="mb-12 text-3xl font-semibold text-center text-gray-800 dark:text-gray-100">What Our Readers Say
            </h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="p-6 transition duration-300 bg-gray-50 rounded-lg dark:bg-gray-800 hover:shadow-md">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User"
                            class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-medium text-gray-800 dark:text-white">Sarah Johnson</h4>
                            <div class="flex">
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                        </path>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300">"The technical articles are incredibly detailed and
                        helped me solve a complex problem at work. Highly recommended!"</p>
                </div>
                <!-- Add 2 more testimonials -->
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-indigo-600 dark:bg-indigo-700">
        <div class="container px-6 mx-auto text-center">
            <h2 class="mb-6 text-3xl font-bold text-white">Ready to Dive Deeper?</h2>
            <p class="mb-8 text-xl text-indigo-100">Explore our comprehensive blog archive with hundreds of technical
                articles.</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('posts.index') }}"
                    class="px-8 py-3 font-medium text-indigo-600 transition duration-300 bg-white rounded-lg hover:bg-indigo-50">
                    Browse All Posts
                </a>
                <a href="{{ route('register') }}"
                    class="px-8 py-3 font-medium text-white transition duration-300 border border-white rounded-lg hover:bg-indigo-700">
                    Join Our Community
                </a>
            </div>
        </div>
    </section>

    <x-footer />
</body>

</html>