<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Genre;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with('genre')
            ->search($request->query('q'))
            ->inGenre($request->query('genre'))
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('posts.index', [
            'posts' => $posts,
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    public function mine(Request $request)
    {
        $posts = $request->user()
            ->posts()
            ->with('genre')
            ->latest()
            ->paginate(8);

        return view('posts.mine', ['posts' => $posts]);
    }

    public function show(Post $post)
    {
        $post->load(['user', 'genre']);

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create', [
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $post = $request->user()->posts()->create($data);

        return redirect()
            ->route('posts.show', $post)
            ->with('status', 'Song shared. Thanks for adding it.');
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return view('posts.edit', [
            'post' => $post,
            'genres' => Genre::orderBy('name')->get(),
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        Gate::authorize('update', $post);

        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        } else {
            unset($data['cover_image']);
        }

        $post->update($data);

        return redirect()
            ->route('posts.show', $post)
            ->with('status', 'Changes saved.');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }

        $post->delete();

        return redirect()
            ->route('posts.mine')
            ->with('status', 'Post deleted.');
    }
}
