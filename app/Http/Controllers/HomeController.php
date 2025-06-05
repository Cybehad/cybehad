<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts = Post::published()
            ->with(['category', 'ratings'])
            ->withAvg('ratings', 'rating')
            ->withCount('ratings')
            ->latest('published_at')
            ->take(6)
            ->get();

        $popularCategories = Category::withCount('posts')
            ->orderByDesc('posts_count')
            ->take(6)
            ->get();

        return view('home', compact('featuredPosts', 'popularCategories'));
    }
}
