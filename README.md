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

Run from 2026-08-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 440µs, 334ns | 1ms, 227µs, 855ns | 1ms, 741µs, 886ns |
| Auryn(Reflection, Transient) | ^1.4 | 386ms, 550µs, 545ns | 240ms, 159µs, 988ns | 409ms, 101µs, 9ns |
| Dice(Configured, Singleton) | ^4.0 | 857µs, 663ns | 817µs, 60ns | 892µs, 877ns |
| Dice(Reflection, Transient) | ^4.0 | 74ms, 402µs, 928ns | 73ms, 678µs, 16ns | 75ms, 196µs, 981ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 792µs, 98ns | 763µs, 893ns | 864µs, 28ns |
| Laravel(Configured, Transient) | ^12.28 | 400ms, 824µs, 713ns | 311ms, 856µs, 985ns | 416ms, 698µs, 932ns |
| Laravel(Reflection, Singleton) | ^12.28 | 2ms, 115µs, 750ns | 1ms, 907µs, 825ns | 2ms, 459µs, 49ns |
| Laravel(Reflection, Transient) | ^12.28 | 584ms, 734µs, 940ns | 581ms, 804µs, 37ns | 589ms, 828µs, 968ns |
| League(Configured, Transient) | ^5.1 | 1s, 85ms, 384µs, 202ns | 706ms, 815µs, 958ns | 1s, 189ms, 54µs, 965ns |
| League(Reflection, Transient) | ^5.1 | 717ms, 258µs, 858ns | 702ms, 457µs, 904ns | 735ms, 303µs, 878ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 856µs, 659ns | 2ms, 779µs, 960ns | 3ms, 210µs, 67ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 836µs, 797ns | 4ms, 750µs, 13ns | 4ms, 987µs, 955ns |
| Phalcon(Configured, Transient) | ^5 | 262ms, 273µs, 97ns | 172ms, 306µs, 60ns | 295ms, 8µs, 897ns |
| Php-baseline |  | 492µs, 453ns | 349µs, 998ns | 679µs, 16ns |
| Php-di(Reflection, Singleton) | ^7.0 | 854µs, 110ns | 808µs | 1ms, 213µs, 73ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 283µs, 812ns | 1ms, 255µs, 989ns | 1ms, 321µs, 77ns |
| Pimple(Configured, Transient) | ^3.5 | 97ms, 769µs, 45ns | 94ms, 187µs, 21ns | 105ms, 817µs, 79ns |
| Quickly(Compiled, Singleton) | dev-master | 811µs, 28ns | 799µs, 894ns | 822µs, 782ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 413µs, 536ns | 1ms, 363µs, 992ns | 1ms, 476µs, 49ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 382µs, 88ns | 1ms, 336µs, 97ns | 1ms, 454µs, 830ns |
| Ray-di(Compiled, Transient) | ^2.16 | 2s, 977ms, 904µs, 796ns | 1s, 354ms, 19µs, 880ns | 4s, 75ms, 855µs, 970ns |
| Ray-di(Reflection, Transient) | ^2.16 | 277ms, 742µs, 815ns | 158ms, 828µs, 973ns | 329ms, 997µs, 62ns |
| Symfony(Compiled, Singleton) | ^7.0 | 751µs, 709ns | 741µs, 4ns | 787µs, 19ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 840µs, 44ns | 786µs, 66ns | 1ms, 134µs, 157ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 887µs, 608ns | 813µs, 7ns | 1ms, 381µs, 158ns |
| Zen(Compiled, Singleton) | ^3.1 | 787µs, 234ns | 706µs, 911ns | 1ms, 401µs, 901ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 7µs, 269ns | 1ms, 704µs, 931ns | 3ms, 186µs, 941ns |
| Auryn(Reflection, Transient) | ^1.4 | 393ms, 158µs, 531ns | 315ms, 281µs, 867ns | 414ms, 127µs, 111ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 811µs, 218ns | 1ms, 445µs, 55ns | 2ms, 365µs, 112ns |
| Dice(Reflection, Transient) | ^4.0 | 74ms, 831µs, 676ns | 73ms, 832µs, 988ns | 76ms, 400µs, 995ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 3µs, 122ns | 833µs, 34ns | 2ms, 73µs, 49ns |
| Laravel(Configured, Transient) | ^12.28 | 403ms, 117µs, 752ns | 315ms, 618µs, 38ns | 416ms, 236µs, 162ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 131µs, 937ns | 2ms, 336µs, 25ns | 4ms, 856µs, 109ns |
| Laravel(Reflection, Transient) | ^12.28 | 486ms, 477µs, 565ns | 374ms, 466µs, 896ns | 596ms, 961µs, 21ns |
| League(Configured, Transient) | ^5.1 | 1s, 91ms, 821µs, 956ns | 859ms, 769µs, 821ns | 1s, 196ms, 822µs, 881ns |
| League(Reflection, Transient) | ^5.1 | 657ms, 74µs, 880ns | 406ms, 477µs, 928ns | 719ms, 12µs, 22ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 583µs, 168ns | 3ms, 473µs, 43ns | 3ms, 999µs, 948ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 602µs, 575ns | 4ms, 157µs, 781ns | 5ms, 59µs, 3ns |
| Phalcon(Configured, Transient) | ^5 | 277ms, 947µs, 688ns | 243ms, 762µs, 16ns | 296ms, 221µs, 971ns |
| Php-baseline |  | 567µs, 579ns | 552µs, 892ns | 587µs, 940ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 711µs, 583ns | 1ms, 27µs, 822ns | 5ms, 259µs, 37ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 362µs, 991ns | 1ms, 295µs, 89ns | 1ms, 579µs, 999ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 818µs, 968ns | 97ms, 129µs, 821ns | 104ms, 107µs, 856ns |
| Quickly(Compiled, Singleton) | dev-master | 842µs, 618ns | 782µs, 12ns | 1ms, 7µs, 80ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 176µs, 94ns | 2ms, 38µs, 955ns | 2ms, 892µs, 971ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 510µs, 381ns | 1ms, 370µs, 906ns | 2ms, 243µs, 41ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 328ms, 313µs, 684ns | 3s, 212ms, 368µs, 965ns | 3s, 466ms, 519µs, 832ns |
| Ray-di(Reflection, Transient) | ^2.16 | 301ms, 812µs, 5ns | 296ms, 332µs, 120ns | 313ms, 252µs, 925ns |
| Symfony(Compiled, Singleton) | ^7.0 | 406µs, 789ns | 392µs, 913ns | 434µs, 875ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 366µs, 853ns | 968µs, 933ns | 4ms, 666µs, 90ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 74µs, 218ns | 858µs, 68ns | 2ms, 863µs, 883ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 89µs, 406ns | 850µs, 200ns | 2ms, 946µs, 138ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 612µs, 91ns | 1ms, 539µs, 945ns | 1ms, 703µs, 23ns |
| Dice(Configured, Singleton) | ^4.0 | 835µs, 204ns | 804µs, 901ns | 856µs, 876ns |
| Laravel(Configured, Transient) | ^12.28 | 354ms, 658µs, 961ns | 290ms, 739µs, 59ns | 405ms, 400µs, 991ns |
| League(Configured, Transient) | ^5.1 | 8s, 812ms, 676µs, 119ns | 7s, 151ms, 990µs, 890ns | 9s, 786ms, 112µs, 70ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 48µs, 895ns | 3ms, 991µs, 842ns | 4ms, 416µs, 942ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 105µs, 972ns | 4ms, 270µs, 76ns | 7ms, 668µs, 18ns |
| Phalcon(Configured, Transient) | ^5 | 253ms, 452µs, 920ns | 206ms, 732µs, 988ns | 290ms, 338µs, 993ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 289µs, 224ns | 1ms, 260µs, 995ns | 1ms, 329µs, 898ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 85µs, 780ns | 100ms, 827µs, 932ns | 110ms, 891µs, 103ns |
| Quickly(Compiled, Singleton) | dev-master | 827µs, 765ns | 809µs, 907ns | 854µs, 969ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 891µs, 348ns | 3ms, 819µs, 227ns | 4ms, 54µs, 69ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 45ms, 205µs, 92ns | 1s, 901ms, 859µs, 998ns | 3s, 510ms, 145µs, 902ns |
| Symfony(Compiled, Singleton) | ^7.0 | 770µs, 139ns | 750µs, 64ns | 816µs, 106ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 859µs, 594ns | 802µs, 993ns | 1ms, 158µs, 952ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 897µs, 693ns | 813µs, 961ns | 1ms, 548µs, 51ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 29µs, 920ns | 815µs, 868ns | 2ms, 367µs, 19ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 9µs, 773ns | 1ms, 681µs, 804ns | 3ms, 165µs, 960ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 21µs, 288ns | 1ms, 828µs, 908ns | 2ms, 444µs, 982ns |
| Laravel(Configured, Transient) | ^12.28 | 368ms, 547µs, 391ns | 217ms, 870µs, 950ns | 406ms, 64µs, 987ns |
| League(Configured, Transient) | ^5.1 | 8s, 928ms, 170µs, 13ns | 5s, 664ms, 211µs, 34ns | 9s, 640ms, 950µs, 918ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 96µs, 412ns | 4ms, 43µs, 102ns | 4ms, 441µs, 976ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 945µs, 87ns | 4ms, 792µs, 928ns | 5ms, 110µs, 979ns |
| Phalcon(Configured, Transient) | ^5 | 254ms, 150µs, 128ns | 200ms, 888µs, 872ns | 291ms, 917µs, 85ns |
| Pimple(Configured, Singleton) | ^3.5 | 919µs, 318ns | 854µs, 15ns | 1ms, 118µs, 898ns |
| Pimple(Configured, Transient) | ^3.5 | 88ms, 906µs, 526ns | 72ms, 546µs, 5ns | 105ms, 715µs, 36ns |
| Quickly(Compiled, Singleton) | dev-master | 466µs, 609ns | 447µs, 988ns | 482µs, 82ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 594µs, 397ns | 4ms, 435µs, 777ns | 5ms, 296µs, 945ns |
| Ray-di(Compiled, Transient) | ^2.16 | 2s, 972ms, 430µs, 610ns | 1s, 908ms, 100µs, 128ns | 3s, 545ms, 336µs, 8ns |
| Symfony(Compiled, Singleton) | ^7.0 | 754µs, 594ns | 715µs, 17ns | 878µs, 95ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 147µs, 675ns | 926µs, 17ns | 2ms, 983µs, 808ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 131µs, 916ns | 880µs, 2ns | 3ms, 198µs, 146ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 124µs, 620ns | 870µs, 943ns | 2ms, 972µs, 126ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 647µs, 611ns | 4ms, 96µs, 31ns | 10ms, 102µs, 33ns |
| Dice(Configured, Singleton) | ^4.0 | 826µs, 883ns | 473µs, 22ns | 936µs, 31ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 884ms, 689µs, 521ns | 7s, 767ms, 803µs, 907ns | 10s, 701ms, 115µs, 131ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 841µs, 999ns | 799µs, 179ns | 926µs, 971ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 943µs, 228ns | 2ms, 557µs, 992ns | 6ms, 873µs, 130ns |
| Laravel(Reflection, Transient) | ^12.28 | 77s, 829ms, 679µs, 799ns | 62s, 592ms, 791µs, 80ns | 82s, 846ms, 802µs, 949ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 657µs, 579ns | 3ms, 408µs, 908ns | 4ms, 230µs, 22ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 424µs, 691ns | 2ms, 817µs, 153ns | 4ms, 973µs, 888ns |
| Php-baseline |  | 635µs, 647ns | 404µs, 119ns | 884µs, 56ns |
| Php-di(Reflection, Singleton) | ^7.0 | 837µs, 969ns | 774µs, 860ns | 1ms, 220µs, 941ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 704µs, 883ns | 1ms, 241µs, 922ns | 1ms, 935µs, 5ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 687ms, 144µs, 684ns | 10s, 903ms, 604µs, 30ns | 14s, 278ms, 264µs, 45ns |
| Quickly(Compiled, Singleton) | dev-master | 881µs, 195ns | 849µs, 8ns | 910µs, 43ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 312µs, 518ns | 1ms, 277µs, 923ns | 1ms, 361µs, 131ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 350µs, 450ns | 1ms, 309µs, 156ns | 1ms, 477µs, 3ns |
| Symfony(Compiled, Singleton) | ^7.0 | 764µs, 298ns | 744µs, 104ns | 797µs, 986ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 629µs, 782ns | 571µs, 12ns | 910µs, 43ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 669µs, 765ns | 612µs, 974ns | 1ms, 88µs, 857ns |
| Zen(Compiled, Singleton) | ^3.1 | 886µs, 774ns | 778µs, 913ns | 1ms, 570µs, 940ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 469µs, 202ns | 4ms, 601µs, 955ns | 6ms, 978µs, 988ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 371µs, 501ns | 1ms, 742µs, 124ns | 2ms, 509µs, 117ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 474ms, 599µs, 361ns | 5s, 995ms, 250µs, 940ns | 10s, 488ms, 3µs, 15ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 22µs, 195ns | 878µs, 95ns | 2ms, 95µs, 937ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 901µs, 409ns | 4ms, 82µs, 918ns | 5ms, 120µs, 38ns |
| Laravel(Reflection, Transient) | ^12.28 | 80s, 781ms, 257µs, 271ns | 68s, 108ms, 739µs, 852ns | 83s, 955ms, 49µs, 991ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 156µs, 495ns | 3ms, 93µs, 4ns | 3ms, 587µs, 961ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 421µs, 233ns | 4ms, 584µs, 789ns | 8ms, 629µs, 83ns |
| Php-baseline |  | 652µs, 551ns | 459µs, 909ns | 910µs, 997ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 156µs, 520ns | 901µs, 937ns | 3ms, 288µs, 984ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 416µs, 921ns | 1ms, 368µs, 999ns | 1ms, 635µs, 74ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 118ms, 134µs, 760ns | 13s, 717ms, 51µs, 982ns | 14s, 262ms, 387µs, 990ns |
| Quickly(Compiled, Singleton) | dev-master | 869µs, 488ns | 764µs, 846ns | 998µs, 20ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 361µs, 823ns | 1ms, 246µs, 929ns | 2ms, 47µs, 61ns |
| Quickly(Reflection, Singleton) | dev-master | 2ms, 61µs, 486ns | 1ms, 375µs, 913ns | 3ms, 638µs, 29ns |
| Symfony(Compiled, Singleton) | ^7.0 | 575µs, 518ns | 547µs, 885ns | 624µs, 179ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 180µs, 553ns | 933µs, 885ns | 3ms, 56µs, 49ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 645µs, 303ns | 499µs, 10ns | 1ms, 755µs, 952ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 90µs, 407ns | 849µs, 962ns | 2ms, 945µs, 184ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 765µs, 322ns | 1ms, 392µs, 841ns | 1ms, 921µs, 892ns |
| Dice(Configured, Singleton) | ^4.0 | 888µs, 419ns | 691µs, 890ns | 1ms, 28µs, 60ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 42µs, 243ns | 3ms, 962µs, 39ns | 4ms, 513µs, 25ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 479µs, 670ns | 3ms, 387µs, 928ns | 6ms, 623µs, 983ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 313µs, 996ns | 1ms, 271µs, 963ns | 1ms, 379µs, 966ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 75ms, 826µs, 525ns | 9s, 876ms, 381µs, 158ns | 14s, 307ms, 428µs, 836ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 754ns | 796µs, 79ns | 899µs, 76ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 270µs, 792ns | 4ms, 141µs, 92ns | 4ms, 427µs, 909ns |
| Symfony(Compiled, Singleton) | ^7.0 | 558µs, 66ns | 526µs, 189ns | 656µs, 127ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 867µs, 986ns | 807µs, 46ns | 1ms, 226µs, 902ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 967µs, 407ns | 790µs, 119ns | 1ms, 703µs, 977ns |
| Zen(Compiled, Singleton) | ^3.1 | 500µs, 82ns | 427µs, 961ns | 964µs, 879ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 189µs, 849ns | 2ms, 79µs, 10ns | 3ms, 565µs, 788ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 310µs, 395ns | 1ms, 353µs, 25ns | 2ms, 709µs, 150ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 96µs, 31ns | 3ms, 917µs, 932ns | 4ms, 873µs, 991ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 945µs, 15ns | 2ms, 981µs, 185ns | 6ms, 156µs, 921ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 396µs, 489ns | 1ms, 347µs, 64ns | 1ms, 658µs, 201ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 50ms, 471µs, 138ns | 13s, 389ms, 558µs, 76ns | 14s, 322ms, 342µs, 157ns |
| Quickly(Compiled, Singleton) | dev-master | 808µs, 215ns | 786µs, 66ns | 839µs, 948ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 747µs, 178ns | 2ms, 636µs, 909ns | 3ms, 275µs, 871ns |
| Symfony(Compiled, Singleton) | ^7.0 | 787µs, 210ns | 766µs, 38ns | 828µs, 981ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 258µs, 873ns | 1ms, 24µs, 7ns | 3ms, 115µs, 892ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 130µs, 8ns | 903µs, 129ns | 3ms, 19µs, 94ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 52µs, 21ns | 830µs, 888ns | 2ms, 802µs, 133ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 834µs, 155ns | 788µs, 927ns | 988µs, 960ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 482µs, 508ns | 3ms, 371µs, 953ns | 3ms, 822µs, 88ns |
| Php-di(Reflection, Singleton) | ^7.0 | 724µs, 172ns | 670µs, 909ns | 1ms, 105µs, 70ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 353µs, 502ns | 1ms, 252µs, 174ns | 1ms, 974µs, 821ns |
| Quickly(Compiled, Singleton) | dev-master | 958µs, 299ns | 777µs, 959ns | 1ms, 135µs, 110ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 369µs, 118ns | 1ms, 321µs, 77ns | 1ms, 465µs, 82ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 368µs, 284ns | 1ms, 311µs, 63ns | 1ms, 605µs, 33ns |
| Symfony(Compiled, Singleton) | ^7.0 | 829µs, 76ns | 798µs, 940ns | 931µs, 24ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 873µs, 327ns | 787µs, 973ns | 1ms, 251µs, 935ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 868µs, 320ns | 769µs, 138ns | 1ms, 530µs, 885ns |
| Zen(Compiled, Singleton) | ^3.1 | 916µs, 99ns | 756µs, 25ns | 1ms, 579µs, 999ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 669µs, 479ns | 557µs, 899ns | 1ms, 462µs, 936ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 597µs, 831ns | 3ms, 498µs, 77ns | 3ms, 930µs, 91ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 215µs, 481ns | 943µs, 183ns | 3ms, 417µs, 968ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 421µs, 904ns | 1ms, 358µs, 985ns | 1ms, 660µs, 108ns |
| Quickly(Compiled, Singleton) | dev-master | 840µs, 377ns | 819µs, 921ns | 864µs, 982ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 189µs, 850ns | 2ms, 66µs, 850ns | 2ms, 934µs, 932ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 589µs, 560ns | 1ms, 478µs, 910ns | 2ms, 336µs, 25ns |
| Symfony(Compiled, Singleton) | ^7.0 | 852µs, 894ns | 819µs, 921ns | 886µs, 201ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 775µs, 27ns | 596µs, 46ns | 2ms, 123µs, 117ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 215µs, 696ns | 998µs, 20ns | 3ms, 53µs, 903ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 173µs, 377ns | 944µs, 852ns | 2ms, 974µs, 33ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 935µs, 718ns | 3ms, 833µs, 55ns | 4ms, 333µs, 19ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 316µs, 642ns | 1ms, 283µs, 884ns | 1ms, 384µs, 973ns |
| Quickly(Compiled, Singleton) | dev-master | 821µs, 328ns | 793µs, 933ns | 885µs, 963ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 871µs, 107ns | 3ms, 821µs, 134ns | 3ms, 989µs, 934ns |
| Symfony(Compiled, Singleton) | ^7.0 | 808µs, 477ns | 765µs, 85ns | 900µs, 983ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 864µs, 934ns | 767µs, 946ns | 1ms, 278µs, 162ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 969µs, 314ns | 803µs, 947ns | 1ms, 667µs, 976ns |
| Zen(Compiled, Singleton) | ^3.1 | 892µs, 663ns | 771µs, 45ns | 1ms, 633µs, 882ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 124µs, 402ns | 3ms, 952µs, 26ns | 4ms, 786µs, 968ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 417µs, 756ns | 1ms, 368µs, 999ns | 1ms, 663µs, 208ns |
| Quickly(Compiled, Singleton) | dev-master | 394µs, 177ns | 379µs, 800ns | 432µs, 968ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 795µs, 265ns | 4ms, 619µs, 836ns | 5ms, 470µs, 991ns |
| Symfony(Compiled, Singleton) | ^7.0 | 822µs, 925ns | 801µs, 86ns | 885µs, 9ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 197µs, 171ns | 960µs, 826ns | 3ms, 93µs, 957ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 224µs, 517ns | 979µs, 900ns | 3ms, 121µs, 137ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 250µs, 648ns | 1ms, 24µs, 7ns | 3ms, 123µs, 998ns |

</details>

Questions, issues, and new containers are welcome!
