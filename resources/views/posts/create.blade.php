@extends('layouts.app')

@section('title', 'Share a song')

@section('content')
    <div class="max-w-xl">
        <h1 class="text-3xl font-bold sm:text-4xl">Share a song</h1>
        <p class="mt-2 text-ink-soft">Add a song you think more people should hear.</p>

        <div class="mt-8 rounded-lg bg-paper p-6 sm:p-8">
            @include('posts._form', ['action' => route('posts.store'), 'submit' => 'Share song'])
        </div>
    </div>
@endsection
