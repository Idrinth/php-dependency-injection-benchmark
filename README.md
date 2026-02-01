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

Run from 2026-02-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 561µs, 594ns | 1ms, 346µs, 111ns | 1ms, 860µs, 857ns |
| Auryn(Reflection, Transient) | ^1.4 | 409ms, 985µs, 613ns | 402ms, 314µs, 901ns | 439ms, 620µs, 971ns |
| Dice(Configured, Singleton) | ^4.0 | 825µs, 381ns | 799µs, 894ns | 844µs, 955ns |
| Dice(Reflection, Transient) | ^4.0 | 71ms, 710µs, 896ns | 70ms, 842µs, 27ns | 72ms, 80µs, 850ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 769µs, 805ns | 742µs, 912ns | 836µs, 133ns |
| Laravel(Configured, Transient) | ^12.28 | 402ms, 698µs, 779ns | 357ms, 173µs, 919ns | 455ms, 753µs, 803ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 462µs, 696ns | 3ms, 355µs, 26ns | 3ms, 653µs, 49ns |
| Laravel(Reflection, Transient) | ^12.28 | 627ms, 843µs, 308ns | 618ms, 289µs, 947ns | 640ms, 357µs, 971ns |
| League(Configured, Transient) | ^5.1 | 885ms, 80µs, 552ns | 876ms, 640µs, 796ns | 894ms, 550µs, 800ns |
| League(Reflection, Transient) | ^5.1 | 646ms, 271µs, 204ns | 542ms, 331µs, 218ns | 711ms, 156µs, 845ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 612µs, 709ns | 3ms, 179µs, 73ns | 5ms, 173µs, 921ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 697µs, 705ns | 3ms, 290µs, 891ns | 4ms, 101µs, 37ns |
| Phalcon(Configured, Transient) | ^5 | 283ms, 955µs, 621ns | 257ms, 385µs, 15ns | 297ms, 158µs, 2ns |
| Php-baseline |  | 467µs, 85ns | 447µs, 34ns | 494µs, 3ns |
| Php-di(Reflection, Singleton) | ^7.0 | 846µs, 910ns | 787µs, 19ns | 1ms, 170µs, 158ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 2µs, 717ns | 987µs, 52ns | 1ms, 19µs, 1ns |
| Pimple(Configured, Transient) | ^3.5 | 98ms, 431µs, 62ns | 94ms, 48µs, 976ns | 103ms, 173µs, 971ns |
| Quickly(Compiled, Singleton) | dev-master | 803µs, 995ns | 784µs, 158ns | 832µs, 796ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 382µs, 803ns | 1ms, 364µs, 946ns | 1ms, 405µs |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 393µs, 389ns | 1ms, 349µs, 925ns | 1ms, 496µs, 791ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 189ms, 805µs, 316ns | 1s, 900ms, 907µs, 993ns | 3s, 561ms, 408µs, 42ns |
| Ray-di(Reflection, Transient) | ^2.16 | 392ms, 905µs, 569ns | 386ms, 660µs, 814ns | 398ms, 84µs, 878ns |
| Symfony(Compiled, Singleton) | ^7.0 | 764µs, 322ns | 722µs, 885ns | 795µs, 125ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 837µs, 802ns | 790µs, 119ns | 1ms, 117µs, 944ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 863µs, 409ns | 797µs, 986ns | 1ms, 369µs, 953ns |
| Zen(Compiled, Singleton) | ^3.1 | 839µs, 304ns | 745µs, 58ns | 1ms, 434µs, 87ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 176µs, 856ns | 1ms, 842µs, 975ns | 3ms, 355µs, 26ns |
| Auryn(Reflection, Transient) | ^1.4 | 416ms, 642µs, 737ns | 399ms, 513µs, 6ns | 466ms, 234µs, 922ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 382µs, 779ns | 1ms, 471µs, 996ns | 3ms, 237µs, 962ns |
| Dice(Reflection, Transient) | ^4.0 | 73ms, 528µs, 671ns | 71ms, 640µs, 14ns | 77ms, 975µs, 988ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 922µs, 536ns | 779µs, 151ns | 1ms, 955µs, 986ns |
| Laravel(Configured, Transient) | ^12.28 | 399ms, 333µs, 95ns | 359ms, 44µs, 75ns | 421ms, 344µs, 41ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 750µs, 991ns | 3ms, 419µs, 876ns | 4ms, 866µs, 838ns |
| Laravel(Reflection, Transient) | ^12.28 | 626ms, 882µs, 529ns | 619ms, 571µs, 924ns | 635ms, 118µs, 961ns |
| League(Configured, Transient) | ^5.1 | 844ms, 830µs, 179ns | 692ms, 983µs, 865ns | 890ms, 83µs, 74ns |
| League(Reflection, Transient) | ^5.1 | 666ms, 406µs, 488ns | 652ms, 12µs, 109ns | 684ms, 631µs, 824ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 271µs, 842ns | 3ms, 190µs, 40ns | 3ms, 698µs, 825ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 826µs, 951ns | 3ms, 427µs, 982ns | 4ms, 253µs, 864ns |
| Phalcon(Configured, Transient) | ^5 | 307ms, 413µs, 554ns | 288ms, 107µs, 872ns | 345ms, 330µs, 953ns |
| Php-baseline |  | 722µs, 789ns | 571µs, 966ns | 854µs, 15ns |
| Php-di(Reflection, Singleton) | ^7.0 | 884µs, 795ns | 700µs, 950ns | 2ms, 428µs, 54ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 448µs, 607ns | 1ms, 322µs, 984ns | 1ms, 992µs, 940ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 996µs, 419ns | 101ms, 223µs, 945ns | 115ms, 93µs, 946ns |
| Quickly(Compiled, Singleton) | dev-master | 781µs, 941ns | 766µs, 992ns | 808µs |
| Quickly(Configured, Singleton) | dev-master | 2ms, 177µs, 524ns | 2ms, 82µs, 109ns | 2ms, 830µs, 982ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 466µs, 989ns | 1ms, 360µs, 893ns | 2ms, 264µs, 22ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 348ms, 953µs, 413ns | 1s, 925ms, 187µs, 110ns | 3s, 570ms, 600µs, 32ns |
| Ray-di(Reflection, Transient) | ^2.16 | 400ms, 773µs | 393ms, 543µs, 958ns | 413ms, 630µs, 8ns |
| Symfony(Compiled, Singleton) | ^7.0 | 772µs, 237ns | 749µs, 826ns | 804µs, 901ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 101µs, 493ns | 882µs, 863ns | 2ms, 919µs, 912ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 25µs, 748ns | 824µs, 928ns | 2ms, 728µs, 939ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 10µs, 155ns | 797µs, 986ns | 2ms, 806µs, 186ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 695µs, 156ns | 1ms, 636µs, 981ns | 1ms, 907µs, 110ns |
| Dice(Configured, Singleton) | ^4.0 | 865µs, 221ns | 797µs, 33ns | 1ms, 230µs, 955ns |
| Laravel(Configured, Transient) | ^12.28 | 372ms, 555µs, 375ns | 331ms, 222µs, 57ns | 392ms, 316µs, 818ns |
| League(Configured, Transient) | ^5.1 | 4s, 375ms, 98µs, 657ns | 4s, 268ms, 851µs, 995ns | 4s, 538ms, 156µs, 986ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 308µs, 390ns | 3ms, 658µs, 56ns | 6ms, 692µs, 886ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 964µs, 591ns | 3ms, 947µs, 19ns | 3ms, 993µs, 34ns |
| Phalcon(Configured, Transient) | ^5 | 295ms, 157µs, 384ns | 268ms, 454µs, 74ns | 309ms, 964µs, 179ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 249µs, 98ns | 1ms, 207µs, 113ns | 1ms, 333µs, 951ns |
| Pimple(Configured, Transient) | ^3.5 | 107ms, 251µs, 739ns | 102ms, 710µs, 8ns | 122ms, 888µs, 88ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 145µs, 958ns | 1ms, 133µs, 918ns | 1ms, 175µs, 880ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 810µs, 262ns | 3ms, 764µs, 867ns | 3ms, 859µs, 43ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 197ms, 802µs, 972ns | 1s, 932ms, 880µs, 878ns | 3s, 560ms, 961µs, 961ns |
| Symfony(Compiled, Singleton) | ^7.0 | 783µs, 157ns | 763µs, 893ns | 816µs, 822ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 208µs, 43ns | 817µs, 60ns | 1ms, 890µs, 897ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 891µs, 327ns | 771µs, 45ns | 1ms, 535µs, 177ns |
| Zen(Compiled, Singleton) | ^3.1 | 657µs, 320ns | 579µs, 118ns | 1ms, 151µs, 84ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 476µs, 906ns | 1ms, 796µs, 960ns | 3ms, 277µs, 63ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 856µs, 64ns | 1ms, 743µs, 78ns | 2ms, 191µs, 781ns |
| Laravel(Configured, Transient) | ^12.28 | 376ms, 798µs, 868ns | 337ms, 218µs, 46ns | 388ms, 385µs, 57ns |
| League(Configured, Transient) | ^5.1 | 4s, 195ms, 791µs, 602ns | 3s, 422ms, 39µs, 31ns | 4s, 489ms, 578µs, 8ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 709µs, 673ns | 3ms, 621µs, 101ns | 4ms, 106µs, 998ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 88µs, 544ns | 3ms, 981µs, 113ns | 4ms, 240µs, 989ns |
| Phalcon(Configured, Transient) | ^5 | 289ms, 161µs, 777ns | 256ms, 464µs, 4ns | 305ms, 544µs, 853ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 379µs, 656ns | 1ms, 322µs, 984ns | 1ms, 616µs, 954ns |
| Pimple(Configured, Transient) | ^3.5 | 106ms, 30µs, 368ns | 102ms, 885µs, 7ns | 117ms, 998µs, 123ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 683ns | 792µs, 980ns | 846µs, 147ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 610µs, 967ns | 4ms, 499µs, 912ns | 5ms, 262µs, 851ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 541ms, 578µs, 578ns | 3s, 474ms, 148µs, 988ns | 3s, 611ms, 6µs, 21ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 238µs, 989ns | 907µs, 897ns | 1ms, 318µs, 931ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 96µs, 81ns | 869µs, 989ns | 2ms, 932µs, 71ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 61µs, 10ns | 851µs, 869ns | 2ms, 881µs, 50ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 565µs, 599ns | 1ms, 230µs, 955ns | 4ms, 385µs, 948ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 955µs, 289ns | 5ms, 369µs, 901ns | 10ms, 962µs, 963ns |
| Dice(Configured, Singleton) | ^4.0 | 920µs, 534ns | 761µs, 985ns | 1ms, 521µs, 110ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 106ms, 295µs, 871ns | 8s, 651ms, 894µs, 92ns | 10s, 471ms, 652µs, 984ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 701µs, 832ns | 672µs, 101ns | 777µs, 6ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 781µs, 795ns | 3ms, 46µs, 989ns | 5ms, 567µs, 73ns |
| Laravel(Reflection, Transient) | ^12.28 | 84s, 406ms, 329µs, 703ns | 73s, 456ms, 927µs, 61ns | 90s, 49ms, 412µs, 12ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 309µs, 202ns | 3ms, 226µs, 41ns | 3ms, 685µs, 951ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 163µs, 74ns | 4ms, 62µs, 891ns | 4ms, 390µs, 954ns |
| Php-baseline |  | 613µs, 784ns | 564µs, 813ns | 648µs, 21ns |
| Php-di(Reflection, Singleton) | ^7.0 | 865µs, 983ns | 816µs, 106ns | 1ms, 229µs, 47ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 382µs, 732ns | 1ms, 339µs, 912ns | 1ms, 537µs, 84ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 110ms, 715µs, 723ns | 13s, 131ms, 28µs, 890ns | 14s, 419ms, 728µs, 994ns |
| Quickly(Compiled, Singleton) | dev-master | 917µs, 887ns | 858µs, 68ns | 1ms, 91µs, 3ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 126µs, 337ns | 1ms, 111µs, 984ns | 1ms, 168µs, 966ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 142µs, 525ns | 1ms, 112µs, 937ns | 1ms, 239µs, 776ns |
| Symfony(Compiled, Singleton) | ^7.0 | 753µs, 188ns | 727µs, 891ns | 808µs |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 845µs, 503ns | 792µs, 980ns | 1ms, 156µs, 91ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 848µs, 793ns | 777µs, 959ns | 1ms, 398µs, 86ns |
| Zen(Compiled, Singleton) | ^3.1 | 677µs, 204ns | 604µs, 152ns | 1ms, 161µs, 813ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 721µs, 854ns | 5ms, 737µs, 66ns | 6ms, 924µs, 867ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 229µs, 356ns | 2ms, 172µs, 946ns | 2ms, 354µs, 860ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 246ms, 450µs, 662ns | 10s, 108ms, 103µs, 990ns | 10s, 559ms, 924µs, 125ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 51µs, 783ns | 877µs, 857ns | 2ms, 499µs, 103ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 129µs, 694ns | 3ms, 971µs, 99ns | 6ms, 788µs, 969ns |
| Laravel(Reflection, Transient) | ^12.28 | 84s, 590ms, 886µs, 402ns | 73s, 923ms, 552µs, 989ns | 90s, 32ms, 896µs, 995ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 399µs, 729ns | 3ms, 164µs, 52ns | 4ms, 131µs, 78ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 67µs, 610ns | 4ms, 193µs, 67ns | 8ms, 262µs, 157ns |
| Php-baseline |  | 668µs, 120ns | 498µs, 56ns | 916µs, 4ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 148µs, 867ns | 898µs, 122ns | 3ms, 149µs, 32ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 107µs, 692ns | 1ms, 43µs, 81ns | 1ms, 260µs, 995ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 236ms, 616µs, 587ns | 13s, 96ms, 54µs, 77ns | 14s, 449ms, 702µs, 978ns |
| Quickly(Compiled, Singleton) | dev-master | 833µs, 749ns | 814µs, 914ns | 862µs, 836ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 189µs, 421ns | 2ms, 67µs, 89ns | 2ms, 887µs, 964ns |
| Quickly(Reflection, Singleton) | dev-master | 2ms, 631µs, 330ns | 2ms, 436µs, 161ns | 3ms, 818µs, 988ns |
| Symfony(Compiled, Singleton) | ^7.0 | 799µs, 775ns | 776µs, 52ns | 819µs, 206ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 99µs, 348ns | 885µs, 963ns | 2ms, 915µs, 143ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 57µs, 219ns | 843µs, 48ns | 2ms, 797µs, 126ns |
| Zen(Compiled, Singleton) | ^3.1 | 815µs, 486ns | 653µs, 28ns | 2ms, 142µs, 906ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 831µs, 30ns | 1ms, 574µs, 993ns | 2ms, 72µs, 95ns |
| Dice(Configured, Singleton) | ^4.0 | 889µs, 778ns | 727µs, 891ns | 1ms, 461µs, 982ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 671µs, 646ns | 3ms, 607µs, 988ns | 4ms, 27µs, 843ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 387µs, 664ns | 3ms, 906µs, 11ns | 7ms, 505µs, 893ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 316µs, 46ns | 1ms, 268µs, 863ns | 1ms, 369µs, 953ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 219ms, 944µs, 977ns | 13s, 152ms, 631µs, 44ns | 14s, 572ms, 890µs, 43ns |
| Quickly(Compiled, Singleton) | dev-master | 973µs, 677ns | 762µs, 939ns | 1ms, 120µs, 805ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 850µs, 126ns | 3ms, 823µs, 41ns | 3ms, 885µs, 30ns |
| Symfony(Compiled, Singleton) | ^7.0 | 788µs, 784ns | 756µs, 25ns | 936µs, 985ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 845µs, 527ns | 775µs, 98ns | 1ms, 200µs, 914ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 899µs, 887ns | 782µs, 12ns | 1ms, 725µs, 912ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 222µs, 181ns | 1ms, 36µs, 882ns | 2ms, 352µs, 952ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 242µs, 492ns | 2ms, 610µs, 206ns | 3ms, 474µs, 950ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 364µs, 182ns | 2ms, 146µs, 5ns | 3ms, 917µs, 932ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 480µs, 815ns | 3ms, 339µs, 52ns | 3ms, 806µs, 114ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 238µs, 676ns | 4ms, 228µs, 115ns | 8ms, 255µs, 4ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 377µs, 129ns | 1ms, 319µs, 885ns | 1ms, 621µs, 961ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 292ms, 859µs, 125ns | 13s, 120ms, 226µs, 144ns | 14s, 523ms, 10µs, 969ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 110µs, 744ns | 820µs, 875ns | 1ms, 168µs, 12ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 711µs, 508ns | 4ms, 559µs, 40ns | 5ms, 468µs, 130ns |
| Symfony(Compiled, Singleton) | ^7.0 | 777µs, 220ns | 739µs, 97ns | 896µs, 930ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 201µs, 510ns | 959µs, 873ns | 3ms, 127µs, 98ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 107µs, 430ns | 887µs, 155ns | 2ms, 950µs, 191ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 130µs, 390ns | 868µs, 797ns | 2ms, 923µs, 965ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 773µs | 728µs, 845ns | 974µs, 893ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 306µs, 508ns | 3ms, 228µs, 187ns | 3ms, 715µs, 38ns |
| Php-di(Reflection, Singleton) | ^7.0 | 858µs, 879ns | 795µs, 841ns | 1ms, 289µs, 844ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 304µs, 292ns | 1ms, 277µs, 923ns | 1ms, 343µs, 11ns |
| Quickly(Compiled, Singleton) | dev-master | 778µs, 317ns | 760µs, 793ns | 791µs, 72ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 640µs, 391ns | 1ms, 394µs, 987ns | 2ms, 210µs, 140ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 408µs, 76ns | 1ms, 363µs, 992ns | 1ms, 693µs, 964ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 148µs, 581ns | 780µs, 820ns | 1ms, 300µs, 96ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 705µs, 432ns | 653µs, 28ns | 984µs, 191ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 735µs, 116ns | 667µs, 810ns | 1ms, 214µs, 27ns |
| Zen(Compiled, Singleton) | ^3.1 | 655µs, 603ns | 584µs, 125ns | 1ms, 188µs, 39ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 82µs, 897ns | 939µs, 130ns | 2ms, 166µs, 32ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 6ms, 403µs, 684ns | 3ms, 496µs, 885ns | 6ms, 979µs, 942ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 187µs, 753ns | 942µs, 945ns | 3ms, 221µs, 988ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 396µs, 322ns | 1ms, 367µs, 92ns | 1ms, 579µs, 46ns |
| Quickly(Compiled, Singleton) | dev-master | 805µs, 449ns | 789µs, 165ns | 844µs, 955ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 203µs, 655ns | 2ms, 102µs, 851ns | 2ms, 922µs, 773ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 703µs, 619ns | 1ms, 511µs, 96ns | 2ms, 541µs, 780ns |
| Symfony(Compiled, Singleton) | ^7.0 | 952µs, 625ns | 808µs, 954ns | 1ms, 338µs, 5ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 229µs, 858ns | 977µs, 993ns | 3ms, 294µs, 944ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 226µs, 949ns | 946µs, 998ns | 3ms, 287µs, 76ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 334µs, 118ns | 846µs, 147ns | 3ms, 148µs, 78ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 462µs, 313ns | 3ms, 546µs, 953ns | 8ms, 355µs, 140ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 303µs, 386ns | 1ms, 264µs, 810ns | 1ms, 377µs, 105ns |
| Quickly(Compiled, Singleton) | dev-master | 795µs, 412ns | 779µs, 151ns | 807µs, 46ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 799µs, 724ns | 3ms, 761µs, 53ns | 3ms, 866µs, 910ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 108µs, 2ns | 762µs, 939ns | 1ms, 356µs, 840ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 858µs, 378ns | 801µs, 86ns | 1ms, 232µs, 862ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 896µs, 501ns | 796µs, 79ns | 1ms, 615µs, 47ns |
| Zen(Compiled, Singleton) | ^3.1 | 861µs, 620ns | 748µs, 872ns | 1ms, 583µs, 814ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 735µs, 613ns | 3ms, 633µs, 975ns | 4ms, 189µs, 14ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 401µs, 591ns | 1ms, 322µs, 984ns | 1ms, 599µs, 788ns |
| Quickly(Compiled, Singleton) | dev-master | 792µs, 551ns | 766µs, 38ns | 832µs, 80ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 632µs, 496ns | 4ms, 513µs, 978ns | 5ms, 316µs, 19ns |
| Symfony(Compiled, Singleton) | ^7.0 | 809µs, 192ns | 779µs, 151ns | 881µs, 910ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 197µs, 171ns | 959µs, 873ns | 3ms, 53µs, 903ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 197µs, 290ns | 977µs, 39ns | 3ms, 51µs, 996ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 150µs, 369ns | 932µs, 931ns | 2ms, 900µs, 123ns |

</details>

Questions, issues, and new containers are welcome!
