## Table of contents
- [Rudra\EventDispatcher\EventDispatcher](#rudra_eventdispatcher_eventdispatcher)
- [Rudra\EventDispatcher\EventDispatcherFacade](#rudra_eventdispatcher_eventdispatcherfacade)
- [Rudra\EventDispatcher\EventDispatcherInterface](#rudra_eventdispatcher_eventdispatcherinterface)
- [Rudra\EventDispatcher\EventInterface](#rudra_eventdispatcher_eventinterface)
- [Rudra\EventDispatcher\ObserverInterface](#rudra_eventdispatcher_observerinterface)
<hr>

<a id="rudra_eventdispatcher_eventdispatcher"></a>

### Class: Rudra\EventDispatcher\EventDispatcher
##### implements [Rudra\EventDispatcher\EventDispatcherInterface](#rudra_eventdispatcher_eventdispatcherinterface)
| Visibility | Function |
|:-----------|:---------|
|public|<em><strong>addListener</strong>( string $event  Closure|array $listener   $arguments ): void</em><br>|
|public|<em><strong>dispatch</strong>( string $event   $arguments )</em><br>|
|public|<em><strong>getListeners</strong>(): array</em><br>|
|public|<em><strong>attachObserver</strong>( string $event  array $subscriber   $arguments ): void</em><br>|
|public|<em><strong>detachObserver</strong>( string $event  object|string $subscriber ): void</em><br>|
|public|<em><strong>notify</strong>( string $event   $arguments ): void</em><br>Notifies observers of an event|
|public|<em><strong>getObservers</strong>(): array</em><br>|


<a id="rudra_eventdispatcher_eventdispatcherfacade"></a>

### Class: Rudra\EventDispatcher\EventDispatcherFacade
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters ): mixed</em><br>|


<a id="rudra_eventdispatcher_eventdispatcherinterface"></a>

### Class: Rudra\EventDispatcher\EventDispatcherInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>addListener</strong>( string $event  Closure|array $listener   $arguments ): void</em><br>|
|abstract public|<em><strong>dispatch</strong>( string $event   $arguments )</em><br>|
|abstract public|<em><strong>getListeners</strong>(): array</em><br>|
|abstract public|<em><strong>attachObserver</strong>( string $event  array $subscriber   $arguments ): void</em><br>|
|abstract public|<em><strong>detachObserver</strong>( string $event  string $subscriberName ): void</em><br>|
|abstract public|<em><strong>notify</strong>( string $event   $arguments ): void</em><br>|
|abstract public|<em><strong>getObservers</strong>(): array</em><br>|


<a id="rudra_eventdispatcher_eventinterface"></a>

### Class: Rudra\EventDispatcher\EventInterface
| Visibility | Function |
|:-----------|:---------|


<a id="rudra_eventdispatcher_observerinterface"></a>

### Class: Rudra\EventDispatcher\ObserverInterface
| Visibility | Function |
|:-----------|:---------|
<hr>

###### created with [Rudra-Documentation-Collector](#https://github.com/Jagepard/Rudra-Documentation-Collector)
