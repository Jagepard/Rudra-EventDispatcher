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
use Rudra\Tests\stub\SomeController;
use Rudra\Interfaces\EventDispatcherInterface;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

/**
 * Class EventDispatcherTest
 * @package Rudra\Tests
 */
class EventDispatcherTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var SomeController
     */
    protected $handler;
    /**
     * @var EventDispatcher
     */
    protected $mediator;

    protected function setUp(): void
    {
        $this->handler  = new SomeController();
        $this->mediator = new EventDispatcher();
    }

    public function testInstance(): void
    {
        $this->assertInstanceOf(EventDispatcherInterface::class, $this->mediator);
        $this->assertInstanceOf(SomeController::class, $this->handler);
    }

    public function testDispatch(): void
    {
        $this->mediator->addListener('onEvent', new SomeController, 'onEvent');
        $this->mediator->dispatch('onEvent');

        $this->assertEquals(Container::$app->get('some'), 'value');
    }
}
