QUEUE_CONNECTION=database

php artisan queue:table &&
php artisan migrate &&
php artisan queue:work