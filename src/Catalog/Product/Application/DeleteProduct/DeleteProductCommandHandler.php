<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\DeleteProduct;

use App\Catalog\Product\Domain\Entity\Id;
use App\Catalog\Product\Domain\Entity\IProductRepository;

class DeleteProductCommandHandler
{
    private IProductRepository $productRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(DeleteProductCommand $command)
    {
        $id = new Id($command->id);
        $this->productRepository->delete($id);
    }
}
