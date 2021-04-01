<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity\ValueObject\Id;

use App\Kernel\Domain\Entity\ValueObject\Integer\IntValueObject;
use Webmozart\Assert\Assert;

abstract class IdValueObject extends IntValueObject
{
    public function __construct(int $value)
    {
        Assert::greaterThan($value, 0);
        parent::__construct($value);
    }
}
