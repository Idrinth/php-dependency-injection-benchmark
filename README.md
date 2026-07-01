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

Run from 2026-07-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 903µs, 319ns | 1ms, 526µs, 117ns | 3ms, 140µs, 211ns |
| Auryn(Reflection, Transient) | ^1.4 | 398ms, 952µs, 817ns | 357ms, 393µs, 980ns | 416ms, 934µs, 13ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 26µs, 606ns | 827µs, 74ns | 1ms, 296µs, 43ns |
| Dice(Reflection, Transient) | ^4.0 | 74ms, 563µs, 264ns | 71ms, 720µs, 123ns | 88ms, 201µs, 45ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 824µs, 189ns | 801µs, 86ns | 867µs, 843ns |
| Laravel(Configured, Transient) | ^12.28 | 413ms, 742µs, 804ns | 396ms, 868µs, 944ns | 425ms, 522µs, 89ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 491µs, 187ns | 3ms, 390µs, 789ns | 3ms, 695µs, 11ns |
| Laravel(Reflection, Transient) | ^12.28 | 532ms, 449µs, 293ns | 483ms, 772µs, 993ns | 580ms, 186µs, 843ns |
| League(Configured, Transient) | ^5.1 | 1s, 132ms, 147µs, 288ns | 978ms, 856µs, 801ns | 1s, 209ms, 629µs, 58ns |
| League(Reflection, Transient) | ^5.1 | 713ms, 250µs, 494ns | 609ms, 580µs, 993ns | 743ms, 955µs, 850ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 548µs, 95ns | 3ms, 566µs, 26ns | 7ms, 731µs, 914ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 109µs, 23ns | 6ms, 50µs, 109ns | 6ms, 222µs, 963ns |
| Phalcon(Configured, Transient) | ^5 | 335ms, 32µs, 701ns | 309ms, 752µs, 941ns | 376ms, 650µs, 94ns |
| Php-baseline |  | 607µs, 562ns | 584µs, 125ns | 624µs, 895ns |
| Php-di(Reflection, Singleton) | ^7.0 | 820µs, 16ns | 769µs, 138ns | 1ms, 171µs, 112ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 206µs, 541ns | 1ms, 178µs, 26ns | 1ms, 219µs, 987ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 459µs, 98ns | 98ms, 264µs, 932ns | 108ms, 824µs, 14ns |
| Quickly(Compiled, Singleton) | dev-master | 818µs, 204ns | 799µs, 894ns | 849µs, 8ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 348µs, 614ns | 1ms, 328µs, 945ns | 1ms, 410µs, 961ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 404µs, 619ns | 1ms, 360µs, 893ns | 1ms, 520µs, 872ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 433ms, 461µs, 380ns | 1s, 776ms, 79µs, 893ns | 3s, 909ms, 426µs, 927ns |
| Ray-di(Reflection, Transient) | ^2.16 | 383ms, 332µs, 800ns | 311ms, 329µs, 126ns | 413ms, 447µs, 141ns |
| Symfony(Compiled, Singleton) | ^7.0 | 828µs, 146ns | 759µs, 124ns | 1ms, 13µs, 40ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 842µs, 285ns | 796µs, 79ns | 1ms, 111µs, 30ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 869µs, 774ns | 794µs, 887ns | 1ms, 374µs, 6ns |
| Zen(Compiled, Singleton) | ^3.1 | 864µs, 195ns | 748µs, 872ns | 1ms, 440µs, 48ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 908µs, 397ns | 1ms, 463µs, 890ns | 3ms, 294µs, 944ns |
| Auryn(Reflection, Transient) | ^1.4 | 407ms, 757µs, 663ns | 398ms, 496µs, 866ns | 414ms, 114µs, 952ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 25µs, 628ns | 1ms, 757µs, 860ns | 3ms, 379µs, 821ns |
| Dice(Reflection, Transient) | ^4.0 | 74ms, 531µs, 841ns | 72ms, 736µs, 978ns | 78ms, 935µs, 861ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 933µs, 3ns | 792µs, 26ns | 1ms, 945µs, 972ns |
| Laravel(Configured, Transient) | ^12.28 | 420ms, 541µs, 691ns | 406ms, 286µs, 1ns | 445ms, 477µs, 962ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 840µs, 184ns | 3ms, 482µs, 103ns | 5ms, 66µs, 871ns |
| Laravel(Reflection, Transient) | ^12.28 | 587ms, 916µs, 16ns | 582ms, 365µs, 36ns | 601ms, 690µs, 53ns |
| League(Configured, Transient) | ^5.1 | 1s, 150ms, 209µs, 522ns | 896ms, 179µs, 914ns | 1s, 215ms, 754µs, 985ns |
| League(Reflection, Transient) | ^5.1 | 694ms, 256µs, 91ns | 589ms, 771µs, 32ns | 735ms, 521µs, 793ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 794µs, 884ns | 3ms, 675µs, 937ns | 4ms, 168µs, 987ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 77µs, 75ns | 5ms, 708µs, 932ns | 6ms, 474µs, 18ns |
| Phalcon(Configured, Transient) | ^5 | 322ms, 969µs, 341ns | 281ms, 877µs, 994ns | 350ms, 827µs, 932ns |
| Php-baseline |  | 727µs, 629ns | 566µs, 959ns | 833µs, 988ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 116µs, 394ns | 862µs, 121ns | 3ms, 164µs, 52ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 404µs, 500ns | 1ms, 354µs, 932ns | 1ms, 631µs, 975ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 542µs, 664ns | 99ms, 495µs, 887ns | 102ms, 996µs, 826ns |
| Quickly(Compiled, Singleton) | dev-master | 799µs, 465ns | 783µs, 920ns | 838µs, 41ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 149µs, 558ns | 2ms, 27µs, 988ns | 2ms, 884µs, 864ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 524µs, 877ns | 1ms, 379µs, 966ns | 2ms, 424µs, 1ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 384ms, 720µs, 706ns | 1s, 984ms, 858µs, 989ns | 3s, 917ms, 481µs, 184ns |
| Ray-di(Reflection, Transient) | ^2.16 | 408ms, 774µs, 65ns | 401ms, 869µs, 58ns | 420ms, 361µs, 995ns |
| Symfony(Compiled, Singleton) | ^7.0 | 656µs, 199ns | 639µs, 915ns | 703µs, 96ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 375µs, 699ns | 949µs, 144ns | 4ms, 596µs, 948ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 850µs, 796ns | 668µs, 48ns | 2ms, 233µs, 28ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 36µs, 190ns | 817µs, 60ns | 2ms, 847µs, 909ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 48µs, 182ns | 1ms, 607µs, 894ns | 2ms, 676µs, 10ns |
| Dice(Configured, Singleton) | ^4.0 | 851µs, 893ns | 804µs, 185ns | 1ms, 14µs, 947ns |
| Laravel(Configured, Transient) | ^12.28 | 383ms, 778µs, 214ns | 375ms, 706µs, 911ns | 392ms, 852µs, 67ns |
| League(Configured, Transient) | ^5.1 | 9s, 230ms, 665µs, 16ns | 7s, 640ms, 908µs, 2ns | 9s, 513ms, 697µs, 147ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 175µs, 782ns | 4ms, 32µs, 135ns | 4ms, 575µs, 14ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 907µs, 344ns | 5ms, 640µs, 983ns | 6ms, 344µs, 795ns |
| Phalcon(Configured, Transient) | ^5 | 332ms, 121µs, 634ns | 317ms, 500µs, 114ns | 339ms, 961µs, 51ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 226µs, 496ns | 1ms, 194µs, 953ns | 1ms, 258µs, 134ns |
| Pimple(Configured, Transient) | ^3.5 | 88ms, 882µs, 613ns | 75ms, 582µs, 27ns | 103ms, 65µs, 13ns |
| Quickly(Compiled, Singleton) | dev-master | 649µs, 356ns | 635µs, 862ns | 666µs, 141ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 366µs, 160ns | 3ms, 330µs, 945ns | 3ms, 475µs, 189ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 541ms, 7µs, 733ns | 2s, 28ms, 243µs, 64ns | 3s, 944ms, 617µs, 33ns |
| Symfony(Compiled, Singleton) | ^7.0 | 745µs, 892ns | 722µs, 885ns | 787µs, 973ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 854µs, 635ns | 807µs, 46ns | 1ms, 138µs, 210ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 921µs, 797ns | 756µs, 978ns | 1ms, 468µs, 896ns |
| Zen(Compiled, Singleton) | ^3.1 | 864µs, 315ns | 773µs, 191ns | 1ms, 480µs, 817ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 767µs, 492ns | 1ms, 318µs, 931ns | 3ms, 118µs, 38ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 59µs, 721ns | 1ms, 441µs, 955ns | 2ms, 774µs, 953ns |
| Laravel(Configured, Transient) | ^12.28 | 387ms, 184µs, 834ns | 381ms, 927µs, 967ns | 393ms, 224µs, 954ns |
| League(Configured, Transient) | ^5.1 | 9s, 409ms, 212µs, 994ns | 9s, 162ms, 492µs, 990ns | 9s, 657ms, 470µs, 941ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 875µs, 255ns | 3ms, 774µs, 166ns | 4ms, 204µs, 988ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 304µs, 287ns | 6ms, 155µs, 967ns | 6ms, 493µs, 91ns |
| Phalcon(Configured, Transient) | ^5 | 323ms, 880µs, 28ns | 273ms, 758µs, 888ns | 344ms, 722µs, 986ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 328µs, 182ns | 1ms, 283µs, 884ns | 1ms, 551µs, 866ns |
| Pimple(Configured, Transient) | ^3.5 | 87ms, 321µs, 543ns | 75ms, 859µs, 69ns | 98ms, 435µs, 878ns |
| Quickly(Compiled, Singleton) | dev-master | 822µs, 615ns | 790µs, 119ns | 863µs, 75ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 781µs, 937ns | 4ms, 611µs, 968ns | 5ms, 486µs, 965ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 775ms, 461µs, 888ns | 3s, 551ms, 710µs, 844ns | 3s, 935ms, 592µs, 174ns |
| Symfony(Compiled, Singleton) | ^7.0 | 655µs, 817ns | 638µs, 961ns | 681µs, 161ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 102µs, 614ns | 869µs, 35ns | 2ms, 902µs, 30ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 99µs, 348ns | 870µs, 943ns | 3ms, 18µs, 140ns |
| Zen(Compiled, Singleton) | ^3.1 | 801µs, 205ns | 633µs, 955ns | 2ms, 173µs, 185ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 239µs, 558ns | 4ms, 115µs, 104ns | 5ms, 910µs, 873ns |
| Dice(Configured, Singleton) | ^4.0 | 879µs, 454ns | 756µs, 978ns | 932µs, 931ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 199ms, 61µs, 775ns | 9s, 908ms, 842µs, 86ns | 10s, 555ms, 636µs, 882ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 828µs, 504ns | 797µs, 33ns | 950µs, 813ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 690µs, 505ns | 3ms, 3µs, 835ns | 4ms, 59µs, 76ns |
| Laravel(Reflection, Transient) | ^12.28 | 81s, 610ms, 179µs, 853ns | 80s, 653ms, 723µs, 955ns | 83s, 282ms, 637µs, 834ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 650µs, 665ns | 3ms, 386µs, 974ns | 4ms, 63µs, 129ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 889µs, 677ns | 5ms, 608µs, 81ns | 10ms, 288µs |
| Php-baseline |  | 624µs, 394ns | 557µs, 899ns | 708µs, 103ns |
| Php-di(Reflection, Singleton) | ^7.0 | 867µs, 176ns | 815µs, 868ns | 1ms, 229µs, 47ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 392µs, 102ns | 1ms, 307µs, 964ns | 1ms, 467µs, 943ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 715ms, 722µs, 393ns | 12s, 769ms, 536µs, 18ns | 14s, 64ms, 841µs, 985ns |
| Quickly(Compiled, Singleton) | dev-master | 862µs, 765ns | 795µs, 125ns | 1ms, 169µs, 204ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 130µs, 723ns | 1ms, 116µs, 991ns | 1ms, 168µs, 12ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 419µs, 67ns | 1ms, 386µs, 880ns | 1ms, 517µs, 57ns |
| Symfony(Compiled, Singleton) | ^7.0 | 765µs, 800ns | 734µs, 90ns | 872µs, 135ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 663µs, 352ns | 620µs, 841ns | 903µs, 129ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 891µs, 423ns | 808µs, 954ns | 1ms, 466µs, 35ns |
| Zen(Compiled, Singleton) | ^3.1 | 856µs, 995ns | 762µs, 939ns | 1ms, 507µs, 997ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 431µs, 340ns | 6ms, 624µs, 221ns | 12ms, 423µs, 992ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 244µs, 43ns | 1ms, 857µs, 42ns | 2ms, 473µs, 115ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 347ms, 245µs, 812ns | 9s, 898ms, 854µs, 17ns | 10s, 570ms, 705µs, 890ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 993µs, 919ns | 857µs, 114ns | 2ms, 50µs, 161ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 484µs, 771ns | 4ms, 179µs | 8ms, 571µs, 147ns |
| Laravel(Reflection, Transient) | ^12.28 | 79s, 712ms, 925µs, 410ns | 63s, 101ms, 954µs, 936ns | 82s, 517ms, 663µs, 2ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 829µs, 669ns | 3ms, 731µs, 966ns | 4ms, 266µs, 977ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 48µs, 655ns | 5ms, 320µs, 787ns | 6ms, 506µs, 919ns |
| Php-baseline |  | 605µs, 869ns | 497µs, 817ns | 676µs, 155ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 169µs, 204ns | 898µs, 122ns | 3ms, 363µs, 847ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 407µs, 742ns | 1ms, 351µs, 118ns | 1ms, 650µs, 94ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 800ms, 612µs, 139ns | 13s, 480ms, 859µs, 994ns | 14s, 24ms, 183µs, 34ns |
| Quickly(Compiled, Singleton) | dev-master | 776µs, 791ns | 757µs, 932ns | 796µs, 79ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 859µs, 902ns | 2ms, 21µs, 74ns | 3ms, 202µs, 915ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 177µs, 525ns | 1ms, 101µs, 16ns | 1ms, 799µs, 821ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 213µs, 97ns | 764µs, 131ns | 1ms, 287µs, 937ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 181µs, 197ns | 955µs, 104ns | 3ms, 54µs, 857ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 297µs, 378ns | 808µs, 954ns | 2ms, 985µs |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 129µs, 817ns | 910µs, 997ns | 2ms, 949µs, 953ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 831µs, 889ns | 940µs, 84ns | 3ms, 121µs, 137ns |
| Dice(Configured, Singleton) | ^4.0 | 857µs, 234ns | 706µs, 911ns | 890µs, 16ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 229µs, 974ns | 4ms, 114µs, 866ns | 4ms, 698µs, 991ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 325µs, 6ns | 4ms, 405µs, 21ns | 10ms, 388µs, 135ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 55µs, 622ns | 1ms, 31µs, 160ns | 1ms, 65µs, 969ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 836ms, 220µs, 836ns | 13s, 592ms, 578µs, 172ns | 13s, 954ms, 826µs, 116ns |
| Quickly(Compiled, Singleton) | dev-master | 812µs, 149ns | 784µs, 158ns | 885µs, 9ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 12µs, 12ns | 3ms, 980µs, 875ns | 4ms, 60µs, 983ns |
| Symfony(Compiled, Singleton) | ^7.0 | 804µs, 615ns | 787µs, 19ns | 817µs, 60ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 371µs, 383ns | 1ms, 285µs, 76ns | 1ms, 903µs, 57ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 887µs, 894ns | 796µs, 794ns | 1ms, 565µs, 933ns |
| Zen(Compiled, Singleton) | ^3.1 | 862µs, 216ns | 768µs, 899ns | 1ms, 595µs, 20ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 159µs, 403ns | 2ms, 460µs, 956ns | 4ms, 142µs, 999ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 463µs, 507ns | 1ms, 727µs, 104ns | 3ms, 859µs, 996ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 52µs, 210ns | 2ms, 958µs, 59ns | 3ms, 407µs, 1ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 436µs, 634ns | 5ms, 864µs, 143ns | 7ms, 113µs, 933ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 348µs, 876ns | 1ms, 307µs, 964ns | 1ms, 602µs, 888ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 779ms, 27µs, 652ns | 13s, 458ms, 271µs, 26ns | 13s, 962ms, 217µs, 92ns |
| Quickly(Compiled, Singleton) | dev-master | 823µs, 497ns | 797µs, 986ns | 859µs, 975ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 535µs, 411ns | 3ms, 653µs, 49ns | 7ms, 915µs, 19ns |
| Symfony(Compiled, Singleton) | ^7.0 | 779µs, 438ns | 752µs, 925ns | 832µs, 80ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 643µs, 705ns | 1ms, 118µs, 898ns | 4ms, 321µs, 98ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 152µs, 181ns | 926µs, 17ns | 3ms, 89µs, 904ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 27µs, 822ns | 801µs, 86ns | 2ms, 807µs, 140ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 804µs, 90ns | 776µs, 52ns | 964µs, 879ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 820µs, 681ns | 3ms, 684µs, 43ns | 4ms, 697µs, 84ns |
| Php-di(Reflection, Singleton) | ^7.0 | 718µs, 545ns | 666µs, 141ns | 1ms, 52µs, 856ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 282µs, 906ns | 1ms, 224µs, 40ns | 1ms, 347µs, 64ns |
| Quickly(Compiled, Singleton) | dev-master | 800µs, 895ns | 766µs, 38ns | 848µs, 54ns |
| Quickly(Configured, Singleton) | dev-master | 952µs, 768ns | 883µs, 102ns | 1ms, 32µs, 114ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 419µs, 472ns | 1ms, 350µs, 879ns | 1ms, 654µs, 148ns |
| Symfony(Compiled, Singleton) | ^7.0 | 791µs, 883ns | 770µs, 807ns | 834µs, 226ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 889µs, 539ns | 835µs, 180ns | 1ms, 269µs, 102ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 887µs, 584ns | 799µs, 179ns | 1ms, 486µs, 63ns |
| Zen(Compiled, Singleton) | ^3.1 | 829µs, 148ns | 734µs, 90ns | 1ms, 556µs, 158ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 44µs, 297ns | 914µs, 96ns | 2ms, 96µs, 891ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 856µs, 516ns | 2ms, 752µs, 65ns | 3ms, 214µs, 120ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 192µs, 665ns | 941µs, 38ns | 3ms, 346µs, 920ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 433µs, 968ns | 1ms, 335µs, 144ns | 1ms, 899µs, 957ns |
| Quickly(Compiled, Singleton) | dev-master | 830µs, 626ns | 803µs, 947ns | 911µs, 951ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 290µs, 916ns | 2ms, 163µs, 171ns | 3ms, 261µs, 89ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 661µs, 205ns | 1ms, 548µs, 51ns | 2ms, 445µs, 936ns |
| Symfony(Compiled, Singleton) | ^7.0 | 633µs, 692ns | 570µs, 58ns | 678µs, 62ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 227µs, 283ns | 971µs, 78ns | 3ms, 39µs, 836ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 160µs, 240ns | 950µs, 813ns | 2ms, 947µs, 92ns |
| Zen(Compiled, Singleton) | ^3.1 | 903µs, 224ns | 721µs, 931ns | 2ms, 350µs, 91ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 883µs, 934ns | 3ms, 792µs, 47ns | 4ms, 328µs, 12ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 260µs, 280ns | 1ms, 216µs, 888ns | 1ms, 411µs, 199ns |
| Quickly(Compiled, Singleton) | dev-master | 853µs, 300ns | 771µs, 999ns | 1ms, 25µs, 915ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 42µs, 911ns | 3ms, 854µs, 36ns | 5ms, 72µs, 116ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 235µs, 890ns | 1ms, 214µs, 27ns | 1ms, 255µs, 989ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 840µs, 711ns | 779µs, 867ns | 1ms, 220µs, 226ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 901µs, 699ns | 802µs, 40ns | 1ms, 687µs, 49ns |
| Zen(Compiled, Singleton) | ^3.1 | 859µs, 928ns | 763µs, 177ns | 1ms, 560µs, 926ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 235µs, 410ns | 4ms, 113µs, 912ns | 4ms, 611µs, 968ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 319µs, 575ns | 1ms, 277µs, 923ns | 1ms, 552µs, 820ns |
| Quickly(Compiled, Singleton) | dev-master | 825µs, 262ns | 795µs, 841ns | 901µs, 937ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 804µs, 182ns | 4ms, 618µs, 883ns | 5ms, 493µs, 879ns |
| Symfony(Compiled, Singleton) | ^7.0 | 782µs, 346ns | 738µs, 143ns | 800µs, 132ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 306µs, 319ns | 977µs, 993ns | 4ms, 199µs, 981ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 240µs, 420ns | 978µs, 946ns | 3ms, 486µs, 871ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 191µs, 902ns | 961µs, 65ns | 2ms, 999µs, 67ns |

</details>

Questions, issues, and new containers are welcome!
