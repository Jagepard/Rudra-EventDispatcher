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
     * @param string $key
     * @param        $listener
     * @param string $event
     * @return mixed
     */
    public function addListener(string $key, $listener, string $event);

    /**
     * @param string $event
     * @return mixed
     */
    public function dispatch(string $event);
}
