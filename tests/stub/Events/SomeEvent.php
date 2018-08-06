<?php

namespace Rudra\Tests\stub\Events;

use Rudra\Interfaces\EventInterface;
use Rudra\ExternalTraits\SetContainerTrait;

class SomeEvent implements EventInterface
{

    use SetContainerTrait;

    public function oneEvent()
    {
        $this->container()->set('one', 'one', 'raw');
    }

    public function twoEvent()
    {
        $this->container()->set('two', 'two', 'raw');
    }
}
