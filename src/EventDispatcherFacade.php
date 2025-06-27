<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher;

use Rudra\Container\Traits\FacadeTrait;

/**
 * @method static void addListener(string $event, \Closure|array $listener, ...$arguments)
 * @method static dispatch(string $event, ...$arguments)
 * @method static array getListeners()
 * @method static void attachObserver(string $event, \Closure|array $subscriber, ...$arguments)
 * @method static void detachObserver(string $event, string $subscriberName)
 * @method static void notify(string $event, ...$arguments)
 * @method static array getObservers()
 * 
 * @see EventDispatcherFacade
 */
final class EventDispatcherFacade
{
    use FacadeTrait;
}
