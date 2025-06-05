<footer {{ $attributes->merge(['class'=>'w-full px-4 bg-gray-200 dark:bg-gray-900 max-w-container sm:px-6 lg:px-8']) }} aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="mb-8">
        <hr class="mt-2 border-t border-gray-100">
        <div class="grid grid-cols-2 mt-10 gap-x-8 gap-y-10 lg:grid-cols-4">
            <div>
                <a href="{{ env('APP_URL') }}">
                    <img class="h-8 w-8 rounded-full border text-indigo-800" src="/ppu.svg?color=indigo&shade=600" alt="{{ env('APP_NAME') }}">
                </a>
                <p class="max-w-2xl mt-4 dark:text-gray-200 text-sm/6">
                    We [{{ env('APP_NAME') }}] specialize in building computer software products. The perfect starting point for your next experience.</p>
                <div class="dark:text-gray-200 my-4 space-x-2">
                    <a target="_blank" href="https://www.facebook.com/cybehad"><i class="bx bxl-facebook"></i></a>
                    <a target="_blank" href="https://www.x.com/cybehad"><i class="bx bxl-twitter"></i></a>
                    <a target="_blank" href="https://www.youtube.com/cybehad"><i class="bx bxl-youtube"></i></a>
                    <a target="_blank" href="https://www.instagram.com/cybehad"><i class="bx bxl-instagram"></i></a>
                </div>
            </div>
            <div><h3 class="font-semibold dark:text-gray-200 text-sm/6">Information</h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li class="group">
                        <a class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5" href="{{ __('home.about') }}">About Us</a>
                    </li>
                    <li class="group">
                        <a class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5" href="{{ __('home.location') }}">Location</a>
                    </li>
                    <li class="group">
                        <a class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5" href="{{ __('home.privacy') }}">Privacy Policy</a>
                    </li>
                    <li class="group">
                        <a class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5" href="{{ __('home.terms') }}">Terms & Conditions</a>
                    </li>
{{--                    <li class="group">--}}
{{--                        <a class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5"--}}
{{--                           href="/components#product-application-ui">Browse all <span>→</span></a>--}}
{{--                    </li>--}}
                </ul>
            </div>
            <div><h3 class="font-semibold dark:text-gray-200 text-sm/6">Support</h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li class="group"><a
                            class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5"
                            href="/faqs">Faqs</a></li>
                    <li class="group"><a
                            class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5"
                            href="/contact">Contact Us</a></li>
                    <li class="group"><a
                            class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5"
                            href="{{ __('home.contact') }}">Feedback & Support</a></li>
                </ul>
            </div>
            <div><h3 class="font-semibold dark:text-gray-200 text-sm/6">Resource</h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li class="group"><a class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5"                            href="/blog">Blog</a></li>
                    <li class="group"><a class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5" href="/learning">Learning</a></li>
                    <li class="group"><a class="text-sm/6 dark:text-gray-200 group-last:text-slate-400 hover:text-gray-400 group-last:[&>span]:inline-block group-last:[&>span]:transition hover:group-last:[&>span]:translate-x-0.5" href="/ads">Advertisement</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div
        class="grid justify-between grid-cols-1 gap-4 py-6 border-t border-gray-100 items-centers md:grid-cols-2">
        <p class="text-sm/6 text-slate-500 max-md:text-center">© 2025 {{  env('APP_NAME') }} | All rights reserved.</p>
        <div class="flex items-center justify-center space-x-4 font-semibold text-sm/6 text-slate-500 md:justify-end">
            <a href="{{ __('home.privacy') }}">Privacy policy</a>
            <div class="w-px h-4 bg-slate-200"></div>
            <a href="{{ __('home.terms') }}">Terms & Conditions</a></div>
    </div>
</footer>
