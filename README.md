# PHP Dependency Injection Benchmark

![PHP Version](https://img.shields.io/badge/PHP-8.4-blue?logo=php) ![Docker Version](https://img.shields.io/badge/Docker-%2A-lightgrey?logo=docker) ![OS](https://img.shields.io/badge/OS-ubuntu%20latest-blue?logo=ubuntu)

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

## 🧩 Containers

| Container | Features |
| --- | --- |
| [Aura.Di](https://github.com/auraphp/Aura.Di) | Configurable DI container with lazy loading and service factories |
| [PHP-DI](https://github.com/PHP-DI/PHP-DI) | Autowiring, annotations, and compiled container support |
| [Pimple](https://github.com/silexphp/Pimple) | Lightweight closure-based container |
| [Symfony DI](https://github.com/symfony/dependency-injection) | Feature-rich container with configuration and compilation |
| [Laravel Container](https://github.com/laravel/framework) | Framework-integrated container with automatic resolution and binding |
| [Nette DI](https://github.com/nette/di) | High-performance compiled container |
| [Auryn](https://github.com/rdlowrey/auryn) | Auryn is a dependency injector for bootstrapping object-oriented PHP applications. |
| [Dice](https://github.com/Level-2/Dice) | A minimalist dependency injection container for PHP. |
| [Laminas ServiceManager](https://github.com/laminas/laminas-servicemanager) | Factory-driven dependency injection container |
| [League Container](https://github.com/thephpleague/container) | A fast and intuitive dependency injection container. |
| [Phalcon](https://github.com/phalcon/cphalcon) | |
| [Quickly](https://github.com/Idrinth/quickly) | A fast dependency injection container featuring build time resolution. |
| [Ray.Di](https://github.com/ray-di/Ray.Di) | DI and AOP framework for PHP inspired by Google Guice |
## Latest Results

Run from 2025-09-08

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 706µs, 695ns | 1ms, 563µs, 72ns | 2ms, 341µs, 985ns |
| auryn | ^1.4 | 411ms, 450µs, 767ns | 403ms, 391µs, 122ns | 449ms, 997µs, 901ns |
| dice(configured) | ^4.0 | 71ms, 742µs, 343ns | 70ms, 227µs, 146ns | 79ms, 410µs, 76ns |
| dice(unconfigured) | ^4.0 | 72ms, 137µs, 904ns | 70ms, 394µs, 39ns | 78ms, 675µs, 985ns |
| laminas-servicemanager | ^3.21 | 774µs, 788ns | 731µs, 945ns | 823µs, 974ns |
| laravel(cached) | ^12.28 | 402ms, 854µs, 61ns | 395ms, 985µs, 126ns | 412ms, 3µs, 40ns |
| laravel(singletons) | ^12.28 | 3ms, 535µs, 795ns | 3ms, 476µs, 142ns | 3ms, 737µs, 926ns |
| laravel(unconfigured) | ^12.28 | 634ms, 230µs, 852ns | 628ms, 604µs, 173ns | 650ms, 637µs, 865ns |
| league(predefined) | ^5.1 | 865ms, 579µs, 986ns | 859ms, 165µs, 906ns | 871ms, 448µs, 40ns |
| league(unconfigured) | ^5.1 | 670ms, 113µs, 325ns | 653ms, 568µs, 29ns | 682ms, 315µs, 826ns |
| nette-di | ^3.2 | 3ms, 484µs, 106ns | 3ms, 355µs, 979ns | 3ms, 599µs, 166ns |
| phalcon(shared) | ^5 | 4ms, 146µs, 456ns | 3ms, 905µs, 773ns | 5ms, 776µs, 882ns |
| phalcon(transient) | ^5 | 253ms, 926µs, 324ns | 250ms, 455µs, 141ns | 258ms, 5µs, 142ns |
| php-di | ^7.0 | 860µs, 977ns | 770µs, 807ns | 1ms, 545µs, 906ns |
| pimple | ^3.5 | 75ms, 546µs, 193ns | 70ms, 335µs, 149ns | 107ms, 900µs, 857ns |
| quickly(compiled) | dev-master | 797µs, 796ns | 777µs, 6ns | 828µs, 27ns |
| quickly(configured) | dev-master | 1ms, 345µs, 896ns | 1ms, 322µs, 984ns | 1ms, 388µs, 788ns |
| quickly(reflection) | dev-master | 1ms, 383µs, 996ns | 1ms, 348µs, 972ns | 1ms, 461µs, 982ns |
| symfony(compiled) | ^7.0 | 2ms, 174µs, 19ns | 2ms, 120µs, 971ns | 2ms, 207µs, 994ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 850µs, 104ns | 1ms, 574µs, 993ns | 3ms, 881µs, 931ns |
| auryn | ^1.4 | 409ms, 590µs, 578ns | 402ms, 964µs, 115ns | 414ms, 975µs, 881ns |
| dice(configured) | ^4.0 | 71ms, 621µs, 203ns | 70ms, 960µs, 998ns | 72ms, 669µs, 982ns |
| dice(unconfigured) | ^4.0 | 71ms, 640µs, 801ns | 70ms, 302µs, 9ns | 72ms, 202µs, 920ns |
| laminas-servicemanager | ^3.21 | 883µs, 507ns | 786µs, 66ns | 1ms, 623µs, 153ns |
| laravel(cached) | ^12.28 | 409ms, 676µs, 575ns | 397ms, 125µs, 5ns | 426ms, 554µs, 918ns |
| laravel(singletons) | ^12.28 | 4ms, 709µs, 959ns | 3ms, 417µs, 15ns | 6ms, 525µs, 993ns |
| laravel(unconfigured) | ^12.28 | 643ms, 795µs, 394ns | 616ms, 266µs, 965ns | 709ms, 784µs, 30ns |
| league(predefined) | ^5.1 | 868ms, 916µs, 392ns | 850ms, 799µs, 83ns | 885ms, 548µs, 114ns |
| league(unconfigured) | ^5.1 | 665ms, 559µs, 720ns | 660ms, 73µs, 995ns | 668ms, 416µs, 976ns |
| nette-di | ^3.2 | 5ms, 382µs, 37ns | 3ms, 293µs, 37ns | 23ms, 789µs, 882ns |
| phalcon(shared) | ^5 | 5ms, 327µs, 987ns | 4ms, 59µs, 791ns | 8ms, 99µs, 79ns |
| phalcon(transient) | ^5 | 259ms, 280µs, 729ns | 252ms, 273µs, 82ns | 273ms, 355µs, 7ns |
| php-di | ^7.0 | 1ms, 191µs, 306ns | 905µs, 36ns | 3ms, 684µs, 997ns |
| pimple | ^3.5 | 72ms, 798µs, 37ns | 70ms, 241µs, 928ns | 77ms, 846µs, 50ns |
| quickly(compiled) | dev-master | 787µs, 901ns | 763µs, 893ns | 820µs, 159ns |
| quickly(configured) | dev-master | 1ms, 808µs, 381ns | 1ms, 695µs, 871ns | 2ms, 470µs, 970ns |
| quickly(reflection) | dev-master | 1ms, 482µs, 486ns | 1ms, 375µs, 913ns | 2ms, 211µs, 809ns |
| symfony(compiled) | ^7.0 | 9ms, 258µs, 675ns | 5ms, 781µs, 888ns | 23ms, 360µs, 13ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 979µs, 184ns | 1ms, 574µs, 993ns | 5ms, 316µs, 19ns |
| dice(configured) | ^4.0 | 10s, 28ms, 331µs, 208ns | 9s, 820ms, 514µs, 202ns | 10s, 316ms, 78µs, 901ns |
| dice(unconfigured) | ^4.0 | 10s, 19ms, 463µs, 825ns | 9s, 920ms, 562µs, 982ns | 10s, 258ms, 958µs, 101ns |
| laminas-servicemanager | ^3.21 | 770µs, 497ns | 745µs, 58ns | 870µs, 943ns |
| laravel(singletons) | ^12.28 | 3ms, 807µs, 640ns | 3ms, 468µs, 36ns | 4ms, 698µs, 38ns |
| nette-di | ^3.2 | 3ms, 414µs, 225ns | 3ms, 360µs, 986ns | 3ms, 483µs, 57ns |
| phalcon(shared) | ^5 | 4ms, 30µs, 13ns | 3ms, 881µs, 931ns | 4ms, 338µs, 26ns |
| php-di | ^7.0 | 854µs, 539ns | 793µs, 933ns | 1ms, 301µs, 50ns |
| pimple | ^3.5 | 10s, 23ms, 854µs, 64ns | 9s, 888ms, 489µs, 7ns | 10s, 219ms, 935µs, 894ns |
| quickly(compiled) | dev-master | 835µs, 299ns | 785µs, 827ns | 945µs, 91ns |
| quickly(configured) | dev-master | 1ms, 375µs, 222ns | 1ms, 334µs, 190ns | 1ms, 407µs, 861ns |
| quickly(reflection) | dev-master | 1ms, 403µs, 713ns | 1ms, 358µs, 32ns | 1ms, 544µs, 952ns |
| symfony(compiled) | ^7.0 | 2ms, 193µs, 498ns | 2ms, 143µs, 144ns | 2ms, 249µs, 956ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 5ms, 446µs, 720ns | 5ms, 214µs, 929ns | 6ms, 875µs, 38ns |
| dice(configured) | ^4.0 | 10s, 34ms, 152µs, 770ns | 9s, 876ms, 881µs, 122ns | 10s, 250ms, 730µs, 991ns |
| dice(unconfigured) | ^4.0 | 10s, 92ms, 906µs, 332ns | 9s, 920ms, 580µs, 863ns | 10s, 183ms, 115µs, 959ns |
| laminas-servicemanager | ^3.21 | 939µs, 297ns | 833µs, 34ns | 1ms, 759µs, 52ns |
| laravel(singletons) | ^12.28 | 3ms, 670µs, 597ns | 3ms, 483µs, 772ns | 4ms, 800µs, 81ns |
| nette-di | ^3.2 | 5ms, 530µs, 428ns | 3ms, 449µs, 916ns | 23ms, 919µs, 105ns |
| phalcon(shared) | ^5 | 4ms, 77µs, 792ns | 4ms, 9µs, 8ns | 4ms, 252µs, 910ns |
| php-di | ^7.0 | 1ms, 199µs, 293ns | 898µs, 122ns | 3ms, 607µs, 34ns |
| pimple | ^3.5 | 10s, 33ms, 932µs, 709ns | 9s, 840ms, 853µs, 929ns | 10s, 463ms, 857µs, 173ns |
| quickly(compiled) | dev-master | 790µs, 715ns | 776µs, 52ns | 813µs, 7ns |
| quickly(configured) | dev-master | 1ms, 778µs, 984ns | 1ms, 666µs, 69ns | 2ms, 496µs, 4ns |
| quickly(reflection) | dev-master | 1ms, 476µs, 120ns | 1ms, 369µs, 953ns | 2ms, 159µs, 118ns |
| symfony(compiled) | ^7.0 | 7ms, 259µs, 178ns | 5ms, 853µs, 891ns | 19ms, 179µs, 821ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 343ms, 500µs, 375ns | 1ms, 541µs, 852ns | 3s, 420ms, 950µs, 174ns |
| laminas-servicemanager | ^3.21 | 856µs, 399ns | 833µs, 34ns | 955µs, 820ns |
| laravel(singletons) | ^12.28 | 3ms, 458µs, 380ns | 3ms, 376µs, 960ns | 3ms, 901µs, 958ns |
| nette-di | ^3.2 | 3ms, 310µs, 632ns | 3ms, 275µs, 871ns | 3ms, 333µs, 806ns |
| phalcon(shared) | ^5 | 4ms, 228µs, 854ns | 3ms, 902µs, 912ns | 5ms, 690µs, 813ns |
| php-di | ^7.0 | 847µs, 530ns | 735µs, 998ns | 1ms, 324µs, 892ns |
| quickly(compiled) | dev-master | 800µs, 895ns | 784µs, 158ns | 818µs, 14ns |
| quickly(configured) | dev-master | 1ms, 341µs, 986ns | 1ms, 302µs, 3ns | 1ms, 379µs, 966ns |
| quickly(reflection) | dev-master | 1ms, 411µs, 676ns | 1ms, 368µs, 45ns | 1ms, 586µs, 914ns |
| symfony(compiled) | ^7.0 | 2ms, 748µs, 107ns | 2ms, 76µs, 148ns | 4ms, 124µs, 879ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3s, 422ms, 346µs, 854ns | 3s, 387ms, 875µs, 80ns | 3s, 447ms, 956µs, 85ns |
| laminas-servicemanager | ^3.21 | 959µs, 491ns | 840µs, 187ns | 1ms, 760µs, 959ns |
| laravel(singletons) | ^12.28 | 4ms, 51µs, 780ns | 3ms, 663µs, 63ns | 5ms, 695µs, 819ns |
| nette-di | ^3.2 | 5ms, 439µs, 996ns | 3ms, 364µs, 86ns | 23ms, 822µs, 69ns |
| phalcon(shared) | ^5 | 4ms, 337µs, 72ns | 4ms, 53µs, 115ns | 6ms, 56µs, 70ns |
| php-di | ^7.0 | 1ms, 241µs, 350ns | 941µs, 38ns | 3ms, 496µs, 170ns |
| quickly(compiled) | dev-master | 827µs, 479ns | 809µs, 907ns | 854µs, 15ns |
| quickly(configured) | dev-master | 1ms, 947µs, 498ns | 1ms, 802µs, 921ns | 2ms, 509µs, 117ns |
| quickly(reflection) | dev-master | 1ms, 641µs, 321ns | 1ms, 461µs, 982ns | 2ms, 309µs, 83ns |
| symfony(compiled) | ^7.0 | 7ms, 164µs, 931ns | 5ms, 831µs, 3ns | 18ms, 468µs, 141ns |

</details>

Questions, issues, and new containers are welcome!
