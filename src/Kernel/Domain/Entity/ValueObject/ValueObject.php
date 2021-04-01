<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity\ValueObject;

abstract class ValueObject
{
    abstract public function getValue();

    public function __toString(): string
    {
        return (string)$this->getValue();
    }

    public function isEqual(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    public function isNotEqual(self $other): bool
    {
        return $this->isEqual($other) === false;
    }

    public function isNull(): bool
    {
        return $this->getValue() === null;
    }

    public function isNotNull(): bool
    {
        return $this->isNull() === false;
    }

    public function isEmpty(): bool
    {
        return empty($this->getValue());
    }

    public function isNotEmpty(): bool
    {
        return $this->isEmpty() === false;
    }
}
