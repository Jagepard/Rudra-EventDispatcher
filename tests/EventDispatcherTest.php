<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\EventDispatcher\Tests;

use Rudra\EventDispatcher\{
    EventDispatcher,
    EventDispatcherFacade,
    EventDispatcherInterface,
    Tests\Stub\Events\AppEvents,
    Tests\Stub\Listeners\AppListener
};
use Rudra\Container\Facades\Rudra;
use Rudra\Exceptions\LogicException;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;
use Rudra\EventDispatcher\Tests\Stub\Controllers\TestController;

class EventDispatcherTest extends PHPUnit_Framework_TestCase
{
    protected AppListener $listener;

    protected function setUp(): void
    {
        Rudra::set([EventDispatcher::class, EventDispatcher::class]);

        EventDispatcherFacade::addListener(AppEvents::APP_LISTENER, [AppListener::class, 'onEvent']);
        EventDispatcherFacade::addListener(AppEvents::APP_PARAMS, [AppListener::class, 'onParams'], 'data');
        EventDispatcherFacade::addListener(AppEvents::APP_CLOSURE, function () {
            Rudra::config()->set(["closure" => "closure"]);
        });
        EventDispatcherFacade::addListener('before', [new TestController(), 'before']);
    }

    public function testInstance(): void
    {
        $this->assertInstanceOf(EventDispatcherInterface::class, Rudra::get(EventDispatcher::class));
        $this->assertInstanceOf(AppListener::class, new AppListener());
    }

    public function testListener(): void
    {
        EventDispatcherFacade::dispatch('app.listener', 123);
        $this->assertEquals(Rudra::config()->get('listener'), 123);
        EventDispatcherFacade::dispatch('before');
        $this->assertEquals(Rudra::config()->get('subscriber'), 'before');
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
        EventDispatcherFacade::attachObserver("before", [TestController::class, "before"]);
        EventDispatcherFacade::notify("before");
        $this->assertEquals(Rudra::config()->get('subscriber'), "before");
        EventDispatcherFacade::detachObserver("before", TestController::class);

        EventDispatcherFacade::attachObserver("after", [TestController::class, "after"]);
        EventDispatcherFacade::notify("after");
        $this->assertEquals(Rudra::config()->get('subscriber'), "after");

        EventDispatcherFacade::attachObserver("closure", ['closure', function () {
            Rudra::config()->set(['closure' => "closure"]);
        }]);
        EventDispatcherFacade::notify("closure");
        $this->assertEquals(Rudra::config()->get('closure'), "closure");
    }

    public function testPublisherObject(): void
    {
        $test = new TestController();

        EventDispatcherFacade::attachObserver("subscriberObject", [$test, "subscriberObject"], 123);
        EventDispatcherFacade::notify("subscriberObject");
        $this->assertEquals(Rudra::config()->get('subscriberObject'), "subscriberObject");
        EventDispatcherFacade::detachObserver("subscriberObject", $test);
    }

    public function testGetListeners(): void
    {
        $this->assertIsArray(EventDispatcherFacade::getListeners());
    }

    public function testGetObservers(): void
    {
        $this->assertIsArray(EventDispatcherFacade::getObservers());
    }

    public function testAddLogicException(): void
    {
        $this->expectException(LogicException::class);
        EventDispatcherFacade::addListener(AppEvents::APP_LISTENER, [AppListener::class]);
    }

    public function testDispatchLogicException(): void
    {
        $this->expectException(LogicException::class);
        EventDispatcherFacade::dispatch('SomeEvent');
    }

    public function testAttachLogicException(): void  
    {
        $this->expectException(LogicException::class);
        EventDispatcherFacade::attachObserver('SomeEvent', ['string']);
    }

    public function testNotifyLogicException(): void  
    {
        $this->expectException(LogicException::class);
        EventDispatcherFacade::notify('wrong_event');
    }

    public function testNotifyWrongMethodSubscriberLogicException(): void  
    {
        $this->expectException(LogicException::class);
        EventDispatcherFacade::attachObserver("wrongMethod", [TestController::class, "wrongMethod"]);
        EventDispatcherFacade::notify('wrongMethod');
    }
}
