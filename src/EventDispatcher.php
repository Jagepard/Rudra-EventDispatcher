<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

use Rudra\Exceptions\LogicException;

class EventDispatcher implements EventDispatcherInterface
{
    protected array $listeners = [];
    protected array $observers = [];

    /**
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

        if (!is_array($listener) || count($listener) !== 2) {
            throw new LogicException("Listener must be a Closure or an array with two elements.");
        }

        $this->listeners[$event]["listener"] = $listener[0];
        $this->listeners[$event]["method"]   = $listener[1];

        if (count($arguments)) {
            $this->listeners[$event]["arguments"] = $arguments;
        }
    }

    /**
     * @param  string $event
     * @param  ...$arguments
     * @return void
     */
    public function dispatch(string $event, ...$arguments)
    {
        if (!isset($this->listeners[$event])) { 
            throw new LogicException("Event '$event' does not exist.");
        }

        if ($this->listeners[$event] instanceof \Closure) {
            return $this->listeners[$event];
        }

        $listener = $this->listeners[$event]["listener"];
        $listener = is_object($listener)
            ? $listener
            : (class_exists($listener) ? new $listener() : throw new LogicException("Subscriber class '$listener' does not exist."));
        $method   = $this->listeners[$event]["method"];

        if (count($arguments)) { 
            $this->listeners[$event]["arguments"] = $arguments;
        }

        return (isset($this->listeners[$event]["arguments"]))
            ? $listener->$method(...$this->listeners[$event]["arguments"])
            : $listener->$method();
    }

    /**
     * @return array
     */
    public function getListeners(): array
    {
        return $this->listeners;
    }

    /**
     * @param  string         $event
     * @param  array $subscriber
     * @param  ...$arguments
     * @return void
     */
    public function attachObserver(string $event, array $subscriber, ...$arguments): void
    {
        if (count($subscriber) !== 2) {
            throw new LogicException("Subscriber must be an array with two elements.");
        }

        $subscriberName = is_object($subscriber[0])
            ? get_class($subscriber[0])
            : $subscriber[0];

        $this->observers[$event][$subscriberName]["class"]  = $subscriber[0];
        $this->observers[$event][$subscriberName]["method"] = $subscriber[1];

        if (count($arguments)) {
            $this->observers[$event][$subscriberName]["arguments"] = $arguments;
        }
    }

    /**
     * @param  string $event
     * @param  string $subscriber
     * @return void
     */
    public function detachObserver(string $event, string|object $subscriber): void
    {
        $subscriberName = is_object($subscriber)
            ? get_class($subscriber)
            : $subscriber;

        if (array_key_exists($subscriberName, $this->observers[$event])) {
            unset($this->observers[$event][$subscriberName]);
        }
    }

    /**
     * Notifies observers of an event
     * 
     * @param  string $event
     * @param  ...$arguments
     * @return void
     */
    public function notify(string $event, ...$arguments): void
    {
        if (!isset($this->observers[$event])) {
            throw new LogicException("Event '$event' does not exist.");
        }

        foreach ($this->observers[$event] as $subscriber) {
            
            $class  = $subscriber["class"];
            $method = $subscriber["method"];
            $args   = $subscriber['arguments'] ?? $arguments;

            if ($method instanceof \Closure) {
                $method(...$args);
                continue;
            }

            $object = is_object($class)
                ? $class
                : (class_exists($class) ? new $class() : throw new LogicException("Subscriber class '{$class}' does not exist."));

            if (!method_exists($object, $method)) {
                throw new LogicException("Method '$method' does not exist in subscriber.");
            }

            $object->{$method}(...$args);
        }
    }

    /**
     * @return array
     */
    public function getObservers(): array
    {
        return $this->observers;
    }
}