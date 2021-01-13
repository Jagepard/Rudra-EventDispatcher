<?php

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

use Rudra\Container\Traits\FacadeTrait;

/**
 * @method static void addListener(string $event, $listener, ...$arguments)
 * @method static dispatch(string $event, ...$arguments)
 * @method static array getListeners()
 *
 * @method static void attachObserver(string $publisher, string $event, $subscriber, ...$arguments)
 * @method static void detachObserver(string $publisher, string $event, string $subscriberName)
 * @method static void notify(string $publisher, string $event, ...$arguments)
 *
 * @see EventDispatcherFacade
 */
final class EventDispatcherFacade
{
    use FacadeTrait;
}
