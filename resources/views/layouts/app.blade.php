<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Music you won’t hear on the charts') | FindYourMusic</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,700&family=DM+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col">

    <header class="border-b border-ink/10 bg-paper">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-x-6 gap-y-3 px-4 py-4 sm:px-6">

            <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                <span class="disc size-8" aria-hidden="true"></span>
                <span class="font-display text-xl font-bold tracking-tight">FindYourMusic</span>
            </a>

            <nav class="flex flex-wrap items-center gap-x-5 gap-y-2 text-sm font-medium" aria-label="Main">
                <a href="{{ route('posts.index') }}"
                   @if (request()->routeIs('posts.index')) aria-current="page" @endif
                   class="hover:text-cobalt {{ request()->routeIs('posts.index') ? 'text-cobalt' : '' }}">Explore</a>

                @auth
                    <a href="{{ route('posts.mine') }}"
                       @if (request()->routeIs('posts.mine')) aria-current="page" @endif
                       class="hover:text-cobalt {{ request()->routeIs('posts.mine') ? 'text-cobalt' : '' }}">Your posts</a>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Share a song</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-cobalt">Log out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-cobalt">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Create account</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto w-full max-w-6xl flex-1 px-4 py-10 sm:px-6">
        @if (session('status'))
            <div role="status" class="mb-8 rounded-md border-l-4 border-cobalt bg-paper px-4 py-3 text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-ink/10 py-6">
        <p class="mx-auto max-w-6xl px-4 text-sm text-ink-soft sm:px-6">FindYourMusic is where listeners share the songs they love most.</p>
    </footer>

</body>
</html>
