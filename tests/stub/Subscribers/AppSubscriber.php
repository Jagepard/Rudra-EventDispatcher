<?php

namespace Rudra\Tests\stub\Subscribers;

use Rudra\Tests\stub\Events\AppEvents;
use Rudra\Interfaces\EventSubscriberInterface;

class AppSubscriber implements EventSubscriberInterface
{
    public function getSubscribedEvents(): array
    {
        return [
            AppEvents::SUB_CLOSURE  => 'oneEvent',
            AppEvents::SUB_LISTENER => 'twoEvent'
        ];
    }
}
