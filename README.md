-   User Management Docs

1. Open terminal
2. Run `git clone https://github.com/karlebh/api-laravel.git`
3. cd into the application with `cd api-laravel`
4. Run `composer i`
5. Make sure you are have php and any sql client install, i'd suggest xampp or laragon
6. Open the sql client and create a database, say, `api_laravel`
7. Copy the database name to your .env file like so `DB_DATABASE=api_laravel`. Then the username and password can be left like so `DB_USERNAME=root`, `DB_PASSWORD=`.
8. Run `php artisan api:prepare`. This is an artisan command that prepares your app by running the migration, seeding the database and starting the server.

-   Test Runing

Run `php artisan test` to run the test.
