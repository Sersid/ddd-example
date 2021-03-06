<?php
declare(strict_types=1);

namespace Tests\Catalog\Product\Application\DeleteProduct;

use App\Catalog\Product\Application\Command\DeleteProduct\DeleteProductCommand;
use App\Catalog\Product\Application\Command\DeleteProduct\DeleteProductCommandHandler;
use App\Catalog\Product\Domain\Entity\Id;
use App\Catalog\Product\Domain\Repository\IProductRepository;
use App\Catalog\Product\Domain\Exception\ProductNotFoundException;
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

        $this->expectException(ProductNotFoundException::class);
        $productRepository = $container->get(IProductRepository::class);
        $productRepository->getById(new Id($command->id));
    }
}
