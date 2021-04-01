<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Application\UpdateProduct;

use App\Catalog\Product\Application\Command\UpdateProduct\UpdateProductCommand;
use App\Catalog\Product\Application\Command\UpdateProduct\UpdateProductCommandHandler;
use App\Catalog\Product\Domain\Event\ProductChangedBrandIdEvent;
use App\Catalog\Product\Domain\Event\ProductChangedPriceEvent;
use App\Catalog\Product\Domain\Event\ProductRenamedEvent;
use App\Catalog\Product\Domain\Exception\ProductNotFoundException;
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
        $this->assertSame($product->getBrandId()->getValue(), $command->brandId);
        $this->assertSame($product->getDescription()->getValue(), $command->description);

        $events = $handler->getEvents();
        $this->assertCount(3, $events);
        $this->assertInstanceOf(ProductRenamedEvent::class, $events[0]);
        $this->assertInstanceOf(ProductChangedBrandIdEvent::class, $events[1]);
        $this->assertInstanceOf(ProductChangedPriceEvent::class, $events[2]);
    }

    private function getCommand(): UpdateProductCommand
    {
        $command = new UpdateProductCommand();
        $command->id = 1;
        $command->name = 'Rename product';
        $command->price = 500100;
        $command->brandId = 1;
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
        $this->expectException(ProductNotFoundException::class);
        $this->getHandler($command);
    }
}
