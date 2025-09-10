# PHP Dependency Injection Benchmark

![PHP Version](https://img.shields.io/badge/PHP-8.4-blue?logo=php) ![Docker Version](https://img.shields.io/badge/Docker-%2A-lightgrey?logo=docker) ![OS](https://img.shields.io/badge/OS-ubuntu%20latest-blue?logo=ubuntu)

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

Run from 2025-09-10

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 656µs, 794ns | 1ms, 542µs, 806ns | 1ms, 826µs, 47ns |
| Auryn(Reflection, Transient) | ^1.4 | 412ms, 314µs, 391ns | 400ms, 866µs, 985ns | 435ms, 924µs, 53ns |
| Dice(Configured, Singleton) | ^4.0 | 820µs, 398ns | 806µs, 93ns | 836µs, 849ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 518µs, 64ns | 69ms, 235µs, 86ns | 72ms, 781µs, 85ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 270µs, 842ns | 1ms, 235µs, 961ns | 1ms, 435µs, 995ns |
| Laravel(Configured, Transient) | ^12.28 | 409ms, 184µs, 622ns | 401ms, 51µs, 998ns | 418ms, 945µs, 74ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 568µs, 935ns | 3ms, 285µs, 884ns | 5ms, 94µs, 51ns |
| Laravel(Reflection, Transient) | ^12.28 | 652ms, 121µs, 543ns | 635ms, 456µs, 85ns | 672ms, 297µs |
| League(Configured, Transient) | ^5.1 | 860ms, 390µs, 520ns | 846ms, 539µs, 20ns | 887ms, 707µs, 948ns |
| League(Reflection, Transient) | ^5.1 | 672ms, 284µs, 770ns | 659ms, 674µs, 882ns | 715ms, 300µs, 83ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 311µs, 276ns | 3ms, 203µs, 868ns | 3ms, 751µs, 993ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 179µs, 906ns | 4ms, 19µs, 975ns | 4ms, 855µs, 155ns |
| Phalcon(Configured, Transient) | ^5 | 293ms, 107µs, 271ns | 289ms, 133µs, 71ns | 297ms, 577µs, 857ns |
| Php-baseline |  | 594µs, 282ns | 565µs, 52ns | 615µs, 835ns |
| Php-di(Reflection, Singleton) | ^7.0 | 838µs, 780ns | 783µs, 920ns | 1ms, 189µs, 947ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 259µs, 207ns | 1ms, 197µs, 99ns | 1ms, 311µs, 63ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 59µs, 818ns | 99ms, 85µs, 92ns | 104ms, 781µs, 150ns |
| Quickly(Compiled, Singleton) | dev-master | 799µs, 298ns | 779µs, 867ns | 813µs, 7ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 398µs, 801ns | 1ms, 384µs, 19ns | 1ms, 418µs, 113ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 361µs, 227ns | 1ms, 326µs, 84ns | 1ms, 464µs, 128ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 497ms, 919µs, 845ns | 3s, 472ms, 424µs, 30ns | 3s, 540ms, 26µs, 187ns |
| Ray-di(Reflection, Transient) | ^2.16 | 360ms, 811µs, 90ns | 342ms, 463µs, 970ns | 414ms, 295µs, 911ns |
| Symfony(Compiled, Singleton) | ^7.0 | 808µs, 310ns | 784µs, 873ns | 844µs, 1ns |
| Zen(Compiled, Singleton) | ^3.1 | 898µs, 194ns | 763µs, 893ns | 1ms, 477µs, 3ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 971µs, 387ns | 1ms, 638µs, 174ns | 3ms, 201µs, 7ns |
| Auryn(Reflection, Transient) | ^1.4 | 409ms, 131µs, 383ns | 405ms, 791µs, 997ns | 413ms, 338µs, 899ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 946µs, 210ns | 1ms, 816µs, 34ns | 2ms, 309µs, 83ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 856µs, 833ns | 70ms, 236µs, 921ns | 73ms, 4µs, 961ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 955µs, 843ns | 818µs, 14ns | 2ms, 55µs, 168ns |
| Laravel(Configured, Transient) | ^12.28 | 405ms, 529µs, 308ns | 401ms, 489µs, 19ns | 410ms, 405µs, 158ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 728µs, 699ns | 3ms, 435µs, 134ns | 4ms, 777µs, 908ns |
| Laravel(Reflection, Transient) | ^12.28 | 634ms, 996µs, 104ns | 630ms, 709µs, 886ns | 642ms, 798µs, 185ns |
| League(Configured, Transient) | ^5.1 | 862ms, 125µs, 134ns | 851ms, 871µs, 967ns | 902ms, 639µs, 150ns |
| League(Reflection, Transient) | ^5.1 | 671ms, 579µs, 289ns | 660ms, 484µs, 75ns | 684ms, 247µs, 16ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 562µs, 903ns | 3ms, 248µs, 929ns | 6ms, 136µs, 894ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 120µs, 302ns | 3ms, 976µs, 106ns | 4ms, 240µs, 36ns |
| Phalcon(Configured, Transient) | ^5 | 294ms, 417µs, 47ns | 291ms, 671µs, 991ns | 296ms, 979µs, 904ns |
| Php-baseline |  | 619µs, 6ns | 605µs, 106ns | 633µs, 1ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 161µs, 646ns | 797µs, 986ns | 4ms, 198µs, 74ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 363µs, 205ns | 1ms, 312µs, 971ns | 1ms, 632µs, 928ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 109µs, 313ns | 100ms, 524µs, 187ns | 108ms, 324µs, 766ns |
| Quickly(Compiled, Singleton) | dev-master | 804µs, 114ns | 787µs, 19ns | 832µs, 80ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 917µs, 599ns | 2ms, 12µs, 14ns | 3ms, 562µs, 211ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 445µs, 579ns | 1ms, 357µs, 78ns | 2ms, 158µs, 880ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 496ms, 777µs, 939ns | 3s, 442ms, 512µs, 35ns | 3s, 572ms, 283µs, 29ns |
| Ray-di(Reflection, Transient) | ^2.16 | 386ms, 461µs, 997ns | 379ms, 725µs, 933ns | 397ms, 289µs, 37ns |
| Symfony(Compiled, Singleton) | ^7.0 | 815µs, 796ns | 794µs, 887ns | 870µs, 943ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 107µs, 501ns | 828µs, 27ns | 3ms, 190µs, 994ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 365µs, 14ns | 5ms, 249µs, 23ns | 5ms, 496µs, 25ns |
| Dice(Configured, Singleton) | ^4.0 | 872µs, 111ns | 843µs, 48ns | 901µs, 937ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 83ms, 823µs, 13ns | 9s, 935ms, 726µs, 881ns | 10s, 232ms, 169µs, 151ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 803µs, 899ns | 776µs, 52ns | 914µs, 812ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 928µs, 995ns | 3ms, 660µs, 917ns | 5ms, 389µs, 928ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 776ms, 828µs, 50ns | 87s, 883ms, 16µs, 109ns | 89s, 439ms, 49µs, 5ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 520µs, 417ns | 3ms, 431µs, 81ns | 3ms, 940µs, 105ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 57µs, 621ns | 3ms, 888µs, 130ns | 4ms, 573µs, 822ns |
| Php-baseline |  | 626µs, 850ns | 588µs, 893ns | 719µs, 785ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 322µs, 984ns | 1ms, 214µs, 27ns | 1ms, 902µs, 818ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 310µs, 729ns | 1ms, 269µs, 102ns | 1ms, 354µs, 932ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 248ms, 272µs, 109ns | 14s, 77ms, 584µs, 28ns | 15s, 94ms, 130µs, 992ns |
| Quickly(Compiled, Singleton) | dev-master | 811µs, 314ns | 782µs, 12ns | 843µs, 48ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 410µs, 579ns | 1ms, 369µs, 953ns | 1ms, 489µs, 877ns |
| Quickly(Reflection, Singleton) | dev-master | 2ms, 327µs, 513ns | 2ms, 276µs, 897ns | 2ms, 614µs, 21ns |
| Symfony(Compiled, Singleton) | ^7.0 | 776µs, 386ns | 750µs, 64ns | 819µs, 921ns |
| Zen(Compiled, Singleton) | ^3.1 | 844µs, 97ns | 756µs, 978ns | 1ms, 501µs, 83ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 944µs, 12ns | 6ms, 782µs, 54ns | 7ms, 704µs, 19ns |
| Dice(Configured, Singleton) | ^4.0 | 3ms, 127µs, 479ns | 2ms, 226µs, 829ns | 3ms, 982µs, 67ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 71ms, 380µs, 19ns | 9s, 951ms, 477µs, 50ns | 10s, 211ms, 734µs, 56ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 976µs, 586ns | 839µs, 948ns | 2ms, 48µs, 969ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 905µs, 271ns | 4ms, 721µs, 879ns | 5ms, 398µs, 35ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 566ms, 197µs, 991ns | 87s, 977ms, 375µs, 30ns | 88s, 880ms, 110µs, 979ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 524µs, 327ns | 3ms, 453µs, 969ns | 3ms, 880µs, 977ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 307µs, 7ns | 4ms, 179µs | 4ms, 405µs, 975ns |
| Php-baseline |  | 643µs, 277ns | 602µs, 960ns | 833µs, 34ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 162µs, 981ns | 901µs, 937ns | 3ms, 377µs, 914ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 347µs, 613ns | 1ms, 291µs, 990ns | 1ms, 570µs, 940ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 230ms, 953µs, 621ns | 14s, 86ms, 638µs, 927ns | 14s, 602ms, 463µs, 960ns |
| Quickly(Compiled, Singleton) | dev-master | 836µs, 300ns | 811µs, 815ns | 862µs, 121ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 815µs, 723ns | 2ms, 30µs, 134ns | 3ms, 498µs, 77ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 739µs, 645ns | 1ms, 451µs, 969ns | 3ms, 620µs, 147ns |
| Symfony(Compiled, Singleton) | ^7.0 | 801µs, 992ns | 782µs, 966ns | 825µs, 166ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 70µs, 857ns | 823µs, 20ns | 3ms, 3µs, 120ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 789µs, 999ns | 756µs, 25ns | 977µs, 993ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 625µs, 988ns | 3ms, 349µs, 65ns | 5ms, 247µs, 116ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 145µs, 243ns | 790µs, 119ns | 2ms, 119µs, 64ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 269µs, 507ns | 1ms, 248µs, 121ns | 1ms, 317µs, 24ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 40µs, 792ns | 817µs, 60ns | 2ms, 214µs, 908ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 386µs, 761ns | 1ms, 350µs, 879ns | 1ms, 430µs, 988ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 365µs, 375ns | 1ms, 320µs, 838ns | 1ms, 575µs, 946ns |
| Symfony(Compiled, Singleton) | ^7.0 | 739µs, 693ns | 718µs, 832ns | 809µs, 907ns |
| Zen(Compiled, Singleton) | ^3.1 | 857µs, 305ns | 754µs, 117ns | 1ms, 520µs, 872ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 92µs, 52ns | 937µs, 938ns | 2ms, 164µs, 125ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 188µs, 656ns | 3ms, 319µs, 25ns | 7ms, 583µs, 141ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 979µs, 565ns | 1ms, 543µs, 998ns | 5ms, 611µs, 896ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 363µs, 229ns | 1ms, 307µs, 964ns | 1ms, 605µs, 987ns |
| Quickly(Compiled, Singleton) | dev-master | 834µs, 35ns | 819µs, 206ns | 847µs, 816ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 226µs, 829ns | 2ms, 92µs, 123ns | 3ms, 11µs, 941ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 569µs, 485ns | 1ms, 471µs, 42ns | 2ms, 306µs, 222ns |
| Symfony(Compiled, Singleton) | ^7.0 | 801µs, 801ns | 782µs, 12ns | 843µs, 48ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 114µs, 296ns | 880µs, 2ns | 3ms, 56µs, 49ns |

</details>

Questions, issues, and new containers are welcome!
