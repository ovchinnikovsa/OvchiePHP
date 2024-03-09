MARIADB_USER=$(shell grep '^MARIADB_USER' ./docker/conf/db.ini | awk -F '=' '{print $$2}')
MARIADB_PASSWORD=$(shell grep '^MARIADB_PASSWORD' ./docker/conf/db.ini | awk -F '=' '{print $$2}')
MARIADB_DATABASE=$(shell grep '^MARIADB_DATABASE' ./docker/conf/db.ini | awk -F '=' '{print $$2}')

run:
	docker-compose up -d

up:
	docker-compose up

stop:
	docker-compose down

build:
	docker-compose build

db_dump:
	docker-compose exec o_mariadb sh -c "exec mariadb-dump -u$(MARIADB_USER) -p$(MARIADB_PASSWORD) $(MARIADB_DATABASE) > /var/backups/db.sql"

db_restore:
	docker-compose exec -i o_mariadb sh -c "exec mysql --user=$(MARIADB_USER) --password=$(MARIADB_PASSWORD) $(MARIADB_DATABASE) < /var/backups/db.sql"

prod:
	docker-compose -f docker-compose-prod.yml up -d

sprod:
	docker-compose -f docker-compose-prod.yml stop