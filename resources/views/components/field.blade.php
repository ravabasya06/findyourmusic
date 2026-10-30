@props(['label', 'name', 'hint' => null])

<div>
    <label for="{{ $name }}" class="block text-sm font-semibold">{{ $label }}</label>

    @if ($hint)
        <p class="mt-0.5 text-sm text-ink-soft">{{ $hint }}</p>
    @endif

    <div class="mt-1.5">
        {{ $slot }}
    </div>

    @error($name)
        <p class="mt-1.5 text-sm text-brick">{{ $message }}</p>
    @enderror
</div>
