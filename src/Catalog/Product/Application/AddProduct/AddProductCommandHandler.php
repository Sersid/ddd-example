<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\AddProduct;

use App\Catalog\Product\Domain\Entity\ProductBrandId;
use App\Catalog\Product\Domain\Entity\ProductCode;
use App\Catalog\Product\Domain\Entity\ProductDescription;
use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\ProductName;
use App\Catalog\Product\Domain\Entity\ProductPrice;
use App\Catalog\Product\Domain\Entity\Product;
use App\Kernel\Domain\Event\EventDispatcher;

class AddProductCommandHandler
{
    private IProductRepository $productRepository;
    private Product $product;
    private EventDispatcher $eventDispatcher;
    private array $events;

    public function __construct(IProductRepository $productRepository, EventDispatcher $eventDispatcher)
    {
        $this->productRepository = $productRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function handle(AddProductCommand $command): void
    {
        $code = new ProductCode($command->code);
        $name = new ProductName($command->name);
        $brandId = new ProductBrandId($command->brandId);
        $price = new ProductPrice($command->price);
        $description = new ProductDescription($command->description);

        $this->product = Product::create($code, $name, $brandId, $price, $description);
        $this->productRepository->add($this->product);

        $this->events = $this->product->releaseEvents();
        $this->eventDispatcher->dispatch($this->events);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getEvents(): array
    {
        return $this->events;
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
