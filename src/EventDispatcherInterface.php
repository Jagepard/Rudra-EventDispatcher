<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

interface EventDispatcherInterface
{
    public function addListener(string $event, $listener, array $arguments = null);
    public function addSubscribers(EventSubscriberInterface $subscriber, $event = null): void;
    public function dispatch(string $event, array $arguments = null);

    public function attachObserver(string $subject, string $event, ObserverInterface $subscriber): void;
    public function detachObserver(string $subject, string $event, ObserverInterface $subscriber): void;
    public function notify(string $subject, string $event): void;
}
