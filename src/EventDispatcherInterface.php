<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\EventDispatcher;

interface EventDispatcherInterface
{
    public function addListener(string $event, \Closure|array $listener, ...$arguments): void;
    public function dispatch(string $event,  ...$arguments): mixed;
    public function getListeners(): array;
    public function attachObserver(string $event, array $subscriber, ...$arguments): void;
    public function detachObserver(string $event, string $subscriberName): void;
    public function notify(string $event, ...$arguments): void;
    public function getObservers(): array;
}
