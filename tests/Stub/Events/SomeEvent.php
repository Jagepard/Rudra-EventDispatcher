<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\EventDispatcher\Tests\Stub\Events;

use Rudra\Container\Facades\Rudra;
use Rudra\EventDispatcher\EventInterface;

class SomeEvent implements EventInterface
{
    public function oneEvent()
    {
        Rudra::config()->set(["one" => "one"]);
    }

    public function twoEvent()
    {
        Rudra::config()->set(["two" => "two"]);
    }
}
