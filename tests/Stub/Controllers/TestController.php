<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\EventDispatcher\Tests\Stub\Controllers;

use Rudra\Container\Facades\Rudra;
use Rudra\EventDispatcher\ObserverInterface;

class TestController implements ObserverInterface
{
    public function before()
    {
        Rudra::config()->set(["subscriber" => "before"]);
    }

    public function after()
    {
        Rudra::config()->set(["subscriber" => "after"]);
    }

    public function subscriberObject($argument = null)
    {
        Rudra::config()->set(["subscriberObject" => "subscriberObject"]);
    }
}
