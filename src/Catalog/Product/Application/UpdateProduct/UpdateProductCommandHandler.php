<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\UpdateProduct;

use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\Product;
use App\Catalog\Product\Domain\Exception\ProductNotFound;

class UpdateProductCommandHandler
{
    private IProductRepository $productRepository;
    private Product $product;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param UpdateProductCommand $command
     * @throws ProductNotFound
     */
    public function handle(UpdateProductCommand $command): void
    {
        $this->product = $this->productRepository->getById($command->id);
        $this->product->setName($command->name);
        $this->product->setBrand($command->brand);
        $this->product->setPrice($command->price);
        $this->product->setDescription($command->description);
        
        $this->productRepository->update($this->product);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
