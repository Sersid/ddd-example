<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Collection;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Webmozart\Assert\Assert;

abstract class Collection implements Countable, IteratorAggregate
{
    protected array $items;

    public function __construct(array $items)
    {
        Assert::allIsInstanceOf($items, static::type());
        $this->items = $items;
    }

    abstract protected static function type(): string;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->all());
    }

    public function all(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->all());
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }

    public function isNotEmpty(): bool
    {
        return $this->isEmpty() === false;
    }
}
