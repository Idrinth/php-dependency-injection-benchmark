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

Run from 2025-12-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 538µs, 157ns | 1ms, 363µs, 992ns | 1ms, 835µs, 107ns |
| Auryn(Reflection, Transient) | ^1.4 | 394ms, 116µs, 497ns | 357ms, 292µs, 890ns | 416ms, 182µs, 41ns |
| Dice(Configured, Singleton) | ^4.0 | 759µs, 482ns | 673µs, 55ns | 878µs, 95ns |
| Dice(Reflection, Transient) | ^4.0 | 73ms, 546µs, 838ns | 70ms, 649µs, 862ns | 81ms, 794µs, 23ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 679µs, 278ns | 657µs, 81ns | 722µs, 169ns |
| Laravel(Configured, Transient) | ^12.28 | 411ms, 181µs, 521ns | 403ms, 15µs, 136ns | 435ms, 529µs, 947ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 495µs, 645ns | 3ms, 359µs, 79ns | 3ms, 781µs, 80ns |
| Laravel(Reflection, Transient) | ^12.28 | 639ms, 939µs, 522ns | 633ms, 275µs, 985ns | 646ms, 313µs, 905ns |
| League(Configured, Transient) | ^5.1 | 848ms, 700µs, 737ns | 702ms, 469µs, 110ns | 920ms, 75µs, 893ns |
| League(Reflection, Transient) | ^5.1 | 655ms, 574µs, 107ns | 557ms, 425µs, 22ns | 677ms, 425µs, 861ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 383µs, 231ns | 3ms, 296µs, 136ns | 3ms, 732µs, 204ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 954µs, 768ns | 3ms, 425µs, 836ns | 5ms, 222µs, 82ns |
| Phalcon(Configured, Transient) | ^5 | 290ms, 130µs, 281ns | 262ms, 619µs, 972ns | 304ms, 506µs, 63ns |
| Php-baseline |  | 615µs, 286ns | 566µs, 5ns | 769µs, 138ns |
| Php-di(Reflection, Singleton) | ^7.0 | 824µs, 451ns | 766µs, 992ns | 1ms, 210µs, 927ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 32µs, 710ns | 994µs, 920ns | 1ms, 58µs, 101ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 669µs, 72ns | 99ms, 862µs, 813ns | 113ms, 740µs, 921ns |
| Quickly(Compiled, Singleton) | dev-master | 797µs, 80ns | 779µs, 867ns | 815µs, 153ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 421µs, 904ns | 1ms, 342µs, 58ns | 1ms, 757µs, 144ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 718µs, 44ns | 1ms, 332µs, 44ns | 2ms, 252µs, 101ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 25ms, 607µs, 252ns | 1s, 917ms, 526µs, 6ns | 3s, 525ms, 320µs, 53ns |
| Ray-di(Reflection, Transient) | ^2.16 | 386ms, 979µs, 174ns | 354ms, 289µs, 54ns | 400ms, 547µs, 981ns |
| Symfony(Compiled, Singleton) | ^7.0 | 777µs, 125ns | 758µs, 886ns | 802µs, 40ns |
| Zen(Compiled, Singleton) | ^3.1 | 831µs, 866ns | 751µs, 18ns | 1ms, 404µs, 47ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 152µs, 85ns | 1ms, 671µs, 75ns | 4ms, 565µs |
| Auryn(Reflection, Transient) | ^1.4 | 403ms, 416µs, 132ns | 364ms, 324µs, 92ns | 420ms, 500µs, 40ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 44µs, 367ns | 1ms, 801µs, 13ns | 3ms, 93µs, 4ns |
| Dice(Reflection, Transient) | ^4.0 | 72ms, 250µs, 890ns | 70ms, 936µs, 918ns | 73ms, 271µs, 36ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 965µs, 285ns | 833µs, 34ns | 2ms, 23µs, 935ns |
| Laravel(Configured, Transient) | ^12.28 | 408ms, 279µs, 109ns | 362ms, 281µs, 84ns | 426ms, 369µs, 905ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 998µs, 351ns | 3ms, 599µs, 166ns | 5ms, 505µs, 84ns |
| Laravel(Reflection, Transient) | ^12.28 | 645ms, 619µs, 583ns | 641ms, 840µs, 934ns | 653ms, 708µs, 934ns |
| League(Configured, Transient) | ^5.1 | 828ms, 612µs, 923ns | 695ms, 476µs, 55ns | 950ms, 685µs, 24ns |
| League(Reflection, Transient) | ^5.1 | 666ms, 957µs, 902ns | 660ms, 495µs, 42ns | 681ms, 654µs, 930ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 925µs, 252ns | 2ms, 866µs, 983ns | 3ms, 305µs, 912ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 585µs, 693ns | 4ms, 215µs, 2ns | 8ms, 305µs, 72ns |
| Phalcon(Configured, Transient) | ^5 | 292ms, 937µs, 350ns | 289ms, 117µs, 813ns | 304ms, 406µs, 881ns |
| Php-baseline |  | 599µs, 265ns | 576µs, 19ns | 626µs, 802ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 107µs, 25ns | 860µs, 214ns | 3ms, 185µs, 33ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 342µs, 511ns | 1ms, 292µs, 943ns | 1ms, 595µs, 20ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 950µs, 264ns | 99ms, 727µs, 869ns | 103ms, 215µs, 932ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 161µs, 217ns | 1ms, 144µs, 886ns | 1ms, 190µs, 185ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 144µs, 122ns | 2ms, 19µs, 882ns | 2ms, 828µs, 121ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 485µs, 133ns | 1ms, 386µs, 165ns | 2ms, 202µs, 987ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 502ms, 466µs, 201ns | 3s, 459ms, 881µs, 67ns | 3s, 576ms, 472µs, 43ns |
| Ray-di(Reflection, Transient) | ^2.16 | 399ms, 185µs, 609ns | 369ms, 802µs, 951ns | 423ms, 465µs, 967ns |
| Symfony(Compiled, Singleton) | ^7.0 | 814µs, 938ns | 766µs, 38ns | 1ms, 47µs, 849ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 3µs, 694ns | 793µs, 933ns | 2ms, 757µs, 72ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 642µs, 417ns | 1ms, 530µs, 170ns | 1ms, 946µs, 926ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 90µs, 240ns | 803µs, 947ns | 1ms, 430µs, 34ns |
| Laravel(Configured, Transient) | ^12.28 | 379ms, 881µs, 811ns | 375ms, 387µs, 907ns | 384ms, 181µs, 22ns |
| League(Configured, Transient) | ^5.1 | 4s, 221ms, 523µs, 761ns | 3s, 405ms, 946µs, 16ns | 4s, 550ms, 789µs, 833ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 697µs, 13ns | 3ms, 623µs, 962ns | 4ms, 95µs, 77ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 854µs, 12ns | 3ms, 439µs, 903ns | 4ms, 401µs, 922ns |
| Phalcon(Configured, Transient) | ^5 | 295ms, 999µs, 598ns | 287ms, 801µs, 980ns | 302ms, 433µs, 13ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 251µs, 697ns | 1ms, 221µs, 895ns | 1ms, 290µs, 82ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 892µs, 564ns | 101ms, 368µs, 904ns | 115ms, 296µs, 125ns |
| Quickly(Compiled, Singleton) | dev-master | 803µs, 756ns | 784µs, 873ns | 824µs, 928ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 864µs, 336ns | 3ms, 825µs, 902ns | 3ms, 911µs, 18ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 358ms, 589µs, 982ns | 1s, 949ms, 84µs, 43ns | 3s, 575ms, 647µs, 115ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 305µs, 150ns | 1ms, 283µs, 884ns | 1ms, 333µs, 951ns |
| Zen(Compiled, Singleton) | ^3.1 | 842µs, 475ns | 761µs, 985ns | 1ms, 457µs, 929ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 30µs, 86ns | 1ms, 691µs, 102ns | 3ms, 238µs, 916ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 909µs, 494ns | 1ms, 820µs, 87ns | 2ms, 202µs, 987ns |
| Laravel(Configured, Transient) | ^12.28 | 388ms, 20µs, 110ns | 341ms, 95µs, 209ns | 455ms, 615µs, 997ns |
| League(Configured, Transient) | ^5.1 | 4s, 380ms, 361µs, 580ns | 4s, 268ms, 558µs, 25ns | 4s, 482ms, 827µs, 901ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 47µs, 417ns | 3ms, 733µs, 158ns | 6ms, 51µs, 63ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 362µs, 130ns | 4ms, 125µs, 118ns | 5ms, 539µs, 894ns |
| Phalcon(Configured, Transient) | ^5 | 290ms, 267µs, 205ns | 263ms, 607µs, 978ns | 299ms, 508µs, 94ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 374µs, 816ns | 1ms, 291µs, 990ns | 1ms, 767µs, 873ns |
| Pimple(Configured, Transient) | ^3.5 | 104ms, 656µs, 314ns | 101ms, 63µs, 966ns | 120ms, 476µs, 961ns |
| Quickly(Compiled, Singleton) | dev-master | 787µs, 210ns | 766µs, 38ns | 814µs, 914ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 763µs, 507ns | 4ms, 589µs, 80ns | 5ms, 357µs, 980ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 62ms, 578µs, 58ns | 1s, 930ms, 595µs, 874ns | 3s, 634ms, 983µs, 62ns |
| Symfony(Compiled, Singleton) | ^7.0 | 803µs, 303ns | 759µs, 124ns | 1ms, 103µs, 162ns |
| Zen(Compiled, Singleton) | ^3.1 | 821µs, 185ns | 654µs, 935ns | 2ms, 153µs, 158ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 120µs, 324ns | 4ms, 665µs, 136ns | 10ms, 552µs, 883ns |
| Dice(Configured, Singleton) | ^4.0 | 846µs, 385ns | 767µs, 946ns | 916µs, 4ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 969ms, 403µs, 624ns | 8s, 948ms, 761µs, 940ns | 10s, 317ms, 948µs, 102ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 819µs, 778ns | 771µs, 999ns | 988µs, 960ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 762µs, 316ns | 3ms, 20µs, 48ns | 3ms, 961µs, 86ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 908ms, 232µs, 998ns | 73s, 70ms, 158µs, 4ns | 93s, 372ms, 61µs, 967ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 464µs, 768ns | 3ms, 363µs, 132ns | 6ms, 809µs, 949ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 350µs, 733ns | 3ms, 594µs, 875ns | 6ms, 360µs, 54ns |
| Php-baseline |  | 655µs, 627ns | 573µs, 873ns | 879µs, 49ns |
| Php-di(Reflection, Singleton) | ^7.0 | 850µs, 486ns | 775µs, 98ns | 1ms, 230µs, 955ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 340µs, 746ns | 1ms, 269µs, 102ns | 1ms, 770µs, 19ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 781ms, 629µs, 991ns | 13s, 43ms, 125µs, 152ns | 14s, 149ms, 928µs, 808ns |
| Quickly(Compiled, Singleton) | dev-master | 910µs, 782ns | 834µs, 941ns | 992µs, 59ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 133µs, 35ns | 1ms, 578µs, 92ns | 2ms, 214µs, 908ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 384µs, 496ns | 1ms, 316µs, 70ns | 1ms, 581µs, 907ns |
| Symfony(Compiled, Singleton) | ^7.0 | 774µs, 884ns | 753µs, 879ns | 802µs, 40ns |
| Zen(Compiled, Singleton) | ^3.1 | 845µs, 932ns | 759µs, 124ns | 1ms, 480µs, 102ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 39µs, 904ns | 6ms, 818µs, 56ns | 7ms, 529µs, 973ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 223µs, 467ns | 1ms, 949µs, 71ns | 2ms, 506µs, 971ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 295ms, 183µs, 491ns | 10s, 103ms, 111µs, 982ns | 10s, 712ms, 830µs, 66ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 7µs, 890ns | 853µs, 61ns | 1ms, 967µs, 906ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 24µs, 600ns | 3ms, 913µs, 164ns | 8ms, 382µs, 81ns |
| Laravel(Reflection, Transient) | ^12.28 | 90s, 719ms, 966µs, 912ns | 88s, 926ms, 779µs, 31ns | 91s, 459ms, 319µs, 114ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 481µs, 245ns | 3ms, 383µs, 874ns | 3ms, 880µs, 23ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 329µs, 419ns | 3ms, 672µs, 122ns | 4ms, 873µs, 991ns |
| Php-baseline |  | 605µs, 320ns | 487µs, 804ns | 643µs, 14ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 785µs, 230ns | 1ms, 398µs, 86ns | 5ms, 116µs, 939ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 373µs, 434ns | 1ms, 323µs, 223ns | 1ms, 628µs, 160ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 107ms, 678µs, 747ns | 13s, 977ms, 827µs, 72ns | 14s, 372ms, 936µs, 10ns |
| Quickly(Compiled, Singleton) | dev-master | 803µs, 709ns | 792µs, 980ns | 814µs, 914ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 147µs, 436ns | 2ms, 30µs, 134ns | 2ms, 773µs, 46ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 576µs, 805ns | 1ms, 433µs, 134ns | 2ms, 612µs, 113ns |
| Symfony(Compiled, Singleton) | ^7.0 | 813µs, 508ns | 771µs, 999ns | 1ms, 24µs, 961ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 45µs, 393ns | 817µs, 60ns | 2ms, 826µs, 929ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 6µs, 268ns | 1ms, 795µs, 53ns | 3ms, 298µs, 44ns |
| Dice(Configured, Singleton) | ^4.0 | 859µs, 522ns | 751µs, 18ns | 940µs, 84ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 813µs, 600ns | 3ms, 224µs, 134ns | 7ms, 102µs, 12ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 462µs, 409ns | 3ms, 677µs, 129ns | 8ms, 48µs, 57ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 234µs, 674ns | 1ms, 208µs, 66ns | 1ms, 291µs, 990ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 138ms, 668µs, 107ns | 14s, 68ms, 286µs, 895ns | 14s, 274ms, 773µs, 836ns |
| Quickly(Compiled, Singleton) | dev-master | 673µs, 246ns | 627µs, 994ns | 721µs, 931ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 990µs, 435ns | 3ms, 937µs, 5ns | 4ms, 49µs, 62ns |
| Symfony(Compiled, Singleton) | ^7.0 | 782µs, 108ns | 756µs, 25ns | 844µs, 1ns |
| Zen(Compiled, Singleton) | ^3.1 | 835µs, 967ns | 736µs, 951ns | 1ms, 506µs, 90ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 434µs, 753ns | 2ms, 669µs, 811ns | 4ms, 158µs, 973ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 279µs, 496ns | 2ms, 194µs, 881ns | 2ms, 727µs, 31ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 268µs, 599ns | 3ms, 204µs, 822ns | 3ms, 625µs, 154ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 751µs, 253ns | 4ms, 273µs, 176ns | 8ms, 203µs, 29ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 307µs, 296ns | 1ms, 267µs, 910ns | 1ms, 543µs, 998ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 270ms, 179µs, 677ns | 14s, 8ms, 894µs, 920ns | 15s, 161ms, 308µs, 50ns |
| Quickly(Compiled, Singleton) | dev-master | 803µs, 875ns | 790µs, 119ns | 835µs, 895ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 768µs, 109ns | 4ms, 592µs, 180ns | 5ms, 378µs, 961ns |
| Symfony(Compiled, Singleton) | ^7.0 | 793µs, 719ns | 767µs, 946ns | 821µs, 113ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 644µs, 778ns | 1ms, 295µs, 89ns | 4ms, 343µs, 986ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 803µs, 399ns | 771µs, 999ns | 982µs, 999ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 526µs, 401ns | 3ms, 293µs, 991ns | 4ms, 617µs, 929ns |
| Php-di(Reflection, Singleton) | ^7.0 | 844µs, 907ns | 781µs, 59ns | 1ms, 266µs, 956ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 216µs, 793ns | 1ms, 194µs, 953ns | 1ms, 240µs, 15ns |
| Quickly(Compiled, Singleton) | dev-master | 807µs, 976ns | 779µs, 867ns | 938µs, 892ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 353µs, 526ns | 1ms, 332µs, 44ns | 1ms, 389µs, 26ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 367µs, 187ns | 1ms, 334µs, 905ns | 1ms, 586µs, 914ns |
| Symfony(Compiled, Singleton) | ^7.0 | 861µs, 620ns | 819µs, 921ns | 963µs, 211ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 1µs, 143ns | 602µs, 6ns | 2ms, 12µs, 14ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 715µs, 660ns | 1ms, 506µs, 805ns | 3ms, 242µs, 15ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 420µs, 829ns | 3ms, 334µs, 45ns | 3ms, 751µs, 39ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 188µs, 850ns | 948µs, 190ns | 3ms, 196µs, 954ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 417µs, 684ns | 1ms, 348µs, 18ns | 1ms, 641µs, 988ns |
| Quickly(Compiled, Singleton) | dev-master | 826µs, 287ns | 801µs, 86ns | 849µs, 8ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 216µs, 935ns | 2ms, 27µs, 34ns | 2ms, 820µs, 14ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 683µs, 616ns | 1ms, 477µs, 956ns | 2ms, 437µs, 114ns |
| Symfony(Compiled, Singleton) | ^7.0 | 844µs, 73ns | 802µs, 993ns | 916µs, 957ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 90µs, 407ns | 871µs, 896ns | 2ms, 799µs, 987ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 335µs, 285ns | 3ms, 262µs, 996ns | 3ms, 651µs, 857ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 775µs, 455ns | 1ms, 235µs, 961ns | 2ms, 278µs, 89ns |
| Quickly(Compiled, Singleton) | dev-master | 786µs, 924ns | 743µs, 150ns | 812µs, 53ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 930µs, 20ns | 3ms, 824µs, 949ns | 4ms, 132µs, 986ns |
| Symfony(Compiled, Singleton) | ^7.0 | 763µs, 916ns | 750µs, 64ns | 786µs, 66ns |
| Zen(Compiled, Singleton) | ^3.1 | 830µs, 388ns | 735µs, 998ns | 1ms, 546µs, 859ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 910µs, 326ns | 3ms, 822µs, 88ns | 4ms, 289µs, 150ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 388µs, 812ns | 1ms, 331µs, 90ns | 1ms, 638µs, 174ns |
| Quickly(Compiled, Singleton) | dev-master | 810µs, 909ns | 787µs, 19ns | 861µs, 883ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 685µs, 568ns | 4ms, 547µs, 119ns | 5ms, 391µs, 836ns |
| Symfony(Compiled, Singleton) | ^7.0 | 796µs, 270ns | 770µs, 92ns | 861µs, 883ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 123µs, 309ns | 911µs, 951ns | 2ms, 882µs, 3ns |

</details>

Questions, issues, and new containers are welcome!
