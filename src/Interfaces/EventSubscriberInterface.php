<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

namespace Rudra\Interfaces;

/**
 * Interface EventSubscriberInterface
 * @package Rudra\Interfaces
 */
interface EventSubscriberInterface
{

    /**
     * @return array
     */
    public function getSubscribedEvents(): array;
}