<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity;

abstract class StringValueObject extends ValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function toUpper(): string
    {
        return mb_strtoupper($this->value);
    }
}
