<?php

namespace Rudra\Tests\stub\Controllers;

use Rudra\Interfaces\SubscriberInterface;
use Rudra\ExternalTraits\SetContainerTrait;

class TestController implements SubscriberInterface
{

    use SetContainerTrait;

    public function before()
    {
        $this->container()->set('subscriber', 'before', 'raw');
    }

    public function after()
    {
        $this->container()->set('subscriber', 'after', 'raw');
    }
}
