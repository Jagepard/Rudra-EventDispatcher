<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\ExternalTraits;

use Rudra\Interfaces\ContainerInterface;

/**
 * Trait EventDispatcherTrait
 * @package Rudra\ExternalTraits
 */
trait EventDispatcherTrait
{

    /**
     * @param string $key
     * @param        $listener
     * @param string $event
     */
    public function addListener(string $key, $listener, string $event): void
    {
        $this->container()->get('event-dispatcher')->addListener($key, $listener, $event);
    }

    /**
     * @param string $key
     * @return mixed|void
     */
    public function dispatch(string $key)
    {
        $this->container()->get('event-dispatcher')->dispatch($key);
    }

    /**
     * @return ContainerInterface
     */
    abstract public function container(): ContainerInterface;
}
