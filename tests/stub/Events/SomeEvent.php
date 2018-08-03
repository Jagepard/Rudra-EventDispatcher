<?php

namespace Rudra\Tests\stub\Events;

use Rudra\Interfaces\EventInterface;

class SomeEvent implements EventInterface
{
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
