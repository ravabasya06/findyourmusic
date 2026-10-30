@props(['post', 'initial' => 'text-6xl'])

<div {{ $attributes->merge(['class' => 'relative']) }}>
    <div class="disc absolute right-0 top-[4%] aspect-square w-[88%] motion-safe:transition-transform motion-safe:duration-300 motion-safe:group-hover:translate-x-[5%]" aria-hidden="true"></div>

    <div class="relative z-10 aspect-square w-[88%] overflow-hidden rounded-sm bg-cobalt">
        @if ($post->cover_image)
            <img src="{{ asset('storage/' . $post->cover_image) }}"
                 alt="Cover art for {{ $post->title }} by {{ $post->artist }}"
                 class="size-full object-cover" loading="lazy">
        @else
            <img src="{{ asset('images/albumPlaceholder.png') }}"
                 alt="Cover art for {{ $post->title }} by {{ $post->artist }}"
                 class="size-full object-cover" loading="lazy">
        @endif
    </div>
</div>
