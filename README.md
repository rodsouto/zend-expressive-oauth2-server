## The PHP League OAuth2 Server For Zend Expressive 

## Installation

0. Run `composer install` in this directory to install dependencies
0. Create a private key `openssl genrsa -out private.key 1024`
0. Create a public key `openssl rsa -in private.key -pubout > public.key`
0. `cd` into the public directory
0. Start a PHP server `php -S localhost:4444`

## Configuration

Check `src/OAuth2Server/ModuleConfig.php` file to configuration.

Create a `data/cache` and `data/db` folders for doctrine cache and SQLite DB file.

## Routes

If you are using programmatic middleware pipelines, add the following routes:

```php
$app->route('/access_token', OAuth2Server\Action\AccessTokenAction::class, ['POST'], 'oauth2.access_token');
$app->route('/authorize', OAuth2Server\Action\AuthorizeAction::class, ['GET'], 'oauth2.authorize');
```

## Requests

Check the [The PHP League Example Page](https://github.com/thephpleague/oauth2-server/tree/master/examples)
