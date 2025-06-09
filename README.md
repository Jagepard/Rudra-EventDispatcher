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
use Rudra\Container;
use Rudra\EventDispatcher;
use Rudra\Interfaces\ContainerInterface;
```
```php
$rudra = Container::app();
```
##### Вызов из контейнера / use container
```php
$services = [
    'contracts' => [
        ContainerInterface::class => $rudra,
    ],
    
    'services' => [
        // Another services
        
        'event.dispatcher' => ['Rudra\EventDispatcher'],
        
        // Another services
    ]
];
```
```php
$rudra->setServices($services); 
```
