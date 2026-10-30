<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'latestPosts' => Post::with('genre')->latest()->take(8)->get(),
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }
}
