bold=$(shell (tput bold))
normal=$(shell (tput sgr0))
.DEFAULT_GOAL=help
DISTRIB:=$(shell lsb_release -is | tr '[:upper:]' '[:lower:]')
VERSION:=$(shell lsb_release -cs)
ARCHITECTURE:=$(shell dpkg --print-architecture)

help:
	@echo "${bold}install${normal}\n\t Installs the whole appplication.\n"
	@echo "${bold}uninstall${normal}\n\t Stops and removes all containers and drops the database.\n"
	@echo "${bold}start${normal}\n\t Starts the application.\n"
	@echo "${bold}db.connect${normal}\n\t Connects to the database.\n"

start:
	docker-compose up -d

stop:
	docker-compose down -v
	docker-compose rm -v

install: uninstall start db.install npm.install

uninstall: stop npm.uninstall
	cd back && sudo rm -rf postgres-data error.log && cd ..

reinstall: install

npm.install:
	cd back && npm install
	cd front && npm install

npm.uninstall:
	cd back && sudo rm -rf node_modules && cd ..
	cd front && sudo rm -rf node_modules && cd ..

#Connects to the databatase
db.connect:
	docker-compose exec postgres /bin/bash -c 'psql -U $$POSTGRES_USER'

db.install:
	sleep 10
	docker-compose exec postgres /bin/bash -c 'psql -U $$POSTGRES_USER -h localhost -f src/data/db.sql'

front.update.dependencies:
	docker-compose exec vuejs npm install

back.update.dependencies:
	docker-compose exec node npm install