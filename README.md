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

Run from 2026-05-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 537µs, 942ns | 1ms, 399µs, 40ns | 1ms, 778µs, 125ns |
| Auryn(Reflection, Transient) | ^1.4 | 376ms, 790µs, 857ns | 311ms, 770µs, 915ns | 417ms, 160µs, 987ns |
| Dice(Configured, Singleton) | ^4.0 | 817µs, 942ns | 796µs, 79ns | 849µs, 8ns |
| Dice(Reflection, Transient) | ^4.0 | 67ms, 21µs, 322ns | 62ms, 67µs, 31ns | 79ms, 408µs, 168ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 809µs, 192ns | 777µs, 6ns | 844µs, 955ns |
| Laravel(Configured, Transient) | ^12.28 | 407ms, 222µs, 366ns | 394ms, 670µs, 9ns | 420ms, 295µs, 953ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 702µs, 425ns | 3ms, 492µs, 116ns | 4ms, 37µs, 857ns |
| Laravel(Reflection, Transient) | ^12.28 | 535ms, 274µs, 815ns | 490ms, 230µs, 83ns | 581ms, 218µs, 957ns |
| League(Configured, Transient) | ^5.1 | 1s, 129ms, 524µs, 207ns | 983ms, 867µs, 883ns | 1s, 172ms, 700µs, 881ns |
| League(Reflection, Transient) | ^5.1 | 718ms, 537µs, 831ns | 678ms, 10µs, 940ns | 749ms, 279µs, 975ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 466µs, 343ns | 3ms, 355µs, 26ns | 3ms, 931µs, 999ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 137µs, 323ns | 5ms, 757µs, 93ns | 6ms, 628µs, 990ns |
| Phalcon(Configured, Transient) | ^5 | 345ms, 106µs, 339ns | 305ms, 58µs, 2ns | 376ms, 819µs, 849ns |
| Php-baseline |  | 545µs, 287ns | 463µs, 8ns | 617µs, 980ns |
| Php-di(Reflection, Singleton) | ^7.0 | 866µs, 317ns | 800µs, 848ns | 1ms, 240µs, 968ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 219µs, 916ns | 1ms, 183µs, 32ns | 1ms, 307µs, 10ns |
| Pimple(Configured, Transient) | ^3.5 | 97ms, 603µs, 392ns | 92ms, 442µs, 35ns | 102ms, 868µs, 795ns |
| Quickly(Compiled, Singleton) | dev-master | 773µs, 549ns | 766µs, 38ns | 791µs, 72ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 336µs, 50ns | 1ms, 310µs, 110ns | 1ms, 396µs, 179ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 356µs, 625ns | 1ms, 323µs, 938ns | 1ms, 431µs, 941ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 300ms, 560µs, 998ns | 2s, 28ms, 130µs, 54ns | 3s, 695ms, 921µs, 182ns |
| Ray-di(Reflection, Transient) | ^2.16 | 371ms, 210µs, 527ns | 303ms, 447µs, 961ns | 421ms, 818µs, 971ns |
| Symfony(Compiled, Singleton) | ^7.0 | 775µs, 122ns | 749µs, 111ns | 803µs, 947ns |
| Zen(Compiled, Singleton) | ^3.1 | 668µs, 978ns | 582µs, 933ns | 1ms, 143µs, 932ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 43µs, 819ns | 1ms, 698µs, 17ns | 3ms, 247µs, 976ns |
| Auryn(Reflection, Transient) | ^1.4 | 399ms, 681µs, 210ns | 353ms, 74µs, 73ns | 413ms, 868µs, 904ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 715µs, 469ns | 1ms, 446µs, 962ns | 2ms, 224µs, 922ns |
| Dice(Reflection, Transient) | ^4.0 | 67ms, 714µs, 238ns | 62ms, 26µs, 23ns | 73ms, 103µs, 904ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 956µs, 106ns | 804µs, 901ns | 2ms, 35µs, 140ns |
| Laravel(Configured, Transient) | ^12.28 | 391ms, 41µs, 731ns | 314ms, 286µs, 947ns | 436ms, 728µs, 954ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 765µs, 892ns | 3ms, 387µs, 928ns | 4ms, 967µs, 927ns |
| Laravel(Reflection, Transient) | ^12.28 | 574ms, 861µs, 431ns | 569ms, 112µs, 62ns | 581ms, 112µs, 146ns |
| League(Configured, Transient) | ^5.1 | 1s, 116ms, 135µs, 263ns | 970ms, 866µs, 918ns | 1s, 192ms, 648µs, 887ns |
| League(Reflection, Transient) | ^5.1 | 713ms, 507µs, 80ns | 680ms, 10µs, 80ns | 751ms, 662µs, 969ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 499µs, 817ns | 3ms, 430µs, 843ns | 3ms, 814µs, 935ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 594µs, 467ns | 6ms, 489µs, 992ns | 6ms, 858µs, 825ns |
| Phalcon(Configured, Transient) | ^5 | 342ms, 455µs, 196ns | 259ms, 516µs, 954ns | 362ms, 688µs, 64ns |
| Php-baseline |  | 593µs, 686ns | 561µs, 952ns | 633µs, 1ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 87µs, 355ns | 823µs, 974ns | 3ms, 214µs, 120ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 387µs, 834ns | 1ms, 334µs, 905ns | 1ms, 623µs, 153ns |
| Pimple(Configured, Transient) | ^3.5 | 96ms, 790µs, 194ns | 93ms, 60µs, 970ns | 99ms, 430µs, 84ns |
| Quickly(Compiled, Singleton) | dev-master | 603µs, 866ns | 586µs, 986ns | 633µs, 955ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 631µs, 593ns | 1ms, 544µs, 952ns | 2ms, 219µs, 200ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 210µs, 403ns | 1ms, 98µs, 871ns | 1ms, 834µs, 869ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 239ms, 373µs, 517ns | 2s, 44ms, 223µs, 70ns | 3s, 935ms, 992µs, 2ns |
| Ray-di(Reflection, Transient) | ^2.16 | 395ms, 173µs, 311ns | 360ms, 842µs, 943ns | 424ms, 833µs, 59ns |
| Symfony(Compiled, Singleton) | ^7.0 | 802µs, 445ns | 741µs, 958ns | 849µs, 962ns |
| Zen(Compiled, Singleton) | ^3.1 | 995µs, 850ns | 746µs, 11ns | 2ms, 774µs |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 621µs, 55ns | 1ms, 570µs, 940ns | 1ms, 750µs, 946ns |
| Dice(Configured, Singleton) | ^4.0 | 850µs, 653ns | 832µs, 796ns | 862µs, 836ns |
| Laravel(Configured, Transient) | ^12.28 | 370ms, 693µs, 469ns | 307ms, 694µs, 196ns | 392ms, 842µs, 54ns |
| League(Configured, Transient) | ^5.1 | 9s, 47ms, 252µs, 511ns | 7s, 114ms, 346µs, 981ns | 9s, 542ms, 840µs, 957ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 876µs, 90ns | 3ms, 768µs, 920ns | 4ms, 265µs, 69ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 148µs, 529ns | 5ms, 871µs, 57ns | 6ms, 586µs, 74ns |
| Phalcon(Configured, Transient) | ^5 | 353ms, 601µs, 479ns | 321ms, 979µs, 999ns | 373ms, 991µs, 966ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 216µs, 650ns | 1ms, 187µs, 86ns | 1ms, 252µs, 174ns |
| Pimple(Configured, Transient) | ^3.5 | 98ms, 733µs, 806ns | 93ms, 136µs, 72ns | 107ms, 214µs, 927ns |
| Quickly(Compiled, Singleton) | dev-master | 769µs, 305ns | 750µs, 64ns | 792µs, 26ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 92µs, 717ns | 4ms, 17µs, 114ns | 4ms, 333µs, 972ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 308ms, 381µs, 80ns | 2s, 42ms, 422µs, 56ns | 3s, 913ms, 84µs, 30ns |
| Symfony(Compiled, Singleton) | ^7.0 | 776µs, 934ns | 753µs, 164ns | 793µs, 218ns |
| Zen(Compiled, Singleton) | ^3.1 | 845µs, 26ns | 752µs, 925ns | 1ms, 505µs, 851ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 882µs, 338ns | 1ms, 446µs, 8ns | 3ms, 202µs, 199ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 928µs, 210ns | 1ms, 808µs, 881ns | 2ms, 353µs, 906ns |
| Laravel(Configured, Transient) | ^12.28 | 379ms, 760µs, 980ns | 327ms, 502µs, 12ns | 394ms, 366µs, 979ns |
| League(Configured, Transient) | ^5.1 | 8s, 689ms, 510µs, 273ns | 7s, 141ms, 160µs, 11ns | 9s, 663ms, 655µs, 996ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 650µs, 188ns | 3ms, 459µs, 930ns | 4ms, 96µs, 984ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 465µs, 291ns | 6ms, 374µs, 120ns | 6ms, 570µs, 100ns |
| Phalcon(Configured, Transient) | ^5 | 348ms, 802µs, 781ns | 328ms, 871µs, 11ns | 369ms, 313µs, 1ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 353µs, 49ns | 1ms, 300µs, 811ns | 1ms, 603µs, 841ns |
| Pimple(Configured, Transient) | ^3.5 | 96ms, 3µs, 150ns | 92ms, 775µs, 106ns | 99ms, 195µs, 957ns |
| Quickly(Compiled, Singleton) | dev-master | 808µs, 334ns | 792µs, 26ns | 838µs, 41ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 916µs, 834ns | 4ms, 727µs, 125ns | 5ms, 668µs, 163ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 536ms, 788µs, 678ns | 2s, 60ms, 98µs, 886ns | 3s, 928ms, 285µs, 121ns |
| Symfony(Compiled, Singleton) | ^7.0 | 743µs, 889ns | 723µs, 838ns | 757µs, 932ns |
| Zen(Compiled, Singleton) | ^3.1 | 781µs, 893ns | 607µs, 967ns | 2ms, 222µs, 61ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 193µs, 996ns | 4ms, 141µs, 92ns | 5ms, 682µs, 945ns |
| Dice(Configured, Singleton) | ^4.0 | 859µs, 546ns | 771µs, 45ns | 899µs, 76ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 15ms, 912µs, 437ns | 7s, 658ms, 632µs, 993ns | 10s, 580ms, 372µs, 95ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 791µs, 239ns | 743µs, 865ns | 894µs, 69ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 892µs, 993ns | 3ms, 618µs, 955ns | 4ms, 431µs, 9ns |
| Laravel(Reflection, Transient) | ^12.28 | 79s, 254ms, 560µs, 756ns | 68s, 180ms, 163µs, 860ns | 81s, 379ms, 861µs, 116ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 564µs, 596ns | 3ms, 441µs, 95ns | 3ms, 957µs, 33ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 286µs, 406ns | 5ms, 814µs, 75ns | 6ms, 824µs, 970ns |
| Php-baseline |  | 597µs, 405ns | 438µs, 928ns | 670µs, 194ns |
| Php-di(Reflection, Singleton) | ^7.0 | 730µs, 419ns | 681µs, 161ns | 1ms, 65µs, 15ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 632µs, 571ns | 1ms, 238µs, 822ns | 2ms, 300µs, 977ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 674ms, 863µs, 529ns | 13s, 208ms, 458µs, 185ns | 14s, 101ms, 454µs, 19ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 131µs, 963ns | 972µs, 986ns | 1ms, 186µs, 847ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 364µs, 779ns | 1ms, 347µs, 64ns | 1ms, 413µs, 106ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 329µs, 255ns | 1ms, 293µs, 897ns | 1ms, 471µs, 42ns |
| Symfony(Compiled, Singleton) | ^7.0 | 765µs, 85ns | 751µs, 18ns | 812µs, 53ns |
| Zen(Compiled, Singleton) | ^3.1 | 870µs, 394ns | 778µs, 913ns | 1ms, 526µs, 117ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 530µs, 475ns | 5ms, 762µs, 100ns | 6ms, 832µs, 122ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 121µs, 424ns | 1ms, 830µs, 101ns | 2ms, 279µs, 996ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 87ms, 513µs, 160ns | 8s, 838ms, 25µs, 93ns | 10s, 591ms, 474µs, 56ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 45µs, 227ns | 907µs, 897ns | 2ms, 113µs, 103ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 392µs, 622ns | 4ms, 171µs, 848ns | 8ms, 920µs, 907ns |
| Laravel(Reflection, Transient) | ^12.28 | 78s, 423ms, 340µs, 868ns | 67s, 843ms, 391µs, 180ns | 80s, 538ms, 703µs, 918ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 586µs, 626ns | 3ms, 484µs, 10ns | 3ms, 915µs, 71ns |
| Phalcon(Configured, Singleton) | ^5 | 7ms, 183µs, 361ns | 6ms, 30µs, 82ns | 12ms, 7µs, 951ns |
| Php-baseline |  | 614µs, 333ns | 506µs, 162ns | 694µs, 990ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 123µs, 809ns | 868µs, 797ns | 3ms, 195µs, 47ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 356µs, 220ns | 1ms, 301µs, 50ns | 1ms, 569µs, 32ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 221ms, 484µs, 565ns | 10s, 513ms, 417µs, 5ns | 13s, 822ms, 888µs, 851ns |
| Quickly(Compiled, Singleton) | dev-master | 833µs, 106ns | 796µs, 794ns | 936µs, 31ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 582µs, 549ns | 2ms, 996µs, 921ns | 3ms, 717µs, 899ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 499µs, 414ns | 1ms, 379µs, 966ns | 2ms, 250µs, 909ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 14µs, 256ns | 948µs, 905ns | 1ms, 222µs, 133ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 2µs, 73ns | 788µs, 211ns | 2ms, 788µs, 66ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 864µs, 600ns | 1ms, 788µs, 854ns | 2ms, 143µs, 144ns |
| Dice(Configured, Singleton) | ^4.0 | 861µs, 692ns | 694µs, 990ns | 941µs, 38ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 83µs, 800ns | 3ms, 930µs, 807ns | 4ms, 734µs, 992ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 110µs, 620ns | 5ms, 89µs, 44ns | 6ms, 939µs, 888ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 246µs, 452ns | 1ms, 207µs, 828ns | 1ms, 273µs, 870ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 7ms, 610µs, 106ns | 10s, 389ms, 642µs | 13s, 976ms, 559µs, 877ns |
| Quickly(Compiled, Singleton) | dev-master | 756µs, 669ns | 735µs, 998ns | 808µs, 954ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 43µs, 507ns | 3ms, 942µs, 966ns | 4ms, 539µs, 12ns |
| Symfony(Compiled, Singleton) | ^7.0 | 632µs, 739ns | 617µs, 27ns | 674µs, 9ns |
| Zen(Compiled, Singleton) | ^3.1 | 829µs, 672ns | 735µs, 998ns | 1ms, 513µs, 4ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 176µs, 140ns | 2ms, 506µs, 17ns | 3ms, 304µs, 4ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 117µs, 800ns | 1ms, 722µs, 97ns | 2ms, 402µs, 67ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 410µs, 935ns | 3ms, 332µs, 853ns | 3ms, 722µs, 906ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 422µs, 257ns | 5ms, 594µs, 15ns | 6ms, 864µs, 70ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 325µs, 273ns | 1ms, 263µs, 856ns | 1ms, 591µs, 205ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 436ms, 774µs, 873ns | 12s, 892ms, 394µs, 65ns | 14s, 67ms, 264µs, 795ns |
| Quickly(Compiled, Singleton) | dev-master | 804µs, 901ns | 756µs, 25ns | 830µs, 173ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 594µs, 589ns | 3ms, 494µs, 977ns | 4ms, 130µs, 840ns |
| Symfony(Compiled, Singleton) | ^7.0 | 770µs, 187ns | 736µs, 951ns | 804µs, 901ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 27µs, 131ns | 813µs, 961ns | 2ms, 709µs, 150ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 798µs, 368ns | 761µs, 32ns | 988µs, 960ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 467µs, 297ns | 3ms, 391µs, 27ns | 3ms, 886µs, 938ns |
| Php-di(Reflection, Singleton) | ^7.0 | 861µs, 740ns | 796µs, 79ns | 1ms, 299µs, 858ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 244µs, 902ns | 1ms, 223µs, 87ns | 1ms, 270µs, 55ns |
| Quickly(Compiled, Singleton) | dev-master | 598µs, 764ns | 582µs, 933ns | 627µs, 994ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 350µs, 593ns | 1ms, 326µs, 84ns | 1ms, 466µs, 35ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 143µs, 121ns | 1ms, 74µs, 75ns | 1ms, 401µs, 185ns |
| Symfony(Compiled, Singleton) | ^7.0 | 839µs, 829ns | 813µs, 961ns | 863µs, 75ns |
| Zen(Compiled, Singleton) | ^3.1 | 613µs, 21ns | 548µs, 124ns | 1ms, 101µs, 16ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 99µs, 634ns | 926µs, 17ns | 2ms, 188µs, 920ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 691µs, 244ns | 3ms, 527µs, 879ns | 4ms, 46µs, 916ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 246µs, 118ns | 963µs, 926ns | 3ms, 288µs, 30ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 379µs, 776ns | 1ms, 328µs, 945ns | 1ms, 615µs, 47ns |
| Quickly(Compiled, Singleton) | dev-master | 785µs, 374ns | 749µs, 111ns | 847µs, 101ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 167µs, 57ns | 2ms, 54µs, 214ns | 2ms, 893µs, 209ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 237µs, 916ns | 1ms, 137µs, 971ns | 1ms, 821µs, 41ns |
| Symfony(Compiled, Singleton) | ^7.0 | 820µs, 541ns | 765µs, 85ns | 957µs, 12ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 64µs, 395ns | 797µs, 33ns | 2ms, 743µs, 5ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 898µs, 930ns | 3ms, 793µs, 1ns | 4ms, 302µs, 24ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 24µs, 389ns | 1ms, 7µs, 80ns | 1ms, 45µs, 942ns |
| Quickly(Compiled, Singleton) | dev-master | 780µs, 606ns | 766µs, 38ns | 817µs, 60ns |
| Quickly(Configured, Singleton) | dev-master | 7ms, 212µs, 138ns | 4ms, 493µs, 951ns | 7ms, 632µs, 970ns |
| Symfony(Compiled, Singleton) | ^7.0 | 622µs, 224ns | 565µs, 52ns | 813µs, 7ns |
| Zen(Compiled, Singleton) | ^3.1 | 807µs, 380ns | 709µs, 772ns | 1ms, 503µs, 944ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 784µs, 704ns | 3ms, 676µs, 891ns | 4ms, 64µs, 83ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 347µs, 255ns | 1ms, 257µs, 181ns | 1ms, 643µs, 180ns |
| Quickly(Compiled, Singleton) | dev-master | 786µs, 733ns | 766µs, 992ns | 811µs, 100ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 131µs, 54ns | 4ms, 24µs, 28ns | 4ms, 742µs, 860ns |
| Symfony(Compiled, Singleton) | ^7.0 | 790µs, 715ns | 747µs, 919ns | 862µs, 836ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 155µs, 591ns | 931µs, 978ns | 3ms, 15µs, 41ns |

</details>

Questions, issues, and new containers are welcome!
