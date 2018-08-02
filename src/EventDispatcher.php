<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

namespace Rudra;

use Rudra\Interfaces\EventDispatcherInterface;

/**
 * Class EventDispatcher
 * @package Rudra
 */
class EventDispatcher implements EventDispatcherInterface
{

    /**
     * @var array
     */
    protected $events = [];
    /**
     * @var array
     */
    protected $listeners = [];

    /**
     * @param string $key
     * @param        $listener
     * @param string $event
     * @return mixed|void
     */
    public function addListener(string $key, $listener, string $event)
    {
        $this->events[$key]    = $event;
        $this->listeners[$key] = $listener;
    }

    /**
     * @param string $event
     * @return mixed|void
     */
    public function dispatch(string $event)
    {
        $event    = $this->events[$event];
        $listener = $this->listeners[$event];

        $listener->$event();
    }
}
