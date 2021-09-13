# Sample PHP App

This is a sample API project made using:

- [Symfony](https://symfony.com/)
- [API Platform](https://api-platform.com/docs/core/)
- [Doctrine ORM](https://www.doctrine-project.org/projects/doctrine-orm/en/current/tutorials/getting-started.html#getting-started-with-doctrine)
- [php-fpm](https://hub.docker.com/_/php)
- [nginx](https://hub.docker.com/_/nginx)
- [mysql](https://hub.docker.com/_/mysql)
- [adminer](https://hub.docker.com/_/adminer)
- [coding standards](https://github.com/slevomat/coding-standard)
- [PSR-12](https://www.php-fig.org/psr/psr-12/)

## Installation

JWT PKI

```sh
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
# setfacl > apt install acl
setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt

chmod 644
```

## Updates

```sh
composer outdated
composer recipes
```

docker exec -it php_api-php_1 /bin/sh
