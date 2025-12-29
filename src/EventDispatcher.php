<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\EventDispatcher;

use Rudra\Exceptions\LogicException;

class EventDispatcher implements EventDispatcherInterface
{
    protected array $listeners = [];
    protected array $observers = [];

    /**
     * Adds an event listener for the specified event.
     * The listener can be either a Closure or an array containing a class/object and a method name.
     * If additional arguments are provided, they are stored along with the listener.
     * -------------------------
     * Добавляет обработчик событий для указанного события.
     * Обработчик может быть либо замыканием (Closure), либо массивом, содержащим класс/объект и имя метода.
     * Если предоставлены дополнительные аргументы, они сохраняются вместе с обработчиком.
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
     * Dispatches an event by invoking its associated listener.
     * If the listener is a Closure, it is returned directly.
     * If the listener is an object or class with a method, the method is invoked with optional arguments.
     * If the event does not exist or the listener is invalid, a LogicException is thrown.
     * -------------------------
     * Вызывает событие, выполняя связанный с ним обработчик.
     * Если обработчик является замыканием (Closure), оно возвращается напрямую.
     * Если обработчик — это объект или класс с методом, метод вызывается с необязательными аргументами.
     * Если событие не существует или обработчик недействителен, выбрасывается исключение LogicException.
     * 
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
     * Attaches an observer to a specific event.
     * The observer must be an array containing a class/object and a method name.
     * If additional arguments are provided, they are stored along with the observer.
     * -------------------------
     * Присоединяет наблюдателя к указанному событию.
     * Наблюдатель должен быть массивом, содержащим класс/объект и имя метода.
     * Если предоставлены дополнительные аргументы, они сохраняются вместе с наблюдателем.
     * 
     * @param  string $event
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
     * Detaches an observer from a specific event.
     * The observer can be identified by its class name or object instance.
     * If the observer exists for the specified event, it is removed from the observers list.
     * -------------------------
     * Отсоединяет наблюдателя от указанного события.
     * Наблюдатель может быть идентифицирован по имени класса или экземпляру объекта.
     * Если наблюдатель существует для указанного события, он удаляется из списка наблюдателей.
     * 
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
     * Notifies all observers of a specific event by invoking their associated methods.
     * If the event does not exist or the observer is invalid, a LogicException is thrown.
     * Observers can be objects or classes with methods, and optional arguments can be passed to them.
     * -------------------------
     * Уведомляет всех наблюдателей указанного события, вызывая связанные с ними методы.
     * Если событие не существует или наблюдатель недействителен, выбрасывается исключение LogicException.
     * Наблюдатели могут быть объектами или классами с методами, и им могут быть переданы необязательные аргументы.
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