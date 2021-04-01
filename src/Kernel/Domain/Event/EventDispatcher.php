<?php
declare(strict_types=1);

namespace App\Kernel\Domain\Event;

use Psr\EventDispatcher\EventDispatcherInterface;

class EventDispatcher
{
    private EventDispatcherInterface $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function dispatch($events)
    {
        if (is_array($events)) {
            foreach ($events as $event) {
                $this->dispatcher->dispatch($event);
            }
        } else {
            $this->dispatcher->dispatch($events);
        }
    }
}
