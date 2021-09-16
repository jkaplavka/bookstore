# Bookstore - Sample PHP App

## Technology

### Backend

-   [Symfony 5](https://symfony.com/)
-   [API Platform](https://api-platform.com/docs/core/)
-   [Doctrine ORM](https://www.doctrine-project.org/projects/doctrine-orm/en/current/tutorials/getting-started.html#getting-started-with-doctrine)
-   [PHP-FPM 8](https://hub.docker.com/_/php)
-   [Nginx](https://hub.docker.com/_/nginx)
-   [MySQL 8](https://hub.docker.com/_/mysql)
-   [Adminer](https://hub.docker.com/_/adminer)
-   [Composer / Packagist](https://packagist.org/)
-   [Docker / Docker compose](https://www.docker.com/)

### Frontend

-   [Vue.js 3](https://v3.vuejs.org/guide/introduction.html#what-is-vue-js)
-   [Typescript](https://www.typescriptlang.org/)
-   [SASS](https://sass-lang.com/)
-   [Bootstrap 5](https://getbootstrap.com/)
-   [Bootstrap icons](https://icons.getbootstrap.com/#icons)
-   [Symfony Encore Webpack](https://symfony.com/doc/current/frontend.html#encore-documentation)
-   [Yarn](https://yarnpkg.com/)

## Development flow

### Install dependencies

```sh
composer install
yarn install
```

### Create JWT PKI

```sh
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
# setfacl > apt install acl
setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt

chmod 644
```

### Create & Initialize Databaze

-   setup database connection url as env variable `DATABASE_URL` (see .env for more details)
-   create database `php bin/console doctrine:database:create`
-   create database tables structure `php bin/console doctrine:migrations:execute`

### Run application

```sh
docker-compose up -d
symfony serve --allow-http -d
yarn dev-server --hot
```

### Code quality

-   [CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
-   [coding standards](https://github.com/slevomat/coding-standard)
-   [PHPStan](https://github.com/phpstan/phpstan)

```sh
php vendor/bin/phpcs
php vendor/bin/phpcbf
php vendor/bin/phpstan analyse
```

### Updates

```sh
composer outdated
composer recipes
yarn upgrade
```
