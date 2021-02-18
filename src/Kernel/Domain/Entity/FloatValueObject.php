<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity;

abstract class FloatValueObject extends ValueObject
{
    protected float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
