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

    public function toUpper(): self
    {
        $clone = clone $this;
        if ($clone->isNotNull()) {
            $clone->value = mb_strtoupper($clone->value);
        }

        return $clone;
    }

    public function trim(): self
    {
        $clone = clone $this;
        if ($clone->isNotNull()) {
            $clone->value = trim($clone->value);
        }

        return $clone;
    }

    public function htmlEntities(): self
    {
        $clone = clone $this;
        if ($clone->isNotNull()) {
            $clone->value = htmlentities($clone->value);
        }

        return $clone;
    }
}
