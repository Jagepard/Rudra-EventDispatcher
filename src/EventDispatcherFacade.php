<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
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
