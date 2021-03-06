<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Application\AddProduct;

use App\Catalog\Product\Application\Command\AddProduct\AddProductCommand;
use App\Catalog\Product\Application\Command\AddProduct\AddProductCommandHandler;
use App\Catalog\Product\Domain\Event\ProductCreatedEvent;
use Tests\TestCase;

class AddProductCommandHandlerTest extends TestCase
{
    public function testHandler()
    {
        $command = new AddProductCommand();
        $command->code = 123456;
        $command->name = 'New product';
        $command->price = 100500;
        $command->brandId = 10;
        $command->description = 'New product description';

        $container = $this->getAppInstance()->getContainer();
        $handler = $container->get(AddProductCommandHandler::class);
        $handler->handle($command);

        $product = $handler->getProduct();

        $this->assertLessThan($product->getId()->getValue(), 0);
        $this->assertSame($product->getCode()->getValue(), $command->code);
        $this->assertSame($product->getName()->getValue(), $command->name);
        $this->assertSame($product->getPrice()->getValue(), $command->price);
        $this->assertSame($product->getBrandId()->getValue(), $command->brandId);
        $this->assertSame($product->getDescription()->getValue(), $command->description);

        $events = $handler->getEvents();

        $this->assertCount(1, $events);
        $this->assertInstanceOf(ProductCreatedEvent::class, $events[0]);
    }
}
