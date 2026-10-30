@extends('layouts.app')

@section('title', 'Explore music')

@section('content')

    <h1 class="text-3xl font-bold sm:text-4xl">Explore music</h1>

    <form method="GET" action="{{ route('posts.index') }}" role="search"
          class="mt-6 grid gap-3 sm:grid-cols-[1fr_14rem_auto]">
        <div>
            <label for="q" class="sr-only">Search songs or artists</label>
            <input id="q" name="q" type="search" value="{{ request('q') }}" placeholder="Search a song or artist" class="input">
        </div>

        <div>
            <label for="genre" class="sr-only">Genre</label>
            <select id="genre" name="genre" class="input">
                <option value="">All genres</option>
                @foreach ($genres as $genre)
                    <option value="{{ $genre->slug }}" @selected(request('genre') === $genre->slug)>{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="btn btn-primary">Search</button>
            @if (request()->hasAny(['q', 'genre']))
                <a href="{{ route('posts.index') }}" class="btn btn-quiet">Clear</a>
            @endif
        </div>
    </form>

    <p class="mt-6 text-sm text-ink-soft">
        {{ $posts->total() }} {{ $posts->total() === 1 ? 'song' : 'songs' }} found
    </p>
    
    @if ($posts->isEmpty())
        <div class="mt-4 rounded-lg bg-paper p-8">
            <p class="font-semibold">No songs match that search.</p>
            <p class="mt-1 text-ink-soft">Try a different genre or spelling, or share the song yourself.</p>
            <a href="{{ route('posts.create') }}" class="btn btn-primary mt-5">Share a song</a>
        </div>
    @else
        <div class="mt-6 grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-3 lg:grid-cols-4">
            @foreach ($posts as $post)
                <x-post-card :post="$post" />
            @endforeach
        </div>

        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    @endif

@endsection
