# FindYourMusic

A website for sharing and discovering niche music. Users can post albums they love, browse what others have shared, and search by title, artist or genre.

Built with **Laravel 13**, **Blade** and **Tailwind CSS** as a web framework course project.

## Features

- Browse all shared music with pagination, search (title or artist) and genre filtering
- Song detail page with a link out to listen
- Register, log in and log out
- Share a song with a title, artist, genre, link, description and optional cover image
- Edit and delete your own posts only (enforced by a policy)
- "Your posts" page to manage everything you have shared
- Seeded demo data: genres, demo users and five example albums

## Tech stack

| Part      | Tool                                   |
| --------- | -------------------------------------- |
| Backend   | Laravel 13 (PHP 8.2+)                  |
| Templates | Blade views and components             |
| Styling   | Tailwind CSS v4, built with Vite       |
| Database  | SQLite (default) or MySQL              |
| Auth      | Session-based, custom `AuthController` |

## Requirements

Install these before you start:

- PHP 8.2 or newer, with the `pdo_sqlite` (or `pdo_mysql`), `mbstring`, `fileinfo` and `gd` extensions
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) 18 or newer, with npm
- MySQL 8 or MariaDB, only if you don't want to use SQLite

## Setup

### 1. Clone the project and install dependencies

```bash
git clone https://github.com/ravabasya06/findyourmusic.git
cd findyourmusic

composer install
npm install
```

### 2. Create your environment file

```bash
cp .env.example .env
php artisan key:generate
```

On Windows Command Prompt, use `copy .env.example .env` instead of `cp`.

### 3. Set up the database

Choose **one** of the two options.

**Option A: SQLite (easiest, no server needed)**

```bash
touch database/database.sqlite
```

On Windows, create an empty file named `database.sqlite` inside the `database` folder. Your `.env` should contain:

```env
DB_CONNECTION=sqlite
```

**Option B: MySQL**

Create an empty database first:

```sql
CREATE DATABASE findyourmusic CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Then edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=findyourmusic
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Create the tables and add demo data

```bash
php artisan migrate --seed
```

To wipe everything and start over at any time:

```bash
php artisan migrate:fresh --seed
```

### 5. Link the storage folder

Uploaded cover images are stored in `storage/app/public`. This command makes them reachable from the browser:

```bash
php artisan storage:link
```

### 6. Start the app

Open two terminals in the project folder.

Terminal 1, the Laravel server:

```bash
php artisan serve
```

Terminal 2, Vite (compiles Tailwind and reloads the page when you edit files):

```bash
npm run dev
```

Then open **http://127.0.0.1:8000**.

> If your `composer.json` still has the default `dev` script from a new Laravel project, `composer run dev` starts everything in one terminal.

## Demo account

After seeding, you can log in with:

| Email                     | Password   |
| ------------------------- | ---------- |
| `demo@findyourmusic.test` | `password` |

The seeder also creates four other users with random names and the password `password`.

## Seeded albums

`php artisan migrate:fresh --seed`.

## Pages and routes

| Page                        | URL                | Who can see it   |
| --------------------------- | ------------------ | ---------------- |
| Home                        | `/`                | Everyone         |
| Explore (search and filter) | `/posts`           | Everyone         |
| Song detail                 | `/posts/{id}`      | Everyone         |
| Log in                      | `/login`           | Logged-out users |
| Register                    | `/register`        | Logged-out users |
| Share a song                | `/posts/create`    | Logged-in users  |
| Edit a post                 | `/posts/{id}/edit` | The post's owner |
| Your posts                  | `/posts/mine`      | Logged-in users  |

Search and filter use query strings, for example `/posts?q=saosin&genre=post-hardcore`.

## Database structure

| Table    | Main columns                                                     | Relationships                 |
| -------- | ---------------------------------------------------------------- | ----------------------------- |
| `users`  | name, email, password                                            | has many posts                |
| `genres` | name, slug                                                       | has many posts                |
| `posts`  | user_id, genre_id, title, artist, link, description, cover_image | belongs to a user and a genre |

## Project structure

Only the files this project adds to a standard Laravel install are listed.

```
app/
  Http/
    Controllers/
      AuthController.php      register, login, logout
      HomeController.php      home page
      PostController.php      CRUD, search, "your posts"
    Requests/
      PostRequest.php         validation for creating and editing posts
  Models/
    Genre.php
    Post.php                  relationships and search/filter scopes
    User.php
  Policies/
    PostPolicy.php            only owners can edit or delete a post
database/
  factories/                  GenreFactory, PostFactory (holds the seeded albums)
  migrations/                 genres and posts tables
  seeders/                    GenreSeeder, DatabaseSeeder
resources/
  css/app.css                 Tailwind theme and shared styles
  views/
    layouts/app.blade.php     page layout, header and footer
    components/               sleeve, post-card, field
    posts/                    index, show, create, edit, mine, _form
    auth/                     login, register
    home.blade.php
routes/web.php
```

## Troubleshooting

| Problem                                            | Fix                                                                                             |
| -------------------------------------------------- | ----------------------------------------------------------------------------------------------- |
| "Vite manifest not found" error                    | Run `npm run dev` (or `npm run build`) and reload the page                                      |
| Page has no styling                                | Make sure `npm run dev` is still running                                                        |
| Cover images show as broken                        | Run `php artisan storage:link`                                                                  |
| "could not find driver"                            | Enable `pdo_sqlite` (or `pdo_mysql`) in your `php.ini` and restart the terminal                 |
| "No application encryption key has been specified" | Run `php artisan key:generate`                                                                  |
| Cover upload fails on a small image                | Check `upload_max_filesize` and `post_max_size` in `php.ini`; the app accepts images up to 2 MB |
| "419 Page Expired" on a form                       | Reload the page and try again, or run `php artisan optimize:clear`                              |
| Port 8000 is already in use                        | Run `php artisan serve --port=8001`                                                             |
| Changes to `.env` are ignored                      | Run `php artisan config:clear`                                                                  |

## Building for production

```bash
npm run build
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Set `APP_ENV=production` and `APP_DEBUG=false` in `.env` before deploying.
