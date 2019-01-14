<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

namespace Rudra\Interfaces;

/**
 * Interface EventDispatcherInterface
 * @package Rudra\Interfaces
 */
interface EventDispatcherInterface
{

    /**
     * @param string     $event
     * @param            $listener
     * @param array|null $arguments
     * @return mixed
     */
    public function addListener(string $event, $listener, array $arguments = null);

    /**
     * @param EventSubscriberInterface $subscriber
     * @param null                     $event
     */
    public function addSubscribers(EventSubscriberInterface $subscriber, $event = null): void;

    /**
     * @param string $event
     * @return mixed
     */
    public function dispatch(string $event);

    /**
     * @param string                      $event
     * @param ObserverSubscriberInterface $subscriber
     */
    public function attachSubscriber(string $event, ObserverSubscriberInterface $subscriber): void;

    /**
     * @param string                      $event
     * @param ObserverSubscriberInterface $subscriber
     */
    public function detachSubscriber(string $event, ObserverSubscriberInterface $subscriber): void;

    /**
     * @param string $event
     */
    public function notify(string $event): void;
}
