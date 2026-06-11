###### Как запустить:
composer install

cp .env.example .env

./vendor/bin/sail artisan key:generate

docker compose up -d

./vendor/bin/sail artisan migrate

##### Запуск тестов:

./vendor/bin/sail artisan test
