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
| aura-di | ^5.0 | 1ms, 632µs, 380ns | 1ms, 538µs, 991ns | 1ms, 783µs, 847ns |
| auryn | ^1.4 | 414ms, 535µs, 93ns | 404ms, 176µs, 950ns | 427ms, 149µs, 57ns |
| dice(configured) | ^4.0 | 73ms, 162µs, 102ns | 70ms, 115µs, 89ns | 83ms, 826µs, 65ns |
| dice(unconfigured) | ^4.0 | 71ms, 536µs, 207ns | 69ms, 557µs, 189ns | 79ms, 151µs, 868ns |
| laminas-servicemanager | ^4.4 | 766µs, 754ns | 742µs, 912ns | 849µs, 962ns |
| laravel(cached) | ^12.28 | 397ms, 603µs, 416ns | 394ms, 770µs, 145ns | 400ms, 765µs, 895ns |
| laravel(singletons) | ^12.28 | 3ms, 504µs, 133ns | 3ms, 453µs, 16ns | 3ms, 674µs, 983ns |
| laravel(unconfigured) | ^12.28 | 630ms, 288µs, 219ns | 613ms, 600µs, 15ns | 647ms, 930µs, 145ns |
| league(predefined) | ^5.1 | 865ms, 700µs, 54ns | 855ms, 434µs, 179ns | 896ms, 719µs, 217ns |
| league(unconfigured) | ^5.1 | 668ms, 549µs, 180ns | 657ms, 615µs, 900ns | 705ms, 110µs, 788ns |
| nette-di | ^3.2 | 4ms, 36µs, 378ns | 3ms, 256µs, 82ns | 6ms, 849µs, 50ns |
| phalcon(shared) | ^5 | 5ms, 279µs, 135ns | 3ms, 962µs, 39ns | 8ms, 82µs, 151ns |
| phalcon(transient) | ^5 | 250ms, 787µs, 496ns | 248ms, 347µs, 997ns | 254ms, 12µs, 823ns |
| php-baseline |  | 3ms, 897µs, 404ns | 3ms, 828µs, 48ns | 4ms, 24µs, 28ns |
| php-di | ^7.0 | 861µs, 644ns | 802µs, 40ns | 1ms, 209µs, 974ns |
| pimple(factories) | ^3.5 | 72ms, 295µs, 761ns | 69ms, 408µs, 893ns | 78ms, 408µs, 956ns |
| pimple(singletons) | ^3.5 | 1ms, 312µs, 804ns | 1ms, 199µs, 960ns | 1ms, 835µs, 107ns |
| quickly(compiled) | dev-master | 957µs, 584ns | 796µs, 79ns | 1ms, 188µs, 39ns |
| quickly(configured) | dev-master | 1ms, 372µs, 790ns | 1ms, 325µs, 845ns | 1ms, 449µs, 823ns |
| quickly(reflection) | dev-master | 1ms, 350µs, 188ns | 1ms, 318µs, 931ns | 1ms, 464µs, 128ns |
| ray-di(compiled) | ^2.16 | 3s, 504ms, 336µs, 881ns | 3s, 420ms, 536µs, 994ns | 3s, 549ms, 690µs, 8ns |
| ray-di(unconfigured) | ^2.16 | 342ms, 106µs, 628ns | 340ms, 357µs, 65ns | 348ms, 169µs, 88ns |
| symfony(compiled) | ^7.0 | 790µs, 190ns | 771µs, 999ns | 845µs, 909ns |
| zen(unconfigured) | ^3.1 | 856µs, 900ns | 770µs, 92ns | 1ms, 498µs, 937ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 939µs, 201ns | 1ms, 610µs, 994ns | 3ms, 134µs, 965ns |
| auryn | ^1.4 | 406ms, 817µs, 770ns | 401ms, 46µs, 991ns | 412ms, 60µs, 22ns |
| dice(configured) | ^4.0 | 74ms, 790µs, 501ns | 71ms, 223µs, 20ns | 90ms, 580µs, 940ns |
| dice(unconfigured) | ^4.0 | 76ms, 779µs, 389ns | 70ms, 55µs, 7ns | 90ms, 243µs, 816ns |
| laminas-servicemanager | ^4.4 | 904µs, 893ns | 768µs, 899ns | 2ms, 5µs, 100ns |
| laravel(cached) | ^12.28 | 405ms, 923µs, 914ns | 399ms, 17µs, 810ns | 414ms, 998µs, 54ns |
| laravel(singletons) | ^12.28 | 3ms, 801µs, 822ns | 3ms, 499µs, 31ns | 5ms, 640µs, 983ns |
| laravel(unconfigured) | ^12.28 | 644ms, 684µs, 481ns | 627ms, 253µs, 55ns | 714ms, 629µs, 888ns |
| league(predefined) | ^5.1 | 869ms, 95µs, 730ns | 853ms, 445µs, 768ns | 883ms, 744µs, 1ns |
| league(unconfigured) | ^5.1 | 677ms, 532µs, 52ns | 657ms, 254µs, 934ns | 726ms, 923µs, 942ns |
| nette-di | ^3.2 | 8ms, 498µs, 311ns | 3ms, 360µs, 33ns | 33ms, 82µs, 962ns |
| phalcon(shared) | ^5 | 4ms, 46µs, 297ns | 3ms, 974µs, 914ns | 4ms, 126µs, 71ns |
| phalcon(transient) | ^5 | 253ms, 569µs, 340ns | 249ms, 573µs, 945ns | 259ms, 52µs, 38ns |
| php-baseline |  | 3ms, 864µs, 383ns | 3ms, 813µs, 982ns | 3ms, 988µs, 981ns |
| php-di | ^7.0 | 1ms, 130µs, 962ns | 865µs, 936ns | 3ms, 368µs, 854ns |
| pimple(factories) | ^3.5 | 72ms, 613µs, 668ns | 69ms, 234µs, 132ns | 79ms, 230µs, 785ns |
| pimple(singletons) | ^3.5 | 1ms, 575µs, 684ns | 1ms, 492µs, 23ns | 1ms, 851µs, 81ns |
| quickly(compiled) | dev-master | 819µs, 802ns | 788µs, 927ns | 847µs, 816ns |
| quickly(configured) | dev-master | 2ms, 751µs, 898ns | 2ms, 403µs, 20ns | 2ms, 901µs, 77ns |
| quickly(reflection) | dev-master | 1ms, 458µs, 573ns | 1ms, 347µs, 64ns | 2ms, 224µs, 922ns |
| ray-di(compiled) | ^2.16 | 3s, 517ms, 829µs, 418ns | 3s, 470ms, 328µs, 807ns | 3s, 564ms, 107µs, 179ns |
| ray-di(unconfigured) | ^2.16 | 363ms, 788µs, 723ns | 350ms, 235µs, 939ns | 409ms, 754µs, 37ns |
| symfony(compiled) | ^7.0 | 784µs, 87ns | 748µs, 872ns | 809µs, 907ns |
| zen(unconfigured) | ^3.1 | 983µs, 357ns | 777µs, 6ns | 2ms, 690µs, 76ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 5ms, 812µs, 191ns | 5ms, 217µs, 75ns | 10ms, 345µs, 935ns |
| auryn | ^1.4 | 56s, 701ms, 383µs, 757ns | 55s, 993ms, 690µs, 967ns | 57s, 221ms, 796µs, 989ns |
| laminas-servicemanager | ^4.4 | 774µs, 407ns | 747µs, 203ns | 887µs, 870ns |
| laravel(cached) | ^12.28 | 56s, 449ms, 968µs, 695ns | 56s, 151ms, 994µs, 943ns | 57s, 75ms, 402µs, 21ns |
| laravel(singletons) | ^12.28 | 4ms, 516µs, 649ns | 3ms, 410µs, 100ns | 6ms, 711µs, 959ns |
| nette-di | ^3.2 | 3ms, 412µs, 580ns | 3ms, 279µs, 924ns | 3ms, 767µs, 967ns |
| phalcon(shared) | ^5 | 4ms, 512µs, 667ns | 4ms, 902ns | 6ms, 433µs, 10ns |
| phalcon(transient) | ^5 | 35s, 546ms, 109µs, 604ns | 34s, 837ms, 737µs, 83ns | 36s, 29ms, 575µs, 109ns |
| php-baseline |  | 10ms, 918µs, 569ns | 9ms, 832µs, 859ns | 18ms, 152µs, 952ns |
| php-di | ^7.0 | 884µs, 795ns | 828µs, 981ns | 1ms, 281µs, 976ns |
| quickly(compiled) | dev-master | 809µs, 240ns | 786µs, 66ns | 838µs, 994ns |
| quickly(configured) | dev-master | 1ms, 345µs, 825ns | 1ms, 322µs, 984ns | 1ms, 374µs, 959ns |
| quickly(reflection) | dev-master | 1ms, 353µs, 311ns | 1ms, 297µs, 950ns | 1ms, 508µs, 951ns |
| ray-di(unconfigured) | ^2.16 | 49s, 309ms, 212µs, 732ns | 48s, 725ms, 101µs, 947ns | 51s, 536ms, 868µs, 95ns |
| symfony(compiled) | ^7.0 | 765µs, 323ns | 691µs, 890ns | 790µs, 119ns |
| zen(unconfigured) | ^3.1 | 854µs, 921ns | 764µs, 846ns | 1ms, 523µs, 971ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 8ms, 398µs, 842ns | 6ms, 522µs, 893ns | 12ms, 600µs, 898ns |
| auryn | ^1.4 | 56s, 650ms, 281µs, 357ns | 55s, 721ms, 129µs, 894ns | 57s, 210ms, 187µs, 911ns |
| laminas-servicemanager | ^4.4 | 997µs, 281ns | 849µs, 962ns | 2ms, 12µs, 14ns |
| laravel(cached) | ^12.28 | 56s, 137ms, 891µs, 674ns | 54s, 650ms, 247µs, 97ns | 56s, 505ms, 588µs, 54ns |
| laravel(singletons) | ^12.28 | 3ms, 787µs, 398ns | 3ms, 544µs, 92ns | 4ms, 895µs, 210ns |
| nette-di | ^3.2 | 24ms, 439µs, 954ns | 23ms, 875µs, 951ns | 26ms, 329µs, 40ns |
| phalcon(shared) | ^5 | 4ms, 221µs, 534ns | 4ms, 138µs, 946ns | 4ms, 328µs, 12ns |
| phalcon(transient) | ^5 | 35s, 377ms, 136µs, 182ns | 34s, 893ms, 409µs, 13ns | 35s, 642ms, 251µs, 14ns |
| php-baseline |  | 10ms, 83µs, 365ns | 9ms, 900µs, 93ns | 10ms, 382µs, 890ns |
| php-di | ^7.0 | 1ms, 238µs, 894ns | 879µs, 49ns | 4ms, 285µs, 97ns |
| quickly(compiled) | dev-master | 799µs, 369ns | 785µs, 112ns | 818µs, 967ns |
| quickly(configured) | dev-master | 1ms, 923µs, 584ns | 1ms, 818µs, 895ns | 2ms, 700µs, 90ns |
| quickly(reflection) | dev-master | 2ms, 572µs, 846ns | 2ms, 436µs, 876ns | 3ms, 623µs, 962ns |
| ray-di(unconfigured) | ^2.16 | 49s, 294ms, 628µs, 691ns | 48s, 763ms, 653µs, 993ns | 49s, 652ms, 543µs, 67ns |
| symfony(compiled) | ^7.0 | 964µs, 808ns | 777µs, 6ns | 1ms, 311µs, 63ns |
| zen(unconfigured) | ^3.1 | 1ms, 53µs, 714ns | 841µs, 140ns | 2ms, 841µs, 949ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^4.4 | 794µs, 672ns | 761µs, 985ns | 968µs, 933ns |
| laravel(singletons) | ^12.28 | 3ms, 534µs, 78ns | 3ms, 479µs, 3ns | 3ms, 895µs, 998ns |
| php-di | ^7.0 | 874µs, 66ns | 804µs, 901ns | 1ms, 300µs, 96ns |
| quickly(compiled) | dev-master | 788µs, 187ns | 767µs, 946ns | 816µs, 106ns |
| quickly(configured) | dev-master | 2ms, 314µs, 829ns | 2ms, 283µs, 811ns | 2ms, 471µs, 923ns |
| quickly(reflection) | dev-master | 1ms, 378µs, 393ns | 1ms, 331µs, 90ns | 1ms, 599µs, 73ns |
| symfony(compiled) | ^7.0 | 788µs, 331ns | 728µs, 130ns | 1ms, 127µs, 4ns |
| zen(unconfigured) | ^3.1 | 845µs, 980ns | 761µs, 32ns | 1ms, 523µs, 17ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^4.4 | 1ms, 82µs, 682ns | 933µs, 170ns | 2ms, 157µs, 211ns |
| laravel(singletons) | ^12.28 | 3ms, 842µs, 329ns | 3ms, 657µs, 817ns | 4ms, 998µs, 207ns |
| php-di | ^7.0 | 1ms, 247µs | 954µs, 866ns | 3ms, 492µs, 116ns |
| quickly(compiled) | dev-master | 830µs, 30ns | 811µs, 100ns | 863µs, 75ns |
| quickly(configured) | dev-master | 1ms, 845µs, 192ns | 1ms, 739µs, 978ns | 2ms, 506µs, 971ns |
| quickly(reflection) | dev-master | 1ms, 585µs, 674ns | 1ms, 474µs, 857ns | 2ms, 305µs, 984ns |
| symfony(compiled) | ^7.0 | 815µs, 105ns | 796µs, 79ns | 854µs, 15ns |
| zen(unconfigured) | ^3.1 | 1ms, 117µs, 86ns | 909µs, 805ns | 2ms, 769µs, 947ns |

</details>

Questions, issues, and new containers are welcome!
