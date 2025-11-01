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

Run from 2025-11-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 610µs, 64ns | 1ms, 552µs, 820ns | 1ms, 753µs, 807ns |
| Auryn(Reflection, Transient) | ^1.4 | 405ms, 728µs, 316ns | 396ms, 826µs, 28ns | 430ms, 651µs, 187ns |
| Dice(Configured, Singleton) | ^4.0 | 831µs, 7ns | 791µs, 72ns | 921µs, 10ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 827µs, 889ns | 70ms, 161µs, 104ns | 72ms, 735µs, 786ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 776µs, 290ns | 748µs, 872ns | 840µs, 902ns |
| Laravel(Configured, Transient) | ^12.28 | 398ms, 526µs, 763ns | 335ms, 36µs, 993ns | 430ms, 783µs, 987ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 33µs, 231ns | 2ms, 893µs, 924ns | 6ms, 156µs, 921ns |
| Laravel(Reflection, Transient) | ^12.28 | 627ms, 295µs, 875ns | 618ms, 685µs, 7ns | 633ms, 134µs, 841ns |
| League(Configured, Transient) | ^5.1 | 828ms, 512µs, 215ns | 726ms, 634µs, 979ns | 860ms, 168µs, 933ns |
| League(Reflection, Transient) | ^5.1 | 659ms, 145µs, 593ns | 649ms, 343µs, 13ns | 672ms, 723µs, 54ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 287µs, 720ns | 3ms, 213µs, 882ns | 3ms, 725µs, 51ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 784µs, 823ns | 3ms, 756µs, 999ns | 3ms, 845µs, 930ns |
| Phalcon(Configured, Transient) | ^5 | 286ms, 723µs, 899ns | 263ms, 498µs, 67ns | 296ms, 524µs, 47ns |
| Php-baseline |  | 592µs, 827ns | 571µs, 12ns | 638µs, 8ns |
| Php-di(Reflection, Singleton) | ^7.0 | 895µs, 428ns | 814µs, 914ns | 1ms, 296µs, 997ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 201µs, 701ns | 1ms, 179µs, 933ns | 1ms, 221µs, 895ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 587µs, 79ns | 99ms, 750µs, 995ns | 116ms, 935µs, 968ns |
| Quickly(Compiled, Singleton) | dev-master | 807µs, 547ns | 781µs, 774ns | 845µs, 909ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 371µs, 264ns | 1ms, 349µs, 925ns | 1ms, 415µs, 967ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 355µs, 99ns | 1ms, 327µs, 37ns | 1ms, 453µs, 161ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 492ms, 624µs, 306ns | 3s, 441ms, 192µs, 865ns | 3s, 545ms, 584µs, 917ns |
| Ray-di(Reflection, Transient) | ^2.16 | 332ms, 168µs, 483ns | 301ms, 456µs, 928ns | 354ms, 820µs, 13ns |
| Symfony(Compiled, Singleton) | ^7.0 | 731µs, 849ns | 706µs, 911ns | 754µs, 117ns |
| Zen(Compiled, Singleton) | ^3.1 | 831µs, 699ns | 745µs, 58ns | 1ms, 419µs, 67ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 11µs, 704ns | 1ms, 697µs, 63ns | 3ms, 155µs, 946ns |
| Auryn(Reflection, Transient) | ^1.4 | 403ms, 937µs, 721ns | 356ms, 920µs, 957ns | 442ms, 505µs, 121ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 931µs, 524ns | 1ms, 739µs, 978ns | 2ms, 192µs, 974ns |
| Dice(Reflection, Transient) | ^4.0 | 71ms, 45µs, 207ns | 68ms, 994µs, 45ns | 73ms, 108µs, 196ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 938µs, 81ns | 809µs, 907ns | 1ms, 960µs, 39ns |
| Laravel(Configured, Transient) | ^12.28 | 387ms, 651µs, 872ns | 337ms, 665µs, 81ns | 406ms, 347µs, 990ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 712µs, 177ns | 3ms, 400µs, 87ns | 4ms, 718µs, 65ns |
| Laravel(Reflection, Transient) | ^12.28 | 641ms, 746µs, 401ns | 635ms, 605µs, 96ns | 653ms, 126µs, 955ns |
| League(Configured, Transient) | ^5.1 | 866ms, 282µs, 939ns | 846ms, 621µs, 990ns | 896ms, 214µs, 962ns |
| League(Reflection, Transient) | ^5.1 | 658ms, 643µs, 507ns | 561ms, 316µs, 967ns | 706ms, 639µs, 51ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 300µs, 309ns | 3ms, 216µs, 981ns | 3ms, 678µs, 83ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 945µs, 565ns | 3ms, 839µs, 969ns | 4ms, 62µs, 891ns |
| Phalcon(Configured, Transient) | ^5 | 289ms, 868µs, 116ns | 285ms, 857µs, 915ns | 294ms, 910µs, 907ns |
| Php-baseline |  | 549µs, 578ns | 463µs, 962ns | 633µs, 955ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 132µs, 249ns | 845µs, 909ns | 3ms, 128µs, 51ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 281µs, 189ns | 1ms, 217µs, 126ns | 1ms, 519µs, 918ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 543µs, 115ns | 98ms, 960µs, 876ns | 116ms, 145µs, 849ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 182ns | 750µs, 64ns | 1ms, 22µs, 815ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 158µs, 284ns | 2ms, 58µs, 982ns | 2ms, 840µs, 42ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 164µs, 245ns | 1ms, 85µs, 996ns | 1ms, 749µs, 992ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 507ms, 461µs, 857ns | 3s, 427ms, 990µs, 913ns | 3s, 569ms, 765µs, 90ns |
| Ray-di(Reflection, Transient) | ^2.16 | 376ms, 928µs, 377ns | 372ms, 884µs, 35ns | 386ms, 445µs, 999ns |
| Symfony(Compiled, Singleton) | ^7.0 | 626µs, 301ns | 615µs, 119ns | 636µs, 100ns |
| Zen(Compiled, Singleton) | ^3.1 | 988µs, 221ns | 769µs, 138ns | 2ms, 779µs, 960ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 829µs, 504ns | 2ms, 696µs, 990ns | 3ms, 108µs, 978ns |
| Dice(Configured, Singleton) | ^4.0 | 836µs, 539ns | 823µs, 974ns | 849µs, 8ns |
| Laravel(Configured, Transient) | ^12.28 | 377ms, 409µs, 219ns | 370ms, 452µs, 880ns | 395ms, 517µs, 110ns |
| League(Configured, Transient) | ^5.1 | 4s, 264ms, 858µs, 198ns | 3s, 427ms, 485µs, 942ns | 4s, 475ms, 671µs, 52ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 717µs, 970ns | 3ms, 655µs, 910ns | 4ms, 44µs, 55ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 785µs, 824ns | 3ms, 740µs, 72ns | 3ms, 823µs, 41ns |
| Phalcon(Configured, Transient) | ^5 | 288ms, 892µs, 769ns | 269ms, 746µs, 65ns | 312ms, 10µs, 49ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 215µs, 529ns | 1ms, 161µs, 98ns | 1ms, 240µs, 968ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 866µs, 56ns | 97ms, 984µs, 75ns | 105ms, 81µs, 81ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 143µs, 312ns | 1ms, 127µs, 958ns | 1ms, 174µs, 926ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 781µs, 247ns | 3ms, 736µs, 19ns | 3ms, 822µs, 803ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 207ms, 254µs, 385ns | 1s, 944ms, 609µs, 880ns | 3s, 586ms, 823µs, 940ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 256µs, 728ns | 1ms, 199µs, 7ns | 1ms, 307µs, 10ns |
| Zen(Compiled, Singleton) | ^3.1 | 656µs, 986ns | 589µs, 132ns | 1ms, 163µs, 959ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 803µs, 112ns | 1ms, 464µs, 843ns | 3ms, 41µs, 982ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 904µs, 869ns | 1ms, 734µs, 18ns | 2ms, 497µs, 911ns |
| Laravel(Configured, Transient) | ^12.28 | 368ms, 733µs, 286ns | 315ms, 486µs, 192ns | 380ms, 904µs, 912ns |
| League(Configured, Transient) | ^5.1 | 4s, 314ms, 87µs, 367ns | 3s, 489ms, 712µs, 953ns | 4s, 565ms, 134µs, 48ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 750µs, 14ns | 3ms, 652µs, 95ns | 4ms, 81µs, 964ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 941µs, 202ns | 3ms, 843µs, 69ns | 4ms, 112µs, 958ns |
| Phalcon(Configured, Transient) | ^5 | 281ms, 923µs, 365ns | 258ms, 708µs, 953ns | 295ms, 80µs, 900ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 936µs, 268ns | 1ms, 252µs, 174ns | 2ms, 599µs, 954ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 737µs, 856ns | 99ms, 75µs, 794ns | 104ms, 812µs, 860ns |
| Quickly(Compiled, Singleton) | dev-master | 810µs, 909ns | 796µs, 79ns | 833µs, 34ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 36µs, 401ns | 4ms, 481µs, 77ns | 7ms, 362µs, 127ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 529ms, 368µs, 782ns | 3s, 397ms, 37µs, 29ns | 3s, 611ms, 3µs, 875ns |
| Symfony(Compiled, Singleton) | ^7.0 | 828µs, 433ns | 785µs, 827ns | 890µs, 970ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 537µs, 728ns | 1ms, 208µs, 66ns | 4ms, 416µs, 227ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 309µs, 319ns | 5ms, 234µs, 3ns | 5ms, 377µs, 54ns |
| Dice(Configured, Singleton) | ^4.0 | 875µs, 568ns | 854µs, 15ns | 900µs, 983ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 787ms, 607µs, 216ns | 8s, 806ms, 863µs, 69ns | 10s, 226ms, 233µs, 959ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 983µs, 953ns | 800µs, 848ns | 1ms, 195µs, 907ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 824µs, 543ns | 3ms, 19µs, 94ns | 5ms, 744µs, 934ns |
| Laravel(Reflection, Transient) | ^12.28 | 86s, 269ms, 162µs, 988ns | 72s, 914ms, 999µs, 8ns | 90s, 102ms, 401µs, 971ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 272µs, 700ns | 3ms, 196µs, 954ns | 3ms, 614µs, 902ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 837µs, 203ns | 3ms, 383µs, 874ns | 4ms, 235µs, 982ns |
| Php-baseline |  | 622µs, 820ns | 496µs, 149ns | 700µs, 950ns |
| Php-di(Reflection, Singleton) | ^7.0 | 882µs, 935ns | 765µs, 85ns | 1ms, 410µs, 7ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 232µs, 361ns | 1ms, 207µs, 113ns | 1ms, 281µs, 23ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 705ms, 649µs, 685ns | 13s, 164ms, 859µs, 56ns | 14s, 107ms, 267µs, 141ns |
| Quickly(Compiled, Singleton) | dev-master | 827µs, 407ns | 812µs, 53ns | 849µs, 962ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 381µs, 802ns | 1ms, 356µs, 840ns | 1ms, 406µs, 908ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 412µs, 820ns | 1ms, 380µs, 920ns | 1ms, 568µs, 78ns |
| Symfony(Compiled, Singleton) | ^7.0 | 769µs, 352ns | 744µs, 104ns | 802µs, 40ns |
| Zen(Compiled, Singleton) | ^3.1 | 825µs, 166ns | 740µs, 51ns | 1ms, 457µs, 929ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 643µs, 33ns | 5ms, 694µs, 150ns | 6ms, 976µs, 842ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 383µs, 470ns | 2ms, 173µs, 900ns | 3ms, 803µs, 968ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 852ms, 228µs, 617ns | 8s, 823ms, 739µs, 51ns | 10s, 134ms, 839µs, 57ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 989µs, 580ns | 856µs, 161ns | 2ms, 47µs, 61ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 752µs, 206ns | 4ms, 653µs, 930ns | 4ms, 821µs, 62ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 25ms, 851µs, 559ns | 73s, 619ms, 60µs, 993ns | 90s, 761ms, 276µs, 960ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 303µs, 432ns | 3ms, 226µs, 995ns | 3ms, 714µs, 84ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 21µs, 573ns | 3ms, 638µs, 29ns | 4ms, 262µs, 924ns |
| Php-baseline |  | 599µs, 884ns | 482µs, 82ns | 633µs, 1ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 143µs, 2ns | 895µs, 23ns | 3ms, 204µs, 107ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 328µs, 563ns | 1ms, 273µs, 155ns | 1ms, 561µs, 880ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 703ms, 701µs, 162ns | 13s, 644ms, 53µs, 936ns | 13s, 776ms, 552µs, 915ns |
| Quickly(Compiled, Singleton) | dev-master | 928µs, 997ns | 774µs, 145ns | 1ms, 169µs, 919ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 170µs, 276ns | 2ms, 67µs, 89ns | 2ms, 828µs, 121ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 546µs, 502ns | 1ms, 420µs, 974ns | 2ms, 369µs, 880ns |
| Symfony(Compiled, Singleton) | ^7.0 | 764µs, 179ns | 679µs, 16ns | 1ms, 37µs, 836ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 58µs, 721ns | 852µs, 108ns | 2ms, 743µs, 959ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 778µs, 316ns | 1ms, 578µs, 807ns | 1ms, 849µs, 889ns |
| Dice(Configured, Singleton) | ^4.0 | 844µs, 1ns | 728µs, 130ns | 912µs, 904ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 766µs, 965ns | 3ms, 701µs, 925ns | 4ms, 116µs, 58ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 846µs, 120ns | 3ms, 708µs, 839ns | 3ms, 986µs, 120ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 271µs, 963ns | 1ms, 159µs, 191ns | 1ms, 990µs, 795ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 709ms, 372µs, 19ns | 13s, 164ms, 552µs, 927ns | 13s, 951ms, 884µs, 984ns |
| Quickly(Compiled, Singleton) | dev-master | 927µs, 853ns | 756µs, 978ns | 1ms, 179µs, 218ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 547µs, 24ns | 3ms, 452µs, 62ns | 3ms, 933µs, 906ns |
| Symfony(Compiled, Singleton) | ^7.0 | 769µs, 376ns | 751µs, 18ns | 808µs |
| Zen(Compiled, Singleton) | ^3.1 | 844µs, 311ns | 743µs, 865ns | 1ms, 513µs, 957ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 335µs, 595ns | 2ms, 593µs, 994ns | 5ms, 362µs, 987ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 136µs, 778ns | 1ms, 818µs, 895ns | 2ms, 306µs, 938ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 994µs, 965ns | 3ms, 656µs, 148ns | 6ms, 8µs, 863ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 986µs, 191ns | 3ms, 705µs, 24ns | 4ms, 198µs, 74ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 285µs, 386ns | 1ms, 243µs, 114ns | 1ms, 525µs, 878ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 788ms, 775µs, 801ns | 13s, 699ms, 282µs, 884ns | 13s, 850ms, 233µs, 78ns |
| Quickly(Compiled, Singleton) | dev-master | 919µs, 866ns | 795µs, 841ns | 1ms, 140µs, 832ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 215µs, 264ns | 4ms, 54µs, 784ns | 4ms, 797µs, 935ns |
| Symfony(Compiled, Singleton) | ^7.0 | 817µs, 751ns | 689µs, 29ns | 1ms, 319µs, 885ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 107µs, 192ns | 877µs, 857ns | 2ms, 933µs, 979ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 849µs, 509ns | 767µs, 946ns | 1ms, 88µs, 142ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 887µs, 986ns | 3ms, 190µs, 994ns | 7ms, 436µs, 990ns |
| Php-di(Reflection, Singleton) | ^7.0 | 683µs, 259ns | 632µs, 47ns | 1ms, 47µs, 849ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 188µs, 683ns | 1ms, 173µs, 19ns | 1ms, 212µs, 120ns |
| Quickly(Compiled, Singleton) | dev-master | 790µs, 405ns | 769µs, 138ns | 833µs, 988ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 385µs, 736ns | 1ms, 362µs, 800ns | 1ms, 450µs, 777ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 463µs, 79ns | 1ms, 343µs, 965ns | 2ms, 43µs, 8ns |
| Symfony(Compiled, Singleton) | ^7.0 | 745µs, 10ns | 725µs, 30ns | 767µs, 946ns |
| Zen(Compiled, Singleton) | ^3.1 | 821µs, 208ns | 694µs, 36ns | 1ms, 483µs, 917ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 68µs, 186ns | 921µs, 10ns | 2ms, 140µs, 998ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 307µs, 723ns | 3ms, 220µs, 81ns | 3ms, 622µs, 55ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 199µs, 364ns | 924µs, 110ns | 3ms, 250µs, 122ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 855µs, 635ns | 1ms, 673µs, 936ns | 2ms, 79µs, 963ns |
| Quickly(Compiled, Singleton) | dev-master | 810µs, 98ns | 774µs, 145ns | 879µs, 49ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 771µs, 688ns | 1ms, 679µs, 897ns | 2ms, 368µs, 927ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 648µs, 20ns | 1ms, 511µs, 96ns | 2ms, 357µs, 959ns |
| Symfony(Compiled, Singleton) | ^7.0 | 683µs, 593ns | 658µs, 988ns | 718µs, 116ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 197µs, 123ns | 880µs, 2ns | 2ms, 859µs, 115ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 978µs, 300ns | 3ms, 614µs, 902ns | 6ms, 41ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 264µs, 262ns | 1ms, 178µs, 979ns | 1ms, 957µs, 893ns |
| Quickly(Compiled, Singleton) | dev-master | 788µs, 855ns | 771µs, 999ns | 812µs, 768ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 823µs, 876ns | 3ms, 772µs, 20ns | 3ms, 898µs, 143ns |
| Symfony(Compiled, Singleton) | ^7.0 | 753µs, 259ns | 720µs, 977ns | 811µs, 815ns |
| Zen(Compiled, Singleton) | ^3.1 | 831µs, 246ns | 740µs, 51ns | 1ms, 526µs, 117ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 704µs, 380ns | 3ms, 616µs, 94ns | 4ms, 79µs, 103ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 282µs, 644ns | 1ms, 235µs, 961ns | 1ms, 542µs, 806ns |
| Quickly(Compiled, Singleton) | dev-master | 822µs, 329ns | 811µs, 100ns | 836µs, 849ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 863µs, 905ns | 4ms, 502µs, 58ns | 5ms, 691µs, 51ns |
| Symfony(Compiled, Singleton) | ^7.0 | 772µs, 595ns | 748µs, 157ns | 795µs, 841ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 144µs, 170ns | 945µs, 91ns | 2ms, 880µs, 96ns |

</details>

Questions, issues, and new containers are welcome!
