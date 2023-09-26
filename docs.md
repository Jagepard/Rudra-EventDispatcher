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
|public|<em><strong>addListener</strong>( string $event  Closure|array $listener   $arguments ): void</em><br>Adds a listener for a specific event<br>Добавляет слушателя определенного события|
|public|<em><strong>dispatch</strong>( string $event   $arguments )</em><br>When an event is dispatched, it notifies listener registered with that event<br>Когда событие отправляется, оно уведомляет прослушиватель, <br>зарегистрированный с этим событием.|
|public|<em><strong>getListeners</strong>(): array</em><br>Gets all listeners<br>Получает всех слушателей|
|public|<em><strong>attachObserver</strong>( string $event  Closure|array $subscriber   $arguments ): void</em><br>Attaches an observer<br>Прикрепляет наблюдателя|
|public|<em><strong>detachObserver</strong>( string $event  string $subscriberName ): void</em><br>Detaches the observer<br>Отсоединяет наблюдателя|
|public|<em><strong>notify</strong>( string $event   $arguments ): void</em><br>Notifies observers of an event<br>Уведомляет наблюдателей о событии|
|public|<em><strong>getObservers</strong>(): array</em><br>Gets all observers<br>Получает всех наблюдателей|


<a id="rudra_eventdispatcher_eventdispatcherfacade"></a>

### Class: Rudra\EventDispatcher\EventDispatcherFacade
| Visibility | Function |
|:-----------|:---------|
|public static|<em><strong>__callStatic</strong>( string $method  array $parameters )</em><br>Calls class methods statically<br>Вызывает методы класса статически|


<a id="rudra_eventdispatcher_eventdispatcherinterface"></a>

### Class: Rudra\EventDispatcher\EventDispatcherInterface
| Visibility | Function |
|:-----------|:---------|
|abstract public|<em><strong>addListener</strong>( string $event  Closure|array $listener   $arguments ): void</em><br>Adds a listener for a specific event<br>Добавляет слушателя определенного события|
|abstract public|<em><strong>dispatch</strong>( string $event   $arguments )</em><br>When an event is dispatched, it notifies listener registered with that event<br>Когда событие отправляется, оно уведомляет прослушиватель, <br>зарегистрированный с этим событием.|
|abstract public|<em><strong>getListeners</strong>(): array</em><br>Gets all listeners<br>Получает всех слушателей|
|abstract public|<em><strong>attachObserver</strong>( string $event  Closure|array $subscriber   $arguments ): void</em><br>Attaches an observer<br>Прикрепляет наблюдателя|
|abstract public|<em><strong>detachObserver</strong>( string $event  string $subscriberName ): void</em><br>Detaches the observer<br>Отсоединяет наблюдателя|
|abstract public|<em><strong>notify</strong>( string $event   $arguments ): void</em><br>Notifies observers of an event<br>Уведомляет наблюдателей о событии|
|abstract public|<em><strong>getObservers</strong>(): array</em><br>Gets all observers<br>Получает всех наблюдателей|


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
