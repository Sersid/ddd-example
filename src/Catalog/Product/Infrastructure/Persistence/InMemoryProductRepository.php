<?php
declare(strict_types=1);

namespace App\Catalog\Product\Infrastructure\Persistence;

use App\Catalog\Product\Domain\Entity\ProductBrandId;
use App\Catalog\Product\Domain\Entity\ProductCode;
use App\Catalog\Product\Domain\Entity\ProductDescription;
use App\Catalog\Product\Domain\Entity\ProductId;
use App\Catalog\Product\Domain\Entity\IProductRepository;
use App\Catalog\Product\Domain\Entity\ProductName;
use App\Catalog\Product\Domain\Entity\ProductPrice;
use App\Catalog\Product\Domain\Entity\Product;
use App\Catalog\Product\Domain\Exception\ProductNotFoundException;
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
                'id' => new ProductId($this->id++),
                'code' => new ProductCode(100001),
                'name' => new ProductName('Product name #100001'),
                'brandId' => new ProductBrandId(5),
                'price' => new ProductPrice(100500),
                'description' => new ProductDescription(null),
            ]),
            $hydrator->hydrate(Product::class, [
                'id' => new ProductId($this->id++),
                'code' => new ProductCode(100002),
                'name' => new ProductName('Product name #100002'),
                'brandId' => new ProductBrandId(null),
                'price' => new ProductPrice(100501),
                'description' => new ProductDescription('Product description #100002'),
            ]),
        ];
    }

    public function add(Product $product): void
    {
        self::$arProducts[] = $product;
        $this->hydrator->setPropertyValue($product, 'id', new ProductId($this->id++));
    }

    /**
     * @param ProductId $id
     *
     * @return Product
     * @throws ProductNotFoundException
     */
    public function getById(ProductId $id): Product
    {
        foreach (self::$arProducts as $product) {
            if ($product->getId()->isEqual($id)) {
                return $product;
            }
        }
        throw new ProductNotFoundException();
    }

    public function update(Product $product): void
    {
    }

    public function delete(ProductId $id): void
    {
        foreach (self::$arProducts as $key => $product) {
            if ($product->getId()->isEqual($id)) {
                unset(self::$arProducts[$key]);
            }
        }
    }
}
