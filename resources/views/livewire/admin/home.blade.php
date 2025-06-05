<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100 tracking-tight">Admin Dashboard</h1>
        <button
            x-data="{ dark: localStorage.getItem('theme') === 'dark' }"
            x-init="$watch('dark', val => { document.documentElement.classList.toggle('dark', val); localStorage.setItem('theme', val ? 'dark' : 'light') })"
            @click="dark = !dark"
            class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 px-4 py-2 rounded transition-colors duration-200 shadow hover:bg-gray-300 dark:hover:bg-gray-600"
            aria-label="Toggle dark mode"
        >
            <span x-show="!dark">🌙 Dark</span>
            <span x-show="dark">☀️ Light</span>
        </button>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-gradient-to-br from-blue-100 to-blue-300 dark:from-blue-900 dark:to-blue-700 shadow-lg rounded-xl p-8 hover:scale-105 transition-transform duration-200">
            <h2 class="text-lg font-semibold mb-2 text-blue-900 dark:text-blue-200">Users</h2>
            <p class="text-4xl font-extrabold text-blue-700 dark:text-blue-300 mb-2">1,234</p>
            <a href="{{ route('admin.users.index') }}" class="text-blue-700 dark:text-blue-300 hover:text-blue-900 dark:hover:text-blue-100 underline font-medium transition-colors duration-150">Manage Users</a>
        </div>
        <div class="bg-gradient-to-br from-green-100 to-green-300 dark:from-green-900 dark:to-green-700 shadow-lg rounded-xl p-8 hover:scale-105 transition-transform duration-200">
            <h2 class="text-lg font-semibold mb-2 text-green-900 dark:text-green-200">Posts</h2>
            <p class="text-4xl font-extrabold text-green-700 dark:text-green-300 mb-2">567</p>
            <a href="{{ route('admin.posts.index') }}" class="text-green-700 dark:text-green-300 hover:text-green-900 dark:hover:text-green-100 underline font-medium transition-colors duration-150">Manage Posts</a>
        </div>
        <div class="bg-gradient-to-br from-red-100 to-red-300 dark:from-red-900 dark:to-red-700 shadow-lg rounded-xl p-8 hover:scale-105 transition-transform duration-200">
            <h2 class="text-lg font-semibold mb-2 text-red-900 dark:text-red-200">Reports</h2>
            <p class="text-4xl font-extrabold text-red-700 dark:text-red-300 mb-2">12</p>
            <a href="{{ route('admin.reports.index') }}" class="text-red-700 dark:text-red-300 hover:text-red-900 dark:hover:text-red-100 underline font-medium transition-colors duration-150">View Reports</a>
        </div>
    </div>
        </div>
    </div>
</div>
