<?php
declare(strict_types=1);

use App\App;
use DI\ContainerBuilder;

require_once __DIR__ . '/../vendor/autoload.php';
function app(): App
{
    $containerBuilder = new ContainerBuilder();
    $container = $containerBuilder->build();

    return new App($container);
}
