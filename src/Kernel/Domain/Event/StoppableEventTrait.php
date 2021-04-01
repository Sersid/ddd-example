<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Event;

trait StoppableEventTrait
{
    private bool $isPropagationStopped = false;

    public function stopPropagation()
    {
        $this->isPropagationStopped = true;
    }

    public function isPropagationStopped() : bool
    {
        return $this->isPropagationStopped;
    }
}
