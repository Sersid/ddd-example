<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Application\AddProduct;

use App\Catalog\Product\Application\AddProduct\AddProductCommand;
use App\Catalog\Product\Application\AddProduct\AddProductCommandHandler;
use Tests\TestCase;

class AddProductCommandHandlerTest extends TestCase
{
    public function testHandler()
    {
        $command = new AddProductCommand();
        $command->code = 123456;
        $command->name = 'New product';
        $command->price = 100500;
        $command->brand = 'Brand name';
        $command->description = 'New product description';

        $container = $this->getAppInstance()->getContainer();
        $handler = $container->get(AddProductCommandHandler::class);
        $handler->handle($command);

        $product = $handler->getProduct();

        $this->assertLessThan($product->getId(), 0);
        $this->assertSame($product->getCode(), $command->code);
        $this->assertSame($product->getName(), $command->name);
        $this->assertSame($product->getPrice(), $command->price);
        $this->assertSame($product->getBrand(), $command->brand);
        $this->assertSame($product->getDescription(), $command->description);
    }
}
