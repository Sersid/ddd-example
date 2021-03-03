<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity;

abstract class StringNullableValueObject extends BaseStringValueObject
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
