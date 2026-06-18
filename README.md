[![PHPunit](https://github.com/Jagepard/Rudra-EventDispatcher/actions/workflows/php.yml/badge.svg)](https://github.com/Jagepard/Rudra-EventDispatcher/actions/workflows/php.yml)
[![Maintainability](https://qlty.sh/badges/8e5c6538-3928-4780-a5ae-ec3184089714/maintainability.svg)](https://qlty.sh/gh/Jagepard/projects/Rudra-EventDispatcher)
[![CodeFactor](https://www.codefactor.io/repository/github/jagepard/rudra-eventdispatcher/badge)](https://www.codefactor.io/repository/github/jagepard/rudra-eventdispatcher)
[![Coverage Status](https://coveralls.io/repos/github/Jagepard/Rudra-EventDispatcher/badge.svg?branch=master)](https://coveralls.io/github/Jagepard/Rudra-EventDispatcher?branch=master)
-----

# Rudra-EventDispatcher | [API](https://github.com/Jagepard/Rudra-EventDispatcher/blob/master/docs.md "Documentation API")
#### Install
```composer require rudra/event-dispatcher```
#### Usage
```php
use Rudra\EventDispatcher\EventDispatcherFacade as Dispatcher;
```
##### Add a listener
```php
Dispatcher::addListener('app.listener', [AppListener::class, 'onEvent']);
Dispatcher::addListener('app.closure', function () {
    Rudra::config()->set(["closure" => "closure"]);
});
Dispatcher::addListener('before', [new TestController(), 'before']);
```
##### Dispatch an event
```php
Dispatcher::dispatch('app.listener', 123);

// For Closure listeners, dispatch returns the Closure itself
$closure = Dispatcher::dispatch('app.closure');
$closure();

Dispatcher::dispatch('before');
```
##### Attach an observer
```php
Dispatcher::attachObserver("before", [TestController::class, "before"]);
Dispatcher::attachObserver("closure", ['closure', function () {
    Rudra::config()->set(['closure' => "closure"]);
}]);

$test = new TestController();
Dispatcher::attachObserver("subscriberObject", [$test, "subscriberObject"], 123);
```
##### Detach an observer
```php
Dispatcher::detachObserver("before", TestController::class);
```
##### Notify the observers
```php
Dispatcher::notify("before");
Dispatcher::notify("closure");
Dispatcher::notify("subscriberObject");
```
##### Get all listeners / observers
```php
Dispatcher::getListeners();
Dispatcher::getObservers();
```
## License

This project is licensed under the **Mozilla Public License 2.0 (MPL-2.0)** — a free, open-source license that:

- Requires preservation of copyright and license notices,
- Allows commercial and non-commercial use,
- Requires that any modifications to the original files remain open under MPL-2.0,
- Permits combining with proprietary code in larger works.

📄 Full license text: [LICENSE](./LICENSE)  
🌐 Official MPL-2.0 page: https://mozilla.org/MPL/2.0/