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
     * @param string $name
     * @param        $listener
     * @return mixed
     */
    public function addListener(string $name, $listener);

    /**
     * @param EventSubscriberInterface $subscriber
     * @param null                     $event
     */
    public function addSubscribers(EventSubscriberInterface $subscriber, $event = null): void;

    /**
     * @param string $name
     * @return mixed
     */
    public function dispatch(string $name);
}
