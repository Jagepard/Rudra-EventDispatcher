## Table of contents

- [\Rudra\EventDispatcher](#class-rudraeventdispatcher)
- [\Rudra\Interfaces\EventInterface (interface)](#interface-rudrainterfaceseventinterface)
- [\Rudra\Interfaces\EventSubscriberInterface (interface)](#interface-rudrainterfaceseventsubscriberinterface)
- [\Rudra\Interfaces\ObserverSubscriberInterface (interface)](#interface-rudrainterfacesobserversubscriberinterface)
- [\Rudra\Interfaces\EventDispatcherInterface (interface)](#interface-rudrainterfaceseventdispatcherinterface)

<hr /><a id="class-rudraeventdispatcher"></a>
### Class: \Rudra\EventDispatcher

> Class EventDispatcher

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addListener(</strong><em>\string</em> <strong>$name</strong>, <em>mixed</em> <strong>$listener</strong>)</strong> : <em>mixed</em> |
| public | <strong>addSubscribers(</strong><em>[\Rudra\Interfaces\EventSubscriberInterface](#interface-rudrainterfaceseventsubscriberinterface)</em> <strong>$subscriber</strong>, <em>null</em> <strong>$event=null</strong>)</strong> : <em>void</em> |
| public | <strong>attachSubscriber(</strong><em>\string</em> <strong>$event</strong>, <em>[\Rudra\Interfaces\ObserverSubscriberInterface](#interface-rudrainterfacesobserversubscriberinterface)</em> <strong>$subscriber</strong>)</strong> : <em>void</em> |
| public | <strong>detachSubscriber(</strong><em>\string</em> <strong>$event</strong>, <em>[\Rudra\Interfaces\ObserverSubscriberInterface](#interface-rudrainterfacesobserversubscriberinterface)</em> <strong>$subscriber</strong>)</strong> : <em>void</em> |
| public | <strong>dispatch(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>mixed</em> |
| public | <strong>notify(</strong><em>\string</em> <strong>$event</strong>)</strong> : <em>void</em> |

*This class implements [\Rudra\Interfaces\EventDispatcherInterface](#interface-rudrainterfaceseventdispatcherinterface)*

<hr /><a id="interface-rudrainterfaceseventinterface"></a>
### Interface: \Rudra\Interfaces\EventInterface

> Interface EventInterface

| Visibility | Function |
|:-----------|:---------|

<hr /><a id="interface-rudrainterfaceseventsubscriberinterface"></a>
### Interface: \Rudra\Interfaces\EventSubscriberInterface

> Interface EventSubscriberInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>getSubscribedEvents()</strong> : <em>array</em> |

<hr /><a id="interface-rudrainterfacesobserversubscriberinterface"></a>
### Interface: \Rudra\Interfaces\ObserverSubscriberInterface

> Interface ObserverSubscriberInterface

| Visibility | Function |
|:-----------|:---------|

<hr /><a id="interface-rudrainterfaceseventdispatcherinterface"></a>
### Interface: \Rudra\Interfaces\EventDispatcherInterface

> Interface EventDispatcherInterface

| Visibility | Function |
|:-----------|:---------|
| public | <strong>addListener(</strong><em>\string</em> <strong>$name</strong>, <em>mixed</em> <strong>$listener</strong>)</strong> : <em>mixed</em> |
| public | <strong>addSubscribers(</strong><em>[\Rudra\Interfaces\EventSubscriberInterface](#interface-rudrainterfaceseventsubscriberinterface)</em> <strong>$subscriber</strong>, <em>null</em> <strong>$event=null</strong>)</strong> : <em>void</em> |
| public | <strong>attachSubscriber(</strong><em>\string</em> <strong>$event</strong>, <em>[\Rudra\Interfaces\ObserverSubscriberInterface](#interface-rudrainterfacesobserversubscriberinterface)</em> <strong>$subscriber</strong>)</strong> : <em>void</em> |
| public | <strong>detachSubscriber(</strong><em>\string</em> <strong>$event</strong>, <em>[\Rudra\Interfaces\ObserverSubscriberInterface](#interface-rudrainterfacesobserversubscriberinterface)</em> <strong>$subscriber</strong>)</strong> : <em>void</em> |
| public | <strong>dispatch(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>mixed</em> |
| public | <strong>notify(</strong><em>\string</em> <strong>$event</strong>)</strong> : <em>void</em> |

