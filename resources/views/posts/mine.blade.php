@extends('layouts.app')

@section('title', 'Your posts')

@section('content')

    <div class="flex flex-wrap items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold sm:text-4xl">Your posts</h1>
            <p class="mt-2 text-ink-soft">{{ $posts->total() }} {{ $posts->total() === 1 ? 'song' : 'songs' }} shared by you</p>
        </div>
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Share a song</a>
    </div>

    @if ($posts->isEmpty())
        <div class="mt-8 rounded-lg bg-paper p-8">
            <p class="font-semibold">You haven’t shared anything yet.</p>
            <p class="mt-1 text-ink-soft">Share your first song and it will show up here.</p>
            <a href="{{ route('posts.create') }}" class="btn btn-primary mt-5">Share your first song</a>
        </div>
    @else
        <ul class="mt-8 divide-y divide-ink/10 rounded-lg bg-paper">
            @foreach ($posts as $post)
                <li class="flex flex-wrap items-center gap-4 p-4">

                    <div class="size-14 shrink-0 overflow-hidden rounded-sm bg-cobalt">
                        @if ($post->cover_image)
                            <img src="{{ asset('storage/' . $post->cover_image) }}" alt="" class="size-full object-cover">
                        @else
                            <div class="grid size-full place-items-center font-display text-2xl font-bold text-marigold" aria-hidden="true">
                                {{ mb_strtoupper(mb_substr($post->title, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <div class="min-w-0 flex-1">
                        <a href="{{ route('posts.show', $post) }}" class="font-display text-lg font-semibold hover:text-cobalt">{{ $post->title }}</a>
                        <p class="text-sm text-ink-soft">
                            {{ collect([$post->artist, $post->genre?->name, 'shared ' . $post->created_at->format('j M Y')])->filter()->implode(', ') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-quiet">Edit</a>
                        <form method="POST" action="{{ route('posts.destroy', $post) }}"
                              onsubmit="return confirm('Delete this post? This can’t be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @endif

@endsection
