<?php

namespace Rudra\Tests\stub\Listeners;

use Rudra\ExternalTraits\SetContainerTrait;

class AppListener
{

    use SetContainerTrait;

    public function onEvent()
    {
        $this->container()->set('listener', 'listener', 'raw');
    }
}
