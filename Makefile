build:
	sudo docker build -t transfer-app .
run:
	sudo docker-compose up -d
stop:
	sudo docker-compose stop
down:
	sudo docker-compose down
install-dependencies:
	composer install
build-and-run:
	make build
	make run
migrate:
	php artisan migrate
refresh-migrations:
	php artisan migrate:fresh
run-tests:
	vendor/bin/phpunit
