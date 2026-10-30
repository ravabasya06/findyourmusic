<?php

namespace Database\Seeders;

use App\Models\Genre;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(GenreSeeder::class);

        $demo = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@findyourmusic.test',
            'password' => 'password',
        ]);

        $users = User::factory(5)->create()->push($demo);

        Post::factory(30)
            ->recycle($users)
            ->recycle(Genre::all())
            ->create();
    }
}
