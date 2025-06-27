## Table of contents
- [Rudra\EventDispatcher\EventDispatcher](#rudra_eventdispatcher_eventdispatcher)
- [Rudra\EventDispatcher\EventDispatcherFacade](#rudra_eventdispatcher_eventdispatcherfacade)
- [Rudra\EventDispatcher\EventDispatcherInterface](#rudra_eventdispatcher_eventdispatcherinterface)
- [Rudra\EventDispatcher\EventInterface](#rudra_eventdispatcher_eventinterface)
- [Rudra\EventDispatcher\ObserverInterface](#rudra_eventdispatcher_observerinterface)
<hr>

<a id="rudra_eventdispatcher_eventdispatcher"></a>

### Class: Rudra\EventDispatcher\EventDispatcher
| Visibility | Function |
|:-----------|:---------|
| public | `addListener(string $event, Closure\|array $listener,  $arguments): void`<br>Adds an event listener for the specified event.<br>The listener can be either a Closure or an array containing a class/object and a method name.<br>If additional arguments are provided, they are stored along with the listener.<br>-------------------------<br>Добавляет обработчик событий для указанного события.<br>Обработчик может быть либо замыканием (Closure), либо массивом, содержащим класс/объект и имя метода.<br>Если предоставлены дополнительные аргументы, они сохраняются вместе с обработчиком. |
| public | `dispatch(string $event,  $arguments)`<br>Dispatches an event by invoking its associated listener.<br>If the listener is a Closure, it is returned directly.<br>If the listener is an object or class with a method, the method is invoked with optional arguments.<br>If the event does not exist or the listener is invalid, a LogicException is thrown.<br>-------------------------<br>Вызывает событие, выполняя связанный с ним обработчик.<br>Если обработчик является замыканием (Closure), оно возвращается напрямую.<br>Если обработчик — это объект или класс с методом, метод вызывается с необязательными аргументами.<br>Если событие не существует или обработчик недействителен, выбрасывается исключение LogicException. |
| public | `getListeners(): array`<br> |
| public | `attachObserver(string $event, array $subscriber,  $arguments): void`<br>Attaches an observer to a specific event.<br>The observer must be an array containing a class/object and a method name.<br>If additional arguments are provided, they are stored along with the observer.<br>-------------------------<br>Присоединяет наблюдателя к указанному событию.<br>Наблюдатель должен быть массивом, содержащим класс/объект и имя метода.<br>Если предоставлены дополнительные аргументы, они сохраняются вместе с наблюдателем. |
| public | `detachObserver(string $event, object\|string $subscriber): void`<br>Detaches an observer from a specific event.<br>The observer can be identified by its class name or object instance.<br>If the observer exists for the specified event, it is removed from the observers list.<br>-------------------------<br>Отсоединяет наблюдателя от указанного события.<br>Наблюдатель может быть идентифицирован по имени класса или экземпляру объекта.<br>Если наблюдатель существует для указанного события, он удаляется из списка наблюдателей. |
| public | `notify(string $event,  $arguments): void`<br>Notifies all observers of a specific event by invoking their associated methods.<br>If the event does not exist or the observer is invalid, a LogicException is thrown.<br>Observers can be objects or classes with methods, and optional arguments can be passed to them.<br>-------------------------<br>Уведомляет всех наблюдателей указанного события, вызывая связанные с ними методы.<br>Если событие не существует или наблюдатель недействителен, выбрасывается исключение LogicException.<br>Наблюдатели могут быть объектами или классами с методами, и им могут быть переданы необязательные аргументы. |
| public | `getObservers(): array`<br> |


<a id="rudra_eventdispatcher_eventdispatcherfacade"></a>

### Class: Rudra\EventDispatcher\EventDispatcherFacade
| Visibility | Function |
|:-----------|:---------|
| public static | `__callStatic(string $method, array $parameters): ?mixed`<br>Handles static method calls for the Facade class.<br>It dynamically resolves the underlying class name by removing "Facade" from the class name.<br>If the resolved class does not exist, it attempts to clean up the class name by removing spaces.<br>If the resolved class is not already registered in the container, it registers it.<br>Finally, it delegates the static method call to the resolved class instance.<br>-------------------------<br>Обрабатывает статические вызовы методов для класса Facade.<br>Динамически разрешает имя базового класса, удаляя "Facade" из имени класса.<br>Если разрешённый класс не существует, пытается очистить имя класса, удаляя пробелы.<br>Если разрешённый класс ещё не зарегистрирован в контейнере, он регистрируется.<br>В конце делегирует статический вызов метода экземпляру разрешённого класса. |


<a id="rudra_eventdispatcher_eventdispatcherinterface"></a>

### Class: Rudra\EventDispatcher\EventDispatcherInterface
| Visibility | Function |
|:-----------|:---------|
| abstract public | `addListener(string $event, Closure\|array $listener,  $arguments): void`<br> |
| abstract public | `dispatch(string $event,  $arguments)`<br> |
| abstract public | `getListeners(): array`<br> |
| abstract public | `attachObserver(string $event, array $subscriber,  $arguments): void`<br> |
| abstract public | `detachObserver(string $event, string $subscriberName): void`<br> |
| abstract public | `notify(string $event,  $arguments): void`<br> |
| abstract public | `getObservers(): array`<br> |


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
