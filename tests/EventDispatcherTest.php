<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher\Tests;

use Rudra\Container\Facades\Rudra;
use Rudra\EventDispatcher\EventDispatcher;
use Rudra\EventDispatcher\EventDispatcherFacade;
use Rudra\EventDispatcher\Tests\Stub\Controllers\TestController;
use Rudra\EventDispatcher\Tests\Stub\Events\AppEvents;
use Rudra\EventDispatcher\Tests\Stub\Listeners\AppListener;
use Rudra\EventDispatcher\EventDispatcherInterface;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

class EventDispatcherTest extends PHPUnit_Framework_TestCase
{
    protected AppListener $listener;

    protected function setUp(): void
    {
        $this->listener = new AppListener();
        Rudra::set([EventDispatcher::class, EventDispatcher::class]);

        EventDispatcherFacade::addListener(AppEvents::APP_LISTENER, [$this->listener, 'onEvent']);
        EventDispatcherFacade::addListener(AppEvents::APP_PARAMS, [$this->listener, 'onParams'], 'data');
        EventDispatcherFacade::addListener(AppEvents::APP_CLOSURE, function () {
            Rudra::config()->set(["closure" => "closure"]);
        });
    }

    public function testInstance(): void
    {
        $this->assertInstanceOf(EventDispatcherInterface::class, Rudra::get(EventDispatcher::class));
        $this->assertInstanceOf(AppListener::class, $this->listener);
    }

    public function testListener(): void
    {
        EventDispatcherFacade::dispatch('app.listener', 123);
        $this->assertEquals(Rudra::config()->get('listener'), 123);
        $this->assertEquals(EventDispatcherFacade::dispatch(AppEvents::APP_PARAMS), 'data');
    }

    public function testClosure(): void
    {
        $closure = EventDispatcherFacade::dispatch('app.closure');
        $closure();

        $this->assertEquals(Rudra::config()->get('closure'), 'closure');
        $this->assertInstanceOf(\Closure::class, $closure);
    }

    public function testPublisher(): void
    {
        EventDispatcherFacade::attachObserver( "before", [TestController::class, "before"]);
        EventDispatcherFacade::notify("before");
        $this->assertEquals(Rudra::config()->get('subscriber'), "before");

        EventDispatcherFacade::attachObserver("after", [TestController::class, "after"]);
        EventDispatcherFacade::notify("after");
        $this->assertEquals(Rudra::config()->get('subscriber'), "after");
    }

    public function testGetListeners(): void
    {
        $this->assertIsArray(EventDispatcherFacade::getListeners());
    }

    public function testGetObservers(): void
    {
        $this->assertIsArray(EventDispatcherFacade::getObservers());
    }
}
