<?php
/**
 * @author      Haydar KULEKCI <haydarkulekci@gmail.com>
 * @copyright   Copyright (c) Haydar KULEKCI
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/biberlabs/zend-expressive-oauth2-server
 */

namespace OAuth2Server;

class ModuleConfig
{
    public function __invoke()
    {
        return [
            'doctrine' => [
                'driver' => [
                    'orm_default' => [
                        'class' => \Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                        'drivers' => [
                            'OAuth2Server\Entity' => 'oauth2_entity',
                        ],
                    ],
                    'oauth2_entity' => [
                        'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                        'cache' => 'array',
                        'paths' => [__DIR__ . '/Entity'],
                    ],
                ],
            ],
            'oauth2' => [
                'certificates' => [
                    'public' => 'file://' . __DIR__ . '/../../public.key',
                    'private' => 'file://' . __DIR__ . '/../../private.key',
                ],
                'grants' => [
                    'password'           => \League\OAuth2\Server\Grant\PasswordGrant::class,
                    'authorization_code' => \League\OAuth2\Server\Grant\AuthCodeGrant::class,
                    'refresh_token'      => \League\OAuth2\Server\Grant\RefreshTokenGrant::class,
                    'client_credentials' => \League\OAuth2\Server\Grant\ClientCredentialsGrant::class,
                ],
            ],
            'dependencies' => [
                'factories' => [
                    \League\OAuth2\Server\ResourceServer::class => \OAuth2Server\Server\ResourceServerFactory::class,
                    \League\OAuth2\Server\AuthorizationServer::class => \OAuth2Server\Server\AuthorizationServerFactory::class,

                    \OAuth2Server\Middleware\ResourceServerMiddleware::class => \OAuth2Server\Middleware\ResourceServerMiddlewareFactory::class,


                    \OAuth2Server\Action\AuthorizeAction::class => \OAuth2Server\Action\AuthorizeActionFactory::class,
                    \OAuth2Server\Action\AccessTokenAction::class => \OAuth2Server\Action\AccessTokenActionFactory::class,

                    \League\OAuth2\Server\Grant\ClientCredentialsGrant::class => \OAuth2Server\Grant\ClientCredentialsGrantFactory::class,
                    \League\OAuth2\Server\Grant\AuthCodeGrant::class => \OAuth2Server\Grant\AuthCodeGrantFactory::class,
                    \League\OAuth2\Server\Grant\PasswordGrant::class => \OAuth2Server\Grant\PasswordGrantFactory::class,
                    \League\OAuth2\Server\Grant\RefreshTokenGrant::class => \OAuth2Server\Grant\RefreshTokenGrantFactory::class,

                    \OAuth2Server\Repository\AccessTokenRepository::class => \OAuth2Server\Repository\Factory::class,
                    \OAuth2Server\Repository\AuthCodeRepository::class => \OAuth2Server\Repository\Factory::class,
                    \OAuth2Server\Repository\ClientRepository::class => \OAuth2Server\Repository\Factory::class,
                    \OAuth2Server\Repository\RefreshTokenRepository::class => \OAuth2Server\Repository\Factory::class,
                    \OAuth2Server\Repository\ScopeRepository::class => \OAuth2Server\Repository\Factory::class,
                    \OAuth2Server\Repository\UserRepository::class => \OAuth2Server\Repository\Factory::class,
                ],
                'aliases' => [
                    \League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface::class => \OAuth2Server\Repository\AccessTokenRepository::class,
                    \League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface::class => \OAuth2Server\Repository\AuthCodeRepository::class,
                    \League\OAuth2\Server\Repositories\ClientRepositoryInterface::class => \OAuth2Server\Repository\ClientRepository::class,
                    \League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface::class => \OAuth2Server\Repository\RefreshTokenRepository::class,
                    \League\OAuth2\Server\Repositories\ScopeRepositoryInterface::class => \OAuth2Server\Repository\ScopeRepository::class,
                    \League\OAuth2\Server\Repositories\UserRepositoryInterface::class => \OAuth2Server\Repository\UserRepository::class,
                ]
            ],
            'routes' => [
                [
                    'name' => 'home',
                    'path' => '/',
                    'middleware' => [
                        \League\OAuth2\Server\Middleware\ResourceServerMiddleware::class,
                        \OAuth2Server\Action\ExampleApiAction::class,
                    ],
                    'allowed_methods' => ['GET'],
                ],
                [
                    'name' => 'oauth2.authorize',
                    'path' => '/authorize',
                    'middleware' => [
                        \OAuth2Server\Action\AuthorizeAction::class,
                    ],
                    'allowed_methods' => ['GET'],
                ],
                [
                    'name' => 'oauth2.access_token',
                    'path' => '/access_token',
                    'middleware' => [
                        \OAuth2Server\Action\AccessTokenAction::class,
                    ],
                    'allowed_methods' => ['POST'],
                ],
            ],
            'middleware_pipeline' => [
                'routing' => [
                    'middleware' => [
                        //\League\OAuth2\Server\Middleware\ResourceServerMiddleware::class,
                    ],
                    'priority' => 1,
                ],
            ],
        ];
    }
}
