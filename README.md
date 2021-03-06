# Introduction
The objective of the project is to develop a multi-threaded application server for PHP, written in PHP. Yes, pure PHP! You think we aren't serious? Maybe! But we think, in order to enable as many developers in our great community, this will be the one and only way to enable you helping us. Through the broadest possible support of the PHP community we hopefully establish this solution as the standard for enterprise applications in PHP environment.

# Highlights
* Servlet engine, with full HTTP 1.1 support
* Web Socket engine, based on [Ratchet](http://socketo.me/)
* Session beans (stateful, stateless + singleton)
* Message beans
* Doctrine as standard Persistence provider
* Timer service
* Integrate message queue
* Web services
* Cluster functionality
* Hot deployment of Web Apps (Mac OS X and Debian only)

# Technical Features
* Joe Watkins [phtreads](https://github.com/krakjoe/pthreads) library is used
* DI & AO  usage within the respective container
* Use of annotations to configure beans
* Configuration by Exception (optional Usage of Deployment Descriptor possible)

The implementation of a Web application and its operation in the PHP Application Server must be as simple as possible. For this purpose, whenever possible, the utilization of standard solution based on existing components as a, such as Doctrine, are used. On the other hand, with the paradigm Configuration by exception, the operation of an application with a minimum of configuration is needed. So a lot of the use cases is already covered by the default behavior of the respective integrated components so that the developer often does not need declarative configuration information.To appeal to the widest possible community the architecture of the Application Server must be constructed so that as large a number of existing applications can easily be migrated via adapter. Furthermore, the future development of Web applications based on all relevant PHP frameworks by providing libraries is supported.

# Requirements
* PHP 5.4+ on x64 or x86
* ZTS Enabled (Thread Safety)
* Posix Threads Implementation
* Memcached (2.1+)

The lastest version is only tested with Mac OS 10.8+ and Debian Wheezy. PHP Application Server should run on any PHP version from 5.3+. However segmentation faults occurred in various tests with PHP 5.3.x repeatedly. Meanwhile this can lead to the early development stage of the pthreads library. We actually use PHP 5.5.+ for development.

# Installation
Actually we support Mac OS X Mountain Lion and Debian Wheezy. We also plan to release a Windows installer and a RPM package as soon as possible but as we're only Mac users we'll be happy if someone is out there to support us with that stuff. Finally it's possible to build the runtime by yourself. This can be done by cloning our [Runtime Environment] (https://github.com/techdivision/TechDivision_Runtime). We've added two ANT targets `create-pkg` and `create-deb` that should do the stuff for you.

## Installation on Mountain Lion
To install on your Mac OS X Mountain Lion please download the actual .pkg Package from http://www.appserver.io.
After downloading the .pkg you can start installation process with a double click on the package. To install the
software you need to have administration privileges (sudo). After the installation process, which is really simple,
you'll find the Application Server software in the folder `/opt/appserver`.

When the installation has been finished the Application Server will be started automatically. If you need to restart
the Application Server, after you've deployed a new app for example, you can use the init scripts `sbin/appserverctl`
and `sbin/memcachectl` therefore. Both accept `start`, `stop` and `restart` as parameter.

Start your favorite browser and open the URL `http://127.0.0.1:8586/demo` to load the demo application.

## Installation on a Debian Wheezy
If you're on a Debian system you don't need to download the .deb package. Follow these instructions:

```
root@debian:~# echo "deb http://deb.appserver.io/ wheezy main" > /etc/apt/sources.list.d/appserver.list
root@debian:~# wget http://deb.appserver.io/appserver.gpg -O - | apt-key add -
root@debian:~# aptitude update
root@debian:~# aptitude install appserver
```

This will install the Application Server in directory `/opt/appserver`. Also it'll be started automatically, but you
can start, stop or restart it with the init-script `/etc/init.d/appserver` and the parameter `start`, `stop` and `restart`. Additionally it is necessary that the memcached daemon has been started before the Application Server will be started itself.

After installation you can open a really simply example app with your favorite browser open the URL
`http://127.0.0.1:8586/demo`.

## Installation on Windows (7+)
To install the Application Server on Windows you first have to download the latest .jar archive from http://appserver.io/downloads.
After doing so you have to check your system for an installed Java Runtime Environment (or JDK that is).
This is a vital requirement for you to use the .jar file.
If the JRE is not installed you have to get it from http://www.oracle.com/technetwork/java/javase/downloads/jre7-downloads-1880261.html first.

If this requirement is met you can start the installation by simply double-clicking the .jar archive.
After authorizing the access to your computer, a guided installation wizard will appear and perform the installation.

After the installation you can start the Application Server with the ``server.bat`` file located within the root directory of your installation.
Best thing to do would be starting a command prompt as an administrator and run the following commands (assuming default installation path):

```
C:\Windows\system32>cd "C:\Program Files\appserver"
C:\Program Files\appserver>server.bat
```

As a final step you can start your favorite browser and open the URL `http://127.0.0.1:8586/demo` to load the demo application.

## Installation on Fedora
To install the Application Server on Fedora (other RedHat-ish systems are not tested yet) you first have to download the latest .rpm archive from
http://appserver.io/downloads.
You can double click the .rpm package for installation or use yum with `yum install <PATH_TO_RPM>` as root.
This will install the appserver within `/opt/appserver` and start it together with a file watcher daemon as soon as installation finishes.

Now start your favorite browser and open the URL `http://127.0.0.1:8586/demo` to load the demo application.

During installation we registered systemd units for the appserver, so you can controll it with `systemctl <COMMAND> appserver` where command
are the basic systemd commands like `start`, `stop`, `restart` and `status`.

# Uninstall
To uninstall the Application Server on Mac OS X, you simply have to delete the folder `/opt/appserver` and the configuration files for the launch deameons. These are files are located in folder `/Library/LaunchDaemons` and named `io.appserver.appserver.plist`, `io.appserver.memcached.plist` and `io.appserver.redis.plist`. On Linux you can simple uninstall the Application Server with the package managment tool you've installed it. If you're using Debian you can use `apitude remove appserver` for example.

# Roadmap
As we're in heavy development it may be, that we've to move some tasks from the following roadmap to a earlier/later version, please be aware of that. If you've ideas or features that definitely has to be in one of the next releases, please contact us. We're always open for new ideas or feedback.

And yes, we've plans for a Community and a Enterprise edition. The Community Edition will provide all functionality needed to develop, run maintain all kind of web applications. The Enterprise Edition will focus on large software solutions that run on many servers and needs real cluster functionality.

## Community Edition

### Version 0.5.8 - Application Server + [WebSocketContainer](https://github.com/techdivision/TechDivision_WebSocketContainer)
- [x] Logging with [monolog](https://github.com/Seldaek/monolog>)
- [x] Generic management API
- [x] HTTP basic + digest authentication for Servlet Container
- [x] Integrate annotations for session beans
- [x] Administration interface with drag-and-drop PHAR installer
- [x] Automated Build- and Deployment using Travis-CI
- [x] Set environment variables in XML configuration files
- [x] Merging XML configuration files
- [x] WebSocket integration
- [x] Running Magento CE 1.7.x + 1.8.x demo applications

### Version 0.5.9 - Application Server + [ServletContainer](https://github.com/techdivision/TechDivision_ServletContainer)
- [x] Windows installer
- [x] PHAR based deployment
- [x] SSL Encryption for TechDivision_ServletContainer project
- [x] RPM packages

### Version 0.6.0 - Application Server + [ServletContainer](https://github.com/techdivision/TechDivision_ServletContainer)
- [ ] AOP
- [ ] DI
- [ ] Refactor routing
- [ ] [Design by Contract](https://github.com/wick-ed/php-by-contract)
- [ ] Separate configuration files for server, container and application
- [ ] Running TYPO3 6.x demo application
- [ ] Running TYPO3 Flow 2.0.x demo application
- [ ] Running TYPO3 Neos 1.x demo application
- [ ] Mac OS X Universal installer
- [ ] 100 % Coverage for PHPUnit test suite for TechDivision_ApplicationServer project
- [ ] RPM repository

### Version 0.7 - [Servlet Container](https://github.com/techdivision/TechDivision_ServletContainer)
- [ ] mod_rewrite functionality for TechDivision_ServletContainer project
- [ ] Add dynamic load of application specific PECL extensions
- [ ] 100 % Coverage for PHPUnit test suite for TechDivision_ServletContainer project

### Version 0.8 - [Persistence Container](https://github.com/techdivision/TechDivision_PersistenceContainer)
- [ ] Stateful + Singleton session bean functionality
- [ ] Container managed entity beans for Doctrine
- [ ] Webservice for session beans
- [ ] 100 % Coverage for PHPUnit test suite for TechDivision_PersistenceContainer project

### Version 0.9 - [Message Queue](https://github.com/techdivision/TechDivision_MessageQueue)
- [ ] Message bean functionality
- [ ] 100 % Coverage for PHPUnit test suite for TechDivision_MessageQueue project

### Version 1.0 - Timer Service
- [ ] Timer Service
- [ ] 100 % Coverage for PHPUnit test suite for TechDivision_TimerService project

### Version 1.1 - Additional Containers
- [ ] Distributed and redundant cluster caching system with automated failover
- [ ] Fast-CGI container

## Enterprise Edition
### Version 1.2 - Cluster Functionality
- [ ] Cluster functionality
- [ ] Appserver nodes get known each other in same network automatically
- [ ] Webapps running on nodes in same network can be executed via all appserver nodes
- [ ] Webapps can be synchronized between appserver nodes to be executed locally
- [ ] Snapshot functionality for webapps
- [ ] HA Loadbalancing Container
- [ ] Container based transactions
- [ ] Hot-Deployment
- [ ] Farming deployment
- [ ] Web Application Firewall (WAF)
