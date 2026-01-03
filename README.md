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

Run from 2026-01-03

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 629µs, 924ns | 1ms, 569µs, 32ns | 1ms, 755µs, 952ns |
| Auryn(Reflection, Transient) | ^1.4 | 403ms, 501µs, 796ns | 372ms, 313µs, 22ns | 416ms, 806µs, 936ns |
| Dice(Configured, Singleton) | ^4.0 | 801µs, 610ns | 682µs, 115ns | 1ms, 65µs, 15ns |
| Dice(Reflection, Transient) | ^4.0 | 72ms, 751µs, 283ns | 70ms, 924µs, 997ns | 78ms, 27µs, 963ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 802µs, 159ns | 780µs, 820ns | 854µs, 969ns |
| Laravel(Configured, Transient) | ^12.28 | 409ms, 799µs, 981ns | 400ms, 197µs, 982ns | 454ms, 355µs, 955ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 352µs, 618ns | 3ms, 267µs, 49ns | 3ms, 487µs, 110ns |
| Laravel(Reflection, Transient) | ^12.28 | 588ms, 679µs, 409ns | 537ms, 12µs, 815ns | 644ms, 389µs, 867ns |
| League(Configured, Transient) | ^5.1 | 871ms, 379µs, 184ns | 703ms, 885µs, 793ns | 944ms, 417µs, 953ns |
| League(Reflection, Transient) | ^5.1 | 664ms, 95µs, 139ns | 563ms, 793µs, 897ns | 735ms, 95µs, 977ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 406µs, 310ns | 3ms, 326µs, 892ns | 3ms, 801µs, 107ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 436µs, 491ns | 3ms, 839µs, 969ns | 7ms, 956µs, 27ns |
| Phalcon(Configured, Transient) | ^5 | 296ms, 347µs, 594ns | 260ms, 684µs, 967ns | 321ms, 208µs, 953ns |
| Php-baseline |  | 603µs, 699ns | 579µs, 833ns | 638µs, 8ns |
| Php-di(Reflection, Singleton) | ^7.0 | 860µs, 786ns | 808µs | 1ms, 208µs, 66ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 254µs, 892ns | 1ms, 213µs, 73ns | 1ms, 303µs, 911ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 745µs, 772ns | 100ms, 746µs, 870ns | 104ms, 374µs, 170ns |
| Quickly(Compiled, Singleton) | dev-master | 785µs, 589ns | 743µs, 865ns | 824µs, 928ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 346µs, 397ns | 1ms, 317µs, 977ns | 1ms, 370µs, 906ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 363µs, 992ns | 1ms, 328µs, 945ns | 1ms, 448µs, 869ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 215ms, 994µs, 787ns | 1s, 908ms, 385µs, 992ns | 3s, 567ms, 703µs, 962ns |
| Ray-di(Reflection, Transient) | ^2.16 | 387ms, 163µs, 805ns | 346ms, 256µs, 971ns | 420ms, 552µs, 15ns |
| Symfony(Compiled, Singleton) | ^7.0 | 799µs, 703ns | 768µs, 899ns | 828µs, 981ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 687µs, 599ns | 645µs, 875ns | 916µs, 4ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 854µs, 849ns | 787µs, 973ns | 1ms, 384µs, 973ns |
| Zen(Compiled, Singleton) | ^3.1 | 669µs, 598ns | 591µs, 39ns | 1ms, 183µs, 32ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 713µs, 704ns | 1ms, 712µs, 83ns | 4ms, 580µs, 20ns |
| Auryn(Reflection, Transient) | ^1.4 | 408ms, 561µs, 253ns | 402ms, 384µs, 42ns | 418ms, 998µs, 956ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 896µs, 262ns | 1ms, 781µs, 940ns | 2ms, 205µs, 848ns |
| Dice(Reflection, Transient) | ^4.0 | 72ms, 575µs, 187ns | 71ms, 482µs, 181ns | 73ms, 512µs, 792ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 966µs, 620ns | 767µs, 946ns | 1ms, 907µs, 110ns |
| Laravel(Configured, Transient) | ^12.28 | 407ms, 400µs, 608ns | 396ms, 881µs, 103ns | 419ms, 474µs, 840ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 699µs, 803ns | 3ms, 330µs, 945ns | 4ms, 762µs, 172ns |
| Laravel(Reflection, Transient) | ^12.28 | 645ms, 401µs, 859ns | 637ms, 121µs, 915ns | 653ms, 427µs, 124ns |
| League(Configured, Transient) | ^5.1 | 889ms, 921µs, 402ns | 866ms, 995µs, 96ns | 929ms, 718µs, 17ns |
| League(Reflection, Transient) | ^5.1 | 661ms, 18µs, 919ns | 557ms, 399µs, 34ns | 694ms, 660µs, 902ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 442µs, 978ns | 3ms, 369µs, 808ns | 3ms, 825µs, 902ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 49µs, 181ns | 3ms, 993µs, 988ns | 4ms, 169µs, 940ns |
| Phalcon(Configured, Transient) | ^5 | 298ms, 730µs, 564ns | 288ms, 568µs, 973ns | 308ms, 433µs, 55ns |
| Php-baseline |  | 594µs, 210ns | 571µs, 966ns | 617µs, 980ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 121µs, 234ns | 811µs, 815ns | 3ms, 372µs, 907ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 294µs, 565ns | 1ms, 257µs, 896ns | 1ms, 505µs, 851ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 220µs, 272ns | 100ms, 752µs, 115ns | 115ms, 411µs, 996ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 175µs, 379ns | 1ms, 147µs, 31ns | 1ms, 220µs, 941ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 151µs, 12ns | 2ms, 47µs, 61ns | 2ms, 851µs, 9ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 513µs, 671ns | 1ms, 382µs, 827ns | 2ms, 315µs, 998ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 206ms, 430µs, 172ns | 1s, 934ms, 41µs, 976ns | 3s, 570ms, 835µs, 828ns |
| Ray-di(Reflection, Transient) | ^2.16 | 388ms, 523µs, 817ns | 344ms, 739µs, 913ns | 403ms, 278µs, 112ns |
| Symfony(Compiled, Singleton) | ^7.0 | 791µs, 740ns | 753µs, 879ns | 818µs, 14ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 919µs, 985ns | 746µs, 965ns | 2ms, 354µs, 860ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 861µs, 477ns | 689µs, 983ns | 2ms, 223µs, 968ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 528µs, 429ns | 1ms, 200µs, 914ns | 4ms, 370µs, 212ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 654µs, 958ns | 1ms, 603µs, 126ns | 1ms, 828µs, 908ns |
| Dice(Configured, Singleton) | ^4.0 | 830µs, 125ns | 810µs, 861ns | 844µs, 1ns |
| Laravel(Configured, Transient) | ^12.28 | 372ms, 909µs, 235ns | 326ms, 984µs, 882ns | 383ms, 855µs, 104ns |
| League(Configured, Transient) | ^5.1 | 4s, 171ms, 102µs, 643ns | 3s, 427ms, 160µs, 24ns | 4s, 399ms, 461µs, 984ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 148µs, 6ns | 3ms, 828µs, 48ns | 5ms, 578µs, 994ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 989µs, 505ns | 3ms, 921µs, 31ns | 4ms, 87µs, 924ns |
| Phalcon(Configured, Transient) | ^5 | 299ms, 771µs, 94ns | 292ms, 546µs, 987ns | 312ms, 268µs, 972ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 405µs, 143ns | 1ms, 255µs, 35ns | 2ms, 216µs, 815ns |
| Pimple(Configured, Transient) | ^3.5 | 105ms, 556µs, 440ns | 102ms, 258µs, 920ns | 127ms, 78µs, 56ns |
| Quickly(Compiled, Singleton) | dev-master | 874µs, 900ns | 746µs, 11ns | 1ms, 147µs, 31ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 885µs, 292ns | 3ms, 745µs, 79ns | 7ms, 681µs, 846ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 401ms, 9µs, 202ns | 1s, 930ms, 211µs, 67ns | 3s, 615ms, 411µs, 996ns |
| Symfony(Compiled, Singleton) | ^7.0 | 751µs, 447ns | 735µs, 998ns | 784µs, 158ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 845µs, 3ns | 790µs, 119ns | 1ms, 117µs, 944ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 891µs, 494ns | 814µs, 914ns | 1ms, 471µs, 996ns |
| Zen(Compiled, Singleton) | ^3.1 | 849µs, 80ns | 740µs, 51ns | 1ms, 602µs, 888ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 994µs, 895ns | 1ms, 675µs, 844ns | 3ms, 208µs, 875ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 885µs, 175ns | 1ms, 791µs, 954ns | 2ms, 175µs, 807ns |
| Laravel(Configured, Transient) | ^12.28 | 382ms, 25µs, 527ns | 376ms, 226µs, 902ns | 387ms, 992µs, 143ns |
| League(Configured, Transient) | ^5.1 | 4s, 121ms, 144µs, 175ns | 3s, 409ms, 929µs, 990ns | 4s, 703ms, 519µs, 105ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 13µs, 346ns | 3ms, 773µs, 212ns | 8ms, 457µs, 899ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 911µs, 733ns | 3ms, 732µs, 919ns | 4ms, 104µs, 137ns |
| Phalcon(Configured, Transient) | ^5 | 291ms, 636µs, 872ns | 263ms, 877µs, 868ns | 309ms, 882µs, 879ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 310µs, 443ns | 1ms, 260µs, 995ns | 1ms, 542µs, 91ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 188µs, 276ns | 94ms, 999µs, 74ns | 125ms, 211µs, 954ns |
| Quickly(Compiled, Singleton) | dev-master | 806µs, 546ns | 787µs, 19ns | 850µs, 915ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 600µs, 334ns | 4ms, 458µs, 189ns | 5ms, 355µs, 119ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 226ms, 768µs, 898ns | 1s, 941ms, 626µs, 71ns | 3s, 592ms, 634µs, 916ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 329µs, 922ns | 1ms, 306µs, 772ns | 1ms, 360µs, 893ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 103µs, 925ns | 870µs, 943ns | 2ms, 882µs, 3ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 79µs, 916ns | 859µs, 975ns | 2ms, 945µs, 184ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 23µs, 340ns | 782µs, 12ns | 2ms, 823µs, 114ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 214µs, 262ns | 4ms, 616µs, 22ns | 5ms, 676µs, 31ns |
| Dice(Configured, Singleton) | ^4.0 | 869µs, 846ns | 803µs, 947ns | 902µs, 175ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 141ms, 92µs, 181ns | 8s, 916ms, 231µs, 155ns | 10s, 487ms, 575µs, 54ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 247µs, 262ns | 1ms, 189µs, 947ns | 1ms, 464µs, 843ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 992µs, 486ns | 3ms, 551µs, 959ns | 6ms, 781µs, 101ns |
| Laravel(Reflection, Transient) | ^12.28 | 89s, 927ms, 776µs, 169ns | 88s, 594ms, 589µs, 948ns | 91s, 542ms, 80µs, 163ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 456µs, 783ns | 3ms, 390µs, 73ns | 3ms, 786µs, 802ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 221µs, 606ns | 3ms, 513µs, 97ns | 5ms, 893µs, 945ns |
| Php-baseline |  | 625µs, 300ns | 502µs, 109ns | 839µs, 948ns |
| Php-di(Reflection, Singleton) | ^7.0 | 744µs, 104ns | 692µs, 129ns | 1ms, 46µs, 895ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 248µs, 191ns | 2ms, 226µs, 114ns | 2ms, 294µs, 778ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 880ms, 583µs, 977ns | 13s, 71ms, 375µs, 846ns | 14s, 133ms, 695µs, 840ns |
| Quickly(Compiled, Singleton) | dev-master | 830µs, 483ns | 819µs, 921ns | 841µs, 140ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 191µs, 829ns | 1ms, 638µs, 889ns | 2ms, 290µs, 964ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 439µs, 285ns | 1ms, 369µs, 953ns | 1ms, 602µs, 888ns |
| Symfony(Compiled, Singleton) | ^7.0 | 802µs, 516ns | 792µs, 26ns | 833µs, 988ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 849µs, 390ns | 797µs, 33ns | 1ms, 199µs, 960ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 871µs, 849ns | 789µs, 880ns | 1ms, 442µs, 909ns |
| Zen(Compiled, Singleton) | ^3.1 | 843µs, 119ns | 746µs, 965ns | 1ms, 481µs, 56ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 796µs, 96ns | 5ms, 659µs, 103ns | 12ms, 701µs, 988ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 154µs, 493ns | 1ms, 888µs, 990ns | 2ms, 289µs, 56ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 877ms, 265µs, 691ns | 8s, 941ms, 293µs, 954ns | 10s, 371ms, 973µs, 991ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 973µs, 33ns | 838µs, 994ns | 1ms, 996µs, 994ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 461µs, 478ns | 3ms, 972µs, 53ns | 8ms, 490µs, 85ns |
| Laravel(Reflection, Transient) | ^12.28 | 89s, 641ms, 551µs, 303ns | 88s, 842ms, 554µs, 92ns | 90s, 926ms, 797µs, 866ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 460µs, 97ns | 3ms, 397µs, 941ns | 3ms, 773µs, 927ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 638µs, 242ns | 4ms, 124µs, 879ns | 8ms, 332µs, 14ns |
| Php-baseline |  | 625µs, 562ns | 562µs, 191ns | 767µs, 946ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 138µs, 401ns | 874µs, 996ns | 3ms, 244µs, 161ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 376µs, 914ns | 1ms, 317µs, 977ns | 1ms, 611µs, 948ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 943ms, 566µs, 489ns | 13s, 93ms, 698µs, 978ns | 14s, 383ms, 615µs, 970ns |
| Quickly(Compiled, Singleton) | dev-master | 801µs, 229ns | 769µs, 853ns | 849µs, 962ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 118µs, 86ns | 2ms, 22µs, 27ns | 2ms, 806µs, 901ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 568µs, 245ns | 1ms, 430µs, 34ns | 2ms, 269µs, 29ns |
| Symfony(Compiled, Singleton) | ^7.0 | 802µs, 63ns | 733µs, 137ns | 916µs, 4ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 141µs, 238ns | 927µs, 925ns | 2ms, 978µs, 86ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 132µs, 512ns | 921µs, 10ns | 2ms, 826µs, 929ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 73µs, 26ns | 841µs, 140ns | 2ms, 892µs, 17ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 820µs, 421ns | 1ms, 569µs, 986ns | 1ms, 903µs, 57ns |
| Dice(Configured, Singleton) | ^4.0 | 916µs, 886ns | 801µs, 86ns | 1ms, 389µs, 980ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 838µs, 109ns | 3ms, 776µs, 73ns | 4ms, 188µs, 60ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 782µs, 414ns | 3ms, 437µs, 42ns | 8ms, 55µs, 925ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 16µs, 20ns | 1ms, 3µs, 980ns | 1ms, 29µs, 14ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 246ms, 732µs, 854ns | 14s, 165ms, 546µs, 178ns | 14s, 345ms, 516µs, 920ns |
| Quickly(Compiled, Singleton) | dev-master | 801µs, 682ns | 782µs, 966ns | 833µs, 34ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 489µs, 613ns | 3ms, 457µs, 69ns | 3ms, 548µs, 860ns |
| Symfony(Compiled, Singleton) | ^7.0 | 794µs, 196ns | 771µs, 45ns | 808µs, 954ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 888µs, 299ns | 819µs, 921ns | 1ms, 188µs, 993ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 3µs, 909ns | 806µs, 808ns | 1ms, 897µs, 96ns |
| Zen(Compiled, Singleton) | ^3.1 | 831µs, 794ns | 747µs, 919ns | 1ms, 497µs, 983ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 443µs, 121ns | 2ms, 682µs, 924ns | 5ms, 495µs, 71ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 383µs, 17ns | 2ms, 160µs, 72ns | 3ms, 676µs, 891ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 895µs, 187ns | 3ms, 819µs, 942ns | 4ms, 266µs, 23ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 355µs, 1ns | 3ms, 634µs, 929ns | 5ms, 237µs, 102ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 404µs, 833ns | 1ms, 268µs, 148ns | 1ms, 891µs, 136ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 276ms, 388µs, 478ns | 14s, 144ms, 279µs, 956ns | 14s, 725ms, 458µs, 860ns |
| Quickly(Compiled, Singleton) | dev-master | 795µs, 626ns | 767µs, 946ns | 848µs, 54ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 694µs, 986ns | 4ms, 494µs, 905ns | 5ms, 395µs, 889ns |
| Symfony(Compiled, Singleton) | ^7.0 | 767µs, 87ns | 754µs, 117ns | 783µs, 920ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 183µs, 247ns | 942µs, 945ns | 3ms, 140µs, 926ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 828µs, 932ns | 1ms, 469µs, 135ns | 4ms, 523µs, 992ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 69µs, 593ns | 842µs, 94ns | 2ms, 853µs, 870ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 843µs, 119ns | 800µs, 132ns | 1ms, 16µs, 139ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 495µs, 502ns | 3ms, 396µs, 34ns | 3ms, 886µs, 938ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 353µs, 883ns | 1ms, 250µs, 28ns | 2ms, 135µs, 992ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 192µs, 163ns | 2ms, 170µs, 801ns | 2ms, 233µs, 28ns |
| Quickly(Compiled, Singleton) | dev-master | 783µs, 395ns | 751µs, 972ns | 856µs, 876ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 407µs, 599ns | 1ms, 384µs, 19ns | 1ms, 451µs, 15ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 418µs, 709ns | 1ms, 353µs, 25ns | 1ms, 579µs, 46ns |
| Symfony(Compiled, Singleton) | ^7.0 | 880µs, 122ns | 795µs, 125ns | 1ms, 261µs, 949ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 861µs, 787ns | 795µs, 125ns | 1ms, 218µs, 80ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 978µs, 326ns | 784µs, 873ns | 1ms, 499µs, 176ns |
| Zen(Compiled, Singleton) | ^3.1 | 840µs, 997ns | 751µs, 18ns | 1ms, 494µs, 169ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 63µs, 776ns | 911µs, 951ns | 2ms, 84µs, 16ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 564µs, 310ns | 3ms, 495µs, 931ns | 3ms, 982µs, 67ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 232µs, 385ns | 979µs, 900ns | 3ms, 299µs, 951ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 414µs, 608ns | 2ms, 353µs, 191ns | 2ms, 726µs, 78ns |
| Quickly(Compiled, Singleton) | dev-master | 807µs, 714ns | 799µs, 179ns | 823µs, 974ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 154µs, 588ns | 2ms, 35µs, 856ns | 2ms, 926µs, 826ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 609µs, 802ns | 1ms, 487µs, 16ns | 2ms, 346µs, 38ns |
| Symfony(Compiled, Singleton) | ^7.0 | 817µs, 704ns | 802µs, 40ns | 833µs, 988ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 373µs, 791ns | 1ms, 40µs, 935ns | 4ms, 256µs, 963ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 176µs, 309ns | 905µs, 36ns | 2ms, 991µs, 914ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 120µs, 758ns | 885µs, 9ns | 2ms, 912µs, 44ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 823µs, 900ns | 3ms, 726µs, 959ns | 4ms, 173µs, 40ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 245µs, 546ns | 1ms, 209µs, 20ns | 1ms, 279µs, 115ns |
| Quickly(Compiled, Singleton) | dev-master | 799µs, 489ns | 780µs, 105ns | 826µs, 835ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 915µs, 405ns | 3ms, 865µs, 3ns | 4ms, 51µs, 208ns |
| Symfony(Compiled, Singleton) | ^7.0 | 799µs, 894ns | 773µs, 906ns | 821µs, 113ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 704µs, 145ns | 656µs, 843ns | 988µs, 960ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 911µs, 712ns | 812µs, 53ns | 1ms, 640µs, 81ns |
| Zen(Compiled, Singleton) | ^3.1 | 846µs, 290ns | 754µs, 833ns | 1ms, 542µs, 806ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 960µs, 633ns | 3ms, 770µs, 112ns | 5ms, 30µs, 155ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 387µs, 834ns | 1ms, 298µs, 904ns | 1ms, 622µs, 200ns |
| Quickly(Compiled, Singleton) | dev-master | 821µs, 89ns | 797µs, 986ns | 869µs, 989ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 696µs, 917ns | 4ms, 473µs, 924ns | 5ms, 401µs, 134ns |
| Symfony(Compiled, Singleton) | ^7.0 | 820µs, 755ns | 803µs, 947ns | 851µs, 869ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 986µs, 27ns | 812µs, 53ns | 2ms, 439µs, 22ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 215µs, 52ns | 958µs, 919ns | 3ms, 39µs, 836ns |
| Zen(Compiled, Singleton) | ^3.1 | 894µs, 69ns | 730µs, 991ns | 2ms, 202µs, 33ns |

</details>

Questions, issues, and new containers are welcome!
