<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
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

    /**
     * When an event is dispatched, it notifies listener registered with that event
     * ----------------------------------------------------------------------------
     * Когда событие отправляется, оно уведомляет прослушиватель, 
     * зарегистрированный с этим событием.
     *
     * @param  string $event
     * @param  ...$arguments
     * @return void
     */
    public function dispatch(string $event,  ...$arguments);

    /**
     * Gets all listeners
     * ------------------
     * Получает всех слушателей
     *
     * @return array
     */
    public function getListeners(): array;

    /**
     * Attaches an observer
     * --------------------
     * Прикрепляет наблюдателя
     *
     * @param  string         $event
     * @param  \Closure|array $subscriber
     * @param  ..$arguments
     * @return void
     */
    public function attachObserver(string $event, \Closure|array $subscriber, ...$arguments): void;

    /**
     * Detaches the observer
     * ---------------------
     * Отсоединяет наблюдателя
     *
     * @param  string $event
     * @param  string $subscriberName
     * @return void
     */
    public function detachObserver(string $event, string $subscriberName): void;

    /**
     * Notifies observers of an event
     * ------------------------------
     * Уведомляет наблюдателей о событии
     *
     * @param  string $event
     * @param  ...$arguments
     * @return void
     */
    public function notify(string $event, ...$arguments): void;

    /**
     * Gets all observers
     * ------------------
     * Получает всех наблюдателей
     *
     * @return array
     */
    public function getObservers(): array;
}
