include .env

up: docker-up
init: docker-down docker-pull docker-build docker-up init-all
down: docker-down

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

init-all: composer-install

composer-install:
	docker-compose run --rm php-cli composer install

composer-update:
	docker-compose run --rm php-cli composer update

migrate-create:
	@echo docker-compose run --rm php-cli ./yii migrate/create $(MAKECMDGOALS)

test:
	docker-compose run --rm php-cli php bin/phpunit
