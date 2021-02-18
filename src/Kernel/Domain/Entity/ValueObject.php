<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity;

abstract class ValueObject
{
    abstract function getValue();

    public function __toString(): string
    {
        return (string)$this->getValue();
    }

    public function equalTo(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }
}
