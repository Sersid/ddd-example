<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\UpdateProduct;

use App\Catalog\Product\Domain\Entity\ProductBrandId;
use App\Catalog\Product\Domain\Entity\ProductDescription;
use App\Catalog\Product\Domain\Entity\ProductId;
use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\ProductName;
use App\Catalog\Product\Domain\Entity\ProductPrice;
use App\Catalog\Product\Domain\Entity\Product;
use App\Catalog\Product\Domain\Exception\ProductNotFound;
use App\Kernel\Domain\Event\EventDispatcher;

class UpdateProductCommandHandler
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

    /**
     * @param UpdateProductCommand $command
     * @throws ProductNotFound
     */
    public function handle(UpdateProductCommand $command): void
    {
        $id = new ProductId($command->id);
        $name = new ProductName($command->name);
        $brandId = new ProductBrandId($command->brandId);
        $price = new ProductPrice($command->price);
        $description = new ProductDescription($command->description);

        $this->product = $this->productRepository->getById($id);
        $this->product->rename($name);
        $this->product->changeBrandId($brandId);
        $this->product->changePrice($price);
        $this->product->changeDescription($description);

        $this->productRepository->update($this->product);

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
}
