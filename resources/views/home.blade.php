@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <section class="max-w-3xl">
        <h1 class="text-4xl font-bold leading-tight tracking-tight sm:text-6xl">Find the music nobody put on the charts.</h1>
        <p class="mt-5 max-w-xl text-lg text-ink-soft">
            Listeners share the songs, scenes and sounds they love most. Search by song, artist or genre, or add one of your own.
        </p>

        <form action="{{ route('posts.index') }}" method="GET" role="search" class="mt-8 flex max-w-xl gap-2">
            <label for="q" class="sr-only">Search songs or artists</label>
            <input id="q" name="q" type="search" placeholder="Search a song or artist" class="input">
            <button type="submit" class="btn btn-primary shrink-0">Search</button>
        </form>
    </section>
    @if ($genres->isNotEmpty())
        <section class="mt-14" aria-labelledby="genres-heading">
            <h2 id="genres-heading" class="text-xl font-semibold">Browse by genre</h2>
            <ul class="mt-4 flex flex-wrap gap-2">
                @foreach ($genres as $genre)
                    <li>
                        <a href="{{ route('posts.index', ['genre' => $genre->slug]) }}"
                           class="inline-block rounded-full border border-ink/25 bg-paper px-3.5 py-1.5 text-sm font-medium hover:border-cobalt hover:text-cobalt">
                            {{ $genre->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif
    <section class="mt-14" aria-labelledby="latest-heading">
        <div class="flex items-baseline justify-between gap-4">
            <h2 id="latest-heading" class="text-xl font-semibold">Latest shares</h2>
            <a href="{{ route('posts.index') }}" class="text-sm font-medium text-cobalt hover:underline">Browse all music</a>
        </div>

        @if ($latestPosts->isEmpty())
            <div class="mt-6 rounded-lg bg-paper p-8">
                <p class="font-semibold">Nothing has been shared yet.</p>
                <p class="mt-1 text-ink-soft">Be the first to add a song others should hear.</p>
                <a href="{{ route('posts.create') }}" class="btn btn-primary mt-5">Share a song</a>
            </div>
        @else
            <div class="mt-6 grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4">
                @foreach ($latestPosts as $post)
                    <x-post-card :post="$post" />
                @endforeach
            </div>
        @endif
    </section>
    @guest
        <section class="mt-16 rounded-lg bg-cobalt p-8 text-white sm:p-10">
            <h2 class="text-2xl font-bold">Got a song others should hear?</h2>
            <p class="mt-2 max-w-xl text-white/85">Create a free account to share your favorite tracks and keep them all in one place.</p>
            <a href="{{ route('register') }}" class="btn mt-6 bg-marigold text-ink hover:bg-white">Create account</a>
        </section>
    @endguest

@endsection
