<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\AddProduct;

use App\Catalog\Product\Domain\Entity\BrandId;
use App\Catalog\Product\Domain\Entity\Code;
use App\Catalog\Product\Domain\Entity\Description;
use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\Name;
use App\Catalog\Product\Domain\Entity\Price;
use App\Catalog\Product\Domain\Entity\Product;
use App\Kernel\Domain\Event\EventDispatcher;

class AddProductCommandHandler
{
    private IProductRepository $productRepository;
    private Product $product;
    private EventDispatcher $eventDispatcher;

    public function __construct(IProductRepository $productRepository, EventDispatcher $eventDispatcher)
    {
        $this->productRepository = $productRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(AddProductCommand $command): void
    {
        $code = new Code($command->code);
        $name = new Name($command->name);
        $brandId = new BrandId($command->brandId);
        $price = new Price($command->price);
        $description = new Description($command->description);

        $this->product = new Product($code, $name, $brandId, $price, $description);
        $this->productRepository->add($this->product);

        $this->eventDispatcher->dispatch($this->product->releaseEvents());
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
