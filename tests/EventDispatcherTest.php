<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher\Tests;

use Rudra\Container\Facades\Rudra;
use Rudra\EventDispatcher\EventDispatcher;
use Rudra\EventDispatcher\EventDispatcherFacade;
use Rudra\EventDispatcher\Tests\Stub\Controllers\TestController;
use Rudra\EventDispatcher\Tests\Stub\Events\AppEvents;
use Rudra\EventDispatcher\Tests\Stub\Events\SomeEvent;
use Rudra\EventDispatcher\Tests\Stub\Listeners\AppListener;
use Rudra\EventDispatcher\EventDispatcherInterface;
use Rudra\EventDispatcher\Tests\Stub\Subscribers\AppSubscriber;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

class EventDispatcherTest extends PHPUnit_Framework_TestCase
{
    protected AppListener $listener;

    protected function setUp(): void
    {
        $this->listener = new AppListener();
        Rudra::set([EventDispatcher::class, EventDispatcher::class]);

        EventDispatcherFacade::addListener(AppEvents::APP_LISTENER, [$this->listener, 'onEvent']);
        EventDispatcherFacade::addListener(AppEvents::APP_PARAMS, [$this->listener, 'onParams'], ['data']);
        EventDispatcherFacade::addListener(AppEvents::APP_CLOSURE, function () {
            Rudra::config()->set(["closure" => "closure"]);
        });

        EventDispatcherFacade::addSubscribers(new AppSubscriber(), new SomeEvent());
    }

    public function testInstance(): void
    {
        $this->assertInstanceOf(EventDispatcherInterface::class, Rudra::get(EventDispatcher::class));
        $this->assertInstanceOf(AppListener::class, $this->listener);
    }

    public function testListener(): void
    {
        EventDispatcherFacade::dispatch('app.listener');
        $this->assertEquals(Rudra::config()->get('listener'), 'listener');
        $this->assertEquals(EventDispatcherFacade::dispatch(AppEvents::APP_PARAMS), 'data');
    }

    public function testClosure(): void
    {
        $closure = EventDispatcherFacade::dispatch('app.closure');
        $closure();

        $this->assertEquals(Rudra::config()->get('closure'), 'closure');
        $this->assertInstanceOf(\Closure::class, $closure);
    }

    public function testSubscribers(): void
    {
        EventDispatcherFacade::dispatch('sub.listener');
        EventDispatcherFacade::dispatch('sub.closure');

        $this->assertEquals(Rudra::config()->get('one'), 'one');
        $this->assertEquals(Rudra::config()->get('two'), 'two');
    }

    public function testPublisher(): void
    {
        EventDispatcherFacade::attachObserver("main", "before", new TestController());
        EventDispatcherFacade::notify("main","before");
        $this->assertEquals(Rudra::config()->get('subscriber'), "before");

        EventDispatcherFacade::detachObserver("main", "before", new TestController());
        EventDispatcherFacade::attachObserver("main", "after", new TestController());
        EventDispatcherFacade::notify("main","after");
        $this->assertEquals(Rudra::config()->get('subscriber'), "after");
    }
}
