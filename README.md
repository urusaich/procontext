###### Как запустить:
composer install

cp .env.example .env

php artisan key:generate

docker compose up -d

php artisan migrate
