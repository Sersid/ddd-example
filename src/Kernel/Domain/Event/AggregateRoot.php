<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Event;

interface AggregateRoot
{
    public function releaseEvents(): array;
}
