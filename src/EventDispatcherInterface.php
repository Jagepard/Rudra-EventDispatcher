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
    public function getListeners(): array;

    public function attachObserver(string $event, array $subscriber, ...$arguments): void;
    public function notify(string $event, ...$arguments): void;
    public function getObservers(): array;
}
