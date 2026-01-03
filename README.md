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
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 688µs, 838ns | 1ms, 604µs, 80ns | 1ms, 882µs, 76ns |
| Auryn(Reflection, Transient) | ^1.4 | 397ms, 838µs, 521ns | 359ms, 457µs, 15ns | 427ms, 487µs, 134ns |
| Dice(Configured, Singleton) | ^4.0 | 835µs, 633ns | 797µs, 986ns | 953µs, 912ns |
| Dice(Reflection, Transient) | ^4.0 | 68ms, 849µs, 730ns | 63ms, 927µs, 888ns | 74ms, 485µs, 63ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 782µs, 990ns | 749µs, 111ns | 838µs, 994ns |
| Laravel(Configured, Transient) | ^12.28 | 398ms, 935µs, 484ns | 345ms, 746µs, 40ns | 411ms, 448µs, 955ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 391µs, 503ns | 3ms, 336µs, 906ns | 6ms, 657µs, 123ns |
| Laravel(Reflection, Transient) | ^12.28 | 585ms, 418µs, 820ns | 536ms, 715µs, 984ns | 630ms, 549µs, 907ns |
| League(Configured, Transient) | ^5.1 | 879ms, 811µs, 215ns | 866ms, 217µs, 136ns | 901ms, 334µs, 47ns |
| League(Reflection, Transient) | ^5.1 | 656ms, 49µs, 895ns | 557ms, 304µs, 859ns | 681ms, 627µs, 35ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 403µs, 830ns | 3ms, 319µs, 978ns | 3ms, 806µs, 114ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 985µs, 524ns | 3ms, 878µs, 116ns | 4ms, 383µs, 87ns |
| Phalcon(Configured, Transient) | ^5 | 296ms, 421µs, 3ns | 257ms, 248µs, 163ns | 326ms, 673µs, 984ns |
| Php-baseline |  | 610µs, 208ns | 582µs, 933ns | 663µs, 42ns |
| Php-di(Reflection, Singleton) | ^7.0 | 855µs, 374ns | 809µs, 907ns | 1ms, 188µs, 993ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 181µs, 339ns | 2ms, 160µs, 72ns | 2ms, 214µs, 908ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 612µs, 69ns | 94ms, 130µs, 992ns | 113ms, 862µs, 37ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 147µs, 723ns | 1ms, 134µs, 872ns | 1ms, 183µs, 986ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 423µs, 954ns | 1ms, 322µs, 984ns | 2ms, 25µs, 842ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 72µs, 883ns | 1ms, 49µs, 41ns | 1ms, 170µs, 873ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 375ms, 999µs, 808ns | 1s, 924ms, 891µs, 948ns | 3s, 606ms, 768µs, 131ns |
| Ray-di(Reflection, Transient) | ^2.16 | 383ms, 943µs, 247ns | 349ms, 242µs, 925ns | 405ms, 219µs, 78ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 212µs, 501ns | 815µs, 868ns | 1ms, 282µs, 930ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 814µs, 270ns | 768µs, 899ns | 1ms, 139µs, 163ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 916µs, 695ns | 837µs, 87ns | 1ms, 458µs, 168ns |
| Zen(Compiled, Singleton) | ^3.1 | 847µs, 864ns | 768µs, 899ns | 1ms, 421µs, 213ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 50µs, 876ns | 1ms, 722µs, 97ns | 3ms, 248µs, 929ns |
| Auryn(Reflection, Transient) | ^1.4 | 404ms, 803µs, 371ns | 366ms, 631µs, 31ns | 413ms, 118µs, 124ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 916µs, 384ns | 1ms, 775µs, 979ns | 2ms, 227µs, 67ns |
| Dice(Reflection, Transient) | ^4.0 | 72ms, 232µs, 413ns | 71ms, 720µs, 123ns | 72ms, 814µs, 941ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 469µs, 111ns | 1ms, 279µs, 115ns | 2ms, 934µs, 932ns |
| Laravel(Configured, Transient) | ^12.28 | 399ms, 706µs, 482ns | 343ms, 712µs, 91ns | 432ms, 846µs, 69ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 676µs, 199ns | 3ms, 368µs, 854ns | 4ms, 751µs, 205ns |
| Laravel(Reflection, Transient) | ^12.28 | 633ms, 939µs, 790ns | 625ms, 241µs, 994ns | 645ms, 249µs, 843ns |
| League(Configured, Transient) | ^5.1 | 858ms, 239µs, 483ns | 698ms, 277µs, 950ns | 889ms, 365µs, 911ns |
| League(Reflection, Transient) | ^5.1 | 671ms, 787µs, 47ns | 658ms, 375µs, 978ns | 699ms, 837µs, 207ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 451µs, 85ns | 3ms, 391µs, 27ns | 3ms, 793µs, 1ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 159µs, 188ns | 4ms, 90µs, 70ns | 4ms, 292µs, 11ns |
| Phalcon(Configured, Transient) | ^5 | 302ms, 373µs, 75ns | 294ms, 829µs, 845ns | 310ms, 339µs, 927ns |
| Php-baseline |  | 601µs, 243ns | 580µs, 72ns | 629µs, 901ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 103µs, 401ns | 833µs, 34ns | 3ms, 154µs, 39ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 361µs, 130ns | 2ms, 271µs, 890ns | 2ms, 710µs, 103ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 768µs, 779ns | 100ms, 383µs, 43ns | 105ms, 208µs, 158ns |
| Quickly(Compiled, Singleton) | dev-master | 867µs, 223ns | 823µs, 20ns | 992µs, 59ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 120µs, 351ns | 2ms, 2µs | 2ms, 875µs, 804ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 454µs, 615ns | 1ms, 353µs, 979ns | 2ms, 196µs, 788ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 574ms, 948µs, 382ns | 3s, 474ms, 550µs, 8ns | 3s, 796ms, 537µs, 876ns |
| Ray-di(Reflection, Transient) | ^2.16 | 396ms, 151µs, 518ns | 390ms, 197µs, 38ns | 402ms, 498µs, 6ns |
| Symfony(Compiled, Singleton) | ^7.0 | 791µs, 335ns | 758µs, 886ns | 841µs, 140ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 132µs, 106ns | 908µs, 851ns | 3ms, 4µs, 74ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 61µs, 34ns | 837µs, 87ns | 2ms, 802µs, 133ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 510µs, 429ns | 1ms, 194µs, 953ns | 4ms, 148µs, 6ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 654µs, 76ns | 1ms, 578µs, 92ns | 1ms, 756µs, 191ns |
| Dice(Configured, Singleton) | ^4.0 | 854µs, 945ns | 821µs, 113ns | 985µs, 145ns |
| Laravel(Configured, Transient) | ^12.28 | 385ms, 70µs, 13ns | 373ms, 453µs, 140ns | 407ms, 186µs, 31ns |
| League(Configured, Transient) | ^5.1 | 4s, 178ms, 515µs, 267ns | 3s, 422ms, 203µs, 63ns | 4s, 503ms, 358µs, 840ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 841µs, 328ns | 3ms, 767µs, 13ns | 4ms, 163µs, 26ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 928µs, 709ns | 3ms, 848µs, 791ns | 3ms, 999µs, 948ns |
| Phalcon(Configured, Transient) | ^5 | 291ms, 397µs, 356ns | 259ms, 526µs, 14ns | 311ms, 759µs, 948ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 266µs, 360ns | 1ms, 212µs, 120ns | 1ms, 297µs, 950ns |
| Pimple(Configured, Transient) | ^3.5 | 108ms, 332µs, 228ns | 103ms, 788µs, 852ns | 141ms, 36µs, 33ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 152µs, 205ns | 1ms, 130µs, 104ns | 1ms, 186µs, 132ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 801µs, 608ns | 3ms, 746µs, 32ns | 3ms, 836µs, 154ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 558ms, 539µs, 414ns | 3s, 494ms, 10µs, 925ns | 3s, 614ms, 623µs, 69ns |
| Symfony(Compiled, Singleton) | ^7.0 | 784µs, 301ns | 746µs, 965ns | 978µs, 946ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 346µs, 325ns | 1ms, 275µs, 62ns | 1ms, 852µs, 989ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 738µs, 477ns | 658µs, 988ns | 1ms, 226µs, 902ns |
| Zen(Compiled, Singleton) | ^3.1 | 844µs, 717ns | 759µs, 124ns | 1ms, 471µs, 42ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 46µs, 203ns | 1ms, 717µs, 90ns | 3ms, 211µs, 21ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 883µs, 387ns | 1ms, 775µs, 26ns | 2ms, 204µs, 895ns |
| Laravel(Configured, Transient) | ^12.28 | 378ms, 853µs, 702ns | 372ms, 961µs, 44ns | 389ms, 779µs, 90ns |
| League(Configured, Transient) | ^5.1 | 4s, 191ms, 510µs, 701ns | 3s, 387ms, 356µs, 996ns | 4s, 523ms, 61µs, 37ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 919µs, 649ns | 3ms, 857µs, 135ns | 4ms, 297µs, 18ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 60µs, 673ns | 3ms, 986µs, 835ns | 4ms, 180µs, 908ns |
| Phalcon(Configured, Transient) | ^5 | 296ms, 666µs, 169ns | 258ms, 141µs, 994ns | 322ms, 650µs, 909ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 348µs, 519ns | 1ms, 287µs, 937ns | 1ms, 620µs, 54ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 915µs, 23ns | 102ms, 924µs, 108ns | 105ms, 608µs, 940ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 137µs, 661ns | 1ms, 65µs, 15ns | 1ms, 168µs, 966ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 226µs, 778ns | 4ms, 502µs, 58ns | 8ms, 657µs, 932ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 561ms, 693µs, 429ns | 3s, 529ms, 599µs, 189ns | 3s, 639ms, 151µs, 96ns |
| Symfony(Compiled, Singleton) | ^7.0 | 767µs, 207ns | 743µs, 865ns | 795µs, 125ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 924µs, 444ns | 755µs, 786ns | 2ms, 323µs, 150ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 84µs, 446ns | 869µs, 989ns | 2ms, 921µs, 104ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 66µs, 827ns | 833µs, 34ns | 2ms, 962µs, 112ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 736µs, 970ns | 4ms, 674µs, 911ns | 9ms, 572µs, 982ns |
| Dice(Configured, Singleton) | ^4.0 | 840µs, 425ns | 749µs, 111ns | 961µs, 65ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 183ms, 661µs, 746ns | 8s, 948ms, 431µs, 15ns | 10s, 503ms, 530µs, 25ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 809µs, 192ns | 778µs, 913ns | 910µs, 997ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 644µs, 728ns | 3ms, 535µs, 985ns | 3ms, 776µs, 73ns |
| Laravel(Reflection, Transient) | ^12.28 | 87s, 975ms, 500µs, 607ns | 74s, 868ms, 211µs, 984ns | 90s, 62ms, 958µs, 955ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 516µs, 483ns | 3ms, 438µs, 949ns | 3ms, 901µs, 958ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 400µs, 300ns | 3ms, 427µs, 982ns | 8ms, 23µs, 23ns |
| Php-baseline |  | 595µs, 21ns | 489µs, 950ns | 674µs, 9ns |
| Php-di(Reflection, Singleton) | ^7.0 | 775µs, 432ns | 721µs, 216ns | 1ms, 81µs, 943ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 292µs, 395ns | 1ms, 266µs, 2ns | 1ms, 312µs, 971ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 875ms, 543µs, 785ns | 13s, 76ms, 532µs, 840ns | 14s, 286ms, 684µs, 989ns |
| Quickly(Compiled, Singleton) | dev-master | 730µs, 276ns | 694µs, 990ns | 849µs, 962ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 317µs, 714ns | 2ms, 251µs, 863ns | 2ms, 424µs, 955ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 131µs, 653ns | 1ms, 101µs, 16ns | 1ms, 216µs, 173ns |
| Symfony(Compiled, Singleton) | ^7.0 | 781µs, 607ns | 766µs, 38ns | 828µs, 27ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 844µs, 788ns | 788µs, 927ns | 1ms, 174µs, 926ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 870µs, 203ns | 787µs, 19ns | 1ms, 425µs, 27ns |
| Zen(Compiled, Singleton) | ^3.1 | 830µs, 78ns | 730µs, 37ns | 1ms, 513µs, 957ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 794µs, 738ns | 6ms, 653µs, 70ns | 7ms, 147µs, 73ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 231µs, 597ns | 1ms, 803µs, 159ns | 2ms, 815µs, 961ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 965ms, 3µs, 490ns | 8s, 931ms, 491µs, 136ns | 10s, 304ms, 693µs, 937ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 100µs, 349ns | 844µs, 1ns | 2ms, 41µs, 101ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 179µs, 238ns | 4ms, 745µs, 6ns | 8ms, 417µs, 129ns |
| Laravel(Reflection, Transient) | ^12.28 | 90s, 361ms, 871µs, 504ns | 88s, 963ms, 247µs, 60ns | 95s, 315ms, 88µs, 987ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 580µs, 689ns | 3ms, 367µs, 900ns | 4ms, 227µs, 876ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 640µs, 364ns | 4ms, 144µs, 906ns | 8ms, 268µs, 833ns |
| Php-baseline |  | 619µs, 530ns | 458µs, 955ns | 838µs, 994ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 164µs, 7ns | 882µs, 148ns | 3ms, 190µs, 994ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 385µs, 617ns | 1ms, 336µs, 97ns | 1ms, 622µs, 200ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 835ms, 163µs, 283ns | 13s, 62ms, 17µs, 917ns | 14s, 136ms, 721µs, 134ns |
| Quickly(Compiled, Singleton) | dev-master | 803µs, 804ns | 794µs, 887ns | 841µs, 856ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 137µs, 541ns | 2ms, 24µs, 173ns | 2ms, 804µs, 40ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 528µs, 716ns | 1ms, 406µs, 908ns | 2ms, 289µs, 56ns |
| Symfony(Compiled, Singleton) | ^7.0 | 807µs, 94ns | 782µs, 966ns | 828µs, 981ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 157µs, 283ns | 931µs, 978ns | 2ms, 995µs, 14ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 103µs, 997ns | 880µs, 956ns | 2ms, 871µs, 36ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 67µs, 662ns | 834µs, 941ns | 2ms, 892µs, 971ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 962µs, 232ns | 1ms, 776µs, 933ns | 3ms, 257µs, 989ns |
| Dice(Configured, Singleton) | ^4.0 | 992µs, 798ns | 859µs, 975ns | 1ms, 469µs, 135ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 916µs, 335ns | 3ms, 803µs, 14ns | 4ms, 326µs, 105ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 935µs, 980ns | 3ms, 409µs, 147ns | 4ms, 208µs, 87ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 25µs, 104ns | 1ms, 12µs, 86ns | 1ms, 54µs, 48ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 19ms, 391µs, 226ns | 13s, 105ms, 773µs, 925ns | 14s, 382ms, 932µs, 901ns |
| Quickly(Compiled, Singleton) | dev-master | 793µs, 313ns | 777µs, 6ns | 828µs, 981ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 982µs, 186ns | 3ms, 873µs, 109ns | 4ms, 354µs |
| Symfony(Compiled, Singleton) | ^7.0 | 663µs, 447ns | 637µs, 54ns | 714µs, 63ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 877µs, 714ns | 828µs, 981ns | 1ms, 194µs, 953ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 894µs, 21ns | 786µs, 781ns | 1ms, 520µs, 872ns |
| Zen(Compiled, Singleton) | ^3.1 | 833µs, 988ns | 746µs, 11ns | 1ms, 488µs, 924ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 603µs, 529ns | 2ms, 656µs, 936ns | 5ms, 471µs, 944ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 179µs, 908ns | 1ms, 885µs, 890ns | 2ms, 379µs, 894ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 874µs, 373ns | 3ms, 822µs, 88ns | 4ms, 184µs, 961ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 185µs, 461ns | 3ms, 851µs, 890ns | 4ms, 570µs, 960ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 341µs, 342ns | 1ms, 289µs, 129ns | 1ms, 577µs, 138ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 178ms, 607µs, 797ns | 13s, 114ms, 582µs, 61ns | 14s, 599ms, 694µs, 967ns |
| Quickly(Compiled, Singleton) | dev-master | 798µs, 487ns | 766µs, 992ns | 914µs, 96ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 637µs, 50ns | 4ms, 456µs, 996ns | 5ms, 297µs, 899ns |
| Symfony(Compiled, Singleton) | ^7.0 | 796µs, 818ns | 778µs, 913ns | 832µs, 80ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 142µs, 215ns | 921µs, 964ns | 3ms, 30µs, 61ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 101µs, 279ns | 868µs, 82ns | 2ms, 884µs, 864ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 315µs, 116ns | 869µs, 35ns | 2ms, 815µs, 8ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 818µs, 777ns | 771µs, 999ns | 965µs, 833ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 416µs, 204ns | 3ms, 359µs, 79ns | 3ms, 789µs, 901ns |
| Php-di(Reflection, Singleton) | ^7.0 | 855µs, 278ns | 791µs, 72ns | 1ms, 308µs, 917ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 245µs, 21ns | 1ms, 221µs, 179ns | 1ms, 283µs, 884ns |
| Quickly(Compiled, Singleton) | dev-master | 813µs, 484ns | 760µs, 78ns | 881µs, 195ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 408µs, 720ns | 1ms, 348µs, 18ns | 1ms, 451µs, 15ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 129µs, 817ns | 1ms, 91µs, 957ns | 1ms, 299µs, 142ns |
| Symfony(Compiled, Singleton) | ^7.0 | 827µs, 598ns | 796µs, 79ns | 880µs, 2ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 369µs, 905ns | 1ms, 284µs, 837ns | 1ms, 950µs, 979ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 871µs, 205ns | 792µs, 980ns | 1ms, 471µs, 42ns |
| Zen(Compiled, Singleton) | ^3.1 | 667µs, 762ns | 596µs, 46ns | 1ms, 189µs, 947ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 736µs, 712ns | 1ms, 530µs, 170ns | 3ms, 299µs, 951ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 483µs, 486ns | 3ms, 403µs, 902ns | 3ms, 880µs, 23ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 222µs, 229ns | 960µs, 111ns | 3ms, 513µs, 97ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 350µs, 641ns | 1ms, 291µs, 990ns | 1ms, 577µs, 138ns |
| Quickly(Compiled, Singleton) | dev-master | 817µs, 775ns | 804µs, 901ns | 839µs, 948ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 158µs, 904ns | 2ms, 53µs, 976ns | 2ms, 841µs, 949ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 619µs, 362ns | 1ms, 497µs, 30ns | 2ms, 354µs, 860ns |
| Symfony(Compiled, Singleton) | ^7.0 | 644µs, 111ns | 626µs, 802ns | 682µs, 115ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 145µs, 124ns | 895µs, 977ns | 3ms, 13µs, 849ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 155µs, 90ns | 932µs, 931ns | 2ms, 922µs, 58ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 142µs, 525ns | 901µs, 937ns | 2ms, 882µs, 3ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 79µs, 246ns | 3ms, 786µs, 87ns | 5ms, 196µs, 94ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 240µs, 944ns | 1ms, 217µs, 126ns | 1ms, 271µs, 963ns |
| Quickly(Compiled, Singleton) | dev-master | 800µs, 991ns | 771µs, 999ns | 824µs, 928ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 470µs, 921ns | 3ms, 446µs, 102ns | 3ms, 540µs, 39ns |
| Symfony(Compiled, Singleton) | ^7.0 | 818µs, 490ns | 782µs, 12ns | 872µs, 850ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 862µs, 145ns | 803µs, 947ns | 1ms, 236µs, 915ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 729µs, 584ns | 639µs, 915ns | 1ms, 343µs, 965ns |
| Zen(Compiled, Singleton) | ^3.1 | 663µs, 566ns | 581µs, 26ns | 1ms, 255µs, 989ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 218µs, 53ns | 3ms, 781µs, 80ns | 7ms, 540µs, 941ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 371µs, 502ns | 1ms, 282µs, 215ns | 1ms, 638µs, 889ns |
| Quickly(Compiled, Singleton) | dev-master | 795µs, 173ns | 783µs, 920ns | 816µs, 106ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 591µs, 178ns | 4ms, 455µs, 89ns | 5ms, 301µs, 952ns |
| Symfony(Compiled, Singleton) | ^7.0 | 829µs, 911ns | 763µs, 177ns | 1ms, 104µs, 116ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 187µs, 467ns | 957µs, 965ns | 3ms, 45µs, 797ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 169µs, 776ns | 940µs, 84ns | 3ms, 46µs, 989ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 734µs, 185ns | 1ms, 390µs, 933ns | 4ms, 565µs |

</details>

Questions, issues, and new containers are welcome!
