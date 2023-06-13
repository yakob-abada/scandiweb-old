CONTAINER_NAME ?= app

container_login:
	docker exec -it ${CONTAINER_NAME} bash

tests: 
	docker exec -it ${CONTAINER_NAME} vendor/bin/phpunit tests --stderr --colors

start:
	docker compose up --build -d