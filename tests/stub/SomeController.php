<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

namespace Rudra\Tests\stub;

use Rudra\Container;

/**
 * Class SomeController
 * @package Rudra\Tests\stub
 */
class SomeController
{

    public function onEvent()
    {
        $container = Container::app();
        $container->set('some', 'value', 'raw');
    }
}
