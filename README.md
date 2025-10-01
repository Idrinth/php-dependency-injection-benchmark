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

Run from 2025-10-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 701µs, 998ns | 1ms, 555µs, 919ns | 1ms, 940µs, 11ns |
| Auryn(Reflection, Transient) | ^1.4 | 405ms, 905µs, 294ns | 399ms, 753µs, 93ns | 413ms, 468µs, 837ns |
| Dice(Configured, Singleton) | ^4.0 | 810µs, 122ns | 787µs, 973ns | 827µs, 789ns |
| Dice(Reflection, Transient) | ^4.0 | 76ms, 961µs, 827ns | 69ms, 898µs, 128ns | 89ms, 312µs, 76ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 773µs | 745µs, 58ns | 844µs, 955ns |
| Laravel(Configured, Transient) | ^12.28 | 408ms, 188µs, 366ns | 401ms, 782µs, 35ns | 431ms, 205µs, 987ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 893µs, 684ns | 3ms, 309µs, 11ns | 6ms, 705µs, 45ns |
| Laravel(Reflection, Transient) | ^12.28 | 634ms, 527µs, 420ns | 625ms, 329µs, 971ns | 651ms, 668µs, 787ns |
| League(Configured, Transient) | ^5.1 | 838ms, 145µs, 661ns | 822ms, 489µs, 23ns | 851ms, 811µs, 885ns |
| League(Reflection, Transient) | ^5.1 | 649ms, 997µs, 758ns | 643ms, 537µs, 998ns | 663ms, 543µs, 939ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 559µs, 494ns | 3ms, 499µs, 31ns | 3ms, 947µs, 19ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 60µs, 435ns | 3ms, 993µs, 34ns | 4ms, 117µs, 12ns |
| Phalcon(Configured, Transient) | ^5 | 296ms, 580µs, 910ns | 290ms, 494µs, 918ns | 306ms, 574µs, 106ns |
| Php-baseline |  | 584µs, 888ns | 566µs, 5ns | 612µs, 20ns |
| Php-di(Reflection, Singleton) | ^7.0 | 850µs, 701ns | 784µs, 873ns | 1ms, 219µs, 987ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 205µs, 777ns | 2ms, 156µs, 19ns | 2ms, 264µs, 22ns |
| Pimple(Configured, Transient) | ^3.5 | 98ms, 637µs, 56ns | 97ms, 365µs, 856ns | 102ms, 315µs, 902ns |
| Quickly(Compiled, Singleton) | dev-master | 778µs, 889ns | 760µs, 78ns | 799µs, 894ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 329µs, 684ns | 1ms, 307µs, 964ns | 1ms, 358µs, 32ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 332µs, 426ns | 1ms, 289µs, 129ns | 1ms, 450µs, 61ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 503ms, 611µs, 516ns | 3s, 468ms, 739µs, 32ns | 3s, 542ms, 589µs, 902ns |
| Ray-di(Reflection, Transient) | ^2.16 | 344ms, 328µs, 880ns | 339ms, 638µs, 948ns | 348ms, 464µs, 965ns |
| Symfony(Compiled, Singleton) | ^7.0 | 780µs, 272ns | 762µs, 939ns | 818µs, 967ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 261µs, 711ns | 1ms, 129µs, 150ns | 2ms, 295µs, 970ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 31µs, 993ns | 1ms, 709µs, 938ns | 3ms, 139µs, 972ns |
| Auryn(Reflection, Transient) | ^1.4 | 414ms, 170µs, 598ns | 401ms, 41µs, 30ns | 436ms, 159µs, 133ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 843µs, 786ns | 1ms, 711µs, 130ns | 2ms, 145µs, 51ns |
| Dice(Reflection, Transient) | ^4.0 | 71ms, 148µs, 276ns | 70ms, 491µs, 75ns | 73ms, 110µs, 818ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 116µs, 347ns | 935µs, 77ns | 2ms, 293µs, 825ns |
| Laravel(Configured, Transient) | ^12.28 | 407ms, 29µs, 294ns | 397ms, 823µs, 95ns | 427ms, 538µs, 156ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 705µs, 906ns | 3ms, 354µs, 72ns | 4ms, 729µs, 986ns |
| Laravel(Reflection, Transient) | ^12.28 | 629ms, 228µs, 925ns | 625ms, 118µs, 970ns | 632ms, 358µs, 74ns |
| League(Configured, Transient) | ^5.1 | 828ms, 286µs, 528ns | 707ms, 325µs, 935ns | 858ms, 843µs, 88ns |
| League(Reflection, Transient) | ^5.1 | 660ms, 708µs, 475ns | 648ms, 866µs, 891ns | 673ms, 776µs, 865ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 560µs, 304ns | 3ms, 392µs, 934ns | 3ms, 980µs, 875ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 81µs, 511ns | 3ms, 583µs, 908ns | 5ms, 133µs, 867ns |
| Phalcon(Configured, Transient) | ^5 | 295ms, 512µs, 8ns | 292ms, 556µs, 47ns | 299ms, 62µs, 967ns |
| Php-baseline |  | 593µs, 328ns | 572µs, 919ns | 609µs, 159ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 100µs, 802ns | 854µs, 969ns | 3ms, 185µs, 33ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 349µs, 902ns | 1ms, 315µs, 832ns | 1ms, 548µs, 51ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 954µs, 8ns | 98ms, 23µs, 891ns | 119ms, 896µs, 173ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 993ns | 782µs, 966ns | 1ms, 85µs, 42ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 55µs, 811ns | 1ms, 945µs, 18ns | 2ms, 710µs, 103ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 459µs, 97ns | 1ms, 348µs, 972ns | 2ms, 183µs, 914ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 485ms, 264µs, 396ns | 3s, 436ms, 836µs, 957ns | 3s, 527ms, 786µs, 970ns |
| Ray-di(Reflection, Transient) | ^2.16 | 372ms, 615µs, 718ns | 332ms, 633µs, 18ns | 380ms, 321µs, 25ns |
| Symfony(Compiled, Singleton) | ^7.0 | 766µs, 515ns | 735µs, 44ns | 786µs, 66ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 86µs, 592ns | 880µs, 956ns | 2ms, 873µs, 897ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 885µs, 700ns | 1ms, 514µs, 911ns | 3ms, 73µs, 930ns |
| Dice(Configured, Singleton) | ^4.0 | 889µs, 15ns | 756µs, 978ns | 1ms, 313µs, 924ns |
| Laravel(Configured, Transient) | ^12.28 | 373ms, 712µs, 277ns | 322ms, 890µs, 996ns | 382ms, 387µs, 876ns |
| League(Configured, Transient) | ^5.1 | 4s, 157ms, 706µs, 236ns | 4s, 96ms, 206µs, 903ns | 4s, 223ms, 624µs, 944ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 20µs, 118ns | 3ms, 756µs, 999ns | 5ms, 197µs, 48ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 185µs, 271ns | 3ms, 983µs, 974ns | 5ms, 307µs, 912ns |
| Phalcon(Configured, Transient) | ^5 | 294ms, 100µs, 928ns | 289ms, 47µs, 956ns | 298ms, 869µs, 132ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 318µs, 264ns | 1ms, 275µs, 62ns | 1ms, 469µs, 135ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 244µs, 522ns | 98ms, 723µs, 888ns | 102ms, 34µs, 807ns |
| Quickly(Compiled, Singleton) | dev-master | 792µs, 121ns | 777µs, 6ns | 832µs, 80ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 798µs, 770ns | 3ms, 736µs, 972ns | 3ms, 890µs, 991ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 520ms, 163µs, 512ns | 3s, 478ms, 19µs, 952ns | 3s, 578ms, 189µs, 849ns |
| Symfony(Compiled, Singleton) | ^7.0 | 769µs, 758ns | 752µs, 925ns | 787µs, 973ns |
| Zen(Compiled, Singleton) | ^3.1 | 836µs, 253ns | 748µs, 872ns | 1ms, 462µs, 936ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 695µs, 393ns | 1ms, 681µs, 804ns | 5ms, 246µs, 162ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 878µs, 738ns | 1ms, 780µs, 986ns | 2ms, 186µs, 59ns |
| Laravel(Configured, Transient) | ^12.28 | 384ms, 340µs, 429ns | 376ms, 791µs, 954ns | 392ms, 79µs, 114ns |
| League(Configured, Transient) | ^5.1 | 4s, 139ms, 267µs, 945ns | 4s, 88ms, 329µs, 76ns | 4s, 197ms, 952µs, 32ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 899µs, 335ns | 3ms, 828µs, 48ns | 4ms, 226µs, 922ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 152µs, 131ns | 4ms, 2µs, 94ns | 4ms, 523µs, 992ns |
| Phalcon(Configured, Transient) | ^5 | 305ms, 811µs, 738ns | 291ms, 265µs, 10ns | 356ms, 498µs, 3ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 349µs, 878ns | 1ms, 298µs, 904ns | 1ms, 567µs, 125ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 576µs, 330ns | 98ms, 425µs, 149ns | 100ms, 584µs, 983ns |
| Quickly(Compiled, Singleton) | dev-master | 929µs, 522ns | 802µs, 40ns | 1ms, 149µs, 177ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 682µs, 588ns | 4ms, 550µs, 933ns | 5ms, 321µs, 25ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 515ms, 946µs, 626ns | 3s, 491ms, 276µs, 979ns | 3s, 543ms, 385µs, 982ns |
| Symfony(Compiled, Singleton) | ^7.0 | 748µs, 419ns | 733µs, 137ns | 772µs, 953ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 74µs, 910ns | 809µs, 907ns | 2ms, 875µs, 89ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 352µs, 376ns | 5ms, 238µs, 56ns | 10ms, 329µs, 8ns |
| Dice(Configured, Singleton) | ^4.0 | 924µs, 420ns | 838µs, 994ns | 1ms, 502µs, 990ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 118ms, 489µs, 122ns | 10s, 43ms, 968µs, 915ns | 10s, 263ms, 149µs, 976ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 955µs, 247ns | 760µs, 793ns | 1ms, 240µs, 968ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 717µs, 494ns | 3ms, 623µs, 962ns | 4ms, 71µs, 950ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 537ms, 708µs, 592ns | 87s, 419ms, 869µs, 899ns | 89s, 641ms, 840µs, 934ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 524µs, 65ns | 3ms, 450µs, 155ns | 3ms, 921µs, 985ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 604µs, 768ns | 4ms, 72µs, 904ns | 8ms, 210µs, 897ns |
| Php-baseline |  | 625µs, 991ns | 491µs, 857ns | 828µs, 981ns |
| Php-di(Reflection, Singleton) | ^7.0 | 856µs, 685ns | 767µs, 946ns | 1ms, 273µs, 155ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 299µs, 214ns | 1ms, 270µs, 55ns | 1ms, 327µs, 991ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 703ms, 422µs, 594ns | 13s, 587ms, 146µs, 43ns | 13s, 796ms, 100µs, 854ns |
| Quickly(Compiled, Singleton) | dev-master | 902µs, 509ns | 815µs, 153ns | 1ms, 176µs, 118ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 280µs, 926ns | 2ms, 240µs, 180ns | 2ms, 418µs, 994ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 369µs, 690ns | 1ms, 293µs, 897ns | 1ms, 482µs, 9ns |
| Symfony(Compiled, Singleton) | ^7.0 | 780µs, 320ns | 765µs, 85ns | 802µs, 40ns |
| Zen(Compiled, Singleton) | ^3.1 | 838µs, 518ns | 751µs, 972ns | 1ms, 474µs, 142ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 614µs, 518ns | 5ms, 711µs, 78ns | 6ms, 857µs, 872ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 189µs, 373ns | 2ms, 137µs, 899ns | 2ms, 315µs, 998ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 126ms, 90µs, 264ns | 10s, 52ms, 620µs, 887ns | 10s, 249ms, 408µs, 960ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 999µs, 188ns | 861µs, 167ns | 2ms, 93ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 66µs, 919ns | 4ms, 604µs, 101ns | 8ms, 51µs, 156ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 667ms, 772µs, 626ns | 88s, 168ms, 214µs, 82ns | 89s, 526ms, 780µs, 128ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 650µs, 307ns | 3ms, 540µs, 39ns | 3ms, 936µs, 52ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 291µs, 224ns | 4ms, 239µs, 82ns | 4ms, 338µs, 979ns |
| Php-baseline |  | 644µs, 969ns | 573µs, 873ns | 861µs, 883ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 85µs, 400ns | 832µs, 80ns | 3ms, 123µs, 998ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 381µs, 874ns | 1ms, 307µs, 10ns | 1ms, 610µs, 40ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 676ms, 626µs, 896ns | 13s, 72ms, 304µs, 964ns | 13s, 938ms, 886µs, 165ns |
| Quickly(Compiled, Singleton) | dev-master | 818µs, 872ns | 801µs, 86ns | 830µs, 888ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 129µs, 530ns | 2ms, 25µs, 842ns | 2ms, 789µs, 974ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 562µs, 309ns | 1ms, 457µs, 929ns | 2ms, 375µs, 125ns |
| Symfony(Compiled, Singleton) | ^7.0 | 813µs, 31ns | 788µs, 927ns | 887µs, 155ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 628µs, 184ns | 1ms, 285µs, 76ns | 4ms, 481µs, 77ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 143µs, 931ns | 1ms, 806µs, 20ns | 3ms, 318µs, 71ns |
| Dice(Configured, Singleton) | ^4.0 | 930µs, 333ns | 827µs, 74ns | 1ms, 497µs, 30ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 844µs, 714ns | 3ms, 760µs, 99ns | 4ms, 173µs, 40ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 488µs, 897ns | 3ms, 539µs, 800ns | 8ms, 121µs, 967ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 530µs, 3ns | 1ms, 239µs, 61ns | 2ms, 264µs, 976ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 760ms, 974µs, 73ns | 13s, 581ms, 778µs, 49ns | 14s, 132ms, 957µs, 935ns |
| Quickly(Compiled, Singleton) | dev-master | 796µs, 627ns | 784µs, 873ns | 837µs, 87ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 854µs, 870ns | 3ms, 814µs, 935ns | 3ms, 949µs, 165ns |
| Symfony(Compiled, Singleton) | ^7.0 | 820µs, 612ns | 747µs, 919ns | 971µs, 78ns |
| Zen(Compiled, Singleton) | ^3.1 | 913µs, 643ns | 731µs, 945ns | 2ms, 278µs, 89ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 515µs, 410ns | 3ms, 144µs, 25ns | 5ms, 501µs, 31ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 402µs, 400ns | 2ms, 84µs, 970ns | 3ms, 823µs, 995ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 172µs, 86ns | 3ms, 872µs, 871ns | 5ms, 77µs, 838ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 393µs, 672ns | 3ms, 875µs, 970ns | 5ms, 848µs, 884ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 388µs, 96ns | 1ms, 339µs, 912ns | 1ms, 626µs, 14ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 798ms, 555µs, 684ns | 13s, 611ms, 762µs, 46ns | 14s, 39ms, 658µs, 69ns |
| Quickly(Compiled, Singleton) | dev-master | 823µs, 640ns | 804µs, 185ns | 856µs, 876ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 621µs, 315ns | 4ms, 456µs, 996ns | 5ms, 249µs, 23ns |
| Symfony(Compiled, Singleton) | ^7.0 | 774µs, 741ns | 757µs, 217ns | 807µs, 46ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 78µs, 605ns | 867µs, 128ns | 2ms, 861µs, 976ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 809µs, 574ns | 774µs, 860ns | 973µs, 939ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 135µs, 728ns | 3ms, 67µs, 970ns | 3ms, 549µs, 98ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 353µs, 716ns | 1ms, 252µs, 889ns | 2ms, 111µs, 911ns |
| Pimple(Configured, Singleton) | ^3.5 | 984µs, 311ns | 977µs, 39ns | 1ms, 8µs, 987ns |
| Quickly(Compiled, Singleton) | dev-master | 791µs, 788ns | 778µs, 913ns | 815µs, 868ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 439µs, 738ns | 1ms, 332µs, 44ns | 2ms, 201µs, 80ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 124µs, 882ns | 1ms, 85µs, 42ns | 1ms, 369µs, 953ns |
| Symfony(Compiled, Singleton) | ^7.0 | 950µs, 407ns | 800µs, 848ns | 1ms, 253µs, 128ns |
| Zen(Compiled, Singleton) | ^3.1 | 849µs, 127ns | 721µs, 931ns | 1ms, 554µs, 12ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 750µs, 16ns | 1ms, 497µs, 983ns | 3ms, 607µs, 34ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 624µs, 57ns | 3ms, 561µs, 973ns | 4ms, 60µs, 983ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 155µs, 543ns | 907µs, 182ns | 3ms, 183µs, 126ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 448µs, 534ns | 2ms, 387µs, 46ns | 2ms, 759µs, 218ns |
| Quickly(Compiled, Singleton) | dev-master | 813µs, 841ns | 788µs, 927ns | 846µs, 147ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 360µs, 892ns | 2ms, 63µs, 35ns | 3ms, 330µs, 945ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 571µs, 130ns | 1ms, 468µs, 896ns | 2ms, 313µs, 137ns |
| Symfony(Compiled, Singleton) | ^7.0 | 794µs, 696ns | 782µs, 966ns | 823µs, 20ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 94µs, 579ns | 880µs, 956ns | 2ms, 830µs, 28ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 35µs, 973ns | 3ms, 741µs, 979ns | 5ms, 722µs, 45ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 274µs, 13ns | 1ms, 260µs, 42ns | 1ms, 291µs, 990ns |
| Quickly(Compiled, Singleton) | dev-master | 791µs, 525ns | 770µs, 92ns | 859µs, 22ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 780µs, 794ns | 3ms, 738µs, 880ns | 3ms, 872µs, 871ns |
| Symfony(Compiled, Singleton) | ^7.0 | 785µs, 779ns | 746µs, 11ns | 976µs, 85ns |
| Zen(Compiled, Singleton) | ^3.1 | 869µs, 941ns | 755µs, 71ns | 1ms, 564µs, 979ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 832µs, 888ns | 3ms, 731µs, 966ns | 4ms, 133µs, 939ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 410µs, 770ns | 1ms, 339µs, 197ns | 1ms, 667µs, 976ns |
| Quickly(Compiled, Singleton) | dev-master | 795µs, 817ns | 779µs, 867ns | 821µs, 113ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 791µs, 331ns | 4ms, 456µs, 43ns | 6ms, 345µs, 987ns |
| Symfony(Compiled, Singleton) | ^7.0 | 827µs, 527ns | 782µs, 966ns | 967µs, 25ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 134µs, 896ns | 912µs, 904ns | 2ms, 951µs, 860ns |

</details>

Questions, issues, and new containers are welcome!
