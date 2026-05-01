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

Run from 2026-05-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 618µs, 409ns | 1ms, 547µs, 98ns | 1ms, 751µs, 899ns |
| Auryn(Reflection, Transient) | ^1.4 | 404ms, 898µs, 762ns | 395ms, 581µs, 7ns | 414ms, 39µs, 850ns |
| Dice(Configured, Singleton) | ^4.0 | 778µs, 722ns | 662µs, 88ns | 879µs, 49ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 464µs, 944ns | 69ms, 164µs, 991ns | 73ms, 363µs, 65ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 781µs, 369ns | 746µs, 11ns | 859µs, 22ns |
| Laravel(Configured, Transient) | ^12.28 | 410ms, 91µs, 638ns | 400ms, 474µs, 71ns | 427ms, 583µs, 932ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 484µs, 511ns | 3ms, 326µs, 892ns | 3ms, 829µs, 2ns |
| Laravel(Reflection, Transient) | ^12.28 | 575ms, 272µs, 226ns | 569ms, 124µs, 937ns | 589ms, 917µs, 898ns |
| League(Configured, Transient) | ^5.1 | 1s, 106ms, 335µs, 67ns | 972ms, 522µs, 20ns | 1s, 197ms, 947µs, 978ns |
| League(Reflection, Transient) | ^5.1 | 679ms, 613µs, 685ns | 533ms, 915µs, 996ns | 737ms, 695µs, 932ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 201µs, 770ns | 3ms, 90µs, 858ns | 3ms, 692µs, 865ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 880µs, 379ns | 5ms, 285µs, 978ns | 6ms, 406µs, 68ns |
| Phalcon(Configured, Transient) | ^5 | 334ms, 739µs, 255ns | 258ms, 955µs, 1ns | 367ms, 985µs, 963ns |
| Php-baseline |  | 587µs, 868ns | 555µs, 992ns | 619µs, 888ns |
| Php-di(Reflection, Singleton) | ^7.0 | 856µs, 208ns | 797µs, 33ns | 1ms, 191µs, 854ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 260µs, 685ns | 1ms, 223µs, 802ns | 1ms, 349µs, 925ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 249µs, 385ns | 97ms, 584µs, 9ns | 115ms, 874µs, 52ns |
| Quickly(Compiled, Singleton) | dev-master | 785µs, 756ns | 771µs, 999ns | 799µs, 894ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 368µs, 784ns | 1ms, 317µs, 24ns | 1ms, 603µs, 841ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 120µs, 281ns | 1ms, 90µs, 49ns | 1ms, 196µs, 146ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 540ms, 25µs, 43ns | 2s, 47ms, 38µs, 793ns | 3s, 975ms, 71µs, 907ns |
| Ray-di(Reflection, Transient) | ^2.16 | 380ms, 793µs, 452ns | 303ms, 234µs, 815ns | 416ms, 193µs, 8ns |
| Symfony(Compiled, Singleton) | ^7.0 | 807µs, 23ns | 774µs, 145ns | 855µs, 922ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 689µs, 888ns | 634µs, 908ns | 927µs, 209ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 859µs, 332ns | 792µs, 26ns | 1ms, 353µs, 979ns |
| Zen(Compiled, Singleton) | ^3.1 | 828µs, 361ns | 730µs, 37ns | 1ms, 498µs, 222ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 27µs, 654ns | 1ms, 715µs, 183ns | 3ms, 212µs, 928ns |
| Auryn(Reflection, Transient) | ^1.4 | 390ms, 623µs, 879ns | 317ms, 261µs, 934ns | 410ms, 661µs, 935ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 893µs, 377ns | 1ms, 767µs, 158ns | 2ms, 305µs, 984ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 640µs, 182ns | 68ms, 653µs, 106ns | 72ms, 680µs, 950ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 950µs, 646ns | 806µs, 93ns | 2ms, 7µs, 7ns |
| Laravel(Configured, Transient) | ^12.28 | 382ms, 892µs, 918ns | 341ms, 741µs, 85ns | 418ms, 619µs, 871ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 816µs, 819ns | 3ms, 371µs, 953ns | 4ms, 937µs, 887ns |
| Laravel(Reflection, Transient) | ^12.28 | 567ms, 288µs, 231ns | 561ms, 125µs, 40ns | 586ms, 215µs, 972ns |
| League(Configured, Transient) | ^5.1 | 1s, 157ms, 23µs, 596ns | 973ms, 697µs, 900ns | 1s, 204ms, 275µs, 131ns |
| League(Reflection, Transient) | ^5.1 | 689ms, 904µs, 93ns | 599ms, 888µs, 86ns | 735ms, 914µs, 945ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 527µs, 665ns | 3ms, 458µs, 23ns | 3ms, 901µs, 958ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 449µs, 317ns | 5ms, 980µs, 968ns | 7ms, 823µs, 944ns |
| Phalcon(Configured, Transient) | ^5 | 351ms, 923µs, 108ns | 325ms, 883µs, 865ns | 370ms, 645µs, 999ns |
| Php-baseline |  | 595µs, 784ns | 552µs, 892ns | 674µs, 962ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 117µs, 396ns | 866µs, 889ns | 3ms, 211µs, 21ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 392µs, 221ns | 1ms, 299µs, 142ns | 1ms, 585µs, 960ns |
| Pimple(Configured, Transient) | ^3.5 | 98ms, 116µs, 159ns | 91ms, 711µs, 997ns | 114ms, 748µs, 1ns |
| Quickly(Compiled, Singleton) | dev-master | 807µs, 523ns | 777µs, 959ns | 864µs, 982ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 323µs, 389ns | 2ms, 45µs, 869ns | 4ms, 584µs, 74ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 491µs, 761ns | 1ms, 367µs, 92ns | 2ms, 292µs, 156ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 549ms, 962µs, 830ns | 2s, 48ms, 458µs, 99ns | 3s, 869ms, 769µs, 96ns |
| Ray-di(Reflection, Transient) | ^2.16 | 381ms, 613µs, 302ns | 304ms, 52µs, 114ns | 419ms, 630µs, 50ns |
| Symfony(Compiled, Singleton) | ^7.0 | 588µs, 989ns | 579µs, 118ns | 622µs, 34ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 136µs, 708ns | 905µs, 36ns | 3ms, 76µs, 76ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 67µs, 900ns | 851µs, 154ns | 2ms, 863µs, 168ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 18µs, 23ns | 802µs, 40ns | 2ms, 798µs, 80ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 618µs, 194ns | 1ms, 554µs, 965ns | 1ms, 722µs, 97ns |
| Dice(Configured, Singleton) | ^4.0 | 745µs, 368ns | 627µs, 994ns | 855µs, 922ns |
| Laravel(Configured, Transient) | ^12.28 | 378ms, 749µs, 442ns | 329ms, 375µs, 28ns | 408ms, 751µs, 964ns |
| League(Configured, Transient) | ^5.1 | 9s, 338ms, 318µs, 824ns | 7s, 868ms, 412µs, 971ns | 9s, 598ms, 244µs, 190ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 690µs, 99ns | 3ms, 602µs, 981ns | 4ms, 5µs, 193ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 16µs, 802ns | 5ms, 578µs, 41ns | 6ms, 443µs, 977ns |
| Phalcon(Configured, Transient) | ^5 | 332ms, 364µs, 511ns | 312ms, 128µs, 67ns | 364ms, 794µs, 969ns |
| Pimple(Configured, Singleton) | ^3.5 | 991µs, 82ns | 974µs, 893ns | 1ms, 9µs, 941ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 876µs, 139ns | 98ms, 993µs, 62ns | 105ms, 886µs, 936ns |
| Quickly(Compiled, Singleton) | dev-master | 800µs, 585ns | 784µs, 873ns | 827µs, 74ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 993µs, 201ns | 3ms, 953µs, 933ns | 4ms, 53µs, 115ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 706ms, 493µs, 687ns | 3s, 21ms, 160µs, 125ns | 3s, 906ms, 743µs, 49ns |
| Symfony(Compiled, Singleton) | ^7.0 | 814µs, 723ns | 787µs, 19ns | 836µs, 133ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 822µs, 186ns | 771µs, 45ns | 1ms, 152µs, 38ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 868µs, 225ns | 768µs, 899ns | 1ms, 475µs, 95ns |
| Zen(Compiled, Singleton) | ^3.1 | 845µs, 98ns | 766µs, 992ns | 1ms, 441µs, 955ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 15µs, 495ns | 1ms, 660µs, 108ns | 3ms, 248µs, 929ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 753µs, 997ns | 1ms, 434µs, 87ns | 2ms, 238µs, 988ns |
| Laravel(Configured, Transient) | ^12.28 | 386ms, 953µs, 520ns | 377ms, 142µs, 906ns | 397ms, 152µs, 900ns |
| League(Configured, Transient) | ^5.1 | 9s, 455ms, 374µs, 383ns | 9s, 146ms, 876µs, 96ns | 9s, 657ms, 879µs, 829ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 236µs, 769ns | 2ms, 788µs, 66ns | 5ms, 582µs, 94ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 546µs, 20ns | 6ms, 369µs, 113ns | 6ms, 868µs, 124ns |
| Phalcon(Configured, Transient) | ^5 | 347ms, 85µs, 380ns | 328ms, 656µs, 911ns | 367ms, 903µs, 947ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 354µs, 265ns | 1ms, 302µs, 957ns | 1ms, 588µs, 821ns |
| Pimple(Configured, Transient) | ^3.5 | 106ms, 716µs, 990ns | 99ms, 79µs, 132ns | 121ms, 340µs, 36ns |
| Quickly(Compiled, Singleton) | dev-master | 750µs, 41ns | 734µs, 90ns | 770µs, 92ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 905µs, 867ns | 4ms, 662µs, 36ns | 5ms, 502µs, 939ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 357ms, 585µs, 811ns | 2s, 33ms, 423µs, 900ns | 3s, 735ms, 430µs, 955ns |
| Symfony(Compiled, Singleton) | ^7.0 | 636µs, 553ns | 609µs, 159ns | 679µs, 969ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 150µs, 727ns | 924µs, 110ns | 3ms, 44µs, 128ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 59µs, 865ns | 833µs, 34ns | 2ms, 893µs, 924ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 86µs, 115ns | 826µs, 120ns | 2ms, 935µs, 886ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 205µs, 59ns | 4ms, 652µs, 23ns | 5ms, 480µs, 51ns |
| Dice(Configured, Singleton) | ^4.0 | 857µs, 281ns | 689µs, 983ns | 898µs, 838ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 677ms, 64µs, 61ns | 7s, 779ms, 700µs, 40ns | 10s, 481ms, 472µs, 969ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 788µs, 92ns | 762µs, 939ns | 890µs, 16ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 32µs, 492ns | 3ms, 116µs, 130ns | 5ms, 944µs, 967ns |
| Laravel(Reflection, Transient) | ^12.28 | 75s, 124ms, 406µs, 123ns | 62s, 33ms, 967µs, 18ns | 80s, 550ms, 767µs, 898ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 420µs, 18ns | 3ms, 440µs, 856ns | 7ms, 163µs, 47ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 103µs, 14ns | 4ms, 598µs, 140ns | 6ms, 645µs, 917ns |
| Php-baseline |  | 583µs, 76ns | 482µs, 797ns | 682µs, 115ns |
| Php-di(Reflection, Singleton) | ^7.0 | 739µs, 932ns | 688µs, 791ns | 1ms, 45µs, 942ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 265µs, 168ns | 1ms, 250µs, 982ns | 1ms, 302µs, 3ns |
| Pimple(Configured, Transient) | ^3.5 | 12s, 995ms, 698µs, 618ns | 10s, 334ms, 169µs, 149ns | 13s, 828ms, 373µs, 908ns |
| Quickly(Compiled, Singleton) | dev-master | 692µs, 105ns | 676µs, 155ns | 752µs, 210ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 357µs, 793ns | 1ms, 323µs, 938ns | 1ms, 390µs, 933ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 337µs, 289ns | 1ms, 291µs, 36ns | 1ms, 559µs, 19ns |
| Symfony(Compiled, Singleton) | ^7.0 | 770µs, 401ns | 751µs, 18ns | 813µs, 961ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 841µs, 331ns | 792µs, 980ns | 1ms, 178µs, 26ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 864µs, 291ns | 792µs, 26ns | 1ms, 398µs, 86ns |
| Zen(Compiled, Singleton) | ^3.1 | 847µs, 148ns | 766µs, 992ns | 1ms, 419µs, 67ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 488µs, 490ns | 5ms, 177µs, 21ns | 7ms, 69µs, 110ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 252µs, 888ns | 2ms, 183µs, 914ns | 2ms, 359µs, 867ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 601ms, 234µs, 292ns | 7s, 537ms, 775µs, 993ns | 10s, 379ms, 184µs, 961ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 978µs, 16ns | 837µs, 87ns | 2ms, 1µs, 47ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 773µs, 688ns | 3ms, 927µs, 946ns | 5ms, 471µs, 944ns |
| Laravel(Reflection, Transient) | ^12.28 | 77s, 392ms, 595µs, 648ns | 67s, 972ms, 22µs, 56ns | 80s, 462ms, 594µs, 985ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 551µs, 840ns | 3ms, 385µs, 66ns | 3ms, 935µs, 98ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 438µs, 946ns | 5ms, 626µs, 201ns | 7ms, 273µs, 912ns |
| Php-baseline |  | 582µs, 718ns | 496µs, 149ns | 625µs, 133ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 106µs, 762ns | 860µs, 214ns | 3ms, 178µs, 119ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 398µs, 491ns | 1ms, 328µs, 945ns | 1ms, 621µs, 7ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 717ms, 778µs, 873ns | 13s, 279ms, 448µs, 32ns | 14s, 116ms, 934µs, 61ns |
| Quickly(Compiled, Singleton) | dev-master | 818µs, 586ns | 797µs, 986ns | 845µs, 909ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 199µs, 220ns | 2ms, 65µs, 896ns | 2ms, 821µs, 922ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 509µs, 332ns | 1ms, 389µs, 26ns | 2ms, 280µs, 950ns |
| Symfony(Compiled, Singleton) | ^7.0 | 803µs, 613ns | 780µs, 105ns | 857µs, 114ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 176µs, 333ns | 949µs, 859ns | 3ms, 16µs, 948ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 888µs, 323ns | 694µs, 990ns | 2ms, 282µs, 857ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 71µs, 214ns | 849µs, 8ns | 2ms, 950µs, 906ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 762µs, 604ns | 1ms, 545µs, 906ns | 1ms, 839µs, 876ns |
| Dice(Configured, Singleton) | ^4.0 | 859µs, 928ns | 712µs, 156ns | 895µs, 977ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 601µs, 884ns | 3ms, 484µs, 10ns | 3ms, 987µs, 73ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 129µs, 503ns | 4ms, 886µs, 865ns | 6ms, 736µs, 993ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 259µs, 374ns | 1ms, 227µs, 140ns | 1ms, 307µs, 964ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 427ms, 787µs, 89ns | 12s, 835ms, 706µs, 949ns | 13s, 991ms, 641µs, 44ns |
| Quickly(Compiled, Singleton) | dev-master | 769µs, 877ns | 741µs, 4ns | 813µs, 7ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 69µs, 900ns | 3ms, 971µs, 99ns | 4ms, 286µs, 50ns |
| Symfony(Compiled, Singleton) | ^7.0 | 816µs, 798ns | 792µs, 26ns | 845µs, 193ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 919µs, 508ns | 789µs, 165ns | 1ms, 590µs, 967ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 685µs | 617µs, 980ns | 1ms, 214µs, 981ns |
| Zen(Compiled, Singleton) | ^3.1 | 858µs, 497ns | 748µs, 872ns | 1ms, 541µs, 137ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 273µs, 987ns | 3ms, 142µs, 833ns | 3ms, 504µs, 37ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 149µs, 939ns | 1ms, 731µs, 872ns | 2ms, 398µs, 967ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 692µs, 221ns | 3ms, 513µs, 97ns | 4ms, 366µs, 874ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 328µs, 773ns | 5ms, 649µs, 805ns | 6ms, 700µs, 992ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 456µs, 379ns | 1ms, 365µs, 900ns | 1ms, 773µs, 118ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 65ms, 335µs, 822ns | 10s, 454ms, 470µs, 872ns | 14s, 37ms, 642µs, 955ns |
| Quickly(Compiled, Singleton) | dev-master | 815µs, 868ns | 799µs, 179ns | 833µs, 34ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 645µs, 729ns | 4ms, 496µs, 97ns | 5ms, 349µs, 159ns |
| Symfony(Compiled, Singleton) | ^7.0 | 778µs, 365ns | 750µs, 64ns | 799µs, 894ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 904µs, 989ns | 723µs, 123ns | 2ms, 279µs, 996ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 161µs, 909ns | 925µs, 64ns | 3ms, 106µs, 832ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 108µs, 741ns | 861µs, 167ns | 2ms, 954µs, 6ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 824µs, 832ns | 779µs, 151ns | 1ms, 180µs, 887ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 450µs, 84ns | 2ms, 380µs, 847ns | 2ms, 759µs, 933ns |
| Php-di(Reflection, Singleton) | ^7.0 | 649µs, 404ns | 605µs, 821ns | 957µs, 12ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 4µs, 338ns | 990µs, 867ns | 1ms, 39µs, 28ns |
| Quickly(Compiled, Singleton) | dev-master | 808µs, 596ns | 776µs, 52ns | 891µs, 208ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 356µs, 840ns | 1ms, 327µs, 991ns | 1ms, 394µs, 33ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 398µs, 277ns | 1ms, 312µs, 17ns | 1ms, 613µs, 855ns |
| Symfony(Compiled, Singleton) | ^7.0 | 806µs, 379ns | 792µs, 980ns | 844µs, 955ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 673µs, 365ns | 622µs, 34ns | 933µs, 170ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 875µs, 997ns | 782µs, 966ns | 1ms, 538µs, 991ns |
| Zen(Compiled, Singleton) | ^3.1 | 672µs, 316ns | 597µs, 953ns | 1ms, 232µs, 862ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 102µs, 995ns | 960µs, 826ns | 2ms, 117µs, 872ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 512µs, 477ns | 3ms, 439µs, 903ns | 3ms, 865µs, 3ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 188µs, 516ns | 936µs, 31ns | 3ms, 258µs, 943ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 431µs, 107ns | 1ms, 327µs, 37ns | 1ms, 701µs, 116ns |
| Quickly(Compiled, Singleton) | dev-master | 811µs, 529ns | 789µs, 880ns | 834µs, 941ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 171µs, 134ns | 2ms, 35µs, 856ns | 2ms, 902µs, 984ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 605µs, 57ns | 1ms, 497µs, 30ns | 2ms, 392µs, 53ns |
| Symfony(Compiled, Singleton) | ^7.0 | 831µs, 508ns | 791µs, 788ns | 998µs, 20ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 203µs, 966ns | 976µs, 800ns | 3ms, 141µs, 880ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 959µs, 515ns | 751µs, 972ns | 2ms, 335µs, 71ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 43µs, 176ns | 816µs, 822ns | 2ms, 776µs, 861ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 933µs, 24ns | 3ms, 811µs, 120ns | 4ms, 289µs, 865ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 267µs, 766ns | 1ms, 250µs, 28ns | 1ms, 287µs, 221ns |
| Quickly(Compiled, Singleton) | dev-master | 793µs, 552ns | 775µs, 98ns | 835µs, 895ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 54µs, 713ns | 3ms, 984µs, 928ns | 4ms, 281µs, 44ns |
| Symfony(Compiled, Singleton) | ^7.0 | 801µs, 801ns | 766µs, 38ns | 946µs, 44ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 847µs, 220ns | 797µs, 986ns | 1ms, 204µs, 967ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 419µs, 925ns | 1ms, 245µs, 975ns | 2ms, 709µs, 865ns |
| Zen(Compiled, Singleton) | ^3.1 | 852µs, 608ns | 766µs, 38ns | 1ms, 555µs, 919ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 990µs, 316ns | 3ms, 782µs, 33ns | 5ms, 68µs, 63ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 415µs, 181ns | 1ms, 342µs, 58ns | 1ms, 697µs, 63ns |
| Quickly(Compiled, Singleton) | dev-master | 801µs, 944ns | 773µs, 906ns | 874µs, 996ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 773µs, 974ns | 4ms, 582µs, 166ns | 5ms, 500µs, 78ns |
| Symfony(Compiled, Singleton) | ^7.0 | 787µs, 901ns | 758µs, 886ns | 817µs, 60ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 333µs, 808ns | 1ms, 2µs, 73ns | 3ms, 536µs, 939ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 960µs, 40ns | 771µs, 999ns | 2ms, 475µs, 23ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 137µs, 471ns | 900µs, 30ns | 2ms, 979µs, 40ns |

</details>

Questions, issues, and new containers are welcome!
