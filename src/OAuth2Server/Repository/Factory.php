<?php

namespace OAuth2Server\Repository;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

class Factory
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityName = str_replace('Repository', 'Entity', $requestedName);

        $entityName = substr($entityName, 0, -6);

        return $container->get(EntityManager::class)->getRepository($entityName);
    }
}
