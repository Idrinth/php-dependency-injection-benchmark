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

Run from 2026-03-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 645µs, 803ns | 1ms, 592µs, 874ns | 1ms, 759µs, 52ns |
| Auryn(Reflection, Transient) | ^1.4 | 395ms, 530µs, 271ns | 351ms, 737µs, 22ns | 417ms, 650µs, 938ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 73µs, 622ns | 764µs, 846ns | 1ms, 389µs, 980ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 229µs, 554ns | 69ms, 565µs, 773ns | 71ms, 453µs, 809ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 993µs, 895ns | 789µs, 165ns | 1ms, 307µs, 964ns |
| Laravel(Configured, Transient) | ^12.28 | 407ms, 69µs, 516ns | 394ms, 210µs, 815ns | 451ms, 91µs, 51ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 132µs, 81ns | 2ms, 701µs, 44ns | 3ms, 826µs, 141ns |
| Laravel(Reflection, Transient) | ^12.28 | 620ms, 991µs, 945ns | 613ms, 542µs, 795ns | 629ms, 142µs, 999ns |
| League(Configured, Transient) | ^5.1 | 839ms, 579µs, 510ns | 825ms, 374µs, 841ns | 870ms, 883µs, 226ns |
| League(Reflection, Transient) | ^5.1 | 662ms, 854µs, 123ns | 546ms, 252µs, 965ns | 736ms, 184µs, 835ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 74µs, 383ns | 2ms, 980µs, 947ns | 3ms, 395µs, 80ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 759µs, 169ns | 3ms, 381µs, 967ns | 4ms, 256µs, 963ns |
| Phalcon(Configured, Transient) | ^5 | 290ms, 846µs, 395ns | 264ms, 647µs, 6ns | 305ms, 735µs, 826ns |
| Php-baseline |  | 535µs, 917ns | 453µs, 948ns | 622µs, 34ns |
| Php-di(Reflection, Singleton) | ^7.0 | 886µs, 726ns | 831µs, 127ns | 1ms, 231µs, 193ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 261µs, 496ns | 1ms, 245µs, 21ns | 1ms, 278µs, 877ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 513µs, 982ns | 99ms, 124µs, 908ns | 107ms, 340µs, 97ns |
| Quickly(Compiled, Singleton) | dev-master | 832µs, 796ns | 772µs, 953ns | 915µs, 50ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 470µs, 17ns | 1ms, 328µs, 945ns | 2ms, 281µs, 188ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 361µs, 298ns | 1ms, 315µs, 116ns | 1ms, 474µs, 857ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 912ms, 348µs, 675ns | 3s, 853ms, 437µs, 185ns | 3s, 995ms, 161µs, 56ns |
| Ray-di(Reflection, Transient) | ^2.16 | 396ms, 129µs, 679ns | 383ms, 972µs, 167ns | 435ms, 926µs, 198ns |
| Symfony(Compiled, Singleton) | ^7.0 | 669µs, 2ns | 655µs, 174ns | 704µs, 50ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 860µs, 404ns | 807µs, 46ns | 1ms, 180µs, 887ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 882µs, 792ns | 807µs, 46ns | 1ms, 404µs, 47ns |
| Zen(Compiled, Singleton) | ^3.1 | 882µs, 53ns | 780µs, 820ns | 1ms, 492µs, 23ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 239µs, 656ns | 1ms, 485µs, 824ns | 5ms, 161µs, 46ns |
| Auryn(Reflection, Transient) | ^1.4 | 401ms, 342µs, 129ns | 355ms, 230µs, 93ns | 425ms, 137µs, 42ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 861µs, 882ns | 1ms, 721µs, 143ns | 2ms, 197µs, 27ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 418µs, 787ns | 69ms, 552µs, 183ns | 71ms, 424µs, 961ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 506µs, 781ns | 1ms, 301µs, 50ns | 3ms, 120µs, 899ns |
| Laravel(Configured, Transient) | ^12.28 | 393ms, 742µs, 489ns | 341ms, 587µs, 66ns | 424ms, 780µs, 130ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 451µs, 180ns | 2ms, 759µs, 933ns | 5ms, 34µs, 923ns |
| Laravel(Reflection, Transient) | ^12.28 | 624ms, 31µs, 949ns | 618ms, 355µs, 989ns | 631ms, 613µs, 16ns |
| League(Configured, Transient) | ^5.1 | 836ms, 392µs, 688ns | 825ms, 903µs, 892ns | 851ms, 835µs, 966ns |
| League(Reflection, Transient) | ^5.1 | 653ms, 211µs, 760ns | 551ms, 676µs, 988ns | 677ms, 370µs, 71ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 538µs, 393ns | 3ms, 458µs, 23ns | 3ms, 988µs, 981ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 409µs, 885ns | 4ms, 253µs, 864ns | 4ms, 543µs, 66ns |
| Phalcon(Configured, Transient) | ^5 | 293ms, 556µs, 308ns | 260ms, 564µs, 88ns | 307ms, 225µs, 942ns |
| Php-baseline |  | 610µs, 494ns | 583µs, 171ns | 653µs, 982ns |
| Php-di(Reflection, Singleton) | ^7.0 | 927µs, 805ns | 719µs, 70ns | 2ms, 524µs, 137ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 342µs, 391ns | 1ms, 291µs, 990ns | 1ms, 570µs, 940ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 443µs, 289ns | 98ms, 836µs, 183ns | 110ms, 862µs, 970ns |
| Quickly(Compiled, Singleton) | dev-master | 693µs, 583ns | 677µs, 824ns | 705µs, 957ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 166µs, 986ns | 2ms, 37µs, 48ns | 3ms, 25µs, 54ns |
| Quickly(Reflection, Singleton) | dev-master | 2ms, 408µs, 599ns | 1ms, 407µs, 861ns | 3ms, 776µs, 73ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 703ms, 68µs, 852ns | 2s, 157ms, 604µs, 932ns | 3s, 916ms, 973µs, 829ns |
| Ray-di(Reflection, Transient) | ^2.16 | 393ms, 494µs, 606ns | 344ms, 756µs, 841ns | 440ms, 625µs, 190ns |
| Symfony(Compiled, Singleton) | ^7.0 | 791µs, 931ns | 761µs, 32ns | 827µs, 74ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 901µs, 627ns | 724µs, 77ns | 2ms, 387µs, 46ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 757µs, 240ns | 1ms, 379µs, 13ns | 4ms, 651µs, 69ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 542µs, 305ns | 1ms, 204µs, 13ns | 4ms, 379µs, 34ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 521µs, 563ns | 1ms, 358µs, 32ns | 1ms, 733µs, 64ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 98µs, 847ns | 807µs, 46ns | 1ms, 462µs, 936ns |
| Laravel(Configured, Transient) | ^12.28 | 383ms, 792µs, 304ns | 375ms, 541µs, 925ns | 401ms, 102µs, 66ns |
| League(Configured, Transient) | ^5.1 | 4s, 117ms, 952µs, 394ns | 4s, 44ms, 304µs, 847ns | 4s, 148ms, 738µs, 145ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 918µs, 194ns | 3ms, 854µs, 990ns | 4ms, 263µs, 877ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 192µs, 376ns | 4ms, 64µs, 798ns | 4ms, 319µs, 906ns |
| Phalcon(Configured, Transient) | ^5 | 291ms, 740µs, 12ns | 265ms, 152µs, 215ns | 310ms, 389µs, 41ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 258µs, 969ns | 1ms, 229µs, 47ns | 1ms, 306µs, 56ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 286µs, 862ns | 101ms, 176µs, 23ns | 109ms, 242µs, 916ns |
| Quickly(Compiled, Singleton) | dev-master | 794µs, 601ns | 771µs, 45ns | 833µs, 34ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 199µs, 481ns | 3ms, 890µs, 991ns | 6ms, 268µs, 978ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 812ms, 367µs, 486ns | 2s, 116ms, 477µs, 966ns | 4s, 249ms, 892µs, 950ns |
| Symfony(Compiled, Singleton) | ^7.0 | 804µs, 996ns | 767µs, 946ns | 854µs, 15ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 851µs, 106ns | 793µs, 933ns | 1ms, 165µs, 151ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 888µs, 776ns | 798µs, 940ns | 1ms, 514µs, 911ns |
| Zen(Compiled, Singleton) | ^3.1 | 823µs, 44ns | 739µs, 812ns | 1ms, 417µs, 875ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 116µs, 966ns | 1ms, 680µs, 850ns | 3ms, 226µs, 995ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 761µs, 531ns | 1ms, 509µs, 904ns | 2ms, 244µs, 949ns |
| Laravel(Configured, Transient) | ^12.28 | 378ms, 39µs, 741ns | 324ms, 820µs, 41ns | 397ms, 634µs, 29ns |
| League(Configured, Transient) | ^5.1 | 4s, 102ms, 532µs, 29ns | 4s, 63ms, 441µs, 991ns | 4s, 165ms, 716µs, 171ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 550µs, 291ns | 3ms, 465µs, 890ns | 3ms, 917µs, 932ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 421µs, 281ns | 4ms, 163µs, 26ns | 5ms, 202µs, 54ns |
| Phalcon(Configured, Transient) | ^5 | 293ms, 146µs, 491ns | 260ms, 889µs, 53ns | 342ms, 494µs, 964ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 375µs, 102ns | 1ms, 331µs, 90ns | 1ms, 649µs, 856ns |
| Pimple(Configured, Transient) | ^3.5 | 104ms, 970µs, 502ns | 101ms, 665µs, 973ns | 111ms, 608µs, 982ns |
| Quickly(Compiled, Singleton) | dev-master | 814µs, 771ns | 798µs, 940ns | 828µs, 981ns |
| Quickly(Configured, Singleton) | dev-master | 6ms, 468µs, 81ns | 4ms, 43µs, 102ns | 8ms, 439µs, 64ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 739ms, 680µs, 171ns | 2s, 145ms, 516µs, 157ns | 3s, 987ms, 894µs, 58ns |
| Symfony(Compiled, Singleton) | ^7.0 | 798µs, 606ns | 775µs, 98ns | 837µs, 87ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 431µs, 59ns | 931µs, 24ns | 4ms, 514µs, 932ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 100µs, 420ns | 874µs, 42ns | 2ms, 999µs, 67ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 68µs, 902ns | 849µs, 8ns | 2ms, 887µs, 964ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 819µs, 511ns | 5ms, 214µs, 929ns | 10ms, 270µs, 118ns |
| Dice(Configured, Singleton) | ^4.0 | 865µs, 530ns | 742µs, 912ns | 946µs, 998ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 60ms, 458µs, 421ns | 9s, 947ms, 861µs, 194ns | 10s, 124ms, 783µs, 39ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 790µs, 190ns | 766µs, 992ns | 876µs, 903ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 166µs, 698ns | 2ms, 960µs, 920ns | 6ms, 576µs, 61ns |
| Laravel(Reflection, Transient) | ^12.28 | 85s, 782ms, 200µs, 622ns | 75s, 491ms, 466µs, 45ns | 87s, 358ms, 852µs, 863ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 557µs, 109ns | 3ms, 407µs, 1ns | 4ms, 132µs, 32ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 611µs, 86ns | 4ms, 116µs, 58ns | 8ms, 200µs, 883ns |
| Php-baseline |  | 662µs, 851ns | 607µs, 13ns | 849µs, 8ns |
| Php-di(Reflection, Singleton) | ^7.0 | 848µs, 245ns | 780µs, 820ns | 1ms, 250µs, 28ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 331µs, 830ns | 1ms, 302µs, 3ns | 1ms, 420µs, 974ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 783ms, 650µs, 827ns | 13s, 61ms, 619µs, 997ns | 14s, 455ms, 446µs, 958ns |
| Quickly(Compiled, Singleton) | dev-master | 870µs, 800ns | 847µs, 816ns | 902µs, 891ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 425µs, 719ns | 1ms, 378µs, 59ns | 1ms, 475µs, 95ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 377µs, 940ns | 1ms, 317µs, 977ns | 1ms, 524µs, 925ns |
| Symfony(Compiled, Singleton) | ^7.0 | 812µs, 172ns | 797µs, 986ns | 829µs, 935ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 385µs, 641ns | 1ms, 294µs, 136ns | 1ms, 991µs, 33ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 9µs, 988ns | 795µs, 841ns | 1ms, 409µs, 53ns |
| Zen(Compiled, Singleton) | ^3.1 | 910µs, 687ns | 770µs, 92ns | 1ms, 470µs, 88ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 191µs, 85ns | 5ms, 725µs, 860ns | 12ms, 567µs, 43ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 172µs, 899ns | 1ms, 858µs, 949ns | 2ms, 321µs, 4ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 101ms, 120µs, 615ns | 9s, 946ms, 392µs, 59ns | 10s, 695ms, 530µs, 891ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 36µs, 620ns | 904µs, 83ns | 2ms, 113µs, 819ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 7µs, 314ns | 3ms, 945µs, 827ns | 6ms, 827µs, 116ns |
| Laravel(Reflection, Transient) | ^12.28 | 85s, 678ms, 469µs, 920ns | 73s, 560ms, 94µs, 833ns | 88s, 323ms, 492µs, 50ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 549µs, 194ns | 3ms, 421µs, 68ns | 3ms, 911µs, 972ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 307µs, 389ns | 3ms, 646µs, 850ns | 4ms, 750µs, 967ns |
| Php-baseline |  | 664µs, 424ns | 508µs, 69ns | 821µs, 113ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 359µs, 796ns | 960µs, 826ns | 3ms, 446µs, 102ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 456µs, 475ns | 1ms, 392µs, 841ns | 1ms, 703µs, 977ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 28ms, 884µs, 315ns | 13s, 906ms, 538µs, 963ns | 14s, 168ms, 762µs, 922ns |
| Quickly(Compiled, Singleton) | dev-master | 822µs, 734ns | 803µs, 947ns | 846µs, 862ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 263µs, 498ns | 2ms, 130µs, 31ns | 2ms, 959µs, 966ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 529µs, 264ns | 1ms, 409µs, 53ns | 2ms, 354µs, 860ns |
| Symfony(Compiled, Singleton) | ^7.0 | 860µs, 595ns | 848µs, 54ns | 875µs, 949ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 160µs, 430ns | 946µs, 998ns | 2ms, 959µs, 12ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 636µs, 314ns | 885µs, 963ns | 4ms, 307µs, 31ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 602µs, 268ns | 1ms, 255µs, 989ns | 4ms, 604µs, 101ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 947µs, 331ns | 1ms, 646µs, 41ns | 3ms, 269µs, 910ns |
| Dice(Configured, Singleton) | ^4.0 | 867µs, 271ns | 844µs, 955ns | 895µs, 23ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 228µs, 448ns | 3ms, 831µs, 148ns | 5ms, 389µs, 928ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 123µs, 234ns | 3ms, 458µs, 23ns | 4ms, 354µs, 953ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 260µs, 161ns | 1ms, 236µs, 915ns | 1ms, 286µs, 983ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 872ms, 905µs, 874ns | 13s, 83ms, 425µs, 998ns | 14s, 88ms, 113µs, 69ns |
| Quickly(Compiled, Singleton) | dev-master | 854µs, 206ns | 833µs, 988ns | 895µs, 977ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 242µs, 277ns | 3ms, 961µs, 801ns | 5ms, 959µs, 33ns |
| Symfony(Compiled, Singleton) | ^7.0 | 807µs, 380ns | 792µs, 980ns | 816µs, 822ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 842µs, 308ns | 787µs, 973ns | 1ms, 170µs, 158ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 909µs, 805ns | 807µs, 46ns | 1ms, 646µs, 41ns |
| Zen(Compiled, Singleton) | ^3.1 | 658µs, 559ns | 588µs, 893ns | 1ms, 192µs, 808ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 317µs, 546ns | 3ms, 193µs, 140ns | 3ms, 553µs, 152ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 189µs, 397ns | 1ms, 914µs, 24ns | 2ms, 278µs, 89ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 967µs, 738ns | 3ms, 859µs, 996ns | 4ms, 351µs, 139ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 361µs, 963ns | 3ms, 716µs, 945ns | 4ms, 765µs, 33ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 392µs, 579ns | 1ms, 343µs, 11ns | 1ms, 562µs, 833ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 93ms, 221µs, 163ns | 13s, 905ms, 832µs, 52ns | 14s, 662ms, 523µs, 31ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 587ns | 792µs, 980ns | 848µs, 54ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 382µs, 84ns | 4ms, 694µs, 938ns | 8ms, 636µs, 951ns |
| Symfony(Compiled, Singleton) | ^7.0 | 809µs, 669ns | 772µs, 953ns | 876µs, 903ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 113µs, 390ns | 871µs, 896ns | 3ms, 102µs, 64ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 114µs, 487ns | 892µs, 877ns | 2ms, 998µs, 113ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 114µs, 940ns | 850µs, 200ns | 3ms, 21µs, 955ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 844µs, 669ns | 812µs, 768ns | 998µs, 20ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 148µs, 841ns | 3ms, 25µs, 54ns | 3ms, 463µs, 983ns |
| Php-di(Reflection, Singleton) | ^7.0 | 716µs, 90ns | 662µs, 803ns | 1ms, 63µs, 108ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 457µs, 715ns | 1ms, 252µs, 889ns | 2ms, 175µs, 92ns |
| Quickly(Compiled, Singleton) | dev-master | 821µs, 232ns | 792µs, 26ns | 898µs, 122ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 362µs, 562ns | 1ms, 325µs, 130ns | 1ms, 440µs, 48ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 347µs, 160ns | 1ms, 289µs, 844ns | 1ms, 582µs, 860ns |
| Symfony(Compiled, Singleton) | ^7.0 | 838µs, 685ns | 794µs, 172ns | 961µs, 65ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 698µs, 614ns | 633µs, 955ns | 992µs, 59ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 865µs, 149ns | 775µs, 98ns | 1ms, 518µs, 11ns |
| Zen(Compiled, Singleton) | ^3.1 | 897µs, 574ns | 810µs, 861ns | 1ms, 597µs, 166ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 88µs, 714ns | 932µs, 931ns | 2ms, 79µs, 963ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 744µs, 602ns | 3ms, 494µs, 977ns | 4ms, 694µs, 938ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 239µs, 824ns | 938µs, 177ns | 3ms, 273µs, 10ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 350µs, 498ns | 1ms, 292µs, 943ns | 1ms, 579µs, 999ns |
| Quickly(Compiled, Singleton) | dev-master | 785µs, 470ns | 768µs, 899ns | 819µs, 921ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 174µs, 472ns | 2ms, 25µs, 842ns | 2ms, 932µs, 71ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 591µs, 706ns | 1ms, 480µs, 817ns | 2ms, 331µs, 972ns |
| Symfony(Compiled, Singleton) | ^7.0 | 660µs, 443ns | 639µs, 915ns | 697µs, 135ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 233µs, 506ns | 987µs, 52ns | 3ms, 262µs, 996ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 980µs, 424ns | 776µs, 52ns | 2ms, 704µs, 143ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 293µs, 540ns | 916µs, 4ns | 3ms, 571µs, 33ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 599µs, 143ns | 3ms, 512µs, 144ns | 3ms, 988µs, 981ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 258µs, 921ns | 1ms, 237µs, 154ns | 1ms, 276µs, 969ns |
| Quickly(Compiled, Singleton) | dev-master | 808µs, 95ns | 776µs, 52ns | 859µs, 975ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 168µs, 272ns | 3ms, 921µs, 31ns | 5ms, 923µs, 986ns |
| Symfony(Compiled, Singleton) | ^7.0 | 817µs, 346ns | 720µs, 24ns | 898µs, 838ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 290µs, 273ns | 781µs, 59ns | 2ms, 43µs, 962ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 890µs, 421ns | 796µs, 79ns | 1ms, 616µs, 954ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 101µs, 708ns | 960µs, 826ns | 2ms, 283µs, 96ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 980µs, 112ns | 3ms, 885µs, 984ns | 4ms, 301µs, 71ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 410µs, 984ns | 1ms, 364µs, 946ns | 1ms, 652µs, 2ns |
| Quickly(Compiled, Singleton) | dev-master | 837µs, 588ns | 798µs, 940ns | 916µs, 957ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 52µs, 685ns | 4ms, 692µs, 792ns | 5ms, 991µs, 935ns |
| Symfony(Compiled, Singleton) | ^7.0 | 853µs, 204ns | 824µs, 213ns | 916µs, 4ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 203µs, 823ns | 977µs, 39ns | 3ms, 103µs, 17ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 135µs, 373ns | 917µs, 911ns | 2ms, 986µs, 907ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 195µs, 597ns | 941µs, 991ns | 3ms, 125µs, 905ns |

</details>

Questions, issues, and new containers are welcome!
