git pull https://github.com/maxialvareez/TodoList.git
cp .env.example .env
php artisan key:generate
composer install --no-dev --optimize-autoloader
php artisan optimize
php artisan route:cache
php artisan cache:clear
php artisan migrate