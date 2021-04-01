<?php
declare(strict_types=1);

use App\Catalog\Product\Application\Command\AddProduct\AddProductCommand;
use App\Catalog\Product\Application\Command\AddProduct\AddProductCommandHandler;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (!empty($_POST)) {
    $command = new AddProductCommand();
    $command->code = (int)$_POST['CODE'];
    $command->name = $_POST['NAME'];
    $command->brand = $_POST['BRAND'];
    $command->price = (float)$_POST['PRICE'];
    $command->description = $_POST['DESCRIPTION'];

    $handler = app()->getContainer()->get(AddProductCommandHandler::class);
    $handler->handle($command);
}
