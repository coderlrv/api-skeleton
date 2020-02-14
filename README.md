# SLIM 4 - API SKELETON
Modelo padrão para projeto API - [Slim PHP micro framework](https://www.slimframework.com).

Used technologies: `PHP, Slim 4, MySQL,,PHP-DI, Eloquent ORM, PHPUnit, env var, Docker & Docker Compose`.

## INSTALAÇÃO RÁPIDA:

### Pré-requisito:

- PHP.
- Composer.
- MySQL/MariaDB.

## Recursos

* Slim php 4.3
* Eloquent ORM 6.15
* NQuery 1.0 ([])
* Php DotEnv 
* Database Migrations ([Phinx](https://phinx.org/))
* Database Migrations Generator
* Unit- and integrations tests (PHPUnit)

### With Composer:

Você pode criar um novo projeto executando os seguintes comandos:

```bash
$ composer create-project maurobonfietti/slim4-api-skeleton [my-api-name]
$ cd [my-api-name]
$ cp .env.example .env
$ composer test
$ composer start
```


#### Configure sua conexão com o MySQL Server:

Por padrão, a API usa um banco de dados MySQL.

Você pode verificar e editar esta configuração no seu arquivo `.env`:

```
DB_HOST='127.0.0.1'
DB_NAME='yourMySqlDatabase'
DB_USER='yourMySqlUsername'
DB_PASS='yourMySqlPassword'
```


## DOCKER (Opcional):

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

### ENDPOINTS PADRÃO:

- Help: `GET /`

- Status: `GET /status`

- User: `GET /user`