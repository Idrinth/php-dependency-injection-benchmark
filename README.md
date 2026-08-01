# PHP Dependency Injection Benchmark

![PHP Version](https://img.shields.io/badge/PHP-8.4-blue?logo=php) ![Docker Version](https://img.shields.io/badge/Docker-%2A-lightgrey?logo=docker) ![OS](https://img.shields.io/badge/OS-ubuntu%20latest-blue?logo=ubuntu) ![Memory](https://img.shields.io/badge/Memory-500MB-blue) ![CPU](https://img.shields.io/badge/CPU-1%20Core-blue)

![PHP Dependency Injection Benchmark](images/php-dependency-injection-benchmark.jpg)

Dependency injection (DI) containers manage the creation and wiring of object dependencies, allowing applications to remain decoupled and easier to maintain.
Testing these containers verifies that they resolve dependencies correctly and perform efficiently, which is vital for application reliability.

This repository benchmarks different dependency injection containers.

**The "quickly" container is maintained by the same author as this benchmark, and the results may be unconsciously biased.**

To reduce favoritism, results are averaged over multiple runs and, where possible, multiple configurations of each container are benchmarked.

Detailed benchmark data, including environment details and dependency versions, is available in [`run_summary.yaml`](run_summary.yaml).
Raw outputs for each monthly run are archived under the [`archive`](archive) directory with date-based subdirectories.

## 📂 Test Files

The benchmark defines three dependency graphs used for testing.

- `src/classes-06.php` (`f06`): 6 classes.
- `src/classes-16.php` (`p16`): 16 classes.
- `src/classes-26.php` (`z26`): 26 classes.

The class names (`f06`, `p16`, `z26`) follow a group-unique letter plus total class count in the group to avoid overlap.

Each file contains all required classes and avoids autoloading so that container performance measurements exclude file-loading overhead.
Each test is executed with and without container startup time to measure resolution speed and initialization cost.

## 🚀 Running individual benchmarks

Build the container and execute a benchmark using docker:

```sh
docker build -t di-benchmark-php-di -f containers/php-di/Dockerfile .
docker run --rm -v "$PWD:/out" di-benchmark-php-di php benchmark.php f06 1
```

The build step prepares the image for the chosen container, and the run command executes a single run of the specified test (for example, `f06`). The resulting `results.json` file will be written to the current directory.

Some containers perform extra work during the image build; for example, `ray-di.compiled` precompiles its dependencies automatically.

## 🧩 Containers

| Name+Link | Run combinations | Description |
| --- | --- | --- |
| [Aura.Di](https://github.com/auraphp/Aura.Di) | configured transient | Configurable DI container with lazy loading and service factories |
| [PHP-DI](https://github.com/PHP-DI/PHP-DI) | reflection singleton | Autowiring, annotations, and compiled container support |
| [Pimple](https://github.com/silexphp/Pimple) | configured singleton, configured transient | Lightweight closure-based container |
| [Symfony DI](https://github.com/symfony/dependency-injection) | compiled singleton | Feature-rich container with configuration and compilation |
| [Laravel Container](https://github.com/laravel/framework) | configured transient, reflection singleton, reflection transient | Framework-integrated container with automatic resolution and binding |
| [Nette DI](https://github.com/nette/di) | compiled singleton | High-performance compiled container |
| [Auryn](https://github.com/rdlowrey/auryn) | reflection transient | Auryn is a dependency injector for bootstrapping object-oriented PHP applications. |
| [Dice](https://github.com/Level-2/Dice) | configured singleton, reflection transient | A minimalist dependency injection container for PHP. |
| [Laminas ServiceManager](https://github.com/laminas/laminas-servicemanager) | reflection singleton | Factory-driven dependency injection container |
| [League Container](https://github.com/thephpleague/container) | configured transient, reflection transient | A fast and intuitive dependency injection container. |
| [Phalcon](https://github.com/phalcon/cphalcon) | configured singleton, configured transient | A PHP extension built for performance |
| [PHP (baseline)](https://www.php.net/) |  | Manual instantiation of dependencies with simple caching |
| [Quickly](https://github.com/Idrinth/quickly) | compiled singleton, configured singleton, reflection singleton | A fast dependency injection container featuring build time resolution. |
| [Ray.Di](https://github.com/ray-di/Ray.Di) | compiled transient, reflection transient | DI and AOP framework for PHP inspired by Google Guice |
| [Zen](https://github.com/woohoolabs/zen) | compiled singleton | Woohoo Labs. Zen DI Container and preload file generator |
## Latest Results

Run from 2026-08-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 655µs, 554ns | 1ms, 580µs, 953ns | 1ms, 758µs, 813ns |
| Auryn(Reflection, Transient) | ^1.4 | 385ms, 215µs, 616ns | 288ms, 738µs, 965ns | 410ms, 564µs, 184ns |
| Dice(Configured, Singleton) | ^4.0 | 737µs, 23ns | 635µs, 147ns | 846µs, 147ns |
| Dice(Reflection, Transient) | ^4.0 | 58ms, 491µs, 182ns | 42ms, 851µs, 924ns | 76ms, 547µs, 861ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 610µs, 280ns | 592µs, 947ns | 654µs, 935ns |
| Laravel(Configured, Transient) | ^12.28 | 387ms, 840µs, 676ns | 303ms, 135µs, 871ns | 416ms, 504µs, 859ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 418µs, 612ns | 3ms, 250µs, 122ns | 3ms, 689µs, 50ns |
| Laravel(Reflection, Transient) | ^12.28 | 592ms, 670µs, 583ns | 586ms, 957µs, 931ns | 601ms, 32µs, 18ns |
| League(Configured, Transient) | ^5.1 | 1s, 83ms, 721µs, 899ns | 716ms, 909µs, 885ns | 1s, 183ms, 243µs, 36ns |
| League(Reflection, Transient) | ^5.1 | 685ms, 692µs, 214ns | 528ms, 536µs, 81ns | 777ms, 462µs, 5ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 456µs, 354ns | 3ms, 305µs, 912ns | 4ms, 118µs, 919ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 378µs, 247ns | 3ms, 748µs, 178ns | 5ms, 240µs, 917ns |
| Phalcon(Configured, Transient) | ^5 | 266ms, 777µs, 133ns | 210ms, 155µs, 10ns | 306ms, 457µs, 42ns |
| Php-baseline |  | 707µs, 364ns | 591µs, 993ns | 916µs, 4ns |
| Php-di(Reflection, Singleton) | ^7.0 | 868µs, 201ns | 816µs, 106ns | 1ms, 199µs, 7ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 311µs, 612ns | 1ms, 286µs, 983ns | 1ms, 346µs, 826ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 999µs, 737ns | 96ms, 764µs, 87ns | 102ms, 967µs, 23ns |
| Quickly(Compiled, Singleton) | dev-master | 789µs, 93ns | 764µs, 131ns | 846µs, 862ns |
| Quickly(Configured, Singleton) | dev-master | 830µs, 578ns | 803µs, 947ns | 847µs, 101ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 379µs, 919ns | 1ms, 347µs, 64ns | 1ms, 475µs, 95ns |
| Ray-di(Compiled, Transient) | ^2.16 | 2s, 852ms, 144µs, 384ns | 1s, 666ms, 305µs, 65ns | 3s, 490ms, 991µs, 830ns |
| Ray-di(Reflection, Transient) | ^2.16 | 258ms, 913µs, 922ns | 156ms, 797µs, 885ns | 298ms, 356µs, 56ns |
| Symfony(Compiled, Singleton) | ^7.0 | 787µs, 854ns | 757µs, 217ns | 874µs, 996ns |
| Zen(Compiled, Singleton) | ^3.1 | 883µs, 889ns | 792µs, 980ns | 1ms, 530µs, 885ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 267µs, 289ns | 1ms, 724µs, 958ns | 5ms, 271µs, 196ns |
| Auryn(Reflection, Transient) | ^1.4 | 399ms, 220µs, 108ns | 289ms, 682µs, 865ns | 431ms, 558µs, 132ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 146µs, 29ns | 2ms, 15µs, 829ns | 2ms, 616µs, 882ns |
| Dice(Reflection, Transient) | ^4.0 | 73ms, 921µs, 656ns | 71ms, 86µs, 883ns | 78ms, 238µs, 10ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 746µs, 393ns | 602µs, 960ns | 1ms, 571µs, 893ns |
| Laravel(Configured, Transient) | ^12.28 | 406ms, 842µs, 637ns | 396ms, 105µs, 51ns | 420ms, 341µs, 14ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 708µs, 100ns | 3ms, 388µs, 881ns | 4ms, 879µs, 951ns |
| Laravel(Reflection, Transient) | ^12.28 | 537ms, 691µs, 116ns | 482ms, 600µs, 927ns | 593ms, 133µs, 211ns |
| League(Configured, Transient) | ^5.1 | 1s, 96ms, 199µs, 917ns | 728ms, 632µs, 211ns | 1s, 189ms, 391µs, 851ns |
| League(Reflection, Transient) | ^5.1 | 634ms, 312µs, 629ns | 505ms, 780µs, 935ns | 720ms, 487µs, 117ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 610µs, 491ns | 3ms, 499µs, 31ns | 4ms, 56µs, 215ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 212µs, 689ns | 3ms, 417µs, 968ns | 5ms, 87µs, 137ns |
| Phalcon(Configured, Transient) | ^5 | 279ms, 743µs, 623ns | 229ms, 230µs, 165ns | 297ms, 801µs, 17ns |
| Php-baseline |  | 378µs, 513ns | 291µs, 109ns | 458µs, 955ns |
| Php-di(Reflection, Singleton) | ^7.0 | 574µs, 231ns | 433µs, 206ns | 1ms, 749µs, 992ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 312µs, 780ns | 1ms, 260µs, 995ns | 1ms, 549µs, 5ns |
| Pimple(Configured, Transient) | ^3.5 | 87ms, 369µs, 322ns | 71ms, 128µs, 129ns | 105ms, 839µs, 14ns |
| Quickly(Compiled, Singleton) | dev-master | 818µs, 800ns | 803µs, 947ns | 839µs, 948ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 135µs, 992ns | 2ms, 21µs, 74ns | 2ms, 888µs, 202ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 462µs, 602ns | 1ms, 353µs, 25ns | 2ms, 206µs, 87ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 106ms, 173µs, 181ns | 1s, 661ms, 247µs, 14ns | 3s, 516ms, 432µs, 46ns |
| Ray-di(Reflection, Transient) | ^2.16 | 299ms, 75µs, 31ns | 177ms, 774µs, 190ns | 340ms, 559µs, 5ns |
| Symfony(Compiled, Singleton) | ^7.0 | 756µs, 573ns | 726µs, 938ns | 793µs, 933ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 33µs, 43ns | 813µs, 961ns | 2ms, 840µs, 995ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 259µs, 803ns | 847µs, 101ns | 1ms, 732µs, 826ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 17µs, 785ns | 810µs, 861ns | 1ms, 246µs, 929ns |
| Laravel(Configured, Transient) | ^12.28 | 352ms, 138µs, 352ns | 290ms, 436µs, 983ns | 412ms, 961µs, 959ns |
| League(Configured, Transient) | ^5.1 | 8s, 883ms, 260µs, 703ns | 7s, 173ms, 634µs, 52ns | 9s, 765ms, 382µs, 51ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 138µs, 183ns | 4ms, 35µs, 949ns | 4ms, 683µs, 971ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 991µs, 674ns | 4ms, 209µs, 41ns | 7ms, 958µs, 889ns |
| Phalcon(Configured, Transient) | ^5 | 271ms, 955µs, 108ns | 205ms, 245µs, 971ns | 305ms, 752µs, 38ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 301µs, 240ns | 1ms, 253µs, 128ns | 1ms, 327µs, 37ns |
| Pimple(Configured, Transient) | ^3.5 | 79ms, 533µs, 100ns | 58ms, 951µs, 139ns | 100ms, 800µs, 991ns |
| Quickly(Compiled, Singleton) | dev-master | 599µs, 479ns | 586µs, 32ns | 610µs, 113ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 833µs, 222ns | 3ms, 805µs, 160ns | 3ms, 865µs, 3ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 323ms, 44µs, 824ns | 2s, 727ms, 263µs, 927ns | 3s, 510ms, 267µs, 972ns |
| Symfony(Compiled, Singleton) | ^7.0 | 749µs, 778ns | 730µs, 37ns | 782µs, 12ns |
| Zen(Compiled, Singleton) | ^3.1 | 869µs, 774ns | 784µs, 873ns | 1ms, 502µs, 990ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 729µs, 511ns | 1ms, 668µs, 930ns | 5ms, 377µs, 54ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 682µs, 591ns | 1ms, 197µs, 814ns | 2ms, 399µs, 921ns |
| Laravel(Configured, Transient) | ^12.28 | 387ms, 250µs, 757ns | 377ms, 604µs, 961ns | 393ms, 462µs, 896ns |
| League(Configured, Transient) | ^5.1 | 8s, 696ms, 739µs, 244ns | 4s, 973ms, 47µs, 971ns | 9s, 628ms, 759µs, 860ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 92µs, 597ns | 3ms, 942µs, 12ns | 4ms, 423µs, 856ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 22µs, 765ns | 3ms, 354µs, 72ns | 5ms, 753µs, 40ns |
| Phalcon(Configured, Transient) | ^5 | 273ms, 62µs, 443ns | 180ms, 327µs, 892ns | 309ms, 33µs, 870ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 326µs, 990ns | 1ms, 275µs, 62ns | 1ms, 605µs, 987ns |
| Pimple(Configured, Transient) | ^3.5 | 87ms, 865µs, 924ns | 74ms, 465µs, 36ns | 99ms, 586µs, 963ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 179µs, 170ns | 1ms, 142µs, 978ns | 1ms, 255µs, 989ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 684µs, 996ns | 4ms, 475µs, 116ns | 5ms, 316µs, 19ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 266ms, 677µs, 451ns | 2s, 741ms, 320µs, 848ns | 3s, 519ms, 419µs, 908ns |
| Symfony(Compiled, Singleton) | ^7.0 | 790µs, 596ns | 761µs, 985ns | 828µs, 981ns |
| Zen(Compiled, Singleton) | ^3.1 | 756µs, 120ns | 552µs, 892ns | 2ms, 370µs, 119ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 148µs, 959ns | 4ms, 271µs, 984ns | 5ms, 360µs, 841ns |
| Dice(Configured, Singleton) | ^4.0 | 829µs, 29ns | 675µs, 201ns | 905µs, 36ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 902ms, 384µs, 614ns | 8s, 174ms, 800µs, 157ns | 10s, 452ms, 584µs, 28ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 793µs, 743ns | 760µs, 78ns | 921µs, 10ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 502µs, 702ns | 2ms, 578µs, 20ns | 3ms, 859µs, 43ns |
| Laravel(Reflection, Transient) | ^12.28 | 71s, 961ms, 862µs, 802ns | 40s, 538ms, 705µs, 110ns | 83s, 219ms, 179µs, 153ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 560µs, 805ns | 3ms, 420µs, 829ns | 4ms, 418µs, 134ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 270µs, 886ns | 4ms, 317µs, 998ns | 10ms, 452µs, 32ns |
| Php-baseline |  | 643µs, 134ns | 583µs, 887ns | 752µs, 925ns |
| Php-di(Reflection, Singleton) | ^7.0 | 840µs, 44ns | 777µs, 959ns | 1ms, 189µs, 231ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 319µs, 193ns | 1ms, 290µs, 82ns | 1ms, 361µs, 131ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 606ms, 88µs, 805ns | 10s, 85ms, 888µs, 147ns | 14s, 342ms, 691µs, 898ns |
| Quickly(Compiled, Singleton) | dev-master | 832µs, 366ns | 802µs, 40ns | 861µs, 883ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 331µs, 400ns | 1ms, 307µs, 10ns | 1ms, 367µs, 807ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 350µs, 998ns | 1ms, 320µs, 838ns | 1ms, 494µs, 884ns |
| Symfony(Compiled, Singleton) | ^7.0 | 578µs, 22ns | 556µs, 945ns | 614µs, 881ns |
| Zen(Compiled, Singleton) | ^3.1 | 884µs, 509ns | 777µs, 6ns | 1ms, 564µs, 979ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 948µs, 661ns | 5ms, 66µs, 871ns | 10ms, 442µs, 972ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 405µs, 261ns | 1ms, 883µs, 983ns | 2ms, 629µs, 41ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 331ms, 893µs, 396ns | 9s, 963ms, 783µs, 979ns | 10s, 591ms, 438µs, 55ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 754µs, 475ns | 613µs, 927ns | 1ms, 691µs, 102ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 832µs, 291ns | 3ms, 974ns | 5ms, 421µs, 876ns |
| Laravel(Reflection, Transient) | ^12.28 | 75s, 855ms, 727µs, 410ns | 57s, 579ms, 668µs, 998ns | 82s, 691ms, 557µs, 168ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 591µs, 322ns | 3ms, 503µs, 799ns | 3ms, 942µs, 12ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 292µs, 487ns | 4ms, 343µs, 986ns | 8ms, 798µs, 837ns |
| Php-baseline |  | 565µs, 552ns | 319µs, 957ns | 757µs, 932ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 139µs, 378ns | 883µs, 102ns | 3ms, 318µs, 786ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 424µs, 765ns | 1ms, 364µs, 946ns | 1ms, 667µs, 22ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 44ms, 153µs, 523ns | 8s, 354ms, 217µs, 52ns | 14s, 314ms, 749µs, 2ns |
| Quickly(Compiled, Singleton) | dev-master | 853µs, 538ns | 829µs, 935ns | 868µs, 82ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 144µs, 241ns | 2ms, 41µs, 101ns | 2ms, 854µs, 824ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 534µs, 914ns | 1ms, 420µs, 21ns | 2ms, 246µs, 856ns |
| Symfony(Compiled, Singleton) | ^7.0 | 828µs, 981ns | 787µs, 973ns | 902µs, 175ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 14µs, 900ns | 783µs, 920ns | 2ms, 766µs, 132ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 706µs, 910ns | 1ms, 411µs, 914ns | 1ms, 857µs, 995ns |
| Dice(Configured, Singleton) | ^4.0 | 957µs, 417ns | 619µs, 888ns | 1ms, 443µs, 147ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 792µs, 215ns | 2ms, 701µs, 44ns | 3ms, 71µs, 69ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 558µs, 134ns | 3ms, 344µs, 58ns | 5ms, 69µs, 17ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 266µs, 598ns | 1ms, 246µs, 929ns | 1ms, 305µs, 818ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 280ms, 71µs, 544ns | 10s, 504ms, 48µs, 109ns | 14s, 255ms, 767µs, 107ns |
| Quickly(Compiled, Singleton) | dev-master | 799µs, 393ns | 787µs, 973ns | 816µs, 106ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 842µs, 67ns | 3ms, 803µs, 14ns | 3ms, 932µs, 952ns |
| Symfony(Compiled, Singleton) | ^7.0 | 535µs, 988ns | 488µs, 996ns | 684µs, 976ns |
| Zen(Compiled, Singleton) | ^3.1 | 861µs, 96ns | 774µs, 145ns | 1ms, 529µs, 932ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 344µs, 273ns | 2ms, 235µs, 174ns | 5ms, 405µs, 902ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 412µs, 271ns | 1ms, 733µs, 64ns | 3ms, 628µs, 969ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 499µs, 101ns | 3ms, 613µs, 948ns | 6ms, 759µs, 166ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 423µs, 402ns | 4ms, 733µs, 85ns | 8ms, 669µs, 853ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 404µs, 118ns | 1ms, 357µs, 78ns | 1ms, 646µs, 995ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 146ms, 213µs, 316ns | 13s, 651ms, 807µs, 69ns | 14s, 351ms, 261µs, 854ns |
| Quickly(Compiled, Singleton) | dev-master | 810µs, 980ns | 792µs, 980ns | 837µs, 802ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 773µs, 283ns | 4ms, 584µs, 74ns | 5ms, 437µs, 135ns |
| Symfony(Compiled, Singleton) | ^7.0 | 601µs, 29ns | 583µs, 887ns | 627µs, 40ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 132µs, 678ns | 910µs, 997ns | 2ms, 956µs, 867ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 798µs, 34ns | 767µs, 946ns | 982µs, 999ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 727µs, 315ns | 3ms, 472µs, 805ns | 7ms, 771µs, 968ns |
| Php-di(Reflection, Singleton) | ^7.0 | 854µs, 110ns | 792µs, 26ns | 1ms, 290µs, 82ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 224µs, 470ns | 1ms, 184µs, 940ns | 1ms, 260µs, 42ns |
| Quickly(Compiled, Singleton) | dev-master | 838µs, 398ns | 774µs, 145ns | 967µs, 25ns |
| Quickly(Configured, Singleton) | dev-master | 782µs, 608ns | 748µs, 872ns | 845µs, 909ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 396µs, 870ns | 1ms, 338µs, 5ns | 1ms, 619µs, 815ns |
| Symfony(Compiled, Singleton) | ^7.0 | 784µs, 325ns | 769µs, 138ns | 809µs, 907ns |
| Zen(Compiled, Singleton) | ^3.1 | 889µs, 182ns | 787µs, 19ns | 1ms, 579µs, 46ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 815µs, 534ns | 704µs, 50ns | 1ms, 657µs, 9ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 228µs, 354ns | 3ms, 145µs, 933ns | 3ms, 645µs, 896ns |
| Php-di(Reflection, Singleton) | ^7.0 | 995µs, 397ns | 787µs, 973ns | 2ms, 624µs, 988ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 449µs, 823ns | 1ms, 389µs, 26ns | 1ms, 742µs, 839ns |
| Quickly(Compiled, Singleton) | dev-master | 820µs, 398ns | 801µs, 86ns | 838µs, 994ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 188µs, 86ns | 2ms, 80µs, 917ns | 2ms, 938µs, 985ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 616µs, 215ns | 1ms, 509µs, 904ns | 2ms, 377µs, 33ns |
| Symfony(Compiled, Singleton) | ^7.0 | 871µs, 396ns | 834µs, 941ns | 920µs, 57ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 192µs, 307ns | 948µs, 905ns | 3ms, 38µs, 883ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 19µs, 737ns | 3ms, 891µs, 944ns | 4ms, 479µs, 169ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 284µs, 3ns | 1ms, 266µs, 2ns | 1ms, 322µs, 984ns |
| Quickly(Compiled, Singleton) | dev-master | 844µs, 621ns | 813µs, 961ns | 916µs, 957ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 876µs, 852ns | 3ms, 817µs, 81ns | 3ms, 922µs, 224ns |
| Symfony(Compiled, Singleton) | ^7.0 | 796µs, 508ns | 758µs, 886ns | 849µs, 962ns |
| Zen(Compiled, Singleton) | ^3.1 | 852µs, 346ns | 749µs, 111ns | 1ms, 571µs, 178ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 961µs, 467ns | 3ms, 881µs, 216ns | 4ms, 369µs, 20ns |
| Pimple(Configured, Singleton) | ^3.5 | 904µs, 822ns | 833µs, 988ns | 1ms, 18µs, 47ns |
| Quickly(Compiled, Singleton) | dev-master | 822µs, 830ns | 801µs, 801ns | 861µs, 167ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 261µs, 280ns | 3ms, 171µs, 920ns | 3ms, 777µs, 980ns |
| Symfony(Compiled, Singleton) | ^7.0 | 796µs, 484ns | 759µs, 840ns | 921µs, 10ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 180µs, 672ns | 962µs, 972ns | 3ms, 4µs, 789ns |

</details>

Questions, issues, and new containers are welcome!
