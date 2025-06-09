<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

interface EventDispatcherInterface
{
    public function addListener(string $event, \Closure|array $listener, ...$arguments): void;
    public function dispatch(string $event,  ...$arguments);
    public function getListeners(): array;
    public function attachObserver(string $event, array $subscriber, ...$arguments): void;
    public function detachObserver(string $event, string $subscriberName): void;
    public function notify(string $event, ...$arguments): void;
    public function getObservers(): array;
}
