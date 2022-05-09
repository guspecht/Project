## How to use

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__
- Default credentials to log in __gustavo@admin.com__ - __password__
- To run the tests we are using SQLlite for it(php artisan migrate were ran already for it), Run __php artisan test --env=testing__
