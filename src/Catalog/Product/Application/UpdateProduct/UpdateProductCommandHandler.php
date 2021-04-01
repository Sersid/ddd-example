<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\UpdateProduct;

use App\Catalog\Product\Domain\Entity\BrandId;
use App\Catalog\Product\Domain\Entity\Description;
use App\Catalog\Product\Domain\Entity\Id;
use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\Name;
use App\Catalog\Product\Domain\Entity\Price;
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
        $id = new Id($command->id);
        $name = new Name($command->name);
        $brandId = new BrandId($command->brandId);
        $price = new Price($command->price);
        $description = new Description($command->description);

        $this->product = $this->productRepository->getById($id);
        $this->product->rename($name);
        $this->product->changeBrandId($brandId);
        $this->product->changePrice($price);
        $this->product->changeDescription($description);

        $this->productRepository->update($this->product);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }
}
