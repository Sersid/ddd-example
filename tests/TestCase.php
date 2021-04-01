<?php
declare(strict_types=1);

namespace Tests;

use App\App;
use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Infrastructure\Persistence\InMemoryProductRepository;
use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase as PHPUnit_TestCase;
use Psr\EventDispatcher\EventDispatcherInterface;
use function DI\autowire;
use function DI\create;

abstract class TestCase extends PHPUnit_TestCase
{
    public function getAppInstance(): App
    {
        $containerBuilder = new ContainerBuilder();

        $containerBuilder->addDefinitions([
            // Kernel
            EventDispatcherInterface::class => create(EventDispatcher::class),

            // Set up repositories
            IProductRepository::class => autowire(InMemoryProductRepository::class),
        ]);

        $container = $containerBuilder->build();

        return new App($container);
    }
}
