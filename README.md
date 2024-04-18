-   User Management Docs

1. open your terminal
2. install from github instructions
3. cd into the application with `cd api-laravel`
4. run `composer i`
5. Make sure you are have php and any sql client install, i'd suggest xampp or laragon
6. Open the sql client and create a database, say, `api_laravel`
7. Copy the database name to your .env file like so `DB_DATABASE=api_laravel`. Then the username and password can be left like so `DB_USERNAME=root`, `DB_PASSWORD=`.
8. run `php artisan api:prepare`. This is an artisan command that prepares your app by running the migration, seeding the database and starting the server.

However, if you want thees steps independently, you can do this, this and this to run migration, seed database and start server.

-   Test Runing

run `php artisan test` to run the test.
