<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Application\UpdateProduct;

use App\Catalog\Product\Application\UpdateProduct\UpdateProductCommand;
use App\Catalog\Product\Application\UpdateProduct\UpdateProductCommandHandler;
use App\Catalog\Product\Domain\Exception\ProductNotFound;
use Tests\TestCase;

class UpdateProductCommandHandlerTest extends TestCase
{
    public function testHandler()
    {
        $command = $this->getCommand();

        $handler = $this->getHandler($command);
        $product = $handler->getProduct();

        $this->assertSame($product->getId()->getValue(), $command->id);
        $this->assertSame($product->getName()->getValue(), $command->name);
        $this->assertSame($product->getPrice()->getValue(), $command->price);
        $this->assertSame($product->getBrand()->getValue(), $command->brand);
        $this->assertSame($product->getDescription()->getValue(), $command->description);
    }

    private function getCommand(): UpdateProductCommand
    {
        $command = new UpdateProductCommand();
        $command->id = 1;
        $command->name = 'Rename product';
        $command->price = 500100;
        $command->brand = 'Rename brand name';
        $command->description = null;

        return $command;
    }

    private function getHandler(UpdateProductCommand $command): UpdateProductCommandHandler
    {
        $container = $this->getAppInstance()->getContainer();
        $handler = $container->get(UpdateProductCommandHandler::class);
        $handler->handle($command);

        return $handler;
    }

    public function testProductNotFoundException()
    {
        $command = $this->getCommand();
        $command->id = 100000000000;
        $this->expectException(ProductNotFound::class);
        $this->getHandler($command);
    }
}
