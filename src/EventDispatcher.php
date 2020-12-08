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

    public function addListener(string $event, $listener, array $arguments = null)
    {
        if ($listener instanceof \Closure) {
            $this->listeners[$event] = $listener;
            return;
        }

        $this->listeners[$event]["listener"] = $listener[0];
        $this->listeners[$event]["method"]   = $listener[1];

        if (isset($arguments)) $this->listeners[$event]["arguments"] = $arguments;
    }

    public function dispatch(string $event, array $arguments = null)
    {
        if ($this->listeners[$event] instanceof \Closure) {
            return $this->listeners[$event];
        }

        $method   = $this->listeners[$event]["method"];
        $listener = $this->listeners[$event]["listener"];

        if (isset($arguments)) $this->listeners[$event]["arguments"] = $arguments;

        return (isset($this->listeners[$event]["arguments"]))
            ? $listener->$method(...$this->listeners[$event]["arguments"])
            : $listener->$method();
    }

    public function attachObserver(string $publisher, string $event, $subscriber, array $arguments = null): void
    {
        if ($subscriber instanceof \Closure) {
            $this->observers[$publisher][$event][] = $subscriber;
            return;
        }

        $this->observers[$publisher][$event][get_class($subscriber[0])]["subscriber"] = $subscriber[0];
        $this->observers[$publisher][$event][get_class($subscriber[0])]["method"]     = $subscriber[1];

        if (isset($arguments)) $this->observers[$publisher][$event][get_class($subscriber[0])]["arguments"] = $arguments;
    }

    public function detachObserver(string $publisher, string $event, string $subscriberName): void
    {
        if (array_key_exists($subscriberName, $this->observers[$publisher][$event])) {
            unset($this->observers[$publisher][$event][$subscriberName]);
        }
    }

    public function notify(string $publisher, string $event): void
    {
        foreach ($this->observers[$publisher][$event] as $subscriber) {
            if (method_exists($subscriber["subscriber"], $subscriber["method"])) {
                $observer = $subscriber["subscriber"];
                $method   = $subscriber["method"];

                (isset($subscriber["arguments"]))
                    ? $observer->$method(...$subscriber["arguments"])
                    : $observer->$method();
            }
        }
    }
}
