<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

interface EventDispatcherInterface
{
    public function addListener(string $event, $listener, ...$arguments): void;
    public function dispatch(string $event,  ...$arguments);

    public function attachObserver(string $publisher, string $event, $subscriber, ...$arguments): void;
    public function detachObserver(string $subject, string $event, string $subscriberName): void;
    public function notify(string $publisher, string $event, ...$arguments): void;
}
