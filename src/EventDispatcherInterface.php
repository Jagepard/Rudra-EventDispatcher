<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

interface EventDispatcherInterface
{
    /**
     * @param  string $event
     * @param  array  $listener
     * @param  ...$arguments
     * @return void
     */
    public function addListener(string $event, \Closure|array $listener, ...$arguments): void;

    /**
     * @param  string $event
     * @param  ...$arguments
     * @return void
     */
    public function dispatch(string $event,  ...$arguments);

    /**
     * @return array
     */
    public function getListeners(): array;


    /**
     * @param  string $event
     * @param  array  $subscriber
     * @param  [type] ...$arguments
     * @return void
     */
    public function attachObserver(string $event, array $subscriber, ...$arguments): void;

    /**
     * @param  string $event
     * @param  string $subscriberName
     * @return void
     */
    public function detachObserver(string $event, string $subscriberName): void;

    /**
     * @param  string $event
     * @param  [type] ...$arguments
     * @return void
     */
    public function notify(string $event, ...$arguments): void;

    /**
     * @return array
     */
    public function getObservers(): array;
}
