<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Event;

interface EventListener
{
    public function handle($event): void;
}
