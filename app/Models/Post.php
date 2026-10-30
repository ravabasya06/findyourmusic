<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_id',
        'title',
        'artist',
        'link',
        'description',
        'cover_image',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        return $query->when($term, function (Builder $query) use ($term) {
            $query->where(function (Builder $query) use ($term) {
                $query->where('title', 'like', "%{$term}%")
                      ->orWhere('artist', 'like', "%{$term}%");
            });
        });
    }

    public function scopeInGenre(Builder $query, ?string $slug): Builder
    {
        return $query->when($slug, function (Builder $query) use ($slug) {
            $query->whereHas('genre', fn (Builder $genre) => $genre->where('slug', $slug));
        });
    }
}
