# FindYourMusic: setup

These files mirror a normal Laravel 12 project. Copy each folder into your project
(app/, database/, resources/, routes/). Replace files that already exist, but see the
notes on `User.php` and `DatabaseSeeder.php` below.

## 1. Tailwind

This project uses Tailwind v4 through Vite (the Laravel 12 default).
`resources/css/app.css` replaces the default one.

## 2. Commands

    php artisan migrate:fresh --seed
    php artisan storage:link
    npm install
    npm run dev
    php artisan serve

Demo login after seeding: demo@findyourmusic.test / password

## 3. Things to check

- `app/Models/User.php`: if you changed yours, only add the `posts()` relationship.
- `routes/web.php`: the order matters. The logged-in group must stay above the public posts route.
- Policies are auto-discovered, so `PostPolicy` needs no registration.

## What lives where

| Requirement          | Files |
|----------------------|-------|
| Views                | resources/views/** |
| Controllers          | app/Http/Controllers/HomeController, PostController, AuthController |
| Models               | app/Models/Genre, Post, User |
| Migrations           | database/migrations/*_create_genres_table, *_create_posts_table |
| Factories            | database/factories/GenreFactory, PostFactory |
| Seeders              | database/seeders/GenreSeeder, DatabaseSeeder |
| Validation           | app/Http/Requests/PostRequest |
| Authorization        | app/Policies/PostPolicy |
| Routes + middleware  | routes/web.php |
