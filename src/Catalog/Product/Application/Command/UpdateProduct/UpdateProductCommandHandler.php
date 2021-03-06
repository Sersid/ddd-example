<?php
declare(strict_types=1);

namespace App\Catalog\Product\Application\Command\UpdateProduct;

use App\Catalog\Product\Domain\Entity\BrandId;
use App\Catalog\Product\Domain\Entity\Description;
use App\Catalog\Product\Domain\Entity\Id;
use App\Catalog\Product\Domain\Repository\IProductRepository;
use App\Catalog\Product\Domain\Entity\Name;
use App\Catalog\Product\Domain\Entity\Price;
use App\Catalog\Product\Domain\Entity\Product;
use App\Catalog\Product\Domain\Exception\ProductNotFoundException;
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
     *
     * @throws ProductNotFoundException
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
