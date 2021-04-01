<?php
declare(strict_types=1);

namespace App\Catalog\Product\Domain\Entity;

use App\Kernel\Domain\Entity\ValueObject\Integer\IntValueObject;
use Webmozart\Assert\Assert;

class Id extends IntValueObject
{
    public function __construct(int $value)
    {
        Assert::greaterThan($value, 0);
        parent::__construct($value);
    }
}
