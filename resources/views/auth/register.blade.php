@extends('layouts.app')

@section('title', 'Create account')

@section('content')
    <div class="mx-auto max-w-md">
        <h1 class="text-3xl font-bold sm:text-4xl">Create account</h1>
        <p class="mt-2 text-ink-soft">Join to share the songs you love and keep them all in one place.</p>

        <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6 rounded-lg bg-paper p-6 sm:p-8">
            @csrf

            <x-field label="Name" name="name">
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="input" @error('name') aria-invalid="true" @enderror>
            </x-field>

            <x-field label="Email" name="email">
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email"
                       class="input" @error('email') aria-invalid="true" @enderror>
            </x-field>

            <x-field label="Password" name="password" hint="Use at least 8 characters.">
                <input id="password" name="password" type="password" required autocomplete="new-password"
                       class="input" @error('password') aria-invalid="true" @enderror>
            </x-field>

            <x-field label="Confirm password" name="password_confirmation">
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                       class="input">
            </x-field>

            <button type="submit" class="btn btn-primary w-full">Create account</button>
        </form>

        <p class="mt-6 text-sm text-ink-soft">
            Already have an account? <a href="{{ route('login') }}" class="font-semibold text-cobalt hover:underline">Log in</a>
        </p>
    </div>
@endsection
