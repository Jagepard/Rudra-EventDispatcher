<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

namespace Rudra;

use Rudra\Interfaces\EventDispatcherInterface;
use Rudra\Interfaces\EventSubscriberInterface;
use Rudra\Interfaces\ObserverSubscriberInterface;

/**
 * Class EventDispatcher
 * @package Rudra
 */
class EventDispatcher implements EventDispatcherInterface
{

    /**
     * @var array
     */
    protected $methods = [];
    /**
     * @var array
     */
    protected $listeners = [];
    /**
     * @var array
     */
    protected $subscribers = [];

    /**
     * @param string $name
     * @param        $listener
     * @return mixed
     */
    public function addListener(string $name, $listener)
    {
        if ($listener instanceof \Closure) {
            $this->listeners[$name] = $listener;
            return;
        }

        $this->methods[$name]   = $listener[1];
        $this->listeners[$name] = $listener[0];
    }

    /**
     * @param EventSubscriberInterface $subscriber
     * @param null                     $event
     */
    public function addSubscribers(EventSubscriberInterface $subscriber, $event = null): void
    {
        foreach ($subscriber->getSubscribedEvents() as $name => $method) {
            isset($event)
                ? $this->addListener($name, [$event, $method])
                : $this->addListener($name, [$subscriber, $method]);
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function dispatch(string $name)
    {
        if ($this->listeners[$name] instanceof \Closure) {
            return $this->listeners[$name];
        }

        $event    = $this->methods[$name];
        $listener = $this->listeners[$name];

        $listener->$event();
    }

    /**
     * @param string                      $event
     * @param ObserverSubscriberInterface $subscriber
     */
    public function attachSubscriber(string $event, ObserverSubscriberInterface $subscriber): void
    {
        $this->subscribers[$event][get_class($subscriber)] = $subscriber;
    }

    /**
     * @param string                      $event
     * @param ObserverSubscriberInterface $subscriber
     */
    public function detachSubscriber(string $event, ObserverSubscriberInterface $subscriber): void
    {
        if (array_key_exists(get_class($subscriber), $this->subscribers[$event])) {
            unset($this->subscribers[get_class($subscriber)]);
        }
    }

    /**
     * @param string $event
     */
    public function notify(string $event): void
    {
        foreach ($this->subscribers[$event] as $subscriber) {
            if (method_exists($subscriber, $event)) {
                $subscriber->$event();
            }
        }
    }
}
