[![PHPunit](https://github.com/Jagepard/Rudra-EventDispatcher/actions/workflows/php.yml/badge.svg)](https://github.com/Jagepard/Rudra-EventDispatcher/actions/workflows/php.yml)
[![Maintainability](https://qlty.sh/badges/8e5c6538-3928-4780-a5ae-ec3184089714/maintainability.svg)](https://qlty.sh/gh/Jagepard/projects/Rudra-EventDispatcher)
[![CodeFactor](https://www.codefactor.io/repository/github/jagepard/rudra-eventdispatcher/badge)](https://www.codefactor.io/repository/github/jagepard/rudra-eventdispatcher)
[![Coverage Status](https://coveralls.io/repos/github/Jagepard/Rudra-EventDispatcher/badge.svg?branch=master)](https://coveralls.io/github/Jagepard/Rudra-EventDispatcher?branch=master)
-----

# Rudra-EventDispatcher | [API](https://github.com/Jagepard/Rudra-EventDispatcher/blob/master/docs.md "Documentation API")
Диспетчер событий

#### Установка / Install
```composer require rudra/event-dispatcher```
#### Использование / Usage
```php
use Rudra\EventDispatcher\EventDispatcherFacade as Dispatcher;
```
##### Add listeners / Добавление слушателей
```php
Dispatcher::addListener('app.listener', [AppListener::class, 'onEvent']);
Dispatcher::addListener('app.closure', function () {
    Rudra::config()->set(["closure" => "closure"]);
});
Dispatcher::addListener('before', [new TestController(), 'before']);
```
##### Dispatches an event / Вызывает событие
```php
Dispatcher::dispatch('app.listener', 123);
Dispatcher::dispatch('app.closure');
Dispatcher::dispatch('before');
```
##### Attach observer / Прикрепить наблюдателя
```php
Dispatcher::attachObserver("before", [TestController::class, "before"]);
Dispatcher::attachObserver("closure", ['closure', function () {
    Rudra::config()->set(['closure' => "closure"]);
}]);
######
$test = new TestController();
Dispatcher::attachObserver("subscriberObject", [$test, "subscriberObject"], 123);
```
##### Detach observer / Отсоединить наблюдателя
```php
Dispatcher::detachObserver("before", TestController::class);
```
##### Notify the observers / Оповестить наблюдателей
```php
Dispatcher::notify("before");
Dispatcher::notify("closure");
Dispatcher::notify("subscriberObject");
```
