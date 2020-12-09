[![Build Status](https://travis-ci.org/Jagepard/Rudra-EventDispatcher.svg?branch=master)](https://travis-ci.org/Jagepard/Rudra-EventDispatcher)
[![codecov](https://codecov.io/gh/Jagepard/Rudra-EventDispatcher/branch/master/graph/badge.svg)](https://codecov.io/gh/Jagepard/Rudra-EventDispatcher)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Jagepard/Rudra-EventDispatcher/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Jagepard/Rudra-EventDispatcher/?branch=master)
[![Code Climate](https://codeclimate.com/github/Jagepard/Rudra-EventDispatcher/badges/gpa.svg)](https://codeclimate.com/github/Jagepard/Rudra-EventDispatcher)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/4bd09ee61e04462aa123c92048150ff2)](https://www.codacy.com/app/Jagepard/Rudra-EventDispatcher?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Jagepard/Rudra-EventDispatcher&amp;utm_campaign=Badge_Grade)
-----
[![Code Intelligence Status](https://scrutinizer-ci.com/g/Jagepard/Rudra-EventDispatcher/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Latest Stable Version](https://poser.pugx.org/rudra/event-dispatcher/v/stable)](https://packagist.org/packages/rudra/event-dispatcher)
[![Total Downloads](https://poser.pugx.org/rudra/event-dispatcher/downloads)](https://packagist.org/packages/rudra/event-dispatcher)
![GitHub](https://img.shields.io/github/license/jagepard/Rudra-EventDispatcher.svg)

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
![Rudra-EventDispatcher](https://github.com/Jagepard/Rudra-EventDispatcher/blob/master/UML.png)
