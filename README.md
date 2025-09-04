# PHP Dependency Injection Benchmark

This repository benchmarks different dependency injection containers.

Tested with PHP 8.4.12.

## Dependency Versions

- **aura-di**
  - `aura/di`: `^5.0`

- **laravel**
  - `illuminate/container`: `^12.28`

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

- **symfony(uncompiled)**
  - `symfony/dependency-injection`: `^7.0`

- **dice**
  - `level-2/dice`: `^4.0`

## Summary

| Container | Average | Minimum | Maximum |
| --- | --- | --- | --- |
| aura-di | 0.0021727323532104493 | 0.0019011497497558594 | 0.002602100372314453 |
| laravel | 0.62267036437988 | 0.61787581443787 | 0.62684988975525 |
| nette-di | 0.0030275821685791 | 0.0029439926147461 | 0.0031428337097168 |
| php-di | 0.00089924335479736 | 0.00082111358642578 | 0.0010550022125244 |
| pimple | 0.070192074775696 | 0.069249868392944 | 0.071099996566772 |
| quickly(configured) | 0.0038796424865723 | 0.003817081451416 | 0.0040390491485596 |
| quickly(reflection) | 0.0038904190063477 | 0.0038211345672607 | 0.0040030479431152 |
| symfony(compiled) | 0.0026464939117432 | 0.0025930404663086 | 0.0027880668640137 |
| symfony(uncompiled) | 0.0020638227462769 | 0.0020380020141602 | 0.0020980834960938 |
| dice | 0 | 0 | 0 |

![Speed comparison without startup time](speed_comparison_without_startup.png)

![Speed comparison with startup time](speed_comparison_with_startup.png)
