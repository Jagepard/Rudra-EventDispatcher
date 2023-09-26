<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

class EventDispatcher implements EventDispatcherInterface
{
    protected array $listeners = [];
    protected array $observers = [];

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
    public function addListener(string $event, \Closure|array $listener, ...$arguments): void
    {
        if ($listener instanceof \Closure) {
            $this->listeners[$event] = $listener;
            return;
        }

        $this->listeners[$event]["listener"] = $listener[0];
        $this->listeners[$event]["method"]   = $listener[1];

        if (count($arguments)) {
            $this->listeners[$event]["arguments"] = $arguments;
        }
    }

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
    public function dispatch(string $event, ...$arguments)
    {
        if ($this->listeners[$event] instanceof \Closure) {
            return $this->listeners[$event];
        }

        $method   = $this->listeners[$event]["method"];
        $listener = new $this->listeners[$event]["listener"];

        if (count($arguments)) $this->listeners[$event]["arguments"] = $arguments;

        return (isset($this->listeners[$event]["arguments"]))
            ? $listener->$method(...$this->listeners[$event]["arguments"])
            : $listener->$method();
    }

    /**
     * Gets all listeners
     * ------------------
     * Получает всех слушателей
     *
     * @return array
     */
    public function getListeners(): array
    {
        return $this->listeners;
    }

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
    public function attachObserver(string $event, \Closure|array $subscriber, ...$arguments): void
    {
        if ($subscriber instanceof \Closure) {
            $this->observers[$event][] = $subscriber;
            return;
        }

        $this->observers[$event][$subscriber[0]] = ['method' => $subscriber[1]];

        if (count($arguments)) $this->observers[$event][$subscriber[0]]["arguments"] = $arguments;
    }

    /**
     * Detaches the observer
     * ---------------------
     * Отсоединяет наблюдателя
     *
     * @param  string $event
     * @param  string $subscriberName
     * @return void
     */
    public function detachObserver(string $event, string $subscriberName): void
    {
        if (array_key_exists($subscriberName, $this->observers[$event])) {
            unset($this->observers[$event][$subscriberName]);
        }
    }

    /**
     * Notifies observers of an event
     * ------------------------------
     * Уведомляет наблюдателей о событии
     *
     * @param  string $event
     * @param  ...$arguments
     * @return void
     */
    public function notify(string $event, ...$arguments): void
    {
        foreach ($this->observers[$event] as $subscriber => $data) {
            $subscriber = new $subscriber;
            if (method_exists($subscriber, $data['method'])) {
                if (count($arguments)) $data["arguments"] = $arguments;

                (isset($data["arguments"]))
                    ? $subscriber->{$data['method']}(...$data["arguments"])
                    : $subscriber->{$data['method']}();
            }
        }
    }

    /**
     * Gets all observers
     * ------------------
     * Получает всех наблюдателей
     *
     * @return array
     */
    public function getObservers(): array
    {
        return $this->observers;
    }
}