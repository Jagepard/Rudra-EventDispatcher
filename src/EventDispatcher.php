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
    protected array $subscribers = [];

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

    public function dispatch(string $event)
    {
        if ($this->listeners[$event] instanceof \Closure) {
            return $this->listeners[$event];
        }

        $method   = $this->methods[$event];
        $listener = $this->listeners[$event];

        return (isset($this->arguments[$event]))
            ? $listener->$method(...$this->arguments[$event])
            : $listener->$method();
    }

    public function attachSubscriber(string $event, ObserverSubscriberInterface $subscriber): void
    {
        $this->subscribers[$event][get_class($subscriber)] = $subscriber;
    }

    public function detachSubscriber(string $event, ObserverSubscriberInterface $subscriber): void
    {
        if (array_key_exists(get_class($subscriber), $this->subscribers[$event])) {
            unset($this->subscribers[get_class($subscriber)]);
        }
    }

    public function notify(string $event): void
    {
        foreach ($this->subscribers[$event] as $subscriber) {
            if (method_exists($subscriber, $event)) {
                $subscriber->$event();
            }
        }
    }
}
