@props(['post'])

<article class="group">
    <a href="{{ route('posts.show', $post) }}" class="block">
        <x-sleeve :post="$post" />
        <h3 class="mt-3 text-lg font-semibold leading-snug group-hover:text-cobalt">{{ $post->title }}</h3>
        <p class="text-sm text-ink-soft">{{ $post->artist }}</p>
    </a>

    @if ($post->genre)
        <a href="{{ route('posts.index', ['genre' => $post->genre->slug]) }}"
           class="mt-2 inline-block rounded-full bg-marigold px-2.5 py-0.5 text-xs font-medium">{{ $post->genre->name }}</a>
    @endif
</article>
