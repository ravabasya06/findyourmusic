<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'artist' => ['required', 'string', 'max:150'],
            'genre_id' => ['required', 'exists:genres,id'],
            'link' => ['required', 'url', 'max:500'],
            'description' => ['nullable', 'string', 'max:2000'],
            'cover_image' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Enter the song title.',
            'artist.required' => 'Enter the artist or band name.',
            'genre_id.required' => 'Choose a genre.',
            'genre_id.exists' => 'Choose a genre from the list.',
            'link.required' => 'Add a link so people can listen.',
            'link.url' => 'Enter a full link that starts with https://',
            'description.max' => 'Keep the description under 2000 characters.',
            'cover_image.image' => 'Upload a JPG, PNG or other image file.',
            'cover_image.max' => 'The cover image must be 2 MB or smaller.',
        ];
    }
}
