<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

class EventDispatcher implements EventDispatcherInterface
{
    protected array $methods = [];
    protected array $listeners = [];
    protected array $arguments = [];
    protected array $observers = [];

    public function addListener(string $event, $listener, array $arguments = null)
    {
        if ($listener instanceof \Closure) {
            $this->listeners[$event] = $listener;
            return;
        }

        $this->methods[$event]   = $listener[1];
        $this->listeners[$event] = $listener[0];

        if (isset($arguments)) $this->arguments[$event] = $arguments;
    }

    public function addSubscribers(EventSubscriberInterface $subscriber, $event = null): void
    {
        foreach ($subscriber->getSubscribedEvents() as $name => $method) {
            isset($event)
                ? $this->addListener($name, [$event, $method])
                : $this->addListener($name, [$subscriber, $method]);
        }
    }

    public function dispatch(string $event, array $arguments = null)
    {
        if ($this->listeners[$event] instanceof \Closure) {
            return $this->listeners[$event];
        }

        $method   = $this->methods[$event];
        $listener = $this->listeners[$event];

        if (isset($arguments)) $this->arguments[$event] = $arguments;

        return (isset($this->arguments[$event]))
            ? $listener->$method(...$this->arguments[$event])
            : $listener->$method();
    }

    public function attachObserver(string $subject, string $event, ObserverInterface $observer): void
    {
        $this->observers[$subject][$event][get_class($observer)] = $observer;
    }

    public function detachObserver(string $subject, string $event, ObserverInterface $observer): void
    {
        if (array_key_exists(get_class($observer), $this->observers[$subject][$event])) {
            unset($this->observers[get_class($observer)]);
        }
    }

    public function notify(string $subject, string $event): void
    {
        foreach ($this->observers[$subject][$event] as $observer) {
            if (method_exists($observer, $event)) {
                $observer->$event();
            }
        }
    }
}
