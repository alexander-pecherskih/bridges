include .env

up: docker-up
init: docker-down docker-pull docker-build docker-up project-init
down: docker-down

project-init: install oauth-keys migrate fixtures

clear:
	docker-compose run --rm php-cli php bin/console cache:clear

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

install:
	docker-compose run --rm php-cli composer install

update:
	docker-compose run --rm php-cli composer update

lint:
	docker-compose run --rm php-cli composer lint
	docker-compose run --rm php-cli composer cs-check

analyze:
	docker-compose run --rm php-cli composer psalm

diff:
	docker-compose run --rm php-cli php bin/console doctrine:migrations:diff

migrate:
	docker-compose run --rm php-cli php bin/console doctrine:migrations:migrate --no-interaction

fixtures:
	docker-compose run --rm php-cli php bin/console doctrine:fixtures:load --no-interaction

oauth-keys:
	docker-compose run --rm php-cli mkdir -p var/oauth
	docker-compose run --rm php-cli openssl genrsa -out var/oauth/private.key 2048
	docker-compose run --rm php-cli openssl rsa -in var/oauth/private.key -pubout -out var/oauth/public.key
	docker-compose run --rm php-cli chmod 644 var/oauth/private.key var/oauth/public.key

test:
	docker-compose run --rm php-cli php bin/phpunit

### FRONTEND ###

frontend-clear:
	docker run --rm -v ${PWD}/frontend:/app -w /app alpine sh -c 'rm -rf .ready build coverage'

frontend-init: frontend-yarn-install frontend-ready

frontend-yarn-install:
	docker-compose run --rm frontend-node-cli yarn install

frontend-ready:
	docker run --rm -v ${PWD}/frontend:/app -w /app alpine touch .ready

frontend-lint:
	docker-compose run --rm frontend-node-cli yarn eslint

frontend-lint-fix:
	docker-compose run --rm frontend-node-cli yarn eslint-fix

frontend-test:
	docker-compose run --rm frontend-node-cli yarn test

frontend-test-watch:
	docker-compose run --rm frontend-node-cli yarn test-watch
