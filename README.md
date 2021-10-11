## Para configurar e executar :

composer install
npm install
touch database/database.sqlite
php artisan migrate:refresh --seed

## Para executar os testes execute:

touch database/test.sqlite
composer test_unit