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
use Rudra\Interfaces\ContainerInterface;
use Rudra\Tests\stub\Controllers\TestController;
use Rudra\Tests\stub\Events\AppEvents;
use Rudra\Tests\stub\Events\SomeEvent;
use Rudra\Tests\stub\Listeners\AppListener;
use Rudra\Interfaces\EventDispatcherInterface;
use Rudra\ExternalTraits\EventDispatcherTrait;
use Rudra\Tests\stub\Subscribers\AppSubscriber;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

/**
 * Class EventDispatcherTest
 * @package Rudra\Tests
 */
class EventDispatcherTest extends PHPUnit_Framework_TestCase
{

    use EventDispatcherTrait;

    /**
     * @var AppListener
     */
    protected $listener;
    /**
     * @var ContainerInterface
     */
    protected $container;

    protected function setUp(): void
    {
        $this->container = Container::app();
        $this->listener = new AppListener($this->container);
        $this->container()->set('event.dispatcher', EventDispatcher::class);

        $this->addListener(AppEvents::APP_LISTENER, [$this->listener, 'onEvent']);
        $this->addListener(AppEvents::APP_PARAMS, [$this->listener, 'onParams'], ['data']);
        $this->addListener(AppEvents::APP_CLOSURE, function () {
            $this->container()->set('closure', 'closure', 'raw');;
        });

        $this->addSubscribers(new AppSubscriber(), new SomeEvent($this->container()));
    }

    public function testInstance(): void
    {
        $this->assertInstanceOf(EventDispatcherInterface::class, $this->container()->get('event.dispatcher'));
        $this->assertInstanceOf(AppListener::class, $this->listener);
    }

    public function testListener(): void
    {
        $this->container()->get('event.dispatcher')->dispatch('app.listener');
        $this->assertEquals($this->container()->get('listener'), 'listener');
        $this->assertEquals($this->container()->get('event.dispatcher')->dispatch(AppEvents::APP_PARAMS), 'data');
    }

    public function testClosure(): void
    {
        $closure = $this->dispatch('app.closure');
        $closure();

        $this->assertEquals($this->container()->get('closure'), 'closure');
        $this->assertInstanceOf(\Closure::class, $closure);
    }

    public function testSubscribers(): void
    {
        $this->dispatch('sub.listener');
        $this->dispatch('sub.closure');

        $this->assertEquals($this->container()->get('one'), 'one');
        $this->assertEquals($this->container()->get('two'), 'two');
    }

    public function testPublisher(): void
    {
        $this->container()->get('event.dispatcher')->attachSubscriber('before', new TestController($this->container()));
        $this->container()->get('event.dispatcher')->notify('before');
        $this->assertEquals($this->container()->get('subscriber'), 'before');

        $this->container()->get('event.dispatcher')->detachSubscriber('before', new TestController($this->container()));
        $this->container()->get('event.dispatcher')->attachSubscriber('after', new TestController($this->container()));
        $this->container()->get('event.dispatcher')->notify('after');
        $this->assertEquals($this->container()->get('subscriber'), 'after');
    }

    public function container(): ContainerInterface
    {
        return $this->container;
    }
}
