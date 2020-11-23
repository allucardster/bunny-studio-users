Bunny Studio Users
==================

Micro-service to handle users and users tasks at Bunny Studio

Requirements
============
- Docker `>= 18.x`
- Docker Compose `>= 1.24.x`

Stack
=====

- PHP 7.4
- Symfony 4.4
- PostgreSQL 13.1
- Nginx:1.18

Setup
=====

- Build the containers with:

```sh
$ docker-compose up -d
```

- Install PHP depencencies with:

```sh
$ docker-compose exec php composer install 
``` 

- Execute migrations with:
```sh
$ docker-compose exec php ./bin/console doctrine:migrations:migrate --no-interaction
```

Documentation
=============

- [API Documentation](https://documenter.getpostman.com/view/5093068/TVev4QJs)

Live Demo
=========

- http://167.99.6.21

Contributors
============

- Richard Melo [Twitter](https://twitter.com/allucardster), [Linkedin](https://www.linkedin.com/in/richardmelo)