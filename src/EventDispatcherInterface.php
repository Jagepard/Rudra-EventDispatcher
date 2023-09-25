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
     * Adds a listener for a specific event
     * ------------------------------------
     * Добавляет слушателя определенного события
     *
     * @param  string $event
     * @param  array  $listener
     * @param  ...$arguments
     * @return void
     */
    public function addListener(string $event, \Closure|array $listener, ...$arguments): void;
    public function dispatch(string $event,  ...$arguments);
    public function getListeners(): array;

    public function attachObserver(string $event, \Closure|array $subscriber, ...$arguments): void;
    public function detachObserver(string $event, string $subscriberName): void;
    public function notify(string $event, ...$arguments): void;
    public function getObservers(): array;
}
