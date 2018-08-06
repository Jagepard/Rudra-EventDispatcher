<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

namespace Rudra\Interfaces;

/**
 * Interface PublisherInterface
 * @package Rudra\Interfaces
 */
interface EventPublisherInterface
{

    /**
     * @param string              $event
     * @param SubscriberInterface $subscriber
     */
    public function attachSubscriber(string $event, SubscriberInterface $subscriber): void;

    /**
     * @param string              $event
     * @param SubscriberInterface $subscriber
     */
    public function detachSubscriber(string $event, SubscriberInterface $subscriber): void;

    /**
     * @param string $event
     */
    public function notify(string $event): void;
}
