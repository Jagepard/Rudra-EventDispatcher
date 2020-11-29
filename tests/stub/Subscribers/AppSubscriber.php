<?php

namespace Rudra\EventDispatcher\Tests\Stub\Subscribers;

use Rudra\EventDispatcher\Tests\Stub\Events\AppEvents;
use Rudra\EventDispatcher\EventSubscriberInterface;

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
