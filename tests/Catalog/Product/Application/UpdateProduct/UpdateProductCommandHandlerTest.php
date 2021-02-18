<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Application\UpdateProduct;

use App\Catalog\Product\Application\UpdateProduct\UpdateProductCommand;
use App\Catalog\Product\Application\UpdateProduct\UpdateProductCommandHandler;
use Tests\TestCase;

class UpdateProductCommandHandlerTest extends TestCase
{
    public function testHandler()
    {
        $command = new UpdateProductCommand();
        $command->id = 1;
        $command->name = 'Rename product';
        $command->price = 500100;
        $command->brand = 'Rename brand name';
        $command->description = null;

        $container = $this->getAppInstance()->getContainer();
        $handler = $container->get(UpdateProductCommandHandler::class);
        $handler->handle($command);

        $product = $handler->getProduct();

        $this->assertSame($product->getId(), $command->id);
        $this->assertSame($product->getName(), $command->name);
        $this->assertSame($product->getPrice(), $command->price);
        $this->assertSame($product->getBrand(), $command->brand);
        $this->assertSame($product->getDescription(), $command->description);
    }
}
