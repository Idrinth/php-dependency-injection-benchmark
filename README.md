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

Run from 2026-06-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 616µs, 811ns | 1ms, 566µs, 171ns | 1ms, 750µs, 946ns |
| Auryn(Reflection, Transient) | ^1.4 | 400ms, 573µs, 492ns | 392ms, 615µs, 795ns | 411ms, 19µs, 86ns |
| Dice(Configured, Singleton) | ^4.0 | 835µs, 490ns | 809µs, 907ns | 874µs, 996ns |
| Dice(Reflection, Transient) | ^4.0 | 64ms, 361µs, 786ns | 53ms, 6µs, 887ns | 74ms, 628µs, 829ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 228µs, 380ns | 1ms, 191µs, 139ns | 1ms, 353µs, 979ns |
| Laravel(Configured, Transient) | ^12.28 | 384ms, 718µs, 561ns | 319ms, 365µs, 978ns | 416ms, 326µs, 999ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 559µs, 112ns | 3ms, 396µs, 34ns | 3ms, 893µs, 136ns |
| Laravel(Reflection, Transient) | ^12.28 | 576ms, 712µs, 608ns | 570ms, 544µs, 4ns | 582ms, 659µs, 6ns |
| League(Configured, Transient) | ^5.1 | 1s, 136ms, 388µs, 87ns | 964ms, 411µs, 973ns | 1s, 206ms, 100µs, 940ns |
| League(Reflection, Transient) | ^5.1 | 672ms, 534µs, 942ns | 546ms, 418µs, 905ns | 723ms, 481µs, 893ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 143µs, 429ns | 3ms, 77µs, 983ns | 3ms, 557µs, 920ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 159µs, 901ns | 5ms, 252µs, 838ns | 10ms, 777µs, 950ns |
| Phalcon(Configured, Transient) | ^5 | 331ms, 41µs, 765ns | 305ms, 960µs, 893ns | 345ms, 837µs, 831ns |
| Php-baseline |  | 596µs, 189ns | 550µs, 985ns | 639µs, 915ns |
| Php-di(Reflection, Singleton) | ^7.0 | 899µs, 100ns | 848µs, 54ns | 1ms, 197µs, 814ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 266µs, 336ns | 1ms, 240µs, 968ns | 1ms, 295µs, 89ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 418µs, 734ns | 96ms, 436µs, 23ns | 110ms, 900µs, 163ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 165ns | 799µs, 894ns | 1ms, 153µs, 945ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 351µs, 666ns | 1ms, 332µs, 998ns | 1ms, 420µs, 21ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 382µs, 708ns | 1ms, 341µs, 104ns | 1ms, 525µs, 163ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 383ms, 548µs, 116ns | 2s, 16ms, 33µs, 887ns | 3s, 923ms, 342µs, 943ns |
| Ray-di(Reflection, Transient) | ^2.16 | 393ms, 315µs, 672ns | 352ms, 550µs, 983ns | 416ms, 901µs, 111ns |
| Symfony(Compiled, Singleton) | ^7.0 | 604µs, 701ns | 592µs, 947ns | 631µs, 93ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 832µs, 605ns | 780µs, 105ns | 1ms, 111µs, 984ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 858µs, 879ns | 773µs, 191ns | 1ms, 388µs, 72ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 53µs, 309ns | 940µs, 84ns | 1ms, 940µs, 965ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 120µs, 590ns | 1ms, 707µs, 792ns | 3ms, 273µs, 963ns |
| Auryn(Reflection, Transient) | ^1.4 | 393ms, 725µs, 538ns | 319ms, 235µs, 86ns | 419ms, 218µs, 63ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 665µs, 115ns | 1ms, 373µs, 52ns | 2ms, 173µs, 185ns |
| Dice(Reflection, Transient) | ^4.0 | 66ms, 126µs, 847ns | 62ms, 986µs, 850ns | 68ms, 928µs, 956ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 946µs, 402ns | 802µs, 40ns | 2ms, 30µs, 849ns |
| Laravel(Configured, Transient) | ^12.28 | 391ms, 764µs, 664ns | 310ms, 783µs, 863ns | 414ms, 270µs, 877ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 790µs, 807ns | 3ms, 458µs, 23ns | 5ms, 17µs, 995ns |
| Laravel(Reflection, Transient) | ^12.28 | 431ms, 183µs, 433ns | 288ms, 985µs, 967ns | 573ms, 48µs, 114ns |
| League(Configured, Transient) | ^5.1 | 1s, 101ms, 456µs, 332ns | 873ms, 87µs, 882ns | 1s, 166ms, 13µs, 956ns |
| League(Reflection, Transient) | ^5.1 | 677ms, 4µs, 146ns | 597ms, 636µs, 938ns | 715ms, 315µs, 818ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 919µs, 506ns | 3ms, 138µs, 65ns | 5ms, 798µs, 816ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 911µs, 755ns | 5ms, 815µs, 982ns | 6ms, 98µs, 985ns |
| Phalcon(Configured, Transient) | ^5 | 322ms, 630µs, 405ns | 253ms, 768µs, 920ns | 360ms, 663µs, 890ns |
| Php-baseline |  | 714µs, 468ns | 529µs, 766ns | 880µs, 2ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 151µs, 776ns | 884µs, 56ns | 3ms, 355µs, 979ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 349µs, 711ns | 1ms, 250µs, 982ns | 1ms, 530µs, 170ns |
| Pimple(Configured, Transient) | ^3.5 | 97ms, 323µs, 989ns | 96ms, 19µs, 29ns | 99ms, 295µs, 139ns |
| Quickly(Compiled, Singleton) | dev-master | 798µs, 726ns | 777µs, 959ns | 835µs, 895ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 179µs, 169ns | 2ms, 27µs, 34ns | 2ms, 955µs, 913ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 893µs, 949ns | 1ms, 378µs, 59ns | 3ms, 105µs, 878ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 350ms, 208µs, 806ns | 2s, 24ms, 775µs, 981ns | 3s, 920ms, 755µs, 147ns |
| Ray-di(Reflection, Transient) | ^2.16 | 403ms, 338µs, 289ns | 351ms, 920µs, 127ns | 432ms, 856µs, 798ns |
| Symfony(Compiled, Singleton) | ^7.0 | 745µs, 916ns | 720µs, 977ns | 798µs, 940ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 174µs, 473ns | 948µs, 905ns | 3ms, 83µs, 944ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 87µs, 93ns | 869µs, 989ns | 2ms, 854µs, 108ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 117µs, 682ns | 889µs, 62ns | 3ms, 17µs, 187ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 662µs, 611ns | 1ms, 585µs, 6ns | 1ms, 754µs, 999ns |
| Dice(Configured, Singleton) | ^4.0 | 856µs, 995ns | 823µs, 20ns | 1ms, 13µs, 40ns |
| Laravel(Configured, Transient) | ^12.28 | 369ms, 173µs, 216ns | 290ms, 914µs, 58ns | 386ms, 581µs, 182ns |
| League(Configured, Transient) | ^5.1 | 9s, 284ms, 309µs, 411ns | 9s, 166ms, 346µs, 73ns | 9s, 525ms, 106µs, 906ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 899µs, 3ns | 2ms, 731µs, 84ns | 3ms, 890µs, 991ns |
| Phalcon(Configured, Singleton) | ^5 | 7ms, 55µs, 759ns | 5ms, 426µs, 883ns | 11ms, 271µs, 953ns |
| Phalcon(Configured, Transient) | ^5 | 332ms, 196µs, 688ns | 305ms, 241µs, 107ns | 348ms, 702µs, 907ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 221µs, 585ns | 1ms, 202µs, 106ns | 1ms, 250µs, 982ns |
| Pimple(Configured, Transient) | ^3.5 | 91ms, 298µs, 294ns | 76ms, 925µs, 992ns | 110ms, 440µs, 15ns |
| Quickly(Compiled, Singleton) | dev-master | 706µs, 338ns | 684µs, 22ns | 731µs, 945ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 85µs, 206ns | 3ms, 361µs, 940ns | 7ms, 9µs, 983ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 860ms, 487µs, 484ns | 3s, 632ms, 724µs, 46ns | 3s, 989ms, 825µs, 10ns |
| Symfony(Compiled, Singleton) | ^7.0 | 808µs, 119ns | 756µs, 25ns | 984µs, 907ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 859µs, 165ns | 816µs, 106ns | 1ms, 134µs, 157ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 870µs, 609ns | 794µs, 887ns | 1ms, 440µs, 48ns |
| Zen(Compiled, Singleton) | ^3.1 | 933µs, 337ns | 785µs, 827ns | 1ms, 518µs, 964ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 966µs, 285ns | 1ms, 626µs, 14ns | 3ms, 210µs, 67ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 905µs, 703ns | 1ms, 767µs, 873ns | 2ms, 255µs, 916ns |
| Laravel(Configured, Transient) | ^12.28 | 380ms, 66µs, 609ns | 373ms, 806µs, 953ns | 389ms, 364µs, 957ns |
| League(Configured, Transient) | ^5.1 | 9s, 75ms, 727µs, 796ns | 7s, 196ms, 548µs, 938ns | 9s, 433ms, 701µs, 38ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 923µs, 487ns | 3ms, 857µs, 851ns | 4ms, 296µs, 64ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 258µs, 726ns | 5ms, 939µs, 6ns | 6ms, 730µs, 79ns |
| Phalcon(Configured, Transient) | ^5 | 325ms, 869µs, 369ns | 255ms, 136µs, 13ns | 352ms, 667µs, 93ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 326µs, 751ns | 1ms, 289µs, 129ns | 1ms, 557µs, 826ns |
| Pimple(Configured, Transient) | ^3.5 | 97ms, 991µs, 347ns | 92ms, 329µs, 25ns | 101ms, 212µs, 978ns |
| Quickly(Compiled, Singleton) | dev-master | 799µs, 703ns | 780µs, 105ns | 813µs, 961ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 637µs, 193ns | 4ms, 500µs, 865ns | 5ms, 316µs, 19ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 506ms, 623µs, 53ns | 2s, 30ms, 970µs, 96ns | 3s, 957ms, 987µs, 785ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 219µs, 630ns | 1ms, 178µs, 979ns | 1ms, 287µs, 937ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 125µs, 49ns | 901µs, 937ns | 2ms, 979µs, 993ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 122µs, 665ns | 885µs, 9ns | 2ms, 972µs, 841ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 8µs, 963ns | 782µs, 966ns | 2ms, 822µs, 875ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 345µs, 677ns | 5ms, 249µs, 23ns | 10ms, 417µs, 938ns |
| Dice(Configured, Singleton) | ^4.0 | 823µs, 283ns | 406µs, 26ns | 982µs, 999ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 91ms, 209µs, 816ns | 8s, 807ms, 928µs, 85ns | 10s, 436ms, 897µs, 39ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 813µs, 293ns | 781µs, 59ns | 903µs, 844ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 661µs, 990ns | 3ms, 17µs, 187ns | 3ms, 941µs, 59ns |
| Laravel(Reflection, Transient) | ^12.28 | 79s, 529ms, 282ns | 67s, 915ms, 922µs, 164ns | 81s, 829ms, 199µs, 75ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 207µs, 492ns | 3ms, 132µs, 104ns | 3ms, 695µs, 11ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 801µs, 105ns | 4ms, 409µs, 74ns | 6ms, 365µs, 60ns |
| Php-baseline |  | 550µs, 198ns | 463µs, 962ns | 674µs, 9ns |
| Php-di(Reflection, Singleton) | ^7.0 | 872µs, 802ns | 811µs, 815ns | 1ms, 250µs, 982ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 288µs, 104ns | 1ms, 243µs, 114ns | 1ms, 353µs, 25ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 683ms, 207µs, 869ns | 13s, 331ms, 12µs, 964ns | 14s, 235ms, 455µs, 36ns |
| Quickly(Compiled, Singleton) | dev-master | 785µs, 493ns | 776µs, 52ns | 796µs, 79ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 378µs, 822ns | 1ms, 360µs, 893ns | 1ms, 442µs, 909ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 377µs, 415ns | 1ms, 343µs, 11ns | 1ms, 503µs, 944ns |
| Symfony(Compiled, Singleton) | ^7.0 | 813µs, 102ns | 765µs, 85ns | 937µs, 938ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 220µs, 774ns | 1ms, 116µs, 991ns | 1ms, 834µs, 869ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 899µs, 624ns | 826µs, 120ns | 1ms, 392µs, 841ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 35µs, 22ns | 730µs, 37ns | 2ms, 93µs, 76ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 197µs, 666ns | 5ms, 282µs, 878ns | 12ms, 392µs, 997ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 397µs, 918ns | 1ms, 969µs, 99ns | 3ms, 412µs, 961ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 869ms, 709µs, 920ns | 8s, 780ms, 282µs, 20ns | 10s, 377ms, 799µs, 34ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 12µs, 86ns | 850µs, 915ns | 2ms, 62µs, 82ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 653µs, 239ns | 3ms, 883µs, 123ns | 5ms, 266µs, 904ns |
| Laravel(Reflection, Transient) | ^12.28 | 77s, 801ms, 794µs, 505ns | 62s, 450ms, 52µs, 976ns | 82s, 309ms, 113µs, 25ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 471µs, 279ns | 3ms, 393µs, 173ns | 3ms, 823µs, 995ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 459µs, 522ns | 5ms, 990µs, 982ns | 7ms, 244µs, 110ns |
| Php-baseline |  | 624µs, 12ns | 458µs, 2ns | 761µs, 985ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 126µs, 384ns | 871µs, 896ns | 3ms, 216µs, 981ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 379µs, 799ns | 1ms, 322µs, 984ns | 1ms, 625µs, 61ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 237ms, 790µs, 60ns | 10s, 414ms, 908µs, 885ns | 14s, 11ms, 433µs, 124ns |
| Quickly(Compiled, Singleton) | dev-master | 788µs, 497ns | 762µs, 939ns | 828µs, 981ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 250µs, 647ns | 2ms, 69µs, 950ns | 2ms, 956µs, 867ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 157µs, 808ns | 1ms, 80µs, 36ns | 1ms, 802µs, 921ns |
| Symfony(Compiled, Singleton) | ^7.0 | 717µs, 186ns | 692µs, 844ns | 777µs, 959ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 187µs, 586ns | 957µs, 12ns | 3ms, 37µs, 929ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 109µs, 4ns | 885µs, 963ns | 2ms, 907µs, 991ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 397µs, 919ns | 1ms, 75µs, 29ns | 4ms, 183µs, 53ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 684µs, 45ns | 906µs, 229ns | 1ms, 847µs, 28ns |
| Dice(Configured, Singleton) | ^4.0 | 865µs, 960ns | 751µs, 18ns | 926µs, 17ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 951µs, 501ns | 3ms, 778µs, 934ns | 4ms, 673µs, 957ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 761µs, 2ns | 5ms, 585µs, 908ns | 10ms, 748µs, 147ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 271µs, 224ns | 1ms, 234µs, 54ns | 1ms, 309µs, 871ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 488ms, 405µs, 132ns | 10s, 824ms, 339µs, 151ns | 14s, 476ms, 605µs, 176ns |
| Quickly(Compiled, Singleton) | dev-master | 808µs, 48ns | 748µs, 872ns | 953µs, 912ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 761µs, 911ns | 3ms, 576µs, 993ns | 3ms, 973µs, 960ns |
| Symfony(Compiled, Singleton) | ^7.0 | 766µs, 444ns | 713µs, 109ns | 910µs, 997ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 876µs, 712ns | 818µs, 967ns | 1ms, 203µs, 60ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 705µs, 909ns | 634µs, 908ns | 1ms, 250µs, 28ns |
| Zen(Compiled, Singleton) | ^3.1 | 674µs, 867ns | 602µs, 960ns | 1ms, 181µs, 840ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 283µs, 143ns | 3ms, 202µs, 915ns | 3ms, 516µs, 912ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 393µs, 341ns | 1ms, 731µs, 872ns | 3ms, 384µs, 828ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 603µs, 243ns | 3ms, 524µs, 65ns | 3ms, 988µs, 981ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 807µs, 804ns | 5ms, 938µs, 53ns | 11ms, 228µs, 799ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 373µs, 4ns | 1ms, 302µs, 3ns | 1ms, 688µs, 957ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 559ms, 1µs, 421ns | 12s, 797ms, 523µs, 975ns | 14s, 248ms, 842µs, 954ns |
| Quickly(Compiled, Singleton) | dev-master | 798µs, 273ns | 778µs, 913ns | 825µs, 881ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 716µs, 205ns | 4ms, 580µs, 20ns | 5ms, 479µs, 97ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 13µs, 398ns | 967µs, 979ns | 1ms, 73µs, 837ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 199µs, 388ns | 948µs, 905ns | 3ms, 185µs, 987ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 114µs, 988ns | 895µs, 977ns | 2ms, 966µs, 880ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 16µs, 426ns | 801µs, 801ns | 2ms, 765µs, 893ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 818µs, 872ns | 782µs, 966ns | 968µs, 933ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 544µs, 282ns | 3ms, 402µs, 948ns | 4ms, 125µs, 833ns |
| Php-di(Reflection, Singleton) | ^7.0 | 882µs, 911ns | 815µs, 153ns | 1ms, 338µs, 958ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 212µs, 787ns | 1ms, 194µs | 1ms, 229µs, 47ns |
| Quickly(Compiled, Singleton) | dev-master | 845µs, 146ns | 764µs, 131ns | 1ms, 12µs, 86ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 344µs, 895ns | 1ms, 316µs, 70ns | 1ms, 416µs, 921ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 372µs, 861ns | 1ms, 330µs, 137ns | 1ms, 597µs, 881ns |
| Symfony(Compiled, Singleton) | ^7.0 | 793µs, 218ns | 761µs, 32ns | 900µs, 983ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 890µs, 970ns | 827µs, 74ns | 1ms, 211µs, 881ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 690µs, 889ns | 619µs, 888ns | 1ms, 188µs, 993ns |
| Zen(Compiled, Singleton) | ^3.1 | 670µs, 242ns | 594µs, 854ns | 1ms, 223µs, 802ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 85µs, 305ns | 915µs, 50ns | 2ms, 166µs, 986ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 423µs, 357ns | 3ms, 341µs, 913ns | 3ms, 821µs, 849ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 422µs, 333ns | 981µs, 92ns | 3ms, 205µs, 60ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 69µs, 997ns | 2ms, 17µs, 974ns | 2ms, 396µs, 106ns |
| Quickly(Compiled, Singleton) | dev-master | 783µs, 252ns | 765µs, 85ns | 804µs, 901ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 195µs, 429ns | 2ms, 49µs, 207ns | 2ms, 968µs, 72ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 674µs, 461ns | 1ms, 553µs, 58ns | 2ms, 398µs, 967ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 120µs, 471ns | 1ms, 112µs, 937ns | 1ms, 140µs, 117ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 257µs, 514ns | 1ms, 21µs, 862ns | 3ms, 135µs, 919ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 153µs, 39ns | 925µs, 64ns | 2ms, 943µs, 38ns |
| Zen(Compiled, Singleton) | ^3.1 | 816µs, 893ns | 640µs, 869ns | 2ms, 171µs, 39ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 32µs, 182ns | 3ms, 850µs, 936ns | 4ms, 900µs, 932ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 221µs, 704ns | 1ms, 199µs, 960ns | 1ms, 251µs, 935ns |
| Quickly(Compiled, Singleton) | dev-master | 800µs, 323ns | 777µs, 6ns | 823µs, 974ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 20µs, 570ns | 3ms, 887µs, 891ns | 8ms, 35µs, 898ns |
| Symfony(Compiled, Singleton) | ^7.0 | 800µs, 371ns | 756µs, 978ns | 842µs, 809ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 327µs, 562ns | 1ms, 243µs, 829ns | 1ms, 964µs, 807ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 883µs, 197ns | 770µs, 92ns | 1ms, 641µs, 35ns |
| Zen(Compiled, Singleton) | ^3.1 | 919µs, 508ns | 818µs, 14ns | 1ms, 656µs, 55ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 908µs, 395ns | 3ms, 850µs, 936ns | 4ms, 252µs, 910ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 377µs, 797ns | 1ms, 314µs, 878ns | 1ms, 642µs, 942ns |
| Quickly(Compiled, Singleton) | dev-master | 838µs, 565ns | 815µs, 868ns | 860µs, 929ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 908µs, 727ns | 4ms, 533µs, 52ns | 8ms, 589µs, 29ns |
| Symfony(Compiled, Singleton) | ^7.0 | 829µs, 243ns | 797µs, 986ns | 955µs, 104ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 339µs, 530ns | 1ms, 881ns | 4ms, 272µs, 937ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 180µs, 863ns | 946µs, 998ns | 3ms, 94µs, 911ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 209µs, 831ns | 957µs, 12ns | 3ms, 159µs, 46ns |

</details>

Questions, issues, and new containers are welcome!
