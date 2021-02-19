<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\AddProduct;

use App\Catalog\Product\Domain\Entity\Brand;
use App\Catalog\Product\Domain\Entity\Code;
use App\Catalog\Product\Domain\Entity\Description;
use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\Name;
use App\Catalog\Product\Domain\Entity\Price;
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
        $code = new Code($command->code);
        $name = new Name($command->name);
        $brand = new Brand($command->brand);
        $price = new Price($command->price);
        $description = new Description($command->description);

        $this->product = new Product($code, $name, $brand, $price, $description);
        $this->productRepository->add($this->product);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    /*
     public function handle(): void
     {
        $_POST || $_GET
     }
    */
    /*
    public function handle(int $code, string $name, string $brand, float $price, ?string $description): void
    {
    }
    */
    /*
    public function handle(array $arData): void
    {
    }
    */
}
