<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\ExternalTraits;

use Rudra\Interfaces\ContainerInterface;
use Rudra\Interfaces\EventSubscriberInterface;

/**
 * Trait EventDispatcherTrait
 * @package Rudra\ExternalTraits
 */
trait EventDispatcherTrait
{

    /**
     * @param string $name
     * @param        $listener
     * @return mixed
     */
    public function addListener(string $name, $listener)
    {
        $this->container()->get('event.dispatcher')->addListener($name, $listener);
    }

    /**
     * @param EventSubscriberInterface $subscriber
     * @param null                     $event
     */
    public function addSubscribers(EventSubscriberInterface $subscriber, $event = null): void
    {
        $this->container()->get('event.dispatcher')->addSubscribers($subscriber, $event);
    }

    /**
     * @param string $name
     */
    public function dispatch(string $name)
    {
        $this->container()->get('event.dispatcher')->dispatch($name);
    }

    /**
     * @return ContainerInterface
     */
    abstract public function container(): ContainerInterface;
}
