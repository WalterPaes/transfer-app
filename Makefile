build:
	sudo docker build -t transfer-app .
run:
	sudo docker-compose up -d
build-and-run:
	make build
	make run
