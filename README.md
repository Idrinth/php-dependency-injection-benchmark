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

## 🧩 Containers

| Container | Features |
| --- | --- |
| [Aura.Di](https://github.com/auraphp/Aura.Di) | Configurable DI container with lazy loading and service factories |
| [PHP-DI](https://github.com/PHP-DI/PHP-DI) | Autowiring, annotations, and compiled container support |
| [Pimple](https://github.com/silexphp/Pimple) | Lightweight closure-based container |
| [Symfony DI](https://github.com/symfony/dependency-injection) | Feature-rich container with configuration and compilation |
| [Laravel Container](https://github.com/laravel/framework) | Framework-integrated container with automatic resolution and binding |
| [Nette DI](https://github.com/nette/di) | High-performance compiled container |
| [Auryn](https://github.com/rdlowrey/auryn) | Auryn is a dependency injector for bootstrapping object-oriented PHP applications. |
| [Dice](https://github.com/Level-2/Dice) | A minimalist dependency injection container for PHP. |
| [Laminas ServiceManager](https://github.com/laminas/laminas-servicemanager) | Factory-driven dependency injection container |
| [League Container](https://github.com/thephpleague/container) | A fast and intuitive dependency injection container. |
| [Phalcon](https://github.com/phalcon/cphalcon) | A PHP extension built for performance |
| [PHP (baseline)](https://www.php.net/) | Manual instantiation of dependencies without a container |
| [Quickly](https://github.com/Idrinth/quickly) | A fast dependency injection container featuring build time resolution. |
| [Ray.Di](https://github.com/ray-di/Ray.Di) | DI and AOP framework for PHP inspired by Google Guice |
| [Zen](https://github.com/woohoolabs/zen) | Woohoo Labs. Zen DI Container and preload file generator |
## Latest Results

Run from 2025-09-09

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 604µs, 819ns | 1ms, 550µs, 197ns | 1ms, 734µs, 18ns |
| auryn | ^1.4 | 401ms, 968µs, 932ns | 398ms, 785µs, 829ns | 406ms, 687µs, 974ns |
| dice(configured) | ^4.0 | 72ms, 119µs, 426ns | 70ms, 185µs, 899ns | 76ms, 436µs, 42ns |
| dice(unconfigured) | ^4.0 | 71ms, 14µs, 618ns | 69ms, 947µs, 4ns | 72ms, 891µs, 950ns |
| laminas-servicemanager | ^3.21 | 773µs, 262ns | 760µs, 78ns | 789µs, 880ns |
| laravel(cached) | ^12.28 | 399ms, 148µs, 201ns | 397ms, 844µs, 76ns | 400ms, 888µs, 919ns |
| laravel(singletons) | ^12.28 | 4ms, 898µs, 786ns | 3ms, 438µs, 949ns | 6ms, 501µs, 913ns |
| laravel(unconfigured) | ^12.28 | 631ms, 818µs, 32ns | 620ms, 545µs, 148ns | 642ms, 846µs, 107ns |
| league(predefined) | ^5.1 | 869ms, 754µs, 433ns | 861ms, 32µs, 962ns | 885ms, 937µs, 929ns |
| league(unconfigured) | ^5.1 | 668ms, 550µs, 610ns | 652ms, 265µs, 71ns | 686ms, 887µs, 979ns |
| nette-di | ^3.2 | 3ms, 468µs, 298ns | 3ms, 345µs, 966ns | 3ms, 982µs, 67ns |
| phalcon(shared) | ^5 | 3ms, 993µs, 82ns | 3ms, 886µs, 938ns | 4ms, 91µs, 24ns |
| phalcon(transient) | ^5 | 252ms, 375µs, 817ns | 246ms, 559µs, 143ns | 260ms, 894µs, 60ns |
| php-baseline |  | 3ms, 800µs, 892ns | 3ms, 769µs, 874ns | 3ms, 834µs, 9ns |
| php-di | ^7.0 | 854µs, 635ns | 789µs, 165ns | 1ms, 236µs, 200ns |
| pimple | ^3.5 | 73ms, 915µs, 958ns | 69ms, 726µs, 943ns | 82ms, 747µs, 936ns |
| quickly(compiled) | dev-master | 822µs, 687ns | 803µs, 947ns | 856µs, 876ns |
| quickly(configured) | dev-master | 1ms, 333µs, 141ns | 1ms, 308µs, 917ns | 1ms, 367µs, 92ns |
| quickly(reflection) | dev-master | 1ms, 356µs, 959ns | 1ms, 324µs, 892ns | 1ms, 462µs, 936ns |
| ray-di(compiled) | ^2.16 | 3s, 495ms, 399µs, 69ns | 3s, 479ms, 360µs, 818ns | 3s, 515ms, 377µs, 44ns |
| symfony(compiled) | ^7.0 | 2ms, 172µs, 64ns | 2ms, 131µs, 938ns | 2ms, 221µs, 107ns |
| zen(unconfigured) | ^3.1 | 1ms, 532µs, 244ns | 1ms, 471µs, 42ns | 1ms, 628µs, 875ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 986µs, 336ns | 1ms, 590µs, 13ns | 3ms, 194µs, 93ns |
| auryn | ^1.4 | 394ms, 36µs, 912ns | 382ms, 485µs, 151ns | 403ms, 850µs, 78ns |
| dice(configured) | ^4.0 | 74ms, 355µs, 983ns | 70ms, 813µs, 894ns | 93ms, 106µs, 985ns |
| dice(unconfigured) | ^4.0 | 72ms, 555µs, 994ns | 69ms, 613µs, 933ns | 82ms, 370µs, 996ns |
| laminas-servicemanager | ^3.21 | 895µs, 142ns | 787µs, 973ns | 1ms, 707µs, 77ns |
| laravel(cached) | ^12.28 | 411ms, 302µs, 18ns | 399ms, 101µs, 972ns | 474ms, 245µs, 71ns |
| laravel(singletons) | ^12.28 | 3ms, 724µs, 646ns | 3ms, 359µs, 794ns | 5ms, 73µs, 70ns |
| laravel(unconfigured) | ^12.28 | 640ms, 399µs, 599ns | 628ms, 154µs, 993ns | 669ms, 361µs, 114ns |
| league(predefined) | ^5.1 | 863ms, 916µs, 778ns | 851ms, 99µs, 967ns | 878ms, 540µs, 992ns |
| league(unconfigured) | ^5.1 | 668ms, 532µs, 204ns | 655ms, 663µs, 13ns | 712ms, 54µs, 14ns |
| nette-di | ^3.2 | 5ms, 568µs, 170ns | 3ms, 313µs, 64ns | 23ms, 576µs, 21ns |
| phalcon(shared) | ^5 | 4ms, 127µs, 1ns | 4ms, 41µs, 910ns | 4ms, 209µs, 41ns |
| phalcon(transient) | ^5 | 254ms, 166µs, 913ns | 249ms, 974µs, 12ns | 274ms, 950µs, 981ns |
| php-baseline |  | 3ms, 871µs, 107ns | 3ms, 814µs, 935ns | 3ms, 947µs, 19ns |
| php-di | ^7.0 | 1ms, 142µs, 930ns | 866µs, 174ns | 3ms, 463µs, 983ns |
| pimple | ^3.5 | 70ms, 789µs, 241ns | 69ms, 463µs, 14ns | 73ms, 855µs, 161ns |
| quickly(compiled) | dev-master | 1ms, 167µs, 464ns | 1ms, 157µs, 45ns | 1ms, 181µs, 840ns |
| quickly(configured) | dev-master | 1ms, 780µs, 629ns | 1ms, 663µs, 208ns | 2ms, 584µs, 934ns |
| quickly(reflection) | dev-master | 2ms, 466µs, 225ns | 2ms, 305µs, 984ns | 3ms, 554µs, 821ns |
| ray-di(compiled) | ^2.16 | 3s, 536ms, 380µs, 147ns | 3s, 510ms, 945µs, 81ns | 3s, 561ms, 518µs, 907ns |
| symfony(compiled) | ^7.0 | 7ms, 514µs, 524ns | 5ms, 898µs, 952ns | 18ms, 959µs, 999ns |
| zen(unconfigured) | ^3.1 | 2ms, 829µs, 527ns | 2ms, 643µs, 108ns | 4ms, 132µs, 32ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 5ms, 301µs, 475ns | 5ms, 230µs, 188ns | 5ms, 496µs, 978ns |
| auryn | ^1.4 | 56s, 455ms, 2µs, 903ns | 55s, 893ms, 59µs, 968ns | 56s, 778ms, 940µs, 916ns |
| laminas-servicemanager | ^3.21 | 770µs, 497ns | 758µs, 886ns | 806µs, 93ns |
| laravel(cached) | ^12.28 | 56s, 603ms, 30µs, 14ns | 56s, 35ms, 625µs, 934ns | 58s, 77ms, 877µs, 998ns |
| laravel(singletons) | ^12.28 | 3ms, 914µs, 499ns | 3ms, 666µs, 877ns | 5ms, 421µs, 876ns |
| nette-di | ^3.2 | 3ms, 423µs, 976ns | 3ms, 280µs, 878ns | 4ms, 40µs, 2ns |
| phalcon(shared) | ^5 | 4ms, 202µs, 103ns | 4ms, 29µs, 35ns | 5ms, 17µs, 42ns |
| phalcon(transient) | ^5 | 35s, 489ms, 543µs, 175ns | 35s, 154ms, 449µs, 939ns | 35s, 762ms, 275µs, 934ns |
| php-baseline |  | 9ms, 849µs, 476ns | 9ms, 814µs, 23ns | 9ms, 893µs, 894ns |
| php-di | ^7.0 | 848µs, 984ns | 795µs, 125ns | 1ms, 254µs, 81ns |
| quickly(compiled) | dev-master | 851µs, 511ns | 839µs, 233ns | 874µs, 996ns |
| quickly(configured) | dev-master | 1ms, 354µs, 598ns | 1ms, 290µs, 82ns | 1ms, 451µs, 969ns |
| quickly(reflection) | dev-master | 1ms, 418µs, 209ns | 1ms, 337µs, 51ns | 1ms, 624µs, 107ns |
| symfony(compiled) | ^7.0 | 3ms, 522µs, 539ns | 2ms, 63µs, 989ns | 4ms, 40µs, 2ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 6ms, 751µs, 585ns | 6ms, 659µs, 984ns | 7ms, 66µs, 11ns |
| auryn | ^1.4 | 57s, 11ms, 145µs, 591ns | 56s, 197ms, 611µs, 93ns | 58s, 27ms, 723µs, 73ns |
| laminas-servicemanager | ^3.21 | 938µs, 820ns | 828µs, 981ns | 1ms, 770µs, 19ns |
| laravel(cached) | ^12.28 | 56s, 337ms, 395µs, 119ns | 55s, 805ms, 932µs, 998ns | 57s, 213ms, 618µs, 993ns |
| laravel(singletons) | ^12.28 | 4ms, 916µs, 95ns | 4ms, 765µs, 33ns | 5ms, 309µs, 104ns |
| nette-di | ^3.2 | 5ms, 364µs, 966ns | 3ms, 317µs, 832ns | 23ms, 683µs, 71ns |
| phalcon(shared) | ^5 | 4ms, 986µs, 476ns | 4ms, 116µs, 58ns | 8ms, 183µs, 956ns |
| phalcon(transient) | ^5 | 35s, 458ms, 40µs, 261ns | 35s, 239ms, 479µs, 64ns | 35s, 729ms, 557µs, 37ns |
| php-baseline |  | 10ms, 132µs, 622ns | 10ms, 80µs, 99ns | 10ms, 203µs, 123ns |
| php-di | ^7.0 | 1ms, 194µs | 879µs, 49ns | 3ms, 477µs, 811ns |
| quickly(compiled) | dev-master | 828µs, 3ns | 816µs, 106ns | 849µs, 962ns |
| quickly(configured) | dev-master | 1ms, 780µs, 676ns | 1ms, 671µs, 75ns | 2ms, 537µs, 965ns |
| quickly(reflection) | dev-master | 1ms, 541µs, 519ns | 1ms, 368µs, 45ns | 2ms, 424µs, 1ns |
| symfony(compiled) | ^7.0 | 7ms, 246µs, 708ns | 5ms, 823µs, 135ns | 19ms, 289µs, 970ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 778µs, 889ns | 758µs, 886ns | 874µs, 996ns |
| nette-di | ^3.2 | 3ms, 399µs, 205ns | 3ms, 378µs, 152ns | 3ms, 452µs, 62ns |
| php-baseline |  | 17ms, 608µs, 213ns | 17ms, 457µs, 8ns | 18ms, 107µs, 175ns |
| php-di | ^7.0 | 873µs, 398ns | 798µs, 940ns | 1ms, 384µs, 973ns |
| quickly(compiled) | dev-master | 769µs, 782ns | 746µs, 965ns | 797µs, 33ns |
| quickly(configured) | dev-master | 1ms, 354µs, 598ns | 1ms, 337µs, 766ns | 1ms, 393µs, 79ns |
| quickly(reflection) | dev-master | 1ms, 386µs, 427ns | 1ms, 336µs, 97ns | 1ms, 660µs, 108ns |
| symfony(compiled) | ^7.0 | 2ms, 151µs, 679ns | 2ms, 120µs, 18ns | 2ms, 213µs, 954ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 1ms, 2µs, 788ns | 861µs, 167ns | 1ms, 983µs, 880ns |
| nette-di | ^3.2 | 5ms, 417µs, 490ns | 3ms, 310µs, 918ns | 24ms, 152µs, 994ns |
| php-baseline |  | 20ms, 837µs, 473ns | 18ms, 174µs, 886ns | 33ms, 358µs, 812ns |
| php-di | ^7.0 | 1ms, 299µs, 595ns | 937µs, 938ns | 4ms, 263µs, 877ns |
| quickly(compiled) | dev-master | 937µs, 724ns | 844µs, 955ns | 1ms, 107µs, 931ns |
| quickly(configured) | dev-master | 1ms, 853µs, 513ns | 1ms, 707µs, 77ns | 2ms, 562µs, 46ns |
| quickly(reflection) | dev-master | 1ms, 579µs, 833ns | 1ms, 433µs, 134ns | 2ms, 256µs, 870ns |
| symfony(compiled) | ^7.0 | 7ms, 220µs, 768ns | 5ms, 777µs, 835ns | 18ms, 348µs, 932ns |

</details>

Questions, issues, and new containers are welcome!
