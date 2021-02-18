<?php
declare(strict_types=1);

namespace Tests;

use App\App;
use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase as PHPUnit_TestCase;

abstract class TestCase extends PHPUnit_TestCase
{
    public function getAppInstance(): App
    {
        $containerBuilder = new ContainerBuilder();

        // Set up repositories
        $repositories = require __DIR__ . '/../src/app/repositories.php';
        $repositories($containerBuilder);

        $container = $containerBuilder->build();

        return new App($container);
    }
}
