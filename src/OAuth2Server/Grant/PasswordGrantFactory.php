<?php
/**
 * @author      Haydar KULEKCI <haydarkulekci@gmail.com>
 * @copyright   Copyright (c) Haydar KULEKCI
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/biberlabs/zend-expressive-oauth2-server
 */

namespace OAuth2Server\Grant;

use Interop\Container\ContainerInterface;
use League\OAuth2\Server\Grant\PasswordGrant;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;

class PasswordGrantFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $grant = new PasswordGrant(
            $container->get(UserRepositoryInterface::class),
            $container->get(RefreshTokenRepositoryInterface::class)
        );
        $grant->setRefreshTokenTTL(new \DateInterval('P1M')); // refresh tokens will expire after 1 month

        return $grant;
    }
}
