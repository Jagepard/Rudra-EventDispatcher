<?php

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
