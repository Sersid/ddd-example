<?php
declare(strict_types=1);

namespace App\Catalog\Product\Infrastructure\Persistence;

use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\Product;
use App\Catalog\Product\Domain\Exception\ProductNotFound;
use App\Kernel\Hydrator;

class InMemoryProductRepository implements IProductRepository
{
    /** @var Product[] */
    private static array $arProducts;
    private Hydrator $hydrator;
    private int $id;

    public function __construct(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
        $this->id = 1;
        self::$arProducts = [
            $hydrator->hydrate(Product::class, [
                'id' => $this->id++,
                'code' => 100001,
                'name' => 'Product name #100001',
                'brand' => 'Brand name',
                'price' => 100500,
                'description' => null,
            ]),
            $hydrator->hydrate(Product::class, [
                'id' => $this->id++,
                'code' => 100002,
                'name' => 'Product name #100002',
                'brand' => 'Brand name',
                'price' => 100501,
                'description' => 'Product description #100002',
            ]),
        ];
    }

    public function add(Product $product): void
    {
        self::$arProducts[] = $product;
        $this->hydrator->setPropertyValue($product, 'id', $this->id++);
    }

    /**
     * @param int $id
     *
     * @return Product
     * @throws ProductNotFound
     */
    public function getById(int $id): Product
    {
        foreach (self::$arProducts as $product) {
            if ($product->getId() === $id) {
                return $product;
            }
        }
        throw new ProductNotFound();
    }

    public function update(Product $product): void
    {
    }

    public function delete(int $id): void
    {
        foreach (self::$arProducts as $key => $product) {
            if ($product->getId() === $id) {
                unset(self::$arProducts[$key]);
            }
        }
    }
}
