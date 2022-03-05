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

    public function addListener(string $event, $listener, ...$arguments): void
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

    public function dispatch(string $event,  ...$arguments)
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

    public function getListeners(): array
    {
        return $this->listeners;
    }

    public function attachObserver(string $event, array $subscriber, ...$arguments): void
    {
        if ($subscriber instanceof \Closure) {
            $this->observers[$event][] = $subscriber;
            return;
        }

        $this->observers[$event][$subscriber[0]] = ['method' => $subscriber[1]];

        if (count($arguments)) $this->observers[$event][$subscriber[0]]["arguments"] = $arguments;
    }

    public function detachObserver(string $event, string $subscriberName): void
    {
        if (array_key_exists($subscriberName, $this->observers[$event])) {
            unset($this->observers[$event][$subscriberName]);
        }
    }

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

    public function getObservers(): array
    {
        return $this->observers;
    }
}