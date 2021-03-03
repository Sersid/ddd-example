<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity\ValueObject\String;

abstract class StringValueObject extends BaseStringValueObject
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
}
