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
    public function dispatch(string $event, array $arguments = null);

    public function attachObserver(string $publisher, string $event, $subscriber, array $arguments = null): void;
    public function detachObserver(string $subject, string $event, string $subscriberName): void;
    public function notify(string $publisher, string $event): void;
}
