<?php
declare(strict_types=1);

namespace App\Catalog\Application\AddProduct;

use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\Product;

class AddProductCommandHandler
{
    private IProductRepository $productRepository;
    private Product $product;

    public function __construct(IProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(AddProductCommand $command): void
    {
        $this->product = new Product(
            $command->code,
            $command->name,
            $command->brand,
            $command->price,
            $command->description
        );
        $this->productRepository->add($this->product);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    // public function __invoke(AddProductCommand $command)
    // {
    // }
}
