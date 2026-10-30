@extends('layouts.app')

@section('title', $post->title . ' by ' . $post->artist)

@section('content')

    <a href="{{ route('posts.index') }}" class="text-sm font-medium text-ink-soft hover:text-cobalt">Back to explore</a>

    <div class="mt-6 grid gap-10 md:grid-cols-[minmax(0,26rem)_1fr] md:gap-14">

        <x-sleeve :post="$post" initial="text-9xl" class="self-start" />

        <div>
            @if ($post->genre)
                <a href="{{ route('posts.index', ['genre' => $post->genre->slug]) }}"
                   class="inline-block rounded-full bg-marigold px-2.5 py-0.5 text-xs font-medium">{{ $post->genre->name }}</a>
            @endif

            <h1 class="mt-3 text-3xl font-bold leading-tight sm:text-5xl">{{ $post->title }}</h1>
            <p class="mt-2 text-xl text-ink-soft">{{ $post->artist }}</p>

            <p class="mt-4 text-sm text-ink-soft">
                Shared by {{ $post->user->name }} on {{ $post->created_at->format('j M Y') }}
            </p>

            @if ($post->description)
                <div class="mt-8 max-w-prose whitespace-pre-line leading-relaxed">{{ $post->description }}</div>
            @endif

            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="{{ $post->link }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary">Listen to this song</a>

                @can('update', $post)
                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-quiet">Edit post</a>
                @endcan

                @can('delete', $post)
                    <form method="POST" action="{{ route('posts.destroy', $post) }}"
                          onsubmit="return confirm('Delete this post? This can’t be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete post</button>
                    </form>
                @endcan
            </div>
        </div>
    </div>

@endsection
