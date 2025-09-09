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
| [Phalcon](https://github.com/phalcon/cphalcon) | A PHP extension built for performance |
| [PHP (baseline)](https://www.php.net/) | Manual instantiation of dependencies without a container |
| [Quickly](https://github.com/Idrinth/quickly) | A fast dependency injection container featuring build time resolution. |
| [Ray.Di](https://github.com/ray-di/Ray.Di) | DI and AOP framework for PHP inspired by Google Guice |
| [Zen](https://github.com/woohoolabs/zen) | Woohoo Labs. Zen DI Container and preload file generator |
## Latest Results

Run from 2025-09-09

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 629µs, 543ns | 1ms, 498µs, 937ns | 1ms, 885µs, 890ns |
| auryn | ^1.4 | 411ms, 370µs, 587ns | 402ms, 865µs, 886ns | 438ms, 215µs, 970ns |
| dice(configured) | ^4.0 | 71ms, 142µs, 458ns | 69ms, 625µs, 139ns | 77ms, 555µs, 179ns |
| dice(unconfigured) | ^4.0 | 71ms, 499µs, 896ns | 69ms, 3µs, 105ns | 84ms, 269µs, 46ns |
| laminas-servicemanager | ^3.21 | 799µs, 12ns | 777µs, 959ns | 814µs, 199ns |
| laravel(cached) | ^12.28 | 406ms, 217µs, 956ns | 398ms, 468µs, 17ns | 416ms, 830µs, 62ns |
| laravel(singletons) | ^12.28 | 3ms, 567µs, 123ns | 3ms, 401µs, 994ns | 3ms, 900µs, 51ns |
| laravel(unconfigured) | ^12.28 | 630ms, 737µs, 924ns | 621ms, 142µs, 148ns | 647ms, 541µs, 999ns |
| league(predefined) | ^5.1 | 859ms, 576µs, 177ns | 849ms, 10µs, 944ns | 872ms, 282µs, 981ns |
| league(unconfigured) | ^5.1 | 668ms, 225µs, 884ns | 661ms, 146µs, 879ns | 684ms, 271µs, 812ns |
| nette-di | ^3.2 | 3ms, 560µs, 328ns | 3ms, 303µs, 50ns | 5ms, 445µs, 957ns |
| phalcon(shared) | ^5 | 3ms, 929µs, 710ns | 3ms, 885µs, 30ns | 3ms, 979µs, 921ns |
| phalcon(transient) | ^5 | 264ms, 58µs, 184ns | 252ms, 519µs, 130ns | 310ms, 624µs, 837ns |
| php-baseline |  | 3ms, 821µs, 659ns | 3ms, 793µs, 1ns | 3ms, 867µs, 864ns |
| php-di | ^7.0 | 975µs, 584ns | 823µs, 20ns | 1ms, 196µs, 861ns |
| pimple | ^3.5 | 73ms, 979µs, 449ns | 70ms, 6µs, 132ns | 86ms, 961µs, 984ns |
| quickly(compiled) | dev-master | 805µs, 997ns | 791µs, 72ns | 833µs, 34ns |
| quickly(configured) | dev-master | 1ms, 341µs, 700ns | 1ms, 283µs, 168ns | 1ms, 392µs, 126ns |
| quickly(reflection) | dev-master | 1ms, 683µs, 425ns | 1ms, 292µs, 943ns | 2ms, 279µs, 43ns |
| ray-di(compiled) | ^2.16 | 3s, 517ms, 485µs, 618ns | 3s, 493ms, 39µs, 131ns | 3s, 596ms, 945µs, 47ns |
| symfony(compiled) | ^7.0 | 2ms, 243µs, 590ns | 2ms, 151µs, 966ns | 2ms, 751µs, 827ns |
| zen(unconfigured) | ^3.1 | 856µs, 113ns | 766µs, 992ns | 1ms, 519µs, 918ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 2ms, 7µs, 102ns | 1ms, 635µs, 74ns | 3ms, 211µs, 975ns |
| auryn | ^1.4 | 416ms, 302µs, 275ns | 403ms, 311µs, 14ns | 441ms, 632µs, 32ns |
| dice(configured) | ^4.0 | 71ms, 817µs, 469ns | 70ms, 789µs, 813ns | 74ms, 419µs, 975ns |
| dice(unconfigured) | ^4.0 | 75ms, 224µs, 995ns | 71ms, 58µs, 34ns | 80ms, 792µs, 903ns |
| laminas-servicemanager | ^3.21 | 903µs, 749ns | 802µs, 993ns | 1ms, 693µs, 964ns |
| laravel(cached) | ^12.28 | 405ms, 33µs, 349ns | 400ms, 170µs, 87ns | 414ms, 170µs, 26ns |
| laravel(singletons) | ^12.28 | 3ms, 716µs, 349ns | 3ms, 376µs, 7ns | 4ms, 774µs, 808ns |
| laravel(unconfigured) | ^12.28 | 642ms, 118µs, 453ns | 623ms, 152µs, 971ns | 682ms, 61µs, 910ns |
| league(predefined) | ^5.1 | 866ms, 150µs, 236ns | 858ms, 582µs, 19ns | 877ms, 135µs, 38ns |
| league(unconfigured) | ^5.1 | 667ms, 725µs, 992ns | 662ms, 85µs, 56ns | 679ms, 313µs, 898ns |
| nette-di | ^3.2 | 6ms, 267µs, 166ns | 3ms, 331µs, 184ns | 31ms, 342µs, 983ns |
| phalcon(shared) | ^5 | 4ms, 127µs, 240ns | 3ms, 921µs, 985ns | 4ms, 578µs, 113ns |
| phalcon(transient) | ^5 | 258ms, 272µs, 552ns | 253ms, 15µs, 41ns | 281ms, 33µs, 992ns |
| php-baseline |  | 5ms, 330µs, 801ns | 3ms, 772µs, 974ns | 6ms, 900µs, 72ns |
| php-di | ^7.0 | 1ms, 91µs, 241ns | 819µs, 921ns | 3ms, 254µs, 175ns |
| pimple | ^3.5 | 70ms, 805µs, 454ns | 69ms, 355µs, 964ns | 76ms, 843µs, 23ns |
| quickly(compiled) | dev-master | 810µs, 408ns | 785µs, 112ns | 828µs, 981ns |
| quickly(configured) | dev-master | 1ms, 729µs, 822ns | 1ms, 623µs, 868ns | 2ms, 418µs, 41ns |
| quickly(reflection) | dev-master | 1ms, 479µs, 792ns | 1ms, 357µs, 78ns | 2ms, 183µs, 914ns |
| ray-di(compiled) | ^2.16 | 3s, 561ms, 380µs, 791ns | 3s, 519ms, 974µs, 946ns | 3s, 605ms, 448µs, 7ns |
| symfony(compiled) | ^7.0 | 7ms, 151µs, 412ns | 5ms, 792µs, 140ns | 18ms, 651µs, 962ns |
| zen(unconfigured) | ^3.1 | 1ms, 270µs, 890ns | 947µs, 952ns | 3ms, 62µs, 963ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 5ms, 282µs, 950ns | 5ms, 245µs, 923ns | 5ms, 341µs, 53ns |
| dice(configured) | ^4.0 | 9s, 987ms, 555µs, 932ns | 9s, 878ms, 198µs, 862ns | 10s, 192ms, 132µs, 949ns |
| dice(unconfigured) | ^4.0 | 10s, 50ms, 274µs, 62ns | 9s, 978ms, 662µs, 14ns | 10s, 234ms, 478µs, 950ns |
| laminas-servicemanager | ^3.21 | 795µs, 102ns | 749µs, 111ns | 858µs, 68ns |
| laravel(singletons) | ^12.28 | 3ms, 741µs, 669ns | 3ms, 694µs, 57ns | 3ms, 809µs, 928ns |
| nette-di | ^3.2 | 3ms, 396µs, 582ns | 3ms, 338µs, 98ns | 3ms, 442µs, 49ns |
| phalcon(shared) | ^5 | 4ms, 74µs, 263ns | 4ms, 34µs, 42ns | 4ms, 104µs, 852ns |
| php-baseline |  | 11ms, 517µs, 119ns | 9ms, 843µs, 111ns | 18ms, 370µs, 866ns |
| php-di | ^7.0 | 842µs, 738ns | 782µs, 12ns | 1ms, 258µs, 134ns |
| pimple | ^3.5 | 9s, 998ms, 774µs, 814ns | 9s, 871ms, 122µs, 121ns | 10s, 108ms, 376µs, 979ns |
| quickly(compiled) | dev-master | 856µs, 328ns | 805µs, 854ns | 1ms, 142µs, 24ns |
| quickly(configured) | dev-master | 1ms, 356µs, 506ns | 1ms, 317µs, 24ns | 1ms, 399µs, 993ns |
| quickly(reflection) | dev-master | 1ms, 346µs, 802ns | 1ms, 305µs, 818ns | 1ms, 482µs, 9ns |
| symfony(compiled) | ^7.0 | 2ms, 169µs, 609ns | 2ms, 138µs, 137ns | 2ms, 206µs, 87ns |
| zen(unconfigured) | ^3.1 | 827µs, 598ns | 735µs, 998ns | 1ms, 483µs, 917ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 6ms, 759µs, 715ns | 6ms, 562µs, 948ns | 7ms, 467µs, 985ns |
| dice(configured) | ^4.0 | 10s, 84ms, 895µs, 181ns | 9s, 983ms, 160µs, 972ns | 10s, 217ms, 437µs, 982ns |
| dice(unconfigured) | ^4.0 | 10s, 109ms, 194µs, 87ns | 9s, 952ms, 340µs, 126ns | 10s, 418ms, 321µs, 847ns |
| laminas-servicemanager | ^3.21 | 896µs, 334ns | 797µs, 986ns | 1ms, 675µs, 128ns |
| laravel(singletons) | ^12.28 | 5ms, 197µs, 358ns | 4ms, 760µs, 26ns | 7ms, 743µs, 835ns |
| nette-di | ^3.2 | 5ms, 631µs, 709ns | 3ms, 433µs, 942ns | 23ms, 769µs, 855ns |
| phalcon(shared) | ^5 | 4ms, 353µs, 189ns | 4ms, 86µs, 17ns | 5ms, 673µs, 885ns |
| php-baseline |  | 11ms, 143µs, 732ns | 9ms, 423µs, 17ns | 15ms, 553µs, 951ns |
| php-di | ^7.0 | 1ms, 851µs, 511ns | 1ms, 435µs, 995ns | 5ms, 405µs, 902ns |
| pimple | ^3.5 | 10s, 117ms, 396µs, 497ns | 9s, 839ms, 81µs, 48ns | 11s, 296ms, 665µs, 906ns |
| quickly(compiled) | dev-master | 894µs, 355ns | 782µs, 12ns | 1ms, 163µs, 959ns |
| quickly(configured) | dev-master | 1ms, 803µs, 779ns | 1ms, 659µs, 870ns | 2ms, 809µs, 47ns |
| quickly(reflection) | dev-master | 1ms, 476µs, 311ns | 1ms, 377µs, 105ns | 2ms, 130µs, 31ns |
| symfony(compiled) | ^7.0 | 7ms, 341µs, 122ns | 5ms, 742µs, 73ns | 18ms, 719µs, 911ns |
| zen(unconfigured) | ^3.1 | 1ms, 12µs, 325ns | 813µs, 7ns | 2ms, 681µs, 970ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 761µs, 818ns | 715µs, 970ns | 864µs, 28ns |
| nette-di | ^3.2 | 3ms, 689µs, 908ns | 3ms, 423µs, 929ns | 5ms, 550µs, 861ns |
| php-di | ^7.0 | 960µs, 183ns | 793µs, 933ns | 1ms, 346µs, 826ns |
| quickly(compiled) | dev-master | 800µs, 108ns | 787µs, 973ns | 830µs, 888ns |
| quickly(configured) | dev-master | 1ms, 342µs, 82ns | 1ms, 279µs, 115ns | 1ms, 639µs, 842ns |
| quickly(reflection) | dev-master | 1ms, 388µs, 49ns | 1ms, 334µs, 190ns | 1ms, 614µs, 93ns |
| symfony(compiled) | ^7.0 | 2ms, 243µs, 876ns | 2ms, 109µs, 50ns | 2ms, 653µs, 837ns |
| zen(unconfigured) | ^3.1 | 853µs, 419ns | 756µs, 978ns | 1ms, 568µs, 78ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 1ms, 10µs, 799ns | 881µs, 910ns | 1ms, 974µs, 105ns |
| nette-di | ^3.2 | 5ms, 515µs, 3ns | 3ms, 417µs, 968ns | 23ms, 936µs, 33ns |
| php-di | ^7.0 | 1ms, 209µs, 592ns | 936µs, 31ns | 3ms, 420µs, 114ns |
| quickly(compiled) | dev-master | 810µs, 909ns | 797µs, 33ns | 837µs, 87ns |
| quickly(configured) | dev-master | 1ms, 795µs, 101ns | 1ms, 695µs, 871ns | 2ms, 500µs, 57ns |
| quickly(reflection) | dev-master | 1ms, 573µs, 634ns | 1ms, 466µs, 989ns | 2ms, 312µs, 183ns |
| symfony(compiled) | ^7.0 | 7ms, 162µs, 809ns | 5ms, 856µs, 990ns | 18ms, 307µs, 924ns |
| zen(unconfigured) | ^3.1 | 1ms, 94µs, 865ns | 852µs, 108ns | 2ms, 836µs, 227ns |

</details>

Questions, issues, and new containers are welcome!
