<?php

namespace Rudra\EventDispatcher\Tests\Stub\Listeners;

use Rudra\Container\Facades\Rudra;

class AppListener
{
    public function onEvent()
    {
        Rudra::config()->set(["listener" => "listener"]);
    }

    public function onParams(string $data)
    {
        return $data;
    }
}
