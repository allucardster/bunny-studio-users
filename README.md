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

Contributors
============

- Richard Melo [Twitter](https://twitter.com/allucardster), [Linkedin](https://www.linkedin.com/in/richardmelo)