docker-up:
	docker-compose up -d
docker-down:
	docker-compose down
docker-restart: docker-down docker-up
bash:
	docker-compose exec php-fpm bash
perm:
	sudo chown ${USER}:${USER} ./* -R
run-test:
	docker-compose exec php-fpm vendor/bin/phpunit
