<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Application\DeleteProduct;

use App\Catalog\Product\Application\DeleteProduct\DeleteProductCommand;
use App\Catalog\Product\Application\DeleteProduct\DeleteProductCommandHandler;
use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Exception\ProductNotFound;
use Tests\TestCase;

class DeleteProductCommandHandlerTest extends TestCase
{
    public function testHandler()
    {
        $command = new DeleteProductCommand();
        $command->id = 1;

        $container = $this->getAppInstance()->getContainer();
        $handler = $container->get(DeleteProductCommandHandler::class);
        $handler->handle($command);

        $this->expectException(ProductNotFound::class);
        $productRepository = $container->get(IProductRepository::class);
        $productRepository->getById($command->id);
    }
}
