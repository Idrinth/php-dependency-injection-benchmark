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

Run from 2026-03-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 805µs, 233ns | 1ms, 590µs, 967ns | 2ms, 640µs, 8ns |
| Auryn(Reflection, Transient) | ^1.4 | 402ms, 994µs, 132ns | 357ms, 805µs, 967ns | 448ms, 70µs, 49ns |
| Dice(Configured, Singleton) | ^4.0 | 825µs, 381ns | 802µs, 40ns | 846µs, 862ns |
| Dice(Reflection, Transient) | ^4.0 | 72ms, 863µs, 6ns | 69ms, 481µs, 849ns | 80ms, 223µs, 83ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 694µs, 847ns | 676µs, 155ns | 741µs, 958ns |
| Laravel(Configured, Transient) | ^12.28 | 400ms, 269µs, 865ns | 345ms, 636µs, 844ns | 428ms, 841µs, 114ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 47µs, 727ns | 3ms, 391µs, 981ns | 6ms, 247µs, 43ns |
| Laravel(Reflection, Transient) | ^12.28 | 620ms, 214µs, 390ns | 610ms, 611µs, 915ns | 628ms, 628µs, 969ns |
| League(Configured, Transient) | ^5.1 | 828ms, 553µs, 485ns | 697ms, 569µs, 131ns | 894ms, 474µs, 983ns |
| League(Reflection, Transient) | ^5.1 | 649ms, 324µs, 941ns | 548ms, 149µs, 824ns | 670ms, 849µs, 84ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 746µs, 604ns | 3ms, 386µs, 20ns | 6ms, 503µs, 105ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 153µs, 13ns | 4ms, 130µs, 125ns | 4ms, 193µs, 67ns |
| Phalcon(Configured, Transient) | ^5 | 301ms, 740µs, 598ns | 290ms, 399µs, 74ns | 314ms, 316µs, 34ns |
| Php-baseline |  | 535µs, 583ns | 458µs, 2ns | 603µs, 914ns |
| Php-di(Reflection, Singleton) | ^7.0 | 892µs, 162ns | 834µs, 226ns | 1ms, 226µs, 902ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 292µs, 514ns | 1ms, 276µs, 969ns | 1ms, 320µs, 123ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 450µs, 967ns | 98ms, 994µs, 970ns | 112ms, 926µs, 6ns |
| Quickly(Compiled, Singleton) | dev-master | 842µs, 738ns | 826µs, 120ns | 861µs, 167ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 370µs, 835ns | 1ms, 328µs, 945ns | 1ms, 416µs, 921ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 360µs, 321ns | 1ms, 332µs, 998ns | 1ms, 474µs, 142ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 771ms, 293µs, 568ns | 2s, 121ms, 900µs, 796ns | 4s, 7ms, 860µs, 183ns |
| Ray-di(Reflection, Transient) | ^2.16 | 383ms, 84µs, 726ns | 349ms, 259µs, 853ns | 400ms, 372µs, 28ns |
| Symfony(Compiled, Singleton) | ^7.0 | 839µs, 638ns | 823µs, 974ns | 884µs, 56ns |
| Zen(Compiled, Singleton) | ^3.1 | 679µs, 111ns | 613µs, 927ns | 1ms, 157µs, 999ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 121µs, 949ns | 1ms, 735µs, 925ns | 3ms, 649µs, 950ns |
| Auryn(Reflection, Transient) | ^1.4 | 402ms, 649µs, 140ns | 376ms, 133µs, 918ns | 412ms, 698µs, 30ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 654µs, 910ns | 1ms, 787µs, 185ns | 3ms, 880µs, 977ns |
| Dice(Reflection, Transient) | ^4.0 | 75ms, 133µs, 132ns | 70ms, 207µs, 834ns | 86ms, 690µs, 902ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 977µs, 444ns | 838µs, 41ns | 2ms, 147µs, 197ns |
| Laravel(Configured, Transient) | ^12.28 | 394ms, 92µs, 774ns | 349ms, 690µs, 914ns | 407ms, 325µs, 29ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 899µs, 955ns | 3ms, 346µs, 920ns | 4ms, 868µs, 984ns |
| Laravel(Reflection, Transient) | ^12.28 | 615ms, 948µs, 796ns | 607ms, 403µs, 993ns | 624ms, 48µs, 948ns |
| League(Configured, Transient) | ^5.1 | 800ms, 586µs, 748ns | 692ms, 679µs, 166ns | 894ms, 871µs, 950ns |
| League(Reflection, Transient) | ^5.1 | 653ms, 490µs, 233ns | 553ms, 541µs, 898ns | 723ms, 708µs, 152ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 691µs, 29ns | 3ms, 415µs, 107ns | 5ms, 295µs, 38ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 280µs, 996ns | 4ms, 231µs, 929ns | 4ms, 385µs, 948ns |
| Phalcon(Configured, Transient) | ^5 | 298ms, 501µs, 276ns | 292ms, 37µs, 963ns | 304ms, 567µs, 98ns |
| Php-baseline |  | 714µs, 659ns | 583µs, 171ns | 859µs, 22ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 297µs, 92ns | 861µs, 883ns | 3ms, 230µs, 94ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 373µs, 434ns | 1ms, 320µs, 123ns | 1ms, 660µs, 108ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 467µs, 15ns | 93ms, 556µs, 880ns | 111ms, 547µs, 946ns |
| Quickly(Compiled, Singleton) | dev-master | 776µs, 100ns | 741µs, 4ns | 805µs, 854ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 184µs, 176ns | 2ms, 78µs, 56ns | 2ms, 956µs, 867ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 477µs, 217ns | 1ms, 376µs, 152ns | 2ms, 182µs, 6ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 554ms, 945µs, 445ns | 2s, 88ms, 907µs, 957ns | 3s, 993ms, 422µs, 985ns |
| Ray-di(Reflection, Transient) | ^2.16 | 396ms, 71µs, 410ns | 356ms, 127µs, 23ns | 407ms, 551µs, 50ns |
| Symfony(Compiled, Singleton) | ^7.0 | 919µs, 508ns | 771µs, 999ns | 1ms, 419µs, 67ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 56µs, 51ns | 772µs, 953ns | 3ms, 79µs, 175ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 616µs, 549ns | 1ms, 544µs, 952ns | 1ms, 885µs, 890ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 99µs, 777ns | 820µs, 159ns | 1ms, 424µs, 74ns |
| Laravel(Configured, Transient) | ^12.28 | 383ms, 406µs, 543ns | 375ms, 924µs, 110ns | 417ms, 330µs, 26ns |
| League(Configured, Transient) | ^5.1 | 4s, 111ms, 562µs, 347ns | 4s, 39ms, 180µs, 994ns | 4s, 238ms, 245µs, 964ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 998µs, 136ns | 3ms, 812µs, 74ns | 5ms, 193µs, 948ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 392µs, 242ns | 3ms, 995µs, 895ns | 6ms, 536µs, 960ns |
| Phalcon(Configured, Transient) | ^5 | 292ms, 889µs, 46ns | 265ms, 666µs, 961ns | 311ms, 61µs, 859ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 307µs, 415ns | 1ms, 285µs, 76ns | 1ms, 330µs, 852ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 15µs, 497ns | 95ms, 653µs, 57ns | 110ms, 577µs, 106ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 154µs, 804ns | 1ms, 116µs, 991ns | 1ms, 200µs, 914ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 267µs, 96ns | 4ms, 29µs, 989ns | 5ms, 198µs, 1ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 586ms, 102µs, 604ns | 2s, 93ms, 312µs, 25ns | 3s, 988ms, 577µs, 127ns |
| Symfony(Compiled, Singleton) | ^7.0 | 802µs, 683ns | 778µs, 913ns | 849µs, 8ns |
| Zen(Compiled, Singleton) | ^3.1 | 893µs, 712ns | 771µs, 45ns | 1ms, 621µs, 7ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 786µs, 731ns | 1ms, 684µs, 904ns | 5ms, 488µs, 157ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 872µs, 38ns | 1ms, 744µs, 985ns | 2ms, 266µs, 883ns |
| Laravel(Configured, Transient) | ^12.28 | 383ms, 811µs, 688ns | 340ms, 860µs, 128ns | 401ms, 507µs, 139ns |
| League(Configured, Transient) | ^5.1 | 4s, 63ms, 809µs, 585ns | 3s, 461ms, 820µs, 840ns | 4s, 165ms, 132µs, 999ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 974µs, 795ns | 3ms, 870µs, 10ns | 4ms, 296µs, 64ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 510µs, 520ns | 4ms, 221µs, 200ns | 8ms, 300µs, 65ns |
| Phalcon(Configured, Transient) | ^5 | 300ms, 552µs, 487ns | 283ms, 869µs, 28ns | 317ms, 39µs, 966ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 510µs, 356ns | 2ms, 429µs, 962ns | 2ms, 860µs, 69ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 417µs, 588ns | 100ms, 739µs, 955ns | 104ms, 326µs, 963ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 802ns | 792µs, 980ns | 896µs, 930ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 952µs, 692ns | 4ms, 604µs, 101ns | 6ms, 493µs, 91ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 766ms, 233µs, 491ns | 2s, 132ms, 309µs, 913ns | 4s, 26ms, 978µs, 15ns |
| Symfony(Compiled, Singleton) | ^7.0 | 823µs, 20ns | 801µs, 86ns | 871µs, 896ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 91µs, 766ns | 869µs, 35ns | 2ms, 907µs, 37ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 259µs, 752ns | 4ms, 692µs, 77ns | 5ms, 592µs, 107ns |
| Dice(Configured, Singleton) | ^4.0 | 924µs, 777ns | 828µs, 27ns | 1ms, 491µs, 69ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 66ms, 314µs, 983ns | 9s, 910ms, 639µs, 47ns | 10s, 181ms, 805µs, 133ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 820µs, 899ns | 792µs, 26ns | 932µs, 216ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 107µs, 356ns | 2ms, 944µs, 946ns | 6ms, 574µs, 869ns |
| Laravel(Reflection, Transient) | ^12.28 | 86s, 996ms, 649µs, 26ns | 86s, 227ms, 230µs, 72ns | 87s, 955ms, 178µs, 976ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 598µs, 332ns | 3ms, 401µs, 994ns | 4ms, 374µs, 980ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 136µs, 586ns | 3ms, 463µs, 983ns | 4ms, 601µs, 1ns |
| Php-baseline |  | 618µs, 886ns | 505µs, 924ns | 768µs, 899ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 352µs, 95ns | 1ms, 251µs, 935ns | 2ms, 53µs, 976ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 337µs, 170ns | 1ms, 313µs, 209ns | 1ms, 357µs, 78ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 879ms, 387µs, 92ns | 13s, 97ms, 824µs, 96ns | 14s, 397ms, 697µs, 925ns |
| Quickly(Compiled, Singleton) | dev-master | 841µs, 474ns | 819µs, 921ns | 887µs, 870ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 331µs, 543ns | 1ms, 304µs, 149ns | 1ms, 365µs, 184ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 141µs, 405ns | 1ms, 109µs, 838ns | 1ms, 257µs, 181ns |
| Symfony(Compiled, Singleton) | ^7.0 | 798µs, 130ns | 777µs, 6ns | 829µs, 935ns |
| Zen(Compiled, Singleton) | ^3.1 | 862µs, 979ns | 761µs, 985ns | 1ms, 535µs, 892ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 130µs, 885ns | 6ms, 654µs, 24ns | 10ms, 620µs, 832ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 412µs, 366ns | 2ms, 189µs, 874ns | 4ms, 902ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 967ms, 518µs, 305ns | 8s, 812ms, 934µs, 875ns | 10s, 459ms, 722µs, 42ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 44µs, 702ns | 887µs, 155ns | 2ms, 151µs, 966ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 140µs, 209ns | 4ms, 44µs, 55ns | 8ms, 538µs, 7ns |
| Laravel(Reflection, Transient) | ^12.28 | 86s, 985ms, 642µs, 75ns | 85s, 418ms, 450µs, 832ns | 88s, 61ms, 897µs, 39ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 701µs, 43ns | 3ms, 452µs, 777ns | 5ms, 323µs, 171ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 501µs, 56ns | 4ms, 386µs, 901ns | 5ms, 136µs, 966ns |
| Php-baseline |  | 677µs, 84ns | 602µs, 960ns | 969µs, 886ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 161µs, 599ns | 902µs, 891ns | 3ms, 260µs, 135ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 415µs, 14ns | 1ms, 343µs, 11ns | 1ms, 778µs, 125ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 115ms, 157µs, 175ns | 13s, 934ms, 779µs, 882ns | 14s, 433ms, 305µs, 25ns |
| Quickly(Compiled, Singleton) | dev-master | 817µs, 799ns | 793µs, 933ns | 859µs, 22ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 320µs, 694ns | 2ms, 59µs, 936ns | 3ms, 438µs, 949ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 231µs, 312ns | 1ms, 138µs, 925ns | 1ms, 886µs, 129ns |
| Symfony(Compiled, Singleton) | ^7.0 | 796µs, 580ns | 759µs, 840ns | 861µs, 883ns |
| Zen(Compiled, Singleton) | ^3.1 | 823µs, 783ns | 653µs, 28ns | 2ms, 185µs, 106ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 35µs, 307ns | 1ms, 574µs, 993ns | 3ms, 287µs, 76ns |
| Dice(Configured, Singleton) | ^4.0 | 886µs, 11ns | 845µs, 193ns | 1ms, 57µs, 863ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 448µs, 367ns | 3ms, 368µs, 139ns | 3ms, 715µs, 38ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 125µs, 308ns | 3ms, 457µs, 784ns | 4ms, 545µs, 211ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 294µs, 708ns | 1ms, 275µs, 62ns | 1ms, 333µs, 951ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 720ms, 272µs, 397ns | 13s, 85ms, 763µs, 931ns | 14s, 328ms, 951µs, 120ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 195µs, 216ns | 1ms, 167µs, 58ns | 1ms, 273µs, 155ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 383µs, 349ns | 3ms, 891µs, 944ns | 7ms, 194µs, 42ns |
| Symfony(Compiled, Singleton) | ^7.0 | 973µs, 296ns | 909µs, 90ns | 1ms, 25µs, 199ns |
| Zen(Compiled, Singleton) | ^3.1 | 854µs, 63ns | 771µs, 999ns | 1ms, 511µs, 96ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 530µs, 550ns | 3ms, 140µs, 211ns | 4ms, 957µs, 914ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 217µs, 30ns | 1ms, 908µs, 63ns | 2ms, 326µs, 11ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 981µs, 947ns | 3ms, 866µs, 910ns | 4ms, 370µs, 927ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 703µs, 187ns | 3ms, 700µs, 17ns | 6ms, 680µs, 965ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 401µs, 90ns | 1ms, 337µs, 51ns | 1ms, 662µs, 969ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 45ms, 1µs, 411ns | 13s, 951ms, 894µs, 998ns | 14s, 146ms, 702µs, 51ns |
| Quickly(Compiled, Singleton) | dev-master | 792µs, 741ns | 762µs, 939ns | 835µs, 180ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 789µs, 471ns | 4ms, 647µs, 970ns | 5ms, 612µs, 850ns |
| Symfony(Compiled, Singleton) | ^7.0 | 824µs, 785ns | 785µs, 112ns | 885µs, 9ns |
| Zen(Compiled, Singleton) | ^3.1 | 869µs, 226ns | 692µs, 844ns | 2ms, 286µs, 911ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 795µs, 412ns | 761µs, 32ns | 959µs, 873ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 574µs, 872ns | 3ms, 427µs, 982ns | 3ms, 964µs, 900ns |
| Php-di(Reflection, Singleton) | ^7.0 | 906µs, 848ns | 817µs, 60ns | 1ms, 430µs, 34ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 219µs, 868ns | 1ms, 199µs, 960ns | 1ms, 253µs, 843ns |
| Quickly(Compiled, Singleton) | dev-master | 690µs, 484ns | 669µs, 956ns | 727µs, 176ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 439µs, 309ns | 1ms, 373µs, 52ns | 1ms, 590µs, 967ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 646µs, 447ns | 1ms, 351µs, 833ns | 2ms, 226µs, 114ns |
| Symfony(Compiled, Singleton) | ^7.0 | 854µs, 563ns | 831µs, 127ns | 887µs, 870ns |
| Zen(Compiled, Singleton) | ^3.1 | 884µs, 914ns | 762µs, 939ns | 1ms, 692µs, 56ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 124µs, 167ns | 986µs, 99ns | 2ms, 212µs, 47ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 837µs, 299ns | 3ms, 487µs, 110ns | 6ms, 548µs, 881ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 244µs, 91ns | 962µs, 18ns | 3ms, 409µs, 862ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 417µs, 326ns | 1ms, 363µs, 39ns | 1ms, 655µs, 101ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 189µs, 64ns | 1ms, 171µs, 827ns | 1ms, 223µs, 87ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 191µs, 996ns | 2ms, 60µs, 890ns | 2ms, 961µs, 158ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 664µs, 757ns | 1ms, 466µs, 989ns | 2ms, 460µs, 956ns |
| Symfony(Compiled, Singleton) | ^7.0 | 840µs, 497ns | 820µs, 159ns | 882µs, 863ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 140µs, 379ns | 886µs, 917ns | 3ms, 139µs, 19ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 905µs, 701ns | 3ms, 815µs, 889ns | 4ms, 354µs, 953ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 296µs, 973ns | 1ms, 276µs, 969ns | 1ms, 320µs, 838ns |
| Quickly(Compiled, Singleton) | dev-master | 900µs, 149ns | 767µs, 946ns | 1ms, 228µs, 94ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 8µs, 626ns | 3ms, 966µs, 93ns | 4ms, 126µs, 71ns |
| Symfony(Compiled, Singleton) | ^7.0 | 810µs, 289ns | 769µs, 138ns | 863µs, 75ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 76µs, 316ns | 971µs, 78ns | 1ms, 670µs, 122ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 960µs, 608ns | 3ms, 894µs, 90ns | 8ms, 533µs |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 48µs, 731ns | 1ms, 19µs, 1ns | 1ms, 219µs, 987ns |
| Quickly(Compiled, Singleton) | dev-master | 855µs, 493ns | 834µs, 941ns | 903µs, 129ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 369µs, 281ns | 4ms, 678µs, 964ns | 8ms, 913µs, 40ns |
| Symfony(Compiled, Singleton) | ^7.0 | 801µs, 301ns | 777µs, 6ns | 839µs, 948ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 211µs, 786ns | 981µs, 92ns | 3ms, 36µs, 975ns |

</details>

Questions, issues, and new containers are welcome!
