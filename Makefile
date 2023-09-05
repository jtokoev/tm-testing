PHP_CONTAINER := tm_test_php

build:
	cp .env.dist .env
	cp app/.env.dist app/.env
	cp docker-compose.override.yml.dist docker-compose.override.yml
	docker-compose up -d
	docker exec ${PHP_CONTAINER} composer install

rebuild:
	docker-compose up -d --build

db:
	docker exec ${PHP_CONTAINER} bin/console doctrine:database:drop --force
	docker exec ${PHP_CONTAINER} bin/console doctrine:database:create
	docker exec ${PHP_CONTAINER} bin/console doctrine:m:m -n -q
	docker exec ${PHP_CONTAINER} bin/console doctrine:fixtures:load  -n --append

test:
	docker exec ${PHP_CONTAINER} bin/phpunit


analyze:
	docker exec ${PHP_CONTAINER} vendor/bin/php-cs-fixer fix --using-cache=no
	docker exec ${PHP_CONTAINER} vendor/bin/psalm --no-cache


check: analyze test