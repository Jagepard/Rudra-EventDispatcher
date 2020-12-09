<?php

namespace Rudra\EventDispatcher\Tests\Stub\Listeners;

use Rudra\Container\Facades\Rudra;

class AppListener
{
    public function onEvent($data)
    {
        Rudra::config()->set(["listener" => $data]);
    }

    public function onParams($data)
    {
        return $data;
    }
}
