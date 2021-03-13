build:
	sudo docker build -t transfer-app .
run:
	sudo docker-compose up -d
build-and-run:
	make build
	make run
migration:
	php vendor/bin/phinx
init-migration:
	vendor/bin/phinx init