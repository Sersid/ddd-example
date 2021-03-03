<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Entity\ValueObject\String;

use App\Kernel\Domain\Entity\ValueObject\ValueObject;

abstract class BaseStringValueObject extends ValueObject
{
    public function toUpper(): self
    {
        return $this->handler(function (self $clone) {
            $clone->value = mb_strtoupper($clone->value);
        });
    }

    public function trim(): self
    {
        return $this->handler(function (self $clone) {
            $clone->value = trim($clone->value);
        });
    }

    public function htmlEntities(): self
    {
        return $this->handler(function (self $clone) {
            $clone->value = htmlentities($clone->value);
        });
    }
}
