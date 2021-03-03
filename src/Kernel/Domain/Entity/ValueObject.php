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

    public function isEqual(self $other): bool
    {
        return $this->getValue() === $other->getValue();
    }

    public function isNull(): bool
    {
        return is_null($this->getValue());
    }

    public function isNotNull(): bool
    {
        return !$this->isNull();
    }

    public function isEmpty(): bool
    {
        return $this->isNull() || empty($this->getValue());
    }

    public function isNotEmpty(): bool
    {
        return $this->isNotNull() && !empty($this->getValue());
    }
}
