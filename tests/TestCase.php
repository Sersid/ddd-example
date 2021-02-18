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
        $container = $containerBuilder->build();

        return new App($container);
    }
}
