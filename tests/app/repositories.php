<?php
declare(strict_types=1);

use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Infrastructure\InMemoryProductRepository;
use DI\ContainerBuilder;
use function DI\autowire;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        IProductRepository::class => autowire(InMemoryProductRepository::class),
    ]);
};
