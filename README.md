# SLIM 4 - API SKELETON

Useful skeleton for RESTful API development, using [Slim PHP micro framework](https://www.slimframework.com).

Used technologies: `PHP, Slim 4, MySQL, PHPUnit, env var, Docker & Docker Compose`.

## QUICK INSTALL:

### Pre Requisite:

- PHP.
- Composer.
- MySQL/MariaDB.

## Features

This project is based on best practice and industry standards:

* Slim php 4.3
* Eloquent ORM 6.15
* NQuery 1.0 ([])
* Php DotEnv 
* Database Migrations ([Phinx](https://phinx.org/))
* Database Migrations Generator
* Unit- and integrations tests (PHPUnit)

### With Composer:

You can create a new project running the following commands:

```bash
$ composer create-project maurobonfietti/slim4-api-skeleton [my-api-name]
$ cd [my-api-name]
$ cp .env.example .env
$ composer test
$ composer start
```


#### Configure your connection to MySQL Server:

By default, the API use a MySQL Database.

You can check and edit this configuration in your `.env` file:

```
DB_HOST='127.0.0.1'
DB_NAME='yourMySqlDatabase'
DB_USER='yourMySqlUsername'
DB_PASS='yourMySqlPassword'
```


## DOCKER READY:

If you like Docker, you can use this project with **docker** and **docker-compose**.

### MINIMAL DOCKER VERSION:

* Engine: 18.03+
* Compose: 1.21+


### DOCKER COMMANDS:

```bash
# Create and start containers for the API.
$ docker-compose up -d --build

# Checkout the API.
$ curl http://localhost:8081

# Stop and remove containers.
$ docker-compose down
```

## DOCUMENTATION:

### DEFAULT ENDPOINTS:

- Help: `GET /`

- Status: `GET /status`

- User: `GET /user`