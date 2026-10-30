@extends('layouts.app')

@section('title', 'Edit ' . $post->title)

@section('content')
    <div class="max-w-xl">
        <h1 class="text-3xl font-bold sm:text-4xl">Edit post</h1>
        <p class="mt-2 text-ink-soft">Update the details for “{{ $post->title }}”.</p>

        <div class="mt-8 rounded-lg bg-paper p-6 sm:p-8">
            @include('posts._form', ['action' => route('posts.update', $post), 'submit' => 'Save changes'])
        </div>
    </div>
@endsection
