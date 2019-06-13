<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\ExternalTraits;

use Rudra\Interfaces\EventSubscriberInterface;
use Rudra\Interfaces\ObserverSubscriberInterface;

trait EventDispatcherTrait
{
    /**
     * @param string     $event
     * @param            $listener
     * @param array|null $arguments
     */
    public function addListener(string $event, $listener, array $arguments = null)
    {
        rudra()->get('event.dispatcher')->addListener($event, $listener, $arguments);
    }

    /**
     * @param EventSubscriberInterface $subscriber
     * @param null                     $event
     */
    public function addSubscribers(EventSubscriberInterface $subscriber, $event = null): void
    {
        rudra()->get('event.dispatcher')->addSubscribers($subscriber, $event);
    }

    /**
     * @param string $event
     * @return mixed
     */
    public function dispatch(string $event)
    {
        return rudra()->get('event.dispatcher')->dispatch($event);
    }

    /**
     * @param string                      $event
     * @param ObserverSubscriberInterface $subscriber
     */
    public function subscribe(string $event, ObserverSubscriberInterface $subscriber): void
    {
        rudra()->get('event.dispatcher')->attachSubscriber($event, $subscriber);
    }

    /**
     * @param string $event
     */
    public function notify(string $event): void
    {
        rudra()->get('event.dispatcher')->notify($event);
    }
}
