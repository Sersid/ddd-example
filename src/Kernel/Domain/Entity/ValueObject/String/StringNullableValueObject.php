<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity\ValueObject\String;

use App\Kernel\Domain\Entity\ValueObject\ValueObject;

abstract class StringNullableValueObject extends ValueObject
{
    protected ?string $value;

    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }
}
