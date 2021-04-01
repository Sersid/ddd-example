<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity\ValueObject\Integer;

use App\Kernel\Domain\Entity\ValueObject\ValueObject;

abstract class IntNullableValueObject extends ValueObject
{
    protected ?int $value;

    public function __construct(?int $value)
    {
        $this->value = $value;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }
}
