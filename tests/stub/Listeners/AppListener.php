<?php

namespace Rudra\Tests\stub\Listeners;

use Rudra\Interfaces\ContainerInterface;
use Rudra\ExternalTraits\SetContainerTrait;

class AppListener
{

    use SetContainerTrait {
        SetContainerTrait::__construct as protected __setContainerTraitConstruct;
    }

    public function __construct(ContainerInterface $container)
    {
        $this->__setContainerTraitConstruct($container);
    }

    public function onEvent()
    {
        $this->container()->set('listener', 'listener', 'raw');
    }
}
