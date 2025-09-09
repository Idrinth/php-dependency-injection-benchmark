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
| aura-di | ^5.0 | 1ms, 587µs, 939ns | 1ms, 524µs, 925ns | 1ms, 732µs, 110ns |
| auryn | ^1.4 | 406ms, 757µs, 855ns | 396ms, 295µs, 70ns | 419ms, 795µs, 36ns |
| dice(configured) | ^4.0 | 72ms, 472µs, 310ns | 70ms, 565µs, 938ns | 84ms, 511µs, 41ns |
| dice(unconfigured) | ^4.0 | 71ms, 171µs, 903ns | 69ms, 900µs, 989ns | 73ms, 280µs, 96ns |
| laminas-servicemanager | ^3.21 | 738µs, 644ns | 725µs, 30ns | 750µs, 64ns |
| laravel(cached) | ^12.28 | 401ms, 528µs, 453ns | 396ms, 391µs, 868ns | 409ms, 856µs, 81ns |
| laravel(singletons) | ^12.28 | 3ms, 474µs, 879ns | 3ms, 329µs, 992ns | 3ms, 711µs, 938ns |
| laravel(unconfigured) | ^12.28 | 632ms, 552µs, 51ns | 616ms, 793µs, 870ns | 651ms, 195µs, 49ns |
| league(predefined) | ^5.1 | 867ms, 684µs, 78ns | 850ms, 327µs, 968ns | 908ms, 110µs, 141ns |
| league(unconfigured) | ^5.1 | 664ms, 487µs, 600ns | 654ms, 889µs, 106ns | 672ms, 539µs, 949ns |
| nette-di | ^3.2 | 3ms, 512µs, 310ns | 3ms, 319µs, 25ns | 4ms, 299µs, 879ns |
| phalcon(shared) | ^5 | 4ms, 79µs, 151ns | 3ms, 920µs, 78ns | 5ms, 58µs, 50ns |
| phalcon(transient) | ^5 | 257ms, 546µs, 925ns | 252ms, 207µs, 994ns | 266ms, 371µs, 965ns |
| php-baseline |  | 3ms, 896µs, 808ns | 3ms, 859µs, 996ns | 3ms, 983µs, 974ns |
| php-di | ^7.0 | 856µs, 304ns | 787µs, 973ns | 1ms, 222µs, 133ns |
| pimple | ^3.5 | 71ms, 265µs, 602ns | 69ms, 661µs, 855ns | 73ms, 157µs, 72ns |
| quickly(compiled) | dev-master | 819µs, 683ns | 791µs, 788ns | 849µs, 962ns |
| quickly(configured) | dev-master | 1ms, 373µs, 767ns | 1ms, 335µs, 859ns | 1ms, 393µs, 79ns |
| quickly(reflection) | dev-master | 1ms, 373µs, 648ns | 1ms, 328µs, 945ns | 1ms, 523µs, 971ns |
| ray-di(compiled) | ^2.16 | 3s, 518ms, 435µs, 931ns | 3s, 446ms, 769µs, 952ns | 3s, 546ms, 274µs, 185ns |
| symfony(compiled) | ^7.0 | 2ms, 271µs, 127ns | 2ms, 130µs, 31ns | 3ms, 276µs, 109ns |
| zen(unconfigured) | ^3.1 | 909µs, 924ns | 774µs, 145ns | 1ms, 488µs, 208ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 928µs, 663ns | 1ms, 601µs, 934ns | 3ms, 95µs, 865ns |
| auryn | ^1.4 | 413ms, 1µs, 990ns | 400ms, 295µs, 19ns | 439ms, 574µs, 956ns |
| dice(configured) | ^4.0 | 71ms, 819µs, 519ns | 70ms, 323µs, 944ns | 75ms, 546µs, 26ns |
| dice(unconfigured) | ^4.0 | 72ms, 869µs, 157ns | 70ms, 276µs, 975ns | 80ms, 601µs, 930ns |
| laminas-servicemanager | ^3.21 | 1ms, 398µs, 181ns | 1ms, 242µs, 876ns | 2ms, 617µs, 120ns |
| laravel(cached) | ^12.28 | 405ms, 328µs, 297ns | 398ms, 56µs, 983ns | 414ms, 17µs, 915ns |
| laravel(singletons) | ^12.28 | 3ms, 755µs, 736ns | 3ms, 393µs, 888ns | 4ms, 807µs, 949ns |
| laravel(unconfigured) | ^12.28 | 638ms, 341µs, 569ns | 628ms, 985µs, 881ns | 657ms, 286µs, 882ns |
| league(predefined) | ^5.1 | 865ms, 746µs, 927ns | 851ms, 478µs, 99ns | 889ms, 867µs, 67ns |
| league(unconfigured) | ^5.1 | 670ms, 30µs, 999ns | 656ms, 484µs, 127ns | 691ms, 251µs, 39ns |
| nette-di | ^3.2 | 5ms, 510µs, 759ns | 3ms, 410µs, 100ns | 24ms, 41µs, 891ns |
| phalcon(shared) | ^5 | 4ms, 87µs, 948ns | 4ms, 46µs, 916ns | 4ms, 139µs, 900ns |
| phalcon(transient) | ^5 | 256ms, 643µs, 9ns | 250ms, 921µs, 964ns | 265ms, 202µs, 45ns |
| php-baseline |  | 3ms, 859µs, 329ns | 3ms, 823µs, 41ns | 3ms, 920µs, 78ns |
| php-di | ^7.0 | 1ms, 158µs, 94ns | 885µs, 9ns | 3ms, 410µs, 100ns |
| pimple | ^3.5 | 70ms, 87µs, 456ns | 68ms, 813µs, 800ns | 71ms, 521µs, 997ns |
| quickly(compiled) | dev-master | 787µs, 234ns | 770µs, 92ns | 805µs, 139ns |
| quickly(configured) | dev-master | 1ms, 777µs, 482ns | 1ms, 678µs, 943ns | 2ms, 506µs, 971ns |
| quickly(reflection) | dev-master | 1ms, 453µs, 995ns | 1ms, 351µs, 118ns | 2ms, 194µs, 881ns |
| ray-di(compiled) | ^2.16 | 3s, 580ms, 874µs, 419ns | 3s, 529ms, 80µs, 867ns | 3s, 665ms, 331µs, 125ns |
| symfony(compiled) | ^7.0 | 7ms, 42µs, 908ns | 5ms, 742µs, 73ns | 18ms, 255µs, 949ns |
| zen(unconfigured) | ^3.1 | 995µs, 278ns | 780µs, 105ns | 2ms, 731µs, 84ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 5ms, 767µs, 416ns | 5ms, 207µs, 61ns | 10ms, 338µs, 783ns |
| dice(configured) | ^4.0 | 9s, 994ms, 243µs, 383ns | 9s, 854ms, 719µs, 877ns | 10s, 282ms, 116µs, 889ns |
| dice(unconfigured) | ^4.0 | 10s, 130ms, 750µs, 60ns | 9s, 957ms, 520µs, 961ns | 10s, 437ms, 591µs, 75ns |
| laminas-servicemanager | ^3.21 | 752µs, 210ns | 725µs, 984ns | 779µs, 151ns |
| laravel(singletons) | ^12.28 | 4ms, 101µs, 443ns | 3ms, 662µs, 824ns | 6ms, 30µs, 797ns |
| nette-di | ^3.2 | 3ms, 440µs, 594ns | 3ms, 407µs, 955ns | 3ms, 508µs, 90ns |
| phalcon(shared) | ^5 | 4ms, 128µs, 718ns | 4ms, 28µs, 81ns | 4ms, 318µs, 952ns |
| php-baseline |  | 9ms, 926µs, 128ns | 9ms, 658µs, 98ns | 10ms, 526µs, 895ns |
| php-di | ^7.0 | 861µs, 978ns | 802µs, 40ns | 1ms, 244µs, 68ns |
| pimple | ^3.5 | 10s, 46ms, 531µs, 963ns | 9s, 801ms, 615µs, 953ns | 10s, 194ms, 692µs, 850ns |
| quickly(compiled) | dev-master | 804µs, 400ns | 768µs, 899ns | 853µs, 61ns |
| quickly(configured) | dev-master | 1ms, 331µs, 186ns | 1ms, 294µs, 851ns | 1ms, 410µs, 961ns |
| quickly(reflection) | dev-master | 1ms, 372µs, 432ns | 1ms, 313µs, 924ns | 1ms, 650µs, 94ns |
| symfony(compiled) | ^7.0 | 2ms, 390µs, 885ns | 2ms, 150µs, 58ns | 3ms, 603µs, 935ns |
| zen(unconfigured) | ^3.1 | 921µs, 225ns | 823µs, 974ns | 1ms, 580µs, 953ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 7ms, 288µs, 384ns | 6ms, 543µs, 159ns | 12ms, 12µs, 4ns |
| dice(configured) | ^4.0 | 10s, 12ms, 255µs, 263ns | 9s, 930ms, 688µs, 858ns | 10s, 192ms, 893µs, 981ns |
| dice(unconfigured) | ^4.0 | 10s, 66ms, 99µs, 333ns | 9s, 899ms, 885µs, 177ns | 10s, 238ms, 276µs, 958ns |
| laminas-servicemanager | ^3.21 | 892µs, 472ns | 787µs, 19ns | 1ms, 659µs, 870ns |
| laravel(singletons) | ^12.28 | 5ms, 117µs, 487ns | 4ms, 715µs, 919ns | 7ms, 665µs, 157ns |
| nette-di | ^3.2 | 5ms, 520µs, 296ns | 3ms, 407µs, 1ns | 24ms, 152µs, 40ns |
| phalcon(shared) | ^5 | 4ms, 157µs, 304ns | 4ms, 84µs, 110ns | 4ms, 248µs, 857ns |
| php-baseline |  | 10ms, 218µs, 572ns | 9ms, 830µs, 951ns | 10ms, 701µs, 179ns |
| php-di | ^7.0 | 1ms, 226µs, 949ns | 884µs, 56ns | 3ms, 310µs, 203ns |
| pimple | ^3.5 | 9s, 943ms, 923µs, 187ns | 9s, 812ms, 633µs, 991ns | 10s, 80ms, 790µs, 996ns |
| quickly(compiled) | dev-master | 829µs, 5ns | 806µs, 93ns | 880µs, 2ns |
| quickly(configured) | dev-master | 1ms, 814µs, 31ns | 1ms, 703µs, 977ns | 2ms, 569µs, 198ns |
| quickly(reflection) | dev-master | 1ms, 483µs, 607ns | 1ms, 379µs, 13ns | 2ms, 212µs, 47ns |
| symfony(compiled) | ^7.0 | 7ms, 154µs, 607ns | 5ms, 726µs, 99ns | 18ms, 333µs, 196ns |
| zen(unconfigured) | ^3.1 | 1ms, 19µs, 787ns | 787µs, 973ns | 2ms, 714µs, 872ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 838µs, 589ns | 780µs, 820ns | 1ms, 138µs, 925ns |
| nette-di | ^3.2 | 3ms, 490µs, 209ns | 3ms, 451µs, 824ns | 3ms, 536µs, 939ns |
| php-di | ^7.0 | 867µs, 605ns | 793µs, 933ns | 1ms, 308µs, 917ns |
| quickly(compiled) | dev-master | 889µs, 492ns | 785µs, 827ns | 1ms, 188µs, 39ns |
| quickly(configured) | dev-master | 1ms, 328µs, 396ns | 1ms, 302µs, 3ns | 1ms, 401µs, 901ns |
| quickly(reflection) | dev-master | 1ms, 378µs, 631ns | 1ms, 315µs, 116ns | 1ms, 595µs, 20ns |
| symfony(compiled) | ^7.0 | 2ms, 146µs, 124ns | 2ms, 75µs, 910ns | 2ms, 583µs, 26ns |
| zen(unconfigured) | ^3.1 | 874µs, 853ns | 761µs, 32ns | 1ms, 598µs, 834ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 960µs, 946ns | 846µs, 862ns | 1ms, 720µs, 190ns |
| nette-di | ^3.2 | 5ms, 502µs, 438ns | 3ms, 288µs, 984ns | 23ms, 957µs, 14ns |
| php-di | ^7.0 | 1ms, 253µs, 175ns | 970µs, 840ns | 3ms, 550µs, 52ns |
| quickly(compiled) | dev-master | 997µs, 829ns | 819µs, 921ns | 1ms, 212µs, 120ns |
| quickly(configured) | dev-master | 1ms, 808µs, 714ns | 1ms, 706µs, 123ns | 2ms, 496µs, 957ns |
| quickly(reflection) | dev-master | 1ms, 599µs, 264ns | 1ms, 420µs, 21ns | 2ms, 309µs, 83ns |
| symfony(compiled) | ^7.0 | 7ms, 58µs, 95ns | 5ms, 764µs, 961ns | 18ms, 206µs, 834ns |
| zen(unconfigured) | ^3.1 | 1ms, 129µs, 31ns | 899µs, 76ns | 2ms, 849µs, 102ns |

</details>

Questions, issues, and new containers are welcome!
