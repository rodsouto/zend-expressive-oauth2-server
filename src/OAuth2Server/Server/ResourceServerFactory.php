<?php
/**
 * @author      Haydar KULEKCI <haydarkulekci@gmail.com>
 * @copyright   Copyright (c) Haydar KULEKCI
 * @license     http://mit-license.org/
 *
 * @link        https://github.com/biberlabs/zend-expressive-oauth2-server
 */

namespace OAuth2Server\Server;

use Interop\Container\ContainerInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\ResourceServer;

class ResourceServerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        return new ResourceServer(
            $clientRepository = $container->get(AccessTokenRepositoryInterface::class),
            $config['oauth2']['certificates']['public']
        );
    }
}
