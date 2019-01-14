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
     * @param string     $event
     * @param            $listener
     * @param array|null $arguments
     */
    public function addListener(string $event, $listener, array $arguments = null)
    {
        $this->container()->get('event.dispatcher')->addListener($event, $listener, $arguments);
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
     * @param string $event
     * @return mixed
     */
    public function dispatch(string $event)
    {
        return $this->container()->get('event.dispatcher')->dispatch($event);
    }

    /**
     * @return ContainerInterface
     */
    abstract public function container(): ContainerInterface;
}
