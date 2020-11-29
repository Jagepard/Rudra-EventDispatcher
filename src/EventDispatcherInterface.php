<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

interface EventDispatcherInterface
{
    /**
     * @param string     $event
     * @param            $listener
     * @param array|null $arguments
     * @return mixed
     */
    public function addListener(string $event, $listener, array $arguments = null);

    /**
     * @param EventSubscriberInterface $subscriber
     * @param null                     $event
     */
    public function addSubscribers(EventSubscriberInterface $subscriber, $event = null): void;

    /**
     * @param string $event
     * @return mixed
     */
    public function dispatch(string $event);

    /**
     * @param string                      $event
     * @param ObserverSubscriberInterface $subscriber
     */
    public function attachSubscriber(string $event, ObserverSubscriberInterface $subscriber): void;

    /**
     * @param string                      $event
     * @param ObserverSubscriberInterface $subscriber
     */
    public function detachSubscriber(string $event, ObserverSubscriberInterface $subscriber): void;

    /**
     * @param string $event
     */
    public function notify(string $event): void;
}
