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

Run from 2026-01-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 647µs, 806ns | 1ms, 592µs, 159ns | 1ms, 797µs, 914ns |
| Auryn(Reflection, Transient) | ^1.4 | 404ms, 642µs, 415ns | 382ms, 414µs, 102ns | 413ms, 506µs, 31ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 22µs, 5ns | 663µs, 995ns | 1ms, 430µs, 988ns |
| Dice(Reflection, Transient) | ^4.0 | 78ms, 288µs, 769ns | 72ms, 416µs, 67ns | 121ms, 16µs, 979ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 779µs, 891ns | 746µs, 965ns | 853µs, 61ns |
| Laravel(Configured, Transient) | ^12.28 | 407ms, 744µs, 73ns | 399ms, 266µs, 958ns | 428ms, 4µs, 26ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 55µs, 24ns | 2ms, 750µs, 158ns | 3ms, 551µs, 6ns |
| Laravel(Reflection, Transient) | ^12.28 | 634ms, 619µs, 212ns | 627ms, 558µs, 946ns | 673ms, 468µs, 112ns |
| League(Configured, Transient) | ^5.1 | 849ms, 410µs, 629ns | 711ms, 332µs, 82ns | 913ms, 315µs, 773ns |
| League(Reflection, Transient) | ^5.1 | 660ms, 102µs, 748ns | 565ms, 507µs, 888ns | 683ms, 753µs, 967ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 991µs, 509ns | 2ms, 951µs, 145ns | 3ms, 314µs, 971ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 692µs, 316ns | 3ms, 365µs, 39ns | 7ms, 955µs, 74ns |
| Phalcon(Configured, Transient) | ^5 | 302ms, 91µs, 121ns | 293ms, 456µs, 77ns | 315ms, 917µs, 15ns |
| Php-baseline |  | 537µs, 14ns | 468µs, 15ns | 619µs, 173ns |
| Php-di(Reflection, Singleton) | ^7.0 | 832µs, 772ns | 783µs, 920ns | 1ms, 186µs, 847ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 270µs, 866ns | 1ms, 230µs, 955ns | 1ms, 321µs, 77ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 15µs, 329ns | 99ms, 990µs, 129ns | 102ms, 558µs, 135ns |
| Quickly(Compiled, Singleton) | dev-master | 792µs, 980ns | 784µs, 873ns | 811µs, 815ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 357µs, 197ns | 1ms, 337µs, 51ns | 1ms, 399µs, 40ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 347µs, 231ns | 1ms, 316µs, 785ns | 1ms, 438µs, 140ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 232ms, 23µs, 48ns | 1s, 899ms, 664µs, 878ns | 3s, 603ms, 332µs, 996ns |
| Ray-di(Reflection, Transient) | ^2.16 | 393ms, 499µs, 803ns | 366ms, 914µs, 33ns | 406ms, 885µs, 147ns |
| Symfony(Compiled, Singleton) | ^7.0 | 771µs, 951ns | 759µs, 124ns | 807µs, 46ns |
| Zen(Compiled, Singleton) | ^3.1 | 830µs, 292ns | 742µs, 912ns | 1ms, 430µs, 988ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 50µs, 805ns | 1ms, 725µs, 196ns | 3ms, 206µs, 968ns |
| Auryn(Reflection, Transient) | ^1.4 | 406ms, 889µs, 271ns | 399ms, 102µs, 926ns | 415ms, 254µs, 116ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 893µs, 973ns | 1ms, 776µs, 933ns | 2ms, 234µs, 220ns |
| Dice(Reflection, Transient) | ^4.0 | 73ms, 59µs, 34ns | 71ms, 811µs, 914ns | 74ms, 308µs, 872ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 920µs, 963ns | 787µs, 973ns | 1ms, 944µs, 65ns |
| Laravel(Configured, Transient) | ^12.28 | 403ms, 122µs, 663ns | 349ms, 869µs, 966ns | 434ms, 131µs, 860ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 374µs, 457ns | 2ms, 802µs, 133ns | 4ms, 707µs, 813ns |
| Laravel(Reflection, Transient) | ^12.28 | 629ms, 612µs, 612ns | 622ms, 926µs, 950ns | 634ms, 989µs, 23ns |
| League(Configured, Transient) | ^5.1 | 863ms, 984µs, 775ns | 709ms, 41µs, 833ns | 908ms, 498µs, 48ns |
| League(Reflection, Transient) | ^5.1 | 671ms, 134µs, 996ns | 662ms, 432µs, 909ns | 691ms, 520µs, 214ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 53µs, 879ns | 2ms, 979µs, 40ns | 3ms, 366µs, 947ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 132µs, 80ns | 3ms, 957µs, 33ns | 4ms, 537µs, 105ns |
| Phalcon(Configured, Transient) | ^5 | 300ms, 67µs, 996ns | 296ms, 472µs, 72ns | 307ms, 761µs, 907ns |
| Php-baseline |  | 531µs, 983ns | 451µs, 87ns | 607µs, 967ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 125µs, 526ns | 861µs, 167ns | 3ms, 320µs, 932ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 382µs, 708ns | 1ms, 307µs, 964ns | 1ms, 611µs, 948ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 102µs, 851ns | 101ms, 64µs, 920ns | 103ms, 204µs, 11ns |
| Quickly(Compiled, Singleton) | dev-master | 820µs, 112ns | 802µs, 40ns | 841µs, 140ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 320µs, 933ns | 1ms, 992µs, 940ns | 4ms, 495µs, 143ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 491µs, 189ns | 1ms, 385µs, 927ns | 2ms, 287µs, 149ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 216ms, 445µs, 660ns | 1s, 927ms, 531µs, 3ns | 3s, 600ms, 174µs, 903ns |
| Ray-di(Reflection, Transient) | ^2.16 | 406ms, 554µs, 102ns | 358ms, 242µs, 988ns | 454ms, 834µs, 938ns |
| Symfony(Compiled, Singleton) | ^7.0 | 815µs, 987ns | 800µs, 132ns | 844µs, 955ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 26µs, 916ns | 791µs, 72ns | 2ms, 903µs, 938ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 532µs, 125ns | 1ms, 380µs, 920ns | 1ms, 761µs, 913ns |
| Dice(Configured, Singleton) | ^4.0 | 833µs, 678ns | 819µs, 921ns | 861µs, 883ns |
| Laravel(Configured, Transient) | ^12.28 | 369ms, 800µs, 400ns | 328ms, 835µs, 964ns | 386ms, 533µs, 21ns |
| League(Configured, Transient) | ^5.1 | 4s, 187ms, 583µs, 661ns | 3s, 393ms, 420µs, 934ns | 4s, 532ms, 450µs, 914ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 857µs, 517ns | 3ms, 762µs, 960ns | 4ms, 223µs, 823ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 513µs, 883ns | 3ms, 818µs, 988ns | 7ms, 858µs, 991ns |
| Phalcon(Configured, Transient) | ^5 | 308ms, 384µs, 203ns | 296ms, 473µs, 26ns | 352ms, 718µs, 114ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 263µs, 403ns | 1ms, 235µs, 8ns | 1ms, 307µs, 964ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 958µs, 463ns | 102ms, 439µs, 880ns | 106ms, 507µs, 778ns |
| Quickly(Compiled, Singleton) | dev-master | 664µs, 830ns | 647µs, 68ns | 674µs, 9ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 886µs, 389ns | 3ms, 842µs, 115ns | 4ms, 41µs, 910ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 77ms, 183µs, 270ns | 1s, 937ms, 968µs, 969ns | 3s, 597ms, 924µs, 232ns |
| Symfony(Compiled, Singleton) | ^7.0 | 764µs, 393ns | 741µs, 4ns | 792µs, 26ns |
| Zen(Compiled, Singleton) | ^3.1 | 888µs, 991ns | 750µs, 780ns | 1ms, 452µs, 207ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 331ns | 1ms, 642µs, 942ns | 3ms, 180µs, 980ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 682µs, 186ns | 1ms, 448µs, 154ns | 2ms, 224µs, 922ns |
| Laravel(Configured, Transient) | ^12.28 | 379ms, 389µs, 238ns | 326ms, 282µs, 978ns | 406ms, 564µs, 950ns |
| League(Configured, Transient) | ^5.1 | 4s, 245ms, 960µs, 164ns | 4s, 148ms, 680µs, 925ns | 4s, 393ms, 967µs, 866ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 878µs, 831ns | 3ms, 813µs, 982ns | 4ms, 266µs, 977ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 71µs, 950ns | 4ms, 23µs, 790ns | 4ms, 186µs, 868ns |
| Phalcon(Configured, Transient) | ^5 | 298ms, 674µs, 130ns | 294ms, 337µs, 987ns | 308ms, 18µs, 922ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 409µs, 530ns | 1ms, 264µs, 95ns | 2ms, 26µs, 81ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 710µs, 581ns | 94ms, 967µs, 842ns | 115ms, 325µs, 927ns |
| Quickly(Compiled, Singleton) | dev-master | 803µs, 303ns | 782µs, 12ns | 842µs, 94ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 600µs, 71ns | 4ms, 420µs, 42ns | 5ms, 153µs, 894ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 401ms, 136µs, 159ns | 1s, 941ms, 982µs, 30ns | 3s, 594ms, 675µs, 64ns |
| Symfony(Compiled, Singleton) | ^7.0 | 787µs, 401ns | 771µs, 999ns | 825µs, 166ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 12µs, 325ns | 756µs, 25ns | 2ms, 789µs, 974ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 259µs, 84ns | 4ms, 678µs, 964ns | 5ms, 393µs, 28ns |
| Dice(Configured, Singleton) | ^4.0 | 840µs, 210ns | 750µs, 64ns | 891µs, 923ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 252ms, 824µs, 234ns | 9s, 957ms, 120µs, 180ns | 10s, 417ms, 474µs, 31ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 228µs, 642ns | 1ms, 178µs, 26ns | 1ms, 455µs, 68ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 849µs, 864ns | 2ms, 967µs, 119ns | 6ms, 752µs, 14ns |
| Laravel(Reflection, Transient) | ^12.28 | 87s, 474ms, 664µs, 473ns | 74s, 660ms, 870µs, 790ns | 89s, 839ms, 437µs, 7ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 502µs, 11ns | 3ms, 397µs, 941ns | 4ms, 50µs, 970ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 728µs, 341ns | 3ms, 948µs, 926ns | 7ms, 911µs, 920ns |
| Php-baseline |  | 566µs, 196ns | 486µs, 850ns | 634µs, 193ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 105µs, 713ns | 813µs, 961ns | 1ms, 826µs, 47ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 29µs, 62ns | 1ms, 15µs, 901ns | 1ms, 39µs, 28ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 30ms, 780µs, 816ns | 13s, 40ms, 619µs, 134ns | 14s, 669ms, 512µs, 987ns |
| Quickly(Compiled, Singleton) | dev-master | 824µs, 666ns | 799µs, 179ns | 851µs, 154ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 375µs, 293ns | 1ms, 283µs, 168ns | 1ms, 605µs, 33ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 406µs, 669ns | 1ms, 353µs, 979ns | 1ms, 613µs, 855ns |
| Symfony(Compiled, Singleton) | ^7.0 | 829µs, 577ns | 765µs, 85ns | 1ms, 134µs, 157ns |
| Zen(Compiled, Singleton) | ^3.1 | 874µs, 495ns | 792µs, 26ns | 1ms, 487µs, 16ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 283µs, 544ns | 5ms, 654µs, 811ns | 12ms, 607µs, 812ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 189µs, 922ns | 1ms, 884µs, 222ns | 2ms, 269µs, 29ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 83ms, 708µs, 477ns | 8s, 923ms, 465µs, 13ns | 10s, 403ms, 22µs, 50ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 999µs, 307ns | 870µs, 943ns | 2ms, 7µs, 7ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 182µs, 456ns | 4ms, 688µs, 24ns | 8ms, 416µs, 175ns |
| Laravel(Reflection, Transient) | ^12.28 | 89s, 341ms, 881µs, 251ns | 88s, 584ms, 526µs, 62ns | 90s, 879ms, 276µs, 37ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 446µs, 602ns | 3ms, 358µs, 125ns | 3ms, 767µs, 13ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 404µs, 664ns | 3ms, 743µs, 886ns | 6ms, 429µs, 910ns |
| Php-baseline |  | 657µs, 343ns | 600µs, 814ns | 839µs, 948ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 153µs, 969ns | 900µs, 983ns | 3ms, 162µs, 145ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 98µs, 942ns | 1ms, 29µs, 14ns | 1ms, 252µs, 174ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 43ms, 886µs, 995ns | 13s, 69ms, 533µs, 109ns | 14s, 289ms, 995µs, 193ns |
| Quickly(Compiled, Singleton) | dev-master | 816µs, 154ns | 792µs, 980ns | 830µs, 888ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 656µs, 411ns | 3ms, 525µs, 972ns | 4ms, 565µs, 954ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 516µs, 699ns | 1ms, 399µs, 993ns | 2ms, 233µs, 982ns |
| Symfony(Compiled, Singleton) | ^7.0 | 816µs, 154ns | 794µs, 172ns | 873µs, 804ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 66µs, 470ns | 840µs, 902ns | 2ms, 868µs, 890ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 849µs, 651ns | 1ms, 592µs, 159ns | 2ms, 155µs, 65ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 44µs, 702ns | 733µs, 137ns | 1ms, 485µs, 109ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 979µs, 444ns | 3ms, 706µs, 932ns | 5ms, 637µs, 168ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 986µs, 96ns | 3ms, 426µs, 74ns | 4ms, 643µs, 917ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 252µs, 317ns | 1ms, 215µs, 934ns | 1ms, 303µs, 911ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 249ms, 47µs, 875ns | 13s, 134ms, 931µs, 802ns | 14s, 881ms, 907µs, 224ns |
| Quickly(Compiled, Singleton) | dev-master | 792µs, 503ns | 764µs, 846ns | 817µs, 60ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 660µs, 296ns | 4ms, 534µs, 6ns | 4ms, 918µs, 98ns |
| Symfony(Compiled, Singleton) | ^7.0 | 656µs, 914ns | 631µs, 93ns | 716µs, 924ns |
| Zen(Compiled, Singleton) | ^3.1 | 840µs, 234ns | 751µs, 18ns | 1ms, 485µs, 109ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 187µs, 751ns | 2ms, 578µs, 20ns | 3ms, 479µs, 3ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 220µs, 749ns | 2ms, 144µs, 98ns | 2ms, 283µs, 96ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 964µs, 328ns | 3ms, 867µs, 149ns | 4ms, 326µs, 105ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 158µs, 400ns | 4ms, 179µs, 954ns | 8ms, 352µs, 41ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 329µs, 874ns | 1ms, 283µs, 168ns | 1ms, 577µs, 854ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 275ms, 39µs, 339ns | 14s, 174ms, 993µs, 38ns | 14s, 360ms, 320µs, 806ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 180µs, 171ns | 1ms, 157µs, 999ns | 1ms, 264µs, 810ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 667µs, 448ns | 4ms, 488µs, 945ns | 5ms, 298µs, 852ns |
| Symfony(Compiled, Singleton) | ^7.0 | 811µs, 934ns | 789µs, 880ns | 838µs, 994ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 59µs, 746ns | 821µs, 113ns | 2ms, 837µs, 181ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 851µs, 178ns | 772µs, 953ns | 1ms, 371µs, 860ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 483µs, 605ns | 3ms, 378µs, 868ns | 3ms, 857µs, 851ns |
| Php-di(Reflection, Singleton) | ^7.0 | 848µs, 31ns | 783µs, 205ns | 1ms, 275µs, 62ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 249µs, 289ns | 1ms, 225µs, 948ns | 1ms, 281µs, 976ns |
| Quickly(Compiled, Singleton) | dev-master | 809µs, 49ns | 789µs, 880ns | 832µs, 796ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 355µs, 886ns | 1ms, 311µs, 63ns | 1ms, 461µs, 29ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 354µs, 479ns | 1ms, 310µs, 825ns | 1ms, 569µs, 32ns |
| Symfony(Compiled, Singleton) | ^7.0 | 840µs, 663ns | 797µs, 33ns | 862µs, 836ns |
| Zen(Compiled, Singleton) | ^3.1 | 828µs, 719ns | 740µs, 51ns | 1ms, 499µs, 891ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 888µs, 800ns | 770µs, 92ns | 1ms, 726µs, 865ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 562µs, 998ns | 3ms, 401µs, 41ns | 4ms, 55µs, 976ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 202µs, 392ns | 909µs, 805ns | 3ms, 296µs, 852ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 374µs, 483ns | 1ms, 296µs, 997ns | 1ms, 524µs, 925ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 110µs, 267ns | 787µs, 973ns | 1ms, 177µs, 72ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 162µs, 313ns | 2ms, 58µs, 982ns | 2ms, 840µs, 42ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 295µs, 971ns | 1ms, 199µs, 7ns | 1ms, 912µs, 832ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 329µs, 398ns | 1ms, 302µs, 3ns | 1ms, 399µs, 40ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 167µs, 273ns | 907µs, 897ns | 3ms, 128µs, 51ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 849µs, 720ns | 3ms, 777µs, 980ns | 4ms, 254µs, 102ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 251µs, 506ns | 1ms, 222µs, 848ns | 1ms, 292µs, 943ns |
| Quickly(Compiled, Singleton) | dev-master | 678µs, 801ns | 657µs, 81ns | 732µs, 183ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 500µs, 223ns | 3ms, 471µs, 136ns | 3ms, 543µs, 853ns |
| Symfony(Compiled, Singleton) | ^7.0 | 793µs, 695ns | 762µs, 939ns | 823µs, 20ns |
| Zen(Compiled, Singleton) | ^3.1 | 855µs, 422ns | 745µs, 58ns | 1ms, 579µs, 999ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 889µs, 846ns | 3ms, 825µs, 902ns | 4ms, 183µs, 53ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 302µs, 218ns | 1ms, 244µs, 68ns | 1ms, 537µs, 84ns |
| Quickly(Compiled, Singleton) | dev-master | 822µs, 710ns | 798µs, 940ns | 876µs, 188ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 932µs, 880ns | 4ms, 641µs, 56ns | 5ms, 601µs, 882ns |
| Symfony(Compiled, Singleton) | ^7.0 | 876µs, 665ns | 843µs, 48ns | 896µs, 930ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 186µs, 180ns | 957µs, 12ns | 2ms, 983µs, 808ns |

</details>

Questions, issues, and new containers are welcome!
