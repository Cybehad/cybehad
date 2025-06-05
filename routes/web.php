<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Livewire\PostList;
use App\Livewire\PostShow;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', [HomeController::class, 'index'])->name('home');
Volt::route('/posts', PostList::class)->name('posts.index');


Route::middleware(['auth'])->group(function () {
    Volt::route('/posts/{post}', PostShow::class)->name('posts.show');
    Volt::route('/posts/category/{category}', PostList::class)->name('posts.category');
    Volt::route('/posts/tags/{tag}', PostList::class)->name('posts.tag');
});
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])
    ->name(name: 'newsletter.unsubscribe');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::prefix('admin')->group(function () {
        Volt::route('/', 'admin.home')->name('admin.home');

        Volt::route('/users', 'admin.users.list')
            ->name('admin.users.index');
        Volt::route('/users/create', 'admin.users.create')
            ->name('admin.users.create');
        Volt::route('/users/{user}/show', 'admin.users.show')
            ->name('admin.users.show');
        Volt::route('/users/{user}/edit', 'admin.users.edit')
            ->name('admin.users.edit');
        Volt::route('/users/{user}/delete', 'admin.users.delete')
            ->name('admin.users.delete');

            Volt::route('/reports', 'admin.reports.list')
            ->name('admin.reports.index');

        Volt::route('/posts', 'admin.posts.list')
            ->name('admin.posts.index');

        Volt::route('/posts/create', 'admin.posts.create')
            ->name('admin.posts.create');

        Volt::route('/posts/{post}/show', 'admin.posts.show')
            ->name('admin.posts.show');

        Volt::route('/posts/{post}/edit', 'admin.posts.edit')
            ->name('admin.posts.edit');
    });
});

require __DIR__ . '/auth.php';
