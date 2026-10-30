@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <div class="mx-auto max-w-md">
        <h1 class="text-3xl font-bold sm:text-4xl">Log in</h1>
        <p class="mt-2 text-ink-soft">Welcome back. Log in to share music and manage your posts.</p>

        <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6 rounded-lg bg-paper p-6 sm:p-8">
            @csrf

            <x-field label="Email" name="email">
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                       class="input" @error('email') aria-invalid="true" @enderror>
            </x-field>

            <x-field label="Password" name="password">
                <input id="password" name="password" type="password" required autocomplete="current-password"
                       class="input" @error('password') aria-invalid="true" @enderror>
            </x-field>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="remember" class="size-4 accent-cobalt">
                Keep me logged in
            </label>

            <button type="submit" class="btn btn-primary w-full">Log in</button>
        </form>

        <p class="mt-6 text-sm text-ink-soft">
            New here? <a href="{{ route('register') }}" class="font-semibold text-cobalt hover:underline">Create an account</a>
        </p>
    </div>
@endsection
