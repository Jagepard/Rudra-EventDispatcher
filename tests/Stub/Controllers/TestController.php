<?php

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
}
