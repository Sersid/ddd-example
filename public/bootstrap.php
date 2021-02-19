<?php
declare(strict_types=1);

use App\App;
use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Infrastructure\Persistence\BitrixProductRepository;
use DI\ContainerBuilder;
use function DI\autowire;

require_once __DIR__ . '/../vendor/autoload.php';
function app(): App
{
    $containerBuilder = new ContainerBuilder();
    $containerBuilder->addDefinitions([
        IProductRepository::class => autowire(BitrixProductRepository::class),
    ]);
    $container = $containerBuilder->build();

    return new App($container);
}
