<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

use Rudra\Container\Traits\FacadeTrait;

/**
 * @method static addListener(string $event, $listener, array $arguments = null)
 * @method static dispatch(string $event, array $arguments = null)
 *
 * @method static void attachObserver(string $publisher, string $event, $subscriber, array $arguments = null)
 * @method static void detachObserver(string $publisher, string $event, string $subscriberName)
 * @method static void notify(string $publisher, string $event)
 *
 * @see EventDispatcherFacade
 */
final class EventDispatcherFacade
{
    use FacadeTrait;
}
