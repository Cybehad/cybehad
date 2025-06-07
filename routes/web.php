<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Livewire\Advertising\AdvertisingSpot;
use App\Livewire\Categories\CategoryForm;
use App\Livewire\Categories\CategoryList;
use App\Livewire\Comments\CommentList;
use App\Livewire\Frontend\PostShow;
use App\Livewire\PostShow as PostShowAlias; // Alias to avoid conflict
use App\Livewire\Posts\PostForm;
use App\Livewire\Posts\PostList;
use App\Livewire\PostList as PostListAlias; // Alias to avoid conflict
use App\Livewire\Products\FeaturedProducts;
use App\Livewire\Tags\TagForm;
use App\Livewire\Tags\TagList;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Volt::route('/posts', PostListAlias::class)->name('posts.index');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/services', function () {
    return view('services');
})->name('services');

Route::middleware(['auth'])->group(function () {
    Volt::route('/posts/{post}', PostShowAlias::class)->name('posts.show');
    Volt::route('/profile/{user}', PostShowAlias::class)->name('profile.show');
    Volt::route('/posts/category/{category}', PostListAlias::class)->name('posts.category');
    Volt::route('/posts/tags/{tag}', PostListAlias::class)->name('posts.tag');
    Route::get('/profile/{user}', function ($user) {
        return redirect()->route('profile.show', ['user' => $user]);
    })->name('profile.user');
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
});

// Admin Routes
Route::middleware(['auth'])
    ->prefix('admin')->group(function () {
        Route::get('/', function () {
            return redirect()->route('posts.admin.index');
        })->name('admin.dashboard');
        // Posts
        Route::get('/posts', PostList::class)->name('posts.admin.index');
        Route::get('/posts/create', PostForm::class)->name('posts.admin.create');
        Route::get('/posts/{post}/edit', PostForm::class)->name('posts.admin.edit');

        // Categories
        Route::get('/categories', CategoryList::class)->name('categories.index');
        Route::get('/categories/create', CategoryForm::class)->name('categories.create');
        Route::get('/categories/{category}/edit', CategoryForm::class)->name('categories.edit');

        // Tags
        Route::get('/tags', TagList::class)->name('tags.index');
        Route::get('/tags/create', TagForm::class)->name('tags.create');
        Route::get('/tags/{tag}/edit', TagForm::class)->name('tags.edit');

        // Comments
        Route::get('/comments', CommentList::class)->name('comments.index');

        // Advertising
        // Route::get('/advertising', AdvertisingSpot::class)->name('advertising.index');

        // Products
        Route::get('/products', FeaturedProducts::class)->name('products.index');
    });
// Route::get('/posts/{post}', PostShow::class)->name('posts.show');

require __DIR__ . '/auth.php';
