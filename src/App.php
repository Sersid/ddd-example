<?php
declare(strict_types=1);

namespace App;

use Psr\Container\ContainerInterface;

class App
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
