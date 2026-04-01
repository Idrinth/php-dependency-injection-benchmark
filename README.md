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

Run from 2026-04-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 522µs, 302ns | 1ms, 360µs, 893ns | 1ms, 754µs, 999ns |
| Auryn(Reflection, Transient) | ^1.4 | 402ms, 519µs, 965ns | 386ms, 587µs, 858ns | 418ms, 501µs, 853ns |
| Dice(Configured, Singleton) | ^4.0 | 833µs, 225ns | 813µs, 961ns | 857µs, 114ns |
| Dice(Reflection, Transient) | ^4.0 | 69ms, 656µs, 944ns | 68ms, 463µs, 87ns | 71ms, 335µs, 77ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 809µs, 383ns | 773µs, 906ns | 912µs, 904ns |
| Laravel(Configured, Transient) | ^12.28 | 395ms, 978µs, 665ns | 350ms, 924µs, 968ns | 424ms, 548µs, 864ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 426µs, 146ns | 3ms, 343µs, 820ns | 3ms, 587µs, 961ns |
| Laravel(Reflection, Transient) | ^12.28 | 582ms, 982µs, 993ns | 573ms, 483µs, 943ns | 604ms, 246µs, 139ns |
| League(Configured, Transient) | ^5.1 | 1s, 136ms, 919µs, 403ns | 1s, 120ms, 108µs, 127ns | 1s, 163ms, 472µs, 890ns |
| League(Reflection, Transient) | ^5.1 | 702ms, 122µs, 68ns | 673ms, 951µs, 864ns | 734ms, 27µs, 147ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 748µs, 725ns | 3ms, 488µs, 63ns | 7ms, 138µs, 967ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 961µs, 920ns | 3ms, 865µs, 3ns | 4ms, 78µs, 865ns |
| Phalcon(Configured, Transient) | ^5 | 301ms, 199µs, 793ns | 294ms, 154µs, 882ns | 328ms, 372µs, 1ns |
| Php-baseline |  | 598µs, 788ns | 564µs, 813ns | 623µs, 226ns |
| Php-di(Reflection, Singleton) | ^7.0 | 898µs, 122ns | 797µs, 33ns | 1ms, 350µs, 164ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 234µs, 388ns | 1ms, 206µs, 159ns | 1ms, 281µs, 976ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 92µs, 30ns | 98ms, 284µs, 6ns | 101ms, 267µs, 99ns |
| Quickly(Compiled, Singleton) | dev-master | 764µs, 632ns | 738µs, 859ns | 866µs, 889ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 378µs, 11ns | 1ms, 345µs, 872ns | 1ms, 433µs, 134ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 386µs, 451ns | 1ms, 343µs, 965ns | 1ms, 505µs, 136ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 408ms, 475µs, 589ns | 2s, 45ms, 56µs, 104ns | 3s, 591ms, 979µs, 980ns |
| Ray-di(Reflection, Transient) | ^2.16 | 392ms, 403µs, 721ns | 384ms, 571µs, 75ns | 408ms, 864µs, 974ns |
| Symfony(Compiled, Singleton) | ^7.0 | 797µs, 700ns | 734µs, 806ns | 891µs, 208ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 837µs, 516ns | 787µs, 973ns | 1ms, 148µs, 939ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 987µs, 887ns | 782µs, 966ns | 1ms, 357µs, 78ns |
| Zen(Compiled, Singleton) | ^3.1 | 842µs, 881ns | 759µs, 124ns | 1ms, 436µs, 948ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 10µs, 583ns | 1ms, 688µs, 957ns | 3ms, 199µs, 815ns |
| Auryn(Reflection, Transient) | ^1.4 | 414ms, 112µs, 901ns | 395ms, 937µs, 204ns | 457ms, 897µs, 901ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 728µs, 820ns | 1ms, 444µs, 816ns | 2ms, 183µs, 914ns |
| Dice(Reflection, Transient) | ^4.0 | 74ms, 247µs, 741ns | 68ms, 966µs, 150ns | 96ms, 610µs, 69ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 932µs, 2ns | 792µs, 26ns | 1ms, 975µs, 59ns |
| Laravel(Configured, Transient) | ^12.28 | 399ms, 784µs, 326ns | 344ms, 182µs, 968ns | 423ms, 365µs, 116ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 796µs, 243ns | 3ms, 448µs, 9ns | 4ms, 942µs, 893ns |
| Laravel(Reflection, Transient) | ^12.28 | 577ms, 487µs, 63ns | 572ms, 893µs, 857ns | 581ms, 668µs, 853ns |
| League(Configured, Transient) | ^5.1 | 1s, 92ms, 994µs, 761ns | 958ms, 193µs, 778ns | 1s, 228ms, 534µs, 936ns |
| League(Reflection, Transient) | ^5.1 | 696ms, 326µs, 923ns | 600ms, 769µs, 42ns | 719ms, 569µs, 206ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 554µs, 272ns | 3ms, 464µs, 937ns | 3ms, 901µs, 4ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 74µs, 144ns | 4ms, 9µs, 962ns | 4ms, 131µs, 78ns |
| Phalcon(Configured, Transient) | ^5 | 290ms, 976µs, 691ns | 273ms, 251µs, 56ns | 299ms, 309µs, 968ns |
| Php-baseline |  | 603µs, 747ns | 584µs, 840ns | 627µs, 40ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 246µs, 595ns | 886µs, 917ns | 3ms, 386µs, 20ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 335µs, 287ns | 1ms, 295µs, 89ns | 1ms, 535µs, 892ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 786µs, 375ns | 99ms, 756µs, 2ns | 108ms, 39µs, 855ns |
| Quickly(Compiled, Singleton) | dev-master | 660µs, 777ns | 643µs, 968ns | 710µs, 964ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 195µs, 620ns | 2ms, 77µs, 102ns | 2ms, 943µs, 38ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 493µs, 144ns | 1ms, 394µs, 987ns | 2ms, 247µs, 95ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 249ms, 969µs, 482ns | 2s, 35ms, 54µs, 922ns | 3s, 625ms, 958µs, 919ns |
| Ray-di(Reflection, Transient) | ^2.16 | 394ms, 882µs, 130ns | 387ms, 900µs, 114ns | 406ms, 177µs, 43ns |
| Symfony(Compiled, Singleton) | ^7.0 | 779µs, 891ns | 736µs, 951ns | 812µs, 53ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 144µs, 671ns | 901µs, 937ns | 3ms, 10µs, 34ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 64µs, 896ns | 858µs, 68ns | 2ms, 815µs, 8ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 41µs, 7ns | 823µs, 974ns | 2ms, 837µs, 181ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 640µs, 33ns | 1ms, 582µs, 145ns | 1ms, 765µs, 966ns |
| Dice(Configured, Singleton) | ^4.0 | 846µs, 624ns | 818µs, 967ns | 941µs, 991ns |
| Laravel(Configured, Transient) | ^12.28 | 379ms, 493µs, 880ns | 339ms, 351µs, 892ns | 415ms, 746µs, 927ns |
| League(Configured, Transient) | ^5.1 | 9s, 10ms, 949µs, 182ns | 7s, 642ms, 487µs, 764ns | 9s, 262ms, 754µs, 917ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 116µs, 10ns | 3ms, 988µs, 27ns | 4ms, 449µs, 129ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 934µs, 1ns | 3ms, 906µs, 965ns | 3ms, 972µs, 53ns |
| Phalcon(Configured, Transient) | ^5 | 291ms, 457µs, 343ns | 262ms, 277µs, 126ns | 315ms, 646µs, 171ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 248µs, 669ns | 1ms, 236µs, 915ns | 1ms, 269µs, 102ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 913µs, 903ns | 100ms, 598µs, 96ns | 115ms, 264µs, 892ns |
| Quickly(Compiled, Singleton) | dev-master | 661µs, 63ns | 648µs, 21ns | 698µs, 89ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 686µs, 212ns | 3ms, 793µs, 954ns | 6ms, 484µs, 31ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 624ms, 314µs, 379ns | 3s, 535ms, 579µs, 919ns | 3s, 915ms, 446µs, 43ns |
| Symfony(Compiled, Singleton) | ^7.0 | 785µs, 207ns | 764µs, 846ns | 845µs, 193ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 860µs, 404ns | 804µs, 901ns | 1ms, 141µs, 71ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 875µs, 520ns | 787µs, 19ns | 1ms, 541µs, 137ns |
| Zen(Compiled, Singleton) | ^3.1 | 835µs, 13ns | 756µs, 25ns | 1ms, 454µs, 114ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 27µs, 583ns | 1ms, 690µs, 864ns | 3ms, 256µs, 82ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 864µs, 719ns | 1ms, 737µs, 117ns | 2ms, 207µs, 994ns |
| Laravel(Configured, Transient) | ^12.28 | 381ms, 561µs, 970ns | 374ms, 439µs, 954ns | 405ms, 987µs, 977ns |
| League(Configured, Transient) | ^5.1 | 8s, 977ms, 84µs, 302ns | 7s, 616ms, 846µs, 84ns | 9s, 188ms, 52µs, 177ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 129µs, 52ns | 4ms, 4µs, 955ns | 4ms, 581µs, 928ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 440µs, 521ns | 3ms, 962µs, 39ns | 7ms, 992µs, 29ns |
| Phalcon(Configured, Transient) | ^5 | 296ms, 706µs, 80ns | 290ms, 23µs, 88ns | 304ms, 167µs, 985ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 373µs, 696ns | 1ms, 307µs, 10ns | 1ms, 585µs, 960ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 223µs, 323ns | 100ms, 430µs, 965ns | 106ms, 570µs, 5ns |
| Quickly(Compiled, Singleton) | dev-master | 815µs, 391ns | 797µs, 33ns | 856µs, 876ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 191µs, 303ns | 4ms, 88µs, 878ns | 4ms, 773µs, 139ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 589ms, 951µs, 682ns | 3s, 537ms, 544µs, 12ns | 3s, 632ms, 459µs, 878ns |
| Symfony(Compiled, Singleton) | ^7.0 | 750µs, 732ns | 732µs, 898ns | 788µs, 211ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 118µs, 707ns | 896µs, 930ns | 2ms, 963µs, 66ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 81µs, 776ns | 859µs, 975ns | 2ms, 941µs, 846ns |
| Zen(Compiled, Singleton) | ^3.1 | 849µs, 819ns | 663µs, 995ns | 2ms, 289µs, 56ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 375µs, 385ns | 5ms, 207µs, 61ns | 6ms, 246µs, 89ns |
| Dice(Configured, Singleton) | ^4.0 | 951µs, 290ns | 878µs, 95ns | 1ms, 482µs, 963ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 925ms, 185µs, 465ns | 8s, 662ms, 758µs, 827ns | 10s, 133ms, 255µs, 4ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 787µs, 758ns | 755µs, 71ns | 905µs, 36ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 561µs, 425ns | 3ms, 15µs, 41ns | 3ms, 928µs, 899ns |
| Laravel(Reflection, Transient) | ^12.28 | 79s, 800ms, 228µs, 571ns | 68s, 357ms, 495µs, 69ns | 81s, 527ms, 372µs, 837ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 303µs, 311ns | 3ms, 460µs, 168ns | 7ms, 192µs, 850ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 907µs, 489ns | 3ms, 406µs, 47ns | 4ms, 113µs, 912ns |
| Php-baseline |  | 609µs, 16ns | 473µs, 22ns | 678µs, 62ns |
| Php-di(Reflection, Singleton) | ^7.0 | 891µs, 971ns | 814µs, 914ns | 1ms, 288µs, 890ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 43µs, 343ns | 1ms, 33µs, 67ns | 1ms, 74µs, 75ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 592ms, 70µs, 317ns | 12s, 992ms, 42µs, 64ns | 14s, 195ms, 283µs, 174ns |
| Quickly(Compiled, Singleton) | dev-master | 858µs, 283ns | 839µs, 948ns | 880µs, 2ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 369µs, 214ns | 1ms, 321µs, 77ns | 1ms, 490µs, 116ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 398µs, 38ns | 1ms, 357µs, 78ns | 1ms, 562µs, 118ns |
| Symfony(Compiled, Singleton) | ^7.0 | 796µs, 985ns | 777µs, 6ns | 838µs, 994ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 864µs, 791ns | 777µs, 6ns | 1ms, 163µs, 5ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 872µs, 778ns | 792µs, 980ns | 1ms, 418µs, 828ns |
| Zen(Compiled, Singleton) | ^3.1 | 814µs, 199ns | 723µs, 123ns | 1ms, 437µs, 902ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 696µs, 224ns | 6ms, 613µs, 16ns | 6ms, 757µs, 974ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 181µs, 410ns | 1ms, 864µs, 194ns | 2ms, 379µs, 179ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 874ms, 685µs, 621ns | 8s, 647ms, 554µs, 159ns | 10s, 165ms, 186µs, 166ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 14µs, 685ns | 858µs, 68ns | 2ms, 86µs, 162ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 521µs, 12ns | 3ms, 968µs | 4ms, 961µs, 13ns |
| Laravel(Reflection, Transient) | ^12.28 | 80s, 930ms, 330µs, 300ns | 79s, 927ms, 535µs, 57ns | 81s, 716ms, 758µs, 12ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 572µs, 487ns | 3ms, 463µs, 29ns | 3ms, 880µs, 23ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 106µs, 497ns | 3ms, 572µs, 940ns | 4ms, 200µs, 935ns |
| Php-baseline |  | 615µs, 477ns | 461µs, 101ns | 823µs, 20ns |
| Php-di(Reflection, Singleton) | ^7.0 | 940µs, 537ns | 742µs, 912ns | 2ms, 537µs, 12ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 344µs, 776ns | 1ms, 289µs, 129ns | 1ms, 579µs, 999ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 934ms, 50µs, 607ns | 12s, 969ms, 841µs, 3ns | 14s, 880ms, 644µs, 83ns |
| Quickly(Compiled, Singleton) | dev-master | 815µs, 892ns | 790µs, 119ns | 833µs, 34ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 185µs, 392ns | 2ms, 58µs, 982ns | 2ms, 982µs, 139ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 237µs, 320ns | 1ms, 138µs, 925ns | 1ms, 827µs, 1ns |
| Symfony(Compiled, Singleton) | ^7.0 | 802µs, 445ns | 772µs, 953ns | 881µs, 910ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 314µs, 330ns | 934µs, 123ns | 3ms, 71µs, 69ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 200µs, 795ns | 941µs, 991ns | 3ms, 118µs, 991ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 66µs, 327ns | 833µs, 988ns | 2ms, 910µs, 852ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 786µs, 804ns | 1ms, 574µs, 39ns | 1ms, 858µs, 949ns |
| Dice(Configured, Singleton) | ^4.0 | 881µs, 695ns | 862µs, 121ns | 912µs, 904ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 6ms, 487µs, 917ns | 3ms, 973µs, 960ns | 8ms, 115µs, 53ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 226µs, 398ns | 3ms, 904µs, 104ns | 6ms, 402µs, 15ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 235µs, 818ns | 1ms, 204µs, 13ns | 1ms, 265µs, 48ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 806ms, 869µs, 196ns | 13s, 110ms, 491µs, 991ns | 14s, 166ms, 497µs, 945ns |
| Quickly(Compiled, Singleton) | dev-master | 809µs, 288ns | 779µs, 867ns | 861µs, 167ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 565µs, 335ns | 3ms, 511µs, 190ns | 3ms, 704µs, 71ns |
| Symfony(Compiled, Singleton) | ^7.0 | 752µs, 806ns | 734µs, 90ns | 849µs, 8ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 840µs, 306ns | 783µs, 920ns | 1ms, 151µs, 84ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 887µs, 870ns | 787µs, 973ns | 1ms, 549µs, 5ns |
| Zen(Compiled, Singleton) | ^3.1 | 799µs, 608ns | 707µs, 864ns | 1ms, 446µs, 962ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 162µs, 455ns | 2ms, 685µs, 70ns | 3ms, 351µs, 926ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 253µs, 174ns | 1ms, 888µs, 36ns | 2ms, 640µs, 8ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 108µs, 905ns | 3ms, 952µs, 26ns | 4ms, 564µs, 46ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 33µs, 541ns | 3ms, 636µs, 837ns | 4ms, 244µs, 89ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 352µs, 500ns | 1ms, 282µs, 930ns | 1ms, 650µs, 94ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 929ms, 870µs, 986ns | 13s, 269ms, 993µs, 66ns | 14s, 260ms, 212µs, 898ns |
| Quickly(Compiled, Singleton) | dev-master | 814µs, 199ns | 795µs, 841ns | 847µs, 816ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 8µs, 888ns | 4ms, 863µs, 977ns | 5ms, 659µs, 103ns |
| Symfony(Compiled, Singleton) | ^7.0 | 848µs, 412ns | 737µs, 905ns | 1ms, 193µs, 46ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 164µs, 221ns | 948µs, 190ns | 2ms, 969µs, 980ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 205µs, 754ns | 959µs, 873ns | 3ms, 190µs, 40ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 83µs, 707ns | 866µs, 174ns | 2ms, 858µs, 877ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 879µs, 192ns | 806µs, 93ns | 1ms, 130µs, 819ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 534µs, 412ns | 3ms, 415µs, 107ns | 3ms, 988µs, 981ns |
| Php-di(Reflection, Singleton) | ^7.0 | 857µs, 210ns | 792µs, 980ns | 1ms, 289µs, 129ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 246µs, 523ns | 1ms, 214µs, 981ns | 1ms, 280µs, 69ns |
| Quickly(Compiled, Singleton) | dev-master | 777µs, 387ns | 759µs, 840ns | 810µs, 146ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 395µs, 201ns | 1ms, 355µs, 171ns | 1ms, 479µs, 148ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 414µs, 227ns | 1ms, 374µs, 959ns | 1ms, 616µs, 1ns |
| Symfony(Compiled, Singleton) | ^7.0 | 822µs, 401ns | 784µs, 873ns | 914µs, 96ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 853µs, 943ns | 792µs, 26ns | 1ms, 242µs, 160ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 848µs, 102ns | 762µs, 939ns | 1ms, 502µs, 990ns |
| Zen(Compiled, Singleton) | ^3.1 | 852µs, 394ns | 757µs, 932ns | 1ms, 564µs, 25ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 889µs, 86ns | 761µs, 32ns | 1ms, 703µs, 977ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 568µs, 720ns | 3ms, 501µs, 892ns | 3ms, 912µs, 925ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 1µs, 501ns | 789µs, 880ns | 2ms, 592µs, 86ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 374µs, 506ns | 1ms, 327µs, 37ns | 1ms, 593µs, 828ns |
| Quickly(Compiled, Singleton) | dev-master | 816µs, 273ns | 807µs, 46ns | 832µs, 80ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 234µs, 673ns | 2ms, 100µs, 944ns | 2ms, 997µs, 875ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 302µs, 552ns | 1ms, 214µs, 981ns | 1ms, 945µs, 972ns |
| Symfony(Compiled, Singleton) | ^7.0 | 854µs, 539ns | 818µs, 14ns | 1ms, 82µs, 181ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 222µs, 419ns | 1ms, 8µs, 987ns | 3ms, 61µs, 56ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 188µs, 492ns | 950µs, 98ns | 3ms, 20ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 108µs, 2ns | 877µs, 141ns | 2ms, 912µs, 44ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 69µs, 352ns | 3ms, 967µs, 46ns | 4ms, 497µs, 51ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 4µs, 695ns | 987µs, 52ns | 1ms, 32µs, 114ns |
| Quickly(Compiled, Singleton) | dev-master | 842µs, 499ns | 763µs, 893ns | 1ms, 59µs, 55ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 167µs, 389ns | 4ms, 119µs, 873ns | 4ms, 202µs, 842ns |
| Symfony(Compiled, Singleton) | ^7.0 | 823µs, 855ns | 802µs, 993ns | 844µs, 1ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 829µs, 696ns | 777µs, 959ns | 1ms, 193µs, 46ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 917µs, 696ns | 781µs, 59ns | 1ms, 980µs, 66ns |
| Zen(Compiled, Singleton) | ^3.1 | 673µs, 794ns | 595µs, 92ns | 1ms, 250µs, 28ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 655µs, 719ns | 3ms, 528µs, 118ns | 4ms, 21µs, 167ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 352µs, 787ns | 1ms, 299µs, 142ns | 1ms, 562µs, 118ns |
| Quickly(Compiled, Singleton) | dev-master | 665µs, 807ns | 643µs, 968ns | 712µs, 871ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 999µs, 876ns | 4ms, 755µs, 973ns | 5ms, 626µs, 916ns |
| Symfony(Compiled, Singleton) | ^7.0 | 825µs, 715ns | 752µs, 925ns | 1ms, 68µs, 830ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 10µs, 84ns | 796µs, 79ns | 2ms, 538µs, 919ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 195µs, 931ns | 973µs, 939ns | 3ms, 46µs, 989ns |
| Zen(Compiled, Singleton) | ^3.1 | 935µs, 6ns | 755µs, 71ns | 2ms, 315µs, 44ns |

</details>

Questions, issues, and new containers are welcome!
