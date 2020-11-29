<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

use Rudra\Container\Traits\FacadeTrait;

/**
 * @method static addListener(string $event, $listener, array $arguments = null)
 * @method static void addSubscribers(EventSubscriberInterface $subscriber, $event = null)
 * @method static dispatch(string $event)
 * @method static void attachSubscriber(string $event, ObserverSubscriberInterface $subscriber)
 * @method static void notify(string $event)
 *
 * @see EventDispatcherFacade
 */
final class EventDispatcherFacade
{
    use FacadeTrait;
}
