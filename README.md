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
| [Yii3 DI](https://github.com/yiisoft/di) | configured singleton, reflection singleton | PSR-11 compatible DI container with definitions and auto-wiring |
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

Run from 2026-09-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 492µs, 214ns | 1ms, 256µs, 942ns | 1ms, 868µs, 9ns |
| Auryn(Reflection, Transient) | ^1.4 | 395ms, 593µs, 214ns | 286ms, 539µs, 793ns | 433ms, 223µs, 962ns |
| Dice(Configured, Singleton) | ^4.0 | 838µs, 685ns | 808µs, 954ns | 887µs, 870ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 624µs, 923ns | 70ms, 18µs, 53ns | 72ms, 4µs, 79ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 811µs, 4ns | 792µs, 980ns | 861µs, 883ns |
| Laravel(Configured, Transient) | ^12.28 | 387ms, 936µs, 639ns | 280ms, 401µs, 945ns | 428ms, 878µs, 68ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 534µs, 54ns | 2ms, 480µs, 30ns | 5ms, 878µs, 925ns |
| Laravel(Reflection, Transient) | ^12.28 | 580ms, 977µs, 940ns | 572ms, 956µs, 85ns | 586ms, 732µs, 864ns |
| League(Configured, Transient) | ^5.1 | 944ms, 301µs, 605ns | 621ms, 382µs, 951ns | 1s, 162ms, 703µs, 990ns |
| League(Reflection, Transient) | ^5.1 | 641ms, 72µs, 297ns | 493ms, 48µs, 906ns | 733ms, 728µs, 170ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 331µs, 971ns | 3ms, 258µs, 943ns | 3ms, 762µs, 6ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 964µs, 185ns | 2ms, 753µs, 973ns | 5ms, 322µs, 933ns |
| Phalcon(Configured, Transient) | ^5 | 269ms, 667µs, 387ns | 200ms, 933µs, 933ns | 301ms, 475µs, 763ns |
| Php-baseline |  | 578µs, 761ns | 560µs, 45ns | 597µs |
| Php-di(Reflection, Singleton) | ^7.0 | 636µs, 458ns | 596µs, 46ns | 876µs, 188ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 214µs, 694ns | 1ms, 44µs, 34ns | 1ms, 585µs, 960ns |
| Pimple(Configured, Transient) | ^3.5 | 90ms, 373µs, 706ns | 74ms, 800µs, 968ns | 113ms, 238µs, 96ns |
| Quickly(Compiled, Singleton) | dev-master | 783µs, 514ns | 762µs, 939ns | 863µs, 75ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 381µs, 993ns | 1ms, 331µs, 806ns | 1ms, 488µs, 924ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 377µs, 725ns | 1ms, 329µs, 898ns | 1ms, 575µs, 946ns |
| Ray-di(Compiled, Transient) | ^2.16 | 2s, 699ms, 842µs, 643ns | 1s, 632ms, 879µs, 18ns | 3s, 501ms, 848µs, 936ns |
| Ray-di(Reflection, Transient) | ^2.16 | 252ms, 525µs, 19ns | 161ms, 411µs, 46ns | 294ms, 960µs, 21ns |
| Symfony(Compiled, Singleton) | ^7.0 | 782µs, 84ns | 761µs, 32ns | 816µs, 106ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 660µs, 395ns | 623µs, 941ns | 865µs, 936ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 667µs, 119ns | 579µs, 118ns | 1ms, 186µs, 132ns |
| Zen(Compiled, Singleton) | ^3.1 | 801µs, 682ns | 715µs, 17ns | 1ms, 405µs |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 902µs, 127ns | 1ms, 497µs, 983ns | 3ms, 196µs, 954ns |
| Auryn(Reflection, Transient) | ^1.4 | 405ms, 513µs, 167ns | 333ms, 810µs, 806ns | 434ms, 144µs, 973ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 699µs, 709ns | 1ms, 388µs, 72ns | 2ms, 272µs, 129ns |
| Dice(Reflection, Transient) | ^4.0 | 71ms, 874µs, 427ns | 70ms, 25µs, 920ns | 75ms, 224µs, 876ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 739µs, 2ns | 622µs, 987ns | 1ms, 595µs, 20ns |
| Laravel(Configured, Transient) | ^12.28 | 380ms, 500µs, 388ns | 308ms, 712µs, 959ns | 414ms, 539µs, 813ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 793µs, 478ns | 3ms, 369µs, 92ns | 5ms, 458µs, 831ns |
| Laravel(Reflection, Transient) | ^12.28 | 584ms, 770µs, 202ns | 582ms, 692µs, 861ns | 587ms, 213µs, 993ns |
| League(Configured, Transient) | ^5.1 | 1s, 51ms, 269µs, 221ns | 872ms, 927µs, 904ns | 1s, 162ms, 616µs, 14ns |
| League(Reflection, Transient) | ^5.1 | 640ms, 835µs, 475ns | 488ms, 337µs, 39ns | 727ms, 864µs, 980ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 613µs, 186ns | 2ms, 565µs, 145ns | 2ms, 897µs, 24ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 345µs, 154ns | 3ms, 403µs, 902ns | 5ms, 327µs, 939ns |
| Phalcon(Configured, Transient) | ^5 | 251ms, 686µs, 239ns | 156ms, 966µs, 924ns | 290ms, 845µs, 870ns |
| Php-baseline |  | 612µs, 616ns | 573µs, 873ns | 649µs, 929ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 61µs, 511ns | 806µs, 93ns | 3ms, 130µs, 912ns |
| Pimple(Configured, Singleton) | ^3.5 | 828µs, 99ns | 773µs, 906ns | 999µs, 927ns |
| Pimple(Configured, Transient) | ^3.5 | 85ms, 737µs, 705ns | 71ms, 290µs, 969ns | 101ms, 644µs, 39ns |
| Quickly(Compiled, Singleton) | dev-master | 785µs, 303ns | 761µs, 32ns | 799µs, 179ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 526µs, 593ns | 2ms, 43µs, 8ns | 3ms, 622µs, 55ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 744µs, 103ns | 1ms, 348µs, 972ns | 2ms, 207µs, 994ns |
| Ray-di(Compiled, Transient) | ^2.16 | 2s, 777ms, 740µs, 478ns | 1s, 158ms, 720µs, 970ns | 3s, 496ms, 555µs, 89ns |
| Ray-di(Reflection, Transient) | ^2.16 | 279ms, 636µs, 216ns | 164ms, 984µs, 941ns | 303ms, 193µs, 92ns |
| Symfony(Compiled, Singleton) | ^7.0 | 521µs, 87ns | 481µs, 128ns | 580µs, 72ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 150µs, 441ns | 916µs, 957ns | 3ms, 81µs, 798ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 52µs, 856ns | 832µs, 80ns | 2ms, 817µs, 153ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 47µs, 968ns | 829µs, 935ns | 2ms, 907µs, 37ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 620µs, 674ns | 1ms, 578µs, 92ns | 1ms, 754µs, 999ns |
| Dice(Configured, Singleton) | ^4.0 | 815µs, 558ns | 794µs, 887ns | 859µs, 22ns |
| Laravel(Configured, Transient) | ^12.28 | 347ms, 998µs, 762ns | 260ms, 322µs, 93ns | 426ms, 321µs, 29ns |
| League(Configured, Transient) | ^5.1 | 8s, 575ms, 85µs, 67ns | 6s, 456ms, 293µs, 106ns | 9s, 480ms, 762µs, 4ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 2µs, 668ns | 1ms, 950µs, 25ns | 2ms, 274µs, 990ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 131µs, 77ns | 4ms, 323µs, 5ns | 8ms, 152µs, 8ns |
| Phalcon(Configured, Transient) | ^5 | 265ms, 206µs, 170ns | 180ms, 560µs, 111ns | 295ms, 804µs, 23ns |
| Pimple(Configured, Singleton) | ^3.5 | 827µs, 670ns | 727µs, 176ns | 980µs, 138ns |
| Pimple(Configured, Transient) | ^3.5 | 77ms, 33µs, 424ns | 52ms, 318µs, 96ns | 100ms, 612µs, 163ns |
| Quickly(Compiled, Singleton) | dev-master | 789µs, 833ns | 767µs, 946ns | 808µs, 954ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 526µs, 401ns | 3ms, 468µs, 36ns | 3ms, 684µs, 997ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 90ms, 643µs, 739ns | 2s, 150ms, 802µs, 135ns | 3s, 323ms, 966µs, 26ns |
| Symfony(Compiled, Singleton) | ^7.0 | 639µs, 510ns | 553µs, 846ns | 777µs, 6ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 415µs, 730ns | 375µs, 986ns | 588µs, 893ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 425µs, 672ns | 373µs, 840ns | 797µs, 986ns |
| Zen(Compiled, Singleton) | ^3.1 | 519µs, 442ns | 447µs, 988ns | 931µs, 24ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 29µs, 991ns | 1ms, 638µs, 889ns | 3ms, 340µs, 5ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 904µs, 320ns | 1ms, 749µs, 38ns | 2ms, 233µs, 28ns |
| Laravel(Configured, Transient) | ^12.28 | 340ms, 757µs, 822ns | 216ms, 727µs, 972ns | 393ms, 774µs, 32ns |
| League(Configured, Transient) | ^5.1 | 9s, 27ms, 699µs, 232ns | 6s, 425ms, 937µs, 175ns | 9s, 529ms, 613µs, 971ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 331µs, 733ns | 2ms, 257µs, 108ns | 2ms, 665µs, 42ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 842µs, 41ns | 4ms, 501µs, 104ns | 8ms, 445µs, 24ns |
| Phalcon(Configured, Transient) | ^5 | 270ms, 987µs, 367ns | 198ms, 328µs, 18ns | 322ms, 681µs, 903ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 355µs, 75ns | 1ms, 315µs, 832ns | 1ms, 580µs, 953ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 485µs, 560ns | 99ms, 979µs, 877ns | 107ms, 501µs, 29ns |
| Quickly(Compiled, Singleton) | dev-master | 785µs, 589ns | 770µs, 92ns | 827µs, 789ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 744µs, 172ns | 4ms, 507µs, 64ns | 5ms, 467µs, 891ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 313ms, 799µs, 118ns | 3s, 248ms, 939µs, 990ns | 3s, 451ms, 581µs, 954ns |
| Symfony(Compiled, Singleton) | ^7.0 | 751µs, 519ns | 737µs, 190ns | 782µs, 12ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 241µs, 922ns | 1ms, 881ns | 3ms, 341µs, 197ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 994µs, 706ns | 793µs, 933ns | 2ms, 683µs, 162ns |
| Zen(Compiled, Singleton) | ^3.1 | 760µs, 412ns | 580µs, 72ns | 2ms, 147µs, 912ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 4ms, 725µs, 193ns | 2ms, 995µs, 967ns | 5ms, 342µs, 6ns |
| Dice(Configured, Singleton) | ^4.0 | 899µs, 100ns | 489µs, 950ns | 1ms, 462µs, 936ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 9ms, 423µs, 112ns | 7s, 822ms, 854µs, 995ns | 10s, 599ms, 879µs, 26ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 618µs, 600ns | 585µs, 79ns | 761µs, 32ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 716µs, 993ns | 3ms, 123µs, 44ns | 3ms, 858µs, 89ns |
| Laravel(Reflection, Transient) | ^12.28 | 75s, 605ms, 915µs, 784ns | 56s, 642ms, 340µs, 898ns | 82s, 277ms, 956µs, 962ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 614µs, 616ns | 3ms, 520µs, 965ns | 4ms, 39µs, 49ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 359µs, 245ns | 3ms, 368µs, 139ns | 5ms, 768µs, 60ns |
| Php-baseline |  | 584µs, 745ns | 422µs, 954ns | 844µs, 1ns |
| Php-di(Reflection, Singleton) | ^7.0 | 667µs, 285ns | 622µs, 34ns | 973µs, 939ns |
| Pimple(Configured, Singleton) | ^3.5 | 970µs, 482ns | 905µs, 990ns | 1ms, 138µs, 925ns |
| Pimple(Configured, Transient) | ^3.5 | 12s, 345ms, 164µs, 227ns | 9s, 797ms, 636µs, 985ns | 14s, 561ms, 879µs, 158ns |
| Quickly(Compiled, Singleton) | dev-master | 623µs, 345ns | 606µs, 60ns | 649µs, 929ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 315µs, 784ns | 1ms, 291µs, 36ns | 1ms, 357µs, 793ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 429µs, 33ns | 1ms, 342µs, 58ns | 1ms, 634µs, 120ns |
| Symfony(Compiled, Singleton) | ^7.0 | 599µs, 122ns | 584µs, 125ns | 625µs, 133ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 77µs, 628ns | 807µs, 46ns | 1ms, 189µs, 947ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 887µs, 894ns | 818µs, 14ns | 1ms, 422µs, 882ns |
| Zen(Compiled, Singleton) | ^3.1 | 870µs, 60ns | 764µs, 131ns | 1ms, 574µs, 993ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 318µs, 140ns | 3ms, 803µs, 968ns | 8ms, 75µs, 952ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 216µs, 362ns | 1ms, 348µs, 18ns | 2ms, 431µs, 869ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 419ms, 562µs, 387ns | 5s, 408ms, 121µs, 824ns | 10s, 675ms, 740µs, 957ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 589µs, 84ns | 422µs | 1ms, 532µs, 793ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 957µs, 605ns | 2ms, 829µs, 74ns | 5ms, 398µs, 35ns |
| Laravel(Reflection, Transient) | ^12.28 | 77s, 72ms, 289µs, 133ns | 62s, 184ms, 163µs, 93ns | 81s, 505ms, 203µs, 8ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 358µs, 888ns | 3ms, 270µs, 149ns | 3ms, 890µs, 37ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 585µs, 576ns | 2ms, 930µs, 164ns | 6ms, 474µs, 18ns |
| Php-baseline |  | 633µs, 764ns | 386µs, 953ns | 1ms, 378µs, 59ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 615µs, 643ns | 1ms, 53µs, 94ns | 4ms, 335µs, 165ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 421µs, 785ns | 1ms, 332µs, 998ns | 1ms, 697µs, 63ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 432ms, 243µs, 919ns | 10s, 738ms, 531µs, 827ns | 14s, 479ms, 506µs, 969ns |
| Quickly(Compiled, Singleton) | dev-master | 779µs, 461ns | 757µs, 932ns | 792µs, 980ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 158µs, 308ns | 1ms, 74µs, 75ns | 1ms, 698µs, 17ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 507µs, 735ns | 1ms, 374µs, 959ns | 2ms, 268µs, 75ns |
| Symfony(Compiled, Singleton) | ^7.0 | 785µs, 732ns | 769µs, 138ns | 799µs, 894ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 198µs, 363ns | 958µs, 919ns | 3ms, 82µs, 36ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 855µs, 40ns | 684µs, 976ns | 2ms, 227µs, 67ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 83µs, 421ns | 841µs, 140ns | 3ms, 18µs, 140ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 809µs, 883ns | 1ms, 741µs, 170ns | 1ms, 891µs, 851ns |
| Dice(Configured, Singleton) | ^4.0 | 712µs, 180ns | 499µs, 963ns | 900µs, 983ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 96µs, 698ns | 3ms, 997µs, 87ns | 4ms, 616µs, 975ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 998µs, 16ns | 3ms, 311µs, 872ns | 8ms, 70µs, 945ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 324µs, 677ns | 1ms, 266µs, 956ns | 1ms, 359µs, 939ns |
| Pimple(Configured, Transient) | ^3.5 | 12s, 456ms, 24µs, 813ns | 8s, 238ms, 375µs, 186ns | 14s, 439ms, 455µs, 986ns |
| Quickly(Compiled, Singleton) | dev-master | 781µs, 488ns | 752µs, 925ns | 845µs, 909ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 916µs, 96ns | 3ms, 856µs, 182ns | 4ms, 17µs, 829ns |
| Symfony(Compiled, Singleton) | ^7.0 | 746µs, 393ns | 725µs, 30ns | 817µs, 60ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 864µs, 195ns | 787µs, 973ns | 1ms, 181µs, 125ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 468µs, 659ns | 411µs, 33ns | 854µs, 15ns |
| Zen(Compiled, Singleton) | ^3.1 | 911µs, 402ns | 797µs, 33ns | 1ms, 637µs, 935ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 190µs, 660ns | 2ms, 71µs, 857ns | 5ms, 356µs, 788ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 224µs, 564ns | 1ms, 709µs, 938ns | 2ms, 390µs, 861ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 222µs, 490ns | 2ms, 151µs, 966ns | 2ms, 524µs, 852ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 799µs, 461ns | 3ms, 530µs, 25ns | 5ms, 335µs, 92ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 333µs, 427ns | 1ms, 276µs, 969ns | 1ms, 566µs, 886ns |
| Pimple(Configured, Transient) | ^3.5 | 12s, 666ms, 213µs, 83ns | 8s, 257ms, 383µs, 108ns | 14s, 423ms, 594µs, 951ns |
| Quickly(Compiled, Singleton) | dev-master | 816µs, 655ns | 773µs, 906ns | 916µs, 957ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 641µs, 437ns | 4ms, 491µs, 806ns | 5ms, 435µs, 943ns |
| Symfony(Compiled, Singleton) | ^7.0 | 779µs, 914ns | 749µs, 111ns | 797µs, 986ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 429µs, 9ns | 977µs, 993ns | 4ms, 749µs, 59ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 718µs, 450ns | 438µs, 928ns | 2ms, 259µs, 16ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 56µs, 265ns | 808µs, 954ns | 3ms, 25µs, 54ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 816µs, 82ns | 782µs, 12ns | 998µs, 973ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 486µs, 990ns | 3ms, 334µs, 999ns | 3ms, 958µs, 940ns |
| Php-di(Reflection, Singleton) | ^7.0 | 898µs, 337ns | 826µs, 120ns | 1ms, 307µs, 10ns |
| Pimple(Configured, Singleton) | ^3.5 | 633µs, 573ns | 623µs, 941ns | 644µs, 922ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 873ns | 775µs, 98ns | 967µs, 979ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 360µs, 416ns | 1ms, 340µs, 866ns | 1ms, 438µs, 140ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 384µs, 425ns | 1ms, 339µs, 912ns | 1ms, 611µs, 948ns |
| Symfony(Compiled, Singleton) | ^7.0 | 774µs, 836ns | 757µs, 217ns | 808µs, 954ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 862µs, 193ns | 791µs, 72ns | 1ms, 226µs, 902ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 742µs, 602ns | 591µs, 39ns | 1ms, 147µs, 985ns |
| Zen(Compiled, Singleton) | ^3.1 | 372µs, 838ns | 324µs, 964ns | 754µs, 117ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 101µs, 660ns | 944µs, 137ns | 2ms, 188µs, 920ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 772µs, 139ns | 3ms, 687µs, 143ns | 4ms, 126µs, 71ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 268µs, 744ns | 1ms, 8µs, 33ns | 3ms, 458µs, 23ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 414µs, 275ns | 1ms, 361µs, 131ns | 1ms, 676µs, 797ns |
| Quickly(Compiled, Singleton) | dev-master | 815µs, 320ns | 806µs, 93ns | 825µs, 166ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 161µs, 478ns | 2ms, 72µs, 95ns | 2ms, 861µs, 22ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 640µs, 987ns | 1ms, 497µs, 983ns | 2ms, 485µs, 36ns |
| Symfony(Compiled, Singleton) | ^7.0 | 837µs, 206ns | 813µs, 961ns | 880µs, 2ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 181µs, 221ns | 947µs, 952ns | 3ms, 212µs, 928ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 184µs, 821ns | 947µs, 952ns | 3ms, 95µs, 149ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 190µs, 948ns | 938µs, 892ns | 3ms, 15µs, 995ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 901µs, 169ns | 3ms, 974µs, 914ns | 8ms, 926µs, 868ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 217µs, 889ns | 1ms, 206µs, 159ns | 1ms, 235µs, 8ns |
| Quickly(Compiled, Singleton) | dev-master | 360µs, 989ns | 349µs, 998ns | 377µs, 178ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 819µs, 966ns | 3ms, 782µs, 987ns | 3ms, 866µs, 910ns |
| Symfony(Compiled, Singleton) | ^7.0 | 766µs, 873ns | 749µs, 826ns | 818µs, 14ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 442µs, 981ns | 404µs, 834ns | 668µs, 48ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 941µs, 300ns | 793µs, 933ns | 1ms, 710µs, 176ns |
| Zen(Compiled, Singleton) | ^3.1 | 449µs, 800ns | 380µs, 39ns | 904µs, 83ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 903µs, 721ns | 4ms, 60µs, 29ns | 8ms, 759µs, 21ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 386µs, 22ns | 1ms, 341µs, 104ns | 1ms, 600µs, 27ns |
| Quickly(Compiled, Singleton) | dev-master | 811µs, 719ns | 797µs, 986ns | 826µs, 120ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 698µs, 276ns | 4ms, 543µs, 66ns | 5ms, 459µs, 785ns |
| Symfony(Compiled, Singleton) | ^7.0 | 872µs, 731ns | 755µs, 71ns | 1ms, 224µs, 994ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 3µs, 813ns | 808µs | 2ms, 571µs, 105ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 980µs, 496ns | 794µs, 887ns | 2ms, 471µs, 923ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 177µs, 310ns | 946µs, 998ns | 3ms, 39µs, 121ns |

</details>

Questions, issues, and new containers are welcome!
