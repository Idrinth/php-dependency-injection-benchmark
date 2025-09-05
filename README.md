# PHP Dependency Injection Benchmark

This repository benchmarks different dependency injection containers.

Tested with PHP 8.3.6.

## Dependency Versions

- **aura-di**
  - `aura/di`: `^5.0`

- **auryn**
  - `rdlowrey/auryn`: `^1.4`

- **dice**
  - `level-2/dice`: `^4.0`

- **laminas-servicemanager**
  - `laminas/laminas-servicemanager`: `^3.21`

- **laravel(singletons)**
  - `illuminate/container`: `^12.28`

- **laravel(unconfigured)**
  - `illuminate/container`: `^12.28`

- **league-container**
  - `league/container`: `^5.1`

- **nette-di**
  - `nette/di`: `^3.2`

- **php-di**
  - `php-di/php-di`: `^7.0`

- **pimple**
  - `pimple/pimple`: `^3.5`

- **quickly(configured)**
  - `idrinth/quickly`: `dev-master`

- **quickly(reflection)**
  - `idrinth/quickly`: `dev-master`

- **symfony(compiled)**
  - `symfony/dependency-injection`: `^7.0`

## Summary

| Container | Average | Minimum | Maximum |
| --- | --- | --- | --- |
| aura-di |  |  |  |
| auryn |  |  |  |
| dice |  |  |  |
| laminas-servicemanager |  |  |  |
| laravel(singletons) |  |  |  |
| laravel(unconfigured) |  |  |  |
| league-container |  |  |  |
| nette-di |  |  |  |
| php-di |  |  |  |
| pimple |  |  |  |
| quickly(configured) |  |  |  |
| quickly(reflection) |  |  |  |
| symfony(compiled) |  |  |  |

![Speed comparison without startup time](speed_comparison_without_startup06.png)

![Speed comparison with startup time](speed_comparison_with_startup06.png)

![Speed comparison without startup time](speed_comparison_without_startup16.png)

![Speed comparison with startup time](speed_comparison_with_startup16.png)

![Speed comparison without startup time](speed_comparison_without_startup26.png)

![Speed comparison with startup time](speed_comparison_with_startup26.png)
