# FindYourMusic: setup

## 1. Create the project and copy the files
```bash
composer create-project laravel/laravel findyourmusic
```
Copy everything from this folder into the project (`app/`, `database/`, `resources/`, `routes/`).
Overwrite `routes/web.php` and `database/seeders/DatabaseSeeder.php`.

## 2. Add the posts relationship to `app/Models/User.php`
```php
use Illuminate\Database\Eloquent\Relations\HasMany;

public function posts(): HasMany
{
    return $this->hasMany(Post::class);
}
```

## 3. Configure the database in `.env`
Quickest option is SQLite (Laravel's default). For MySQL, set `DB_CONNECTION=mysql`,
`DB_DATABASE`, `DB_USERNAME` and `DB_PASSWORD`.

## 4. Run it
```bash
php artisan storage:link
php artisan migrate:fresh --seed
npm install
npm run dev          # keep this running
php artisan serve    # in a second terminal
```
Demo login: `test@example.com` / `password`

## Assignment checklist
| Requirement | Where |
|---|---|
| View | `resources/views/**` (layout, components, pages) |
| Controller | `PostController` (resource CRUD), `AuthController`, `HomeController` |
| Model | `Post`, `Genre`, `User` (relationships and query scopes) |
| DB + migration | `create_genres_table`, `create_posts_table` |
| Factory (+ seeder) | `PostFactory`, `GenreFactory`, `GenreSeeder`, `DatabaseSeeder` |
| CRUD | create, read, update, delete on `posts` |
| Extra Laravel features | Form Requests, Policy, auth middleware, route model binding, eager loading, query scopes, pagination, file uploads |
