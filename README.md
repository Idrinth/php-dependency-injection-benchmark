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

Run from 2025-09-19

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 642µs, 918ns | 1ms, 564µs, 25ns | 1ms, 806µs, 20ns |
| Auryn(Reflection, Transient) | ^1.4 | 409ms, 918µs, 260ns | 402ms, 14µs, 970ns | 427ms, 305µs, 936ns |
| Dice(Configured, Singleton) | ^4.0 | 832µs, 533ns | 763µs, 177ns | 926µs, 971ns |
| Dice(Reflection, Transient) | ^4.0 | 71ms, 294µs, 713ns | 69ms, 765µs, 806ns | 76ms, 415µs, 61ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 123µs, 356ns | 775µs, 98ns | 2ms, 125µs, 24ns |
| Laravel(Configured, Transient) | ^12.28 | 405ms, 877µs, 184ns | 396ms, 364µs, 927ns | 416ms, 214µs, 942ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 483µs, 270ns | 3ms, 367µs, 900ns | 6ms, 330µs, 13ns |
| Laravel(Reflection, Transient) | ^12.28 | 633ms, 178µs, 687ns | 627ms, 44µs, 916ns | 640ms, 975µs, 952ns |
| League(Configured, Transient) | ^5.1 | 868ms, 835µs, 306ns | 851ms, 470µs, 947ns | 898ms, 373µs, 126ns |
| League(Reflection, Transient) | ^5.1 | 672ms, 78µs, 633ns | 658ms, 447µs, 980ns | 706ms, 895µs, 112ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 485µs, 369ns | 3ms, 232µs, 955ns | 5ms, 337µs, 953ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 25µs, 292ns | 3ms, 885µs, 984ns | 4ms, 319µs, 906ns |
| Phalcon(Configured, Transient) | ^5 | 292ms, 881µs, 965ns | 288ms, 994µs, 73ns | 296ms, 348µs, 94ns |
| Php-baseline |  | 611µs, 66ns | 581µs, 979ns | 702µs, 142ns |
| Php-di(Reflection, Singleton) | ^7.0 | 904µs, 393ns | 795µs, 125ns | 1ms, 230µs, 955ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 262µs, 974ns | 1ms, 237µs, 869ns | 1ms, 312µs, 971ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 507µs, 92ns | 99ms, 326µs, 133ns | 101ms, 679µs, 86ns |
| Quickly(Compiled, Singleton) | dev-master | 816µs, 988ns | 761µs, 32ns | 848µs, 54ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 387µs, 71ns | 1ms, 354µs, 932ns | 1ms, 420µs, 974ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 373µs, 767ns | 1ms, 332µs, 44ns | 1ms, 454µs, 830ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 519ms, 836µs, 997ns | 3s, 488ms, 115µs, 72ns | 3s, 572ms, 59µs, 154ns |
| Ray-di(Reflection, Transient) | ^2.16 | 347ms, 326µs, 612ns | 342ms, 658µs, 42ns | 353ms, 600µs, 978ns |
| Symfony(Compiled, Singleton) | ^7.0 | 794µs, 720ns | 762µs, 939ns | 815µs, 868ns |
| Zen(Compiled, Singleton) | ^3.1 | 857µs, 210ns | 777µs, 959ns | 1ms, 471µs, 996ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 793µs, 169ns | 1ms, 740µs, 932ns | 5ms, 336µs, 999ns |
| Auryn(Reflection, Transient) | ^1.4 | 409ms, 639µs, 215ns | 405ms, 492µs, 67ns | 416ms, 139µs, 841ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 236ns | 1ms, 804µs, 113ns | 2ms, 748µs, 12ns |
| Dice(Reflection, Transient) | ^4.0 | 71ms, 516µs, 394ns | 69ms, 736µs, 957ns | 72ms, 943µs, 925ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 944µs, 876ns | 766µs, 992ns | 2ms, 39µs, 194ns |
| Laravel(Configured, Transient) | ^12.28 | 406ms, 331µs, 682ns | 403ms, 272µs, 151ns | 408ms, 951µs, 997ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 248µs, 641ns | 3ms, 423µs, 929ns | 8ms, 344µs, 888ns |
| Laravel(Reflection, Transient) | ^12.28 | 632ms, 737µs, 88ns | 624ms, 352µs, 931ns | 648ms, 164µs, 987ns |
| League(Configured, Transient) | ^5.1 | 863ms, 426µs, 780ns | 846ms, 763µs, 134ns | 881ms, 181µs, 1ns |
| League(Reflection, Transient) | ^5.1 | 663ms, 744µs, 306ns | 657ms, 232µs, 999ns | 668ms, 814µs, 897ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 440µs, 523ns | 3ms, 371µs, 953ns | 3ms, 842µs, 115ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 182µs, 720ns | 4ms, 117µs, 12ns | 4ms, 258µs, 871ns |
| Phalcon(Configured, Transient) | ^5 | 300ms, 584µs, 220ns | 290ms, 527µs, 105ns | 333ms, 641µs, 767ns |
| Php-baseline |  | 607µs, 919ns | 574µs, 111ns | 688µs, 76ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 120µs, 185ns | 848µs, 54ns | 3ms, 351µs, 926ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 377µs, 820ns | 1ms, 306µs, 56ns | 1ms, 619µs, 815ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 940µs, 609ns | 98ms, 661µs, 184ns | 104ms, 130µs, 983ns |
| Quickly(Compiled, Singleton) | dev-master | 818µs, 705ns | 791µs, 72ns | 873µs, 88ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 138µs, 328ns | 2ms, 26µs, 81ns | 2ms, 937µs, 78ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 503µs, 515ns | 1ms, 395µs, 940ns | 2ms, 293µs, 109ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 520ms, 552µs, 182ns | 3s, 483ms, 488µs, 82ns | 3s, 579ms, 315µs, 900ns |
| Ray-di(Reflection, Transient) | ^2.16 | 382ms, 104µs, 873ns | 375ms, 371µs, 932ns | 390ms, 780µs, 925ns |
| Symfony(Compiled, Singleton) | ^7.0 | 750µs, 827ns | 729µs, 84ns | 763µs, 177ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 42µs, 604ns | 823µs, 974ns | 2ms, 892µs, 17ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 619µs, 5ns | 1ms, 559µs, 19ns | 1ms, 723µs, 51ns |
| Dice(Configured, Singleton) | ^4.0 | 900µs, 983ns | 833µs, 34ns | 1ms, 242µs, 876ns |
| Laravel(Configured, Transient) | ^12.28 | 383ms, 265µs, 18ns | 376ms, 859µs, 903ns | 403ms, 935µs, 194ns |
| League(Configured, Transient) | ^5.1 | 4s, 141ms, 483µs, 616ns | 4s, 113ms, 262µs, 176ns | 4s, 178ms, 825µs, 139ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 696µs, 298ns | 3ms, 602µs, 27ns | 4ms, 76µs, 957ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 79µs, 341ns | 3ms, 930µs, 91ns | 4ms, 523µs, 38ns |
| Phalcon(Configured, Transient) | ^5 | 295ms, 356µs, 893ns | 288ms, 790µs, 941ns | 301ms, 397µs, 800ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 298µs, 46ns | 1ms, 246µs, 213ns | 1ms, 536µs, 130ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 458µs, 191ns | 100ms, 446µs, 939ns | 102ms, 638µs, 6ns |
| Quickly(Compiled, Singleton) | dev-master | 795µs, 698ns | 782µs, 966ns | 813µs, 961ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 911µs, 709ns | 3ms, 824µs, 949ns | 4ms, 419µs, 88ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 530ms, 156µs, 302ns | 3s, 441ms, 142µs, 82ns | 3s, 585ms, 194µs, 110ns |
| Symfony(Compiled, Singleton) | ^7.0 | 834µs, 560ns | 819µs, 206ns | 864µs, 982ns |
| Zen(Compiled, Singleton) | ^3.1 | 860µs, 810ns | 769µs, 853ns | 1ms, 516µs, 103ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 21µs, 908ns | 1ms, 675µs, 128ns | 3ms, 266µs, 96ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 754µs, 139ns | 1ms, 811µs, 981ns | 3ms, 926µs, 38ns |
| Laravel(Configured, Transient) | ^12.28 | 383ms, 840µs, 513ns | 378ms, 478µs, 50ns | 397ms, 948µs, 980ns |
| League(Configured, Transient) | ^5.1 | 4s, 139ms, 363µs, 884ns | 4s, 96ms, 181µs, 154ns | 4s, 194ms, 803µs, 953ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 928µs, 446ns | 3ms, 641µs, 128ns | 5ms, 756µs, 139ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 120µs, 254ns | 4ms, 902ns | 4ms, 237µs, 890ns |
| Phalcon(Configured, Transient) | ^5 | 295ms, 661µs, 854ns | 288ms, 625µs, 1ns | 305ms, 839µs, 61ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 310µs, 491ns | 1ms, 249µs, 74ns | 1ms, 514µs, 196ns |
| Pimple(Configured, Transient) | ^3.5 | 105ms, 621µs, 170ns | 100ms, 701µs, 808ns | 121ms, 284µs, 961ns |
| Quickly(Compiled, Singleton) | dev-master | 821µs, 89ns | 791µs, 72ns | 848µs, 54ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 657µs, 196ns | 4ms, 534µs, 6ns | 5ms, 378µs, 961ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 541ms, 490µs, 101ns | 3s, 504ms, 416µs, 942ns | 3s, 571ms, 807µs, 861ns |
| Symfony(Compiled, Singleton) | ^7.0 | 837µs, 373ns | 752µs, 925ns | 1ms, 10µs, 894ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 68µs, 806ns | 838µs, 994ns | 2ms, 964µs, 973ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 872µs, 845ns | 5ms, 328µs, 178ns | 10ms, 155µs, 916ns |
| Dice(Configured, Singleton) | ^4.0 | 861µs, 954ns | 837µs, 87ns | 877µs, 857ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 67ms, 717µs, 3ns | 9s, 923ms, 184µs, 156ns | 10s, 257ms, 284µs, 164ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 804µs, 901ns | 777µs, 959ns | 905µs, 36ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 2µs, 46ns | 3ms, 616µs, 94ns | 6ms, 633µs, 996ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 965ms, 186µs, 119ns | 88s, 116ms, 444µs, 110ns | 89s, 481ms, 729µs, 30ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 482µs, 222ns | 3ms, 247µs, 976ns | 4ms, 626µs, 35ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 187µs, 583ns | 3ms, 818µs, 35ns | 5ms, 350µs, 112ns |
| Php-baseline |  | 657µs, 916ns | 590µs, 85ns | 855µs, 922ns |
| Php-di(Reflection, Singleton) | ^7.0 | 858µs, 759ns | 801µs, 86ns | 1ms, 255µs, 989ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 271µs, 104ns | 1ms, 260µs, 995ns | 1ms, 287µs, 937ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 114ms, 61µs, 260ns | 14s, 15ms, 554µs, 904ns | 14s, 408ms, 339µs, 977ns |
| Quickly(Compiled, Singleton) | dev-master | 837µs, 779ns | 802µs, 40ns | 908µs, 851ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 398µs, 181ns | 1ms, 366µs, 138ns | 1ms, 441µs, 1ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 384µs, 496ns | 1ms, 348µs, 18ns | 1ms, 513µs, 957ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 109µs, 576ns | 1ms, 46µs, 895ns | 1ms, 158µs, 952ns |
| Zen(Compiled, Singleton) | ^3.1 | 878µs, 572ns | 779µs, 867ns | 1ms, 609µs, 86ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 816µs, 673ns | 6ms, 752µs, 14ns | 6ms, 925µs, 106ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 573µs, 84ns | 2ms, 213µs, 954ns | 3ms, 935µs, 98ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 62ms, 472µs, 558ns | 9s, 922ms, 578µs, 96ns | 10s, 420ms, 108µs, 79ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 988µs, 912ns | 833µs, 988ns | 2ms, 120µs, 971ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 848µs, 313ns | 4ms, 656µs, 791ns | 5ms, 374µs, 908ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 742ms, 877µs, 697ns | 87s, 981ms, 7µs, 814ns | 89s, 576ms, 495µs, 170ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 402µs, 304ns | 3ms, 342µs, 866ns | 3ms, 753µs, 900ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 284µs, 71ns | 4ms, 111µs, 51ns | 4ms, 467µs, 964ns |
| Php-baseline |  | 654µs, 244ns | 540µs, 971ns | 842µs, 94ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 151µs, 752ns | 860µs, 929ns | 3ms, 438µs, 949ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 372µs, 909ns | 1ms, 324µs, 176ns | 1ms, 621µs, 961ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 152ms, 94µs, 483ns | 13s, 926ms, 615µs, 953ns | 14s, 807ms, 340µs, 860ns |
| Quickly(Compiled, Singleton) | dev-master | 831µs, 151ns | 805µs, 854ns | 869µs, 35ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 131µs, 80ns | 2ms, 14µs, 875ns | 2ms, 910µs, 852ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 556µs, 15ns | 1ms, 398µs, 86ns | 2ms, 673µs, 864ns |
| Symfony(Compiled, Singleton) | ^7.0 | 807µs, 833ns | 743µs, 150ns | 843µs, 48ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 87µs, 832ns | 865µs, 936ns | 2ms, 985µs |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 810µs, 145ns | 1ms, 775µs, 979ns | 1ms, 870µs, 870ns |
| Dice(Configured, Singleton) | ^4.0 | 943µs, 303ns | 833µs, 988ns | 1ms, 545µs, 906ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 783µs, 202ns | 3ms, 684µs, 997ns | 4ms, 153µs, 966ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 96µs, 579ns | 4ms, 23µs, 75ns | 4ms, 138µs, 946ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 232µs, 886ns | 1ms, 163µs, 959ns | 1ms, 291µs, 36ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 165ms, 710µs, 449ns | 13s, 965ms, 712µs, 70ns | 14s, 561ms, 506µs, 986ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 51µs, 807ns | 980µs, 854ns | 1ms, 101µs, 970ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 447µs, 913ns | 4ms, 192µs, 113ns | 6ms, 515µs, 26ns |
| Symfony(Compiled, Singleton) | ^7.0 | 793µs, 75ns | 777µs, 6ns | 844µs, 1ns |
| Zen(Compiled, Singleton) | ^3.1 | 850µs, 272ns | 762µs, 939ns | 1ms, 510µs, 858ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 325µs, 9ns | 3ms, 273µs, 10ns | 3ms, 416µs, 61ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 245µs, 354ns | 2ms, 183µs, 914ns | 2ms, 300µs, 977ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 855µs, 395ns | 3ms, 658µs, 56ns | 4ms, 342µs, 79ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 328µs, 607ns | 4ms, 285µs, 812ns | 8ms, 343µs, 935ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 432µs, 538ns | 1ms, 290µs, 82ns | 2ms, 30µs, 134ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 117ms, 847µs, 752ns | 13s, 987ms, 376µs, 928ns | 14s, 232ms, 787µs, 847ns |
| Quickly(Compiled, Singleton) | dev-master | 846µs, 385ns | 824µs, 213ns | 875µs, 949ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 749µs, 941ns | 4ms, 612µs, 922ns | 5ms, 412µs, 101ns |
| Symfony(Compiled, Singleton) | ^7.0 | 751µs, 781ns | 728µs, 845ns | 821µs, 113ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 121µs, 520ns | 891µs, 208ns | 3ms, 30µs, 61ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 292µs, 395ns | 1ms, 236µs, 915ns | 1ms, 654µs, 863ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 340µs, 77ns | 3ms, 246µs, 68ns | 3ms, 832µs, 817ns |
| Php-di(Reflection, Singleton) | ^7.0 | 850µs, 605ns | 786µs, 66ns | 1ms, 299µs, 858ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 262µs, 807ns | 1ms, 244µs, 68ns | 1ms, 293µs, 182ns |
| Quickly(Compiled, Singleton) | dev-master | 824µs, 165ns | 797µs, 986ns | 890µs, 970ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 419µs, 711ns | 1ms, 320µs, 123ns | 1ms, 718µs, 997ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 368µs, 975ns | 1ms, 312µs, 17ns | 1ms, 602µs, 888ns |
| Symfony(Compiled, Singleton) | ^7.0 | 780µs, 57ns | 761µs, 985ns | 797µs, 986ns |
| Zen(Compiled, Singleton) | ^3.1 | 919µs, 79ns | 759µs, 840ns | 1ms, 873µs, 16ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 62µs, 488ns | 909µs, 90ns | 2ms, 133µs, 846ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 435µs, 15ns | 3ms, 340µs, 959ns | 3ms, 801µs, 822ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 252µs, 365ns | 957µs, 12ns | 3ms, 532µs, 886ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 448µs, 11ns | 1ms, 322µs, 31ns | 2ms, 440µs, 929ns |
| Quickly(Compiled, Singleton) | dev-master | 873µs, 88ns | 839µs, 948ns | 984µs, 907ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 381µs, 563ns | 2ms, 77µs, 102ns | 3ms, 20µs, 48ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 558µs, 41ns | 1ms, 456µs, 22ns | 2ms, 336µs, 25ns |
| Symfony(Compiled, Singleton) | ^7.0 | 772µs, 213ns | 753µs, 164ns | 817µs, 60ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 117µs, 777ns | 883µs, 102ns | 3ms, 76µs, 76ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 816µs, 8ns | 3ms, 670µs, 930ns | 4ms, 487µs, 37ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 248µs, 835ns | 2ms, 203µs, 941ns | 2ms, 312µs, 898ns |
| Quickly(Compiled, Singleton) | dev-master | 803µs, 208ns | 787µs, 19ns | 844µs, 955ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 949µs, 117ns | 3ms, 899µs, 97ns | 3ms, 998µs, 994ns |
| Symfony(Compiled, Singleton) | ^7.0 | 819µs, 492ns | 787µs, 19ns | 907µs, 897ns |
| Zen(Compiled, Singleton) | ^3.1 | 877µs, 618ns | 761µs, 32ns | 1ms, 709µs, 938ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 757µs, 715ns | 3ms, 699µs, 64ns | 4ms, 137µs, 39ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 345µs, 38ns | 1ms, 288µs, 175ns | 1ms, 608µs, 133ns |
| Quickly(Compiled, Singleton) | dev-master | 838µs, 398ns | 813µs, 7ns | 899µs, 76ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 807µs, 782ns | 4ms, 620µs, 790ns | 5ms, 506µs, 992ns |
| Symfony(Compiled, Singleton) | ^7.0 | 758µs, 910ns | 740µs, 51ns | 782µs, 966ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 155µs, 543ns | 930µs, 70ns | 3ms, 13µs, 849ns |

</details>

Questions, issues, and new containers are welcome!
