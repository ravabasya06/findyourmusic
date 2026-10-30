<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            'Bossa Nova',

            // Nu Metal & Heavy Alternative
            'Nu metal', 'Alternative metal', 'Rap metal', 'Industrial metal',

            // Post-Hardcore, Metalcore & Screamo
            'Post-hardcore', 'Metalcore', 'Melodic metalcore', 'Mathcore', 'Screamo', 'Melodic hardcore', 'Emo violence',

            // Shoegaze, Math Rock, Midwest Emo & Post-Rock
            'Shoegaze', 'Nu-gaze', 'Blackgaze', 'Math rock', 'Midwest emo', 'Post-rock', 'Post-metal', 'Slowcore', 'Twinkle daddies',

            // Pop Punk & Punk Sub-genres
            'Pop punk', 'Easycore', 'Skate punk', 'Power pop',

            // City Pop, Denpa & Related Japanese / Electronic Branches
            'City pop', 'Denpa', 'Shibuya-kei', 'Kawaii metal', 'Future funk', 'Anison', 'Chiptune'
        ];

        foreach ($genres as $name) {
            Genre::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name],
            );
        }
    }
}
