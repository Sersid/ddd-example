<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity\ValueObject\Id;

use App\Kernel\Domain\Entity\ValueObject\Integer\IntNullableValueObject;
use Webmozart\Assert\Assert;

abstract class IdNullableValueObject extends IntNullableValueObject
{
    public function __construct(?int $value)
    {
        if ($value !== null) {
            Assert::greaterThan($value, 0);
        }
        parent::__construct($value);
    }
}

