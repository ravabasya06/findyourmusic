@php $post ??= null; @endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if ($post)
        @method('PUT')
    @endif

    <x-field label="Song title" name="title">
        <input id="title" name="title" type="text" value="{{ old('title', $post?->title) }}" required
               class="input" @error('title') aria-invalid="true" @enderror>
    </x-field>

    <x-field label="Artist or band" name="artist">
        <input id="artist" name="artist" type="text" value="{{ old('artist', $post?->artist) }}" required
               class="input" @error('artist') aria-invalid="true" @enderror>
    </x-field>

    <x-field label="Genre" name="genre_id">
        <select id="genre_id" name="genre_id" required class="input" @error('genre_id') aria-invalid="true" @enderror>
            <option value="">Choose a genre</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" @selected((string) old('genre_id', $post?->genre_id) === (string) $genre->id)>
                    {{ $genre->name }}
                </option>
            @endforeach
        </select>
    </x-field>

    <x-field label="Link to the song" name="link" hint="Paste a link from YouTube, Spotify, Bandcamp or SoundCloud.">
        <input id="link" name="link" type="url" value="{{ old('link', $post?->link) }}" required
               placeholder="https://" class="input" @error('link') aria-invalid="true" @enderror>
    </x-field>

    <x-field label="Why should people listen?" name="description" hint="Optional. Say what makes this song worth finding.">
        <textarea id="description" name="description" rows="5"
                  class="input" @error('description') aria-invalid="true" @enderror>{{ old('description', $post?->description) }}</textarea>
    </x-field>

    <x-field label="Cover image" name="cover_image"
             hint="Optional. Square JPG or PNG images look best, up to 2 MB.{{ $post?->cover_image ? ' Leave this empty to keep the current cover.' : '' }}">
        <input id="cover_image" name="cover_image" type="file" accept="image/*"
               class="block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-cobalt file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-cobalt-dark">
    </x-field>

    <div class="flex flex-wrap items-center gap-3 pt-2">
        <button type="submit" class="btn btn-primary">{{ $submit }}</button>
        <a href="{{ $post ? route('posts.show', $post) : route('posts.index') }}" class="btn btn-quiet">Cancel</a>
    </div>
</form>
