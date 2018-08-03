<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPL-3.0
 */

namespace Rudra\Tests;

use Rudra\Container;
use Rudra\EventDispatcher;
use Rudra\Tests\stub\Events\AppEvents;
use Rudra\Tests\stub\Events\SomeEvent;
use Rudra\Tests\stub\Listeners\AppListener;
use Rudra\Interfaces\EventDispatcherInterface;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;
use Rudra\Tests\stub\Subscribers\AppSubscriber;

/**
 * Class EventDispatcherTest
 * @package Rudra\Tests
 */
class EventDispatcherTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var AppListener
     */
    protected $listener;
    /**
     * @var EventDispatcher
     */
    protected $mediator;

    protected function setUp(): void
    {
        $this->listener = new AppListener(Container::app());
        $this->mediator = new EventDispatcher();

        $this->mediator->addListener(AppEvents::APP_LISTENER, [$this->listener, 'onEvent']);
        $this->mediator->addListener(AppEvents::APP_CLOSURE, function() {
            $this->listener->container()->set('closure', 'closure', 'raw');;
        });

        $this->mediator->addSubscribers(new AppSubscriber(), new SomeEvent($this->listener->container()));
    }

    public function testInstance(): void
    {
        $this->assertInstanceOf(EventDispatcherInterface::class, $this->mediator);
        $this->assertInstanceOf(AppListener::class, $this->listener);
    }

    public function testListener(): void
    {
        $this->mediator->dispatch('app.listener');
        $this->assertEquals($this->listener->container()->get('listener'), 'listener');
    }

    public function testClosure(): void
    {
        $closure = $this->mediator->dispatch('app.closure');
        $closure();

        $this->assertEquals($this->listener->container()->get('closure'), 'closure');
        $this->assertInstanceOf(\Closure::class, $closure);
    }

    public function testSubscribers(): void
    {
        $this->mediator->dispatch('sub.listener');
        $this->mediator->dispatch('sub.closure');

        $this->assertEquals($this->listener->container()->get('one'), 'one');
        $this->assertEquals($this->listener->container()->get('two'), 'two');
    }
}
