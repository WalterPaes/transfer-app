build:
	sudo docker build -t transfer-app .
run:
	sudo docker-compose up -d
stop:
	sudo docker-compose stop
down:
	sudo docker-compose down
build-and-run:
	make build
	make run
migrate:
	php artisan migrate
