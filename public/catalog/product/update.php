<?php
declare(strict_types=1);

use App\Catalog\Product\Application\UpdateProduct\UpdateProductCommand;
use App\Catalog\Product\Application\UpdateProduct\UpdateProductCommandHandler;
use App\Catalog\Product\Domain\Exception\ProductNotFoundException;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (!empty($_POST)) {
    $command = new UpdateProductCommand();
    $command->id = (int)$_GET['ID'];
    $command->name = $_POST['NAME'];
    $command->brand = $_POST['BRAND'];
    $command->price = (float)$_POST['PRICE'];
    $command->description = $_POST['DESCRIPTION'];

    $handler = app()->getContainer()->get(UpdateProductCommandHandler::class);
    try {
        $handler->handle($command);
    } catch (InvalidArgumentException $e) {
        echo $e->getMessage();
    } catch (ProductNotFoundException $e) {
        echo "Товар не найден";
    } catch (\Throwable $e) {
        // не надо так :(
    }
}
