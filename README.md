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

Run from 2026-02-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 710µs, 700ns | 1ms, 630µs, 67ns | 1ms, 866µs, 817ns |
| Auryn(Reflection, Transient) | ^1.4 | 392ms, 337µs, 107ns | 358ms, 478µs, 69ns | 412ms, 531µs, 852ns |
| Dice(Configured, Singleton) | ^4.0 | 767µs, 898ns | 678µs, 62ns | 859µs, 22ns |
| Dice(Reflection, Transient) | ^4.0 | 66ms, 766µs, 500ns | 61ms, 503µs, 887ns | 73ms, 199µs, 987ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 690µs, 412ns | 674µs, 962ns | 708µs, 103ns |
| Laravel(Configured, Transient) | ^12.28 | 408ms, 151µs, 507ns | 393ms, 172µs, 25ns | 472ms, 101µs, 926ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 106µs, 712ns | 3ms, 343µs, 820ns | 6ms, 299µs, 18ns |
| Laravel(Reflection, Transient) | ^12.28 | 627ms, 72µs, 954ns | 619ms, 239µs, 91ns | 637ms, 320µs, 41ns |
| League(Configured, Transient) | ^5.1 | 850ms, 516µs, 438ns | 687ms, 857µs, 866ns | 921ms, 310µs, 901ns |
| League(Reflection, Transient) | ^5.1 | 670ms, 766µs, 997ns | 654ms, 997µs, 110ns | 692ms, 272µs, 901ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 341µs, 984ns | 3ms, 263µs, 950ns | 3ms, 726µs, 5ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 26µs, 603ns | 4ms, 1µs, 855ns | 4ms, 59µs, 76ns |
| Phalcon(Configured, Transient) | ^5 | 284ms, 769µs, 701ns | 253ms, 509µs, 44ns | 310ms, 99µs, 124ns |
| Php-baseline |  | 607µs, 919ns | 589µs, 847ns | 625µs, 133ns |
| Php-di(Reflection, Singleton) | ^7.0 | 868µs, 391ns | 813µs, 7ns | 1ms, 195µs, 907ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 290µs, 11ns | 1ms, 262µs, 903ns | 1ms, 331µs, 90ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 759µs, 264ns | 100ms, 162µs, 29ns | 112ms, 936µs, 973ns |
| Quickly(Compiled, Singleton) | dev-master | 783µs, 920ns | 746µs, 11ns | 810µs, 146ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 398µs, 277ns | 1ms, 377µs, 105ns | 1ms, 429µs, 80ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 398µs, 563ns | 1ms, 368µs, 999ns | 1ms, 515µs, 865ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 368ms, 963µs, 432ns | 1s, 922ms, 559µs, 22ns | 3s, 572ms, 603µs, 225ns |
| Ray-di(Reflection, Transient) | ^2.16 | 390ms, 95µs, 186ns | 353ms, 19µs, 952ns | 410ms, 682µs, 916ns |
| Symfony(Compiled, Singleton) | ^7.0 | 677µs, 204ns | 645µs, 875ns | 727µs, 891ns |
| Zen(Compiled, Singleton) | ^3.1 | 822µs, 806ns | 746µs, 965ns | 1ms, 415µs, 14ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 809µs, 357ns | 1ms, 878µs, 976ns | 5ms, 21µs, 95ns |
| Auryn(Reflection, Transient) | ^1.4 | 403ms, 845µs, 524ns | 367ms, 117µs, 166ns | 410ms, 793µs, 66ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 858µs, 115ns | 1ms, 767µs, 158ns | 2ms, 197µs, 980ns |
| Dice(Reflection, Transient) | ^4.0 | 73ms, 767µs, 232ns | 71ms, 455µs, 955ns | 80ms, 11µs, 844ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 794µs, 625ns | 693µs, 82ns | 1ms, 618µs, 146ns |
| Laravel(Configured, Transient) | ^12.28 | 403ms, 484µs, 773ns | 399ms, 101µs, 18ns | 406ms, 846µs, 46ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 117µs, 82ns | 3ms, 443µs, 2ns | 8ms, 560µs, 180ns |
| Laravel(Reflection, Transient) | ^12.28 | 579ms, 537µs, 653ns | 527ms, 621µs, 984ns | 641ms, 481µs, 876ns |
| League(Configured, Transient) | ^5.1 | 873ms, 389µs, 458ns | 684ms, 781µs, 74ns | 943ms, 315µs, 982ns |
| League(Reflection, Transient) | ^5.1 | 660ms, 137µs, 319ns | 550ms, 372µs, 123ns | 695ms, 157µs, 51ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 23µs, 2ns | 3ms, 219µs, 127ns | 7ms, 236µs, 957ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 155µs, 826ns | 4ms, 95µs, 77ns | 4ms, 261µs, 970ns |
| Phalcon(Configured, Transient) | ^5 | 299ms, 182µs, 33ns | 291ms, 651µs, 964ns | 317ms, 209µs, 5ns |
| Php-baseline |  | 599µs, 217ns | 570µs, 58ns | 657µs, 81ns |
| Php-di(Reflection, Singleton) | ^7.0 | 889µs, 968ns | 702µs, 857ns | 2ms, 459µs, 49ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 389µs, 122ns | 1ms, 317µs, 977ns | 1ms, 644µs, 134ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 80µs, 633ns | 95ms, 14µs, 95ns | 105ms, 704µs, 69ns |
| Quickly(Compiled, Singleton) | dev-master | 798µs, 654ns | 782µs, 12ns | 839µs, 948ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 192µs, 592ns | 2ms, 84µs, 16ns | 2ms, 948µs, 45ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 526µs, 665ns | 1ms, 400µs, 947ns | 2ms, 270µs, 936ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 341ms, 757µs, 869ns | 1s, 963ms, 707µs, 923ns | 3s, 537ms, 88µs, 871ns |
| Ray-di(Reflection, Transient) | ^2.16 | 394ms, 537µs, 711ns | 357ms, 455µs, 15ns | 419ms, 28µs, 997ns |
| Symfony(Compiled, Singleton) | ^7.0 | 785µs, 493ns | 758µs, 886ns | 824µs, 928ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 34µs, 92ns | 805µs, 139ns | 2ms, 818µs, 107ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 732µs, 587ns | 1ms, 679µs, 897ns | 1ms, 837µs, 15ns |
| Dice(Configured, Singleton) | ^4.0 | 837µs, 159ns | 783µs, 920ns | 892µs, 877ns |
| Laravel(Configured, Transient) | ^12.28 | 378ms, 417µs, 992ns | 372ms, 458µs, 934ns | 390ms, 846µs, 967ns |
| League(Configured, Transient) | ^5.1 | 4s, 268ms, 87µs, 458ns | 3s, 487ms, 65µs, 76ns | 4s, 588ms, 374µs, 137ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 749µs, 799ns | 3ms, 647µs, 89ns | 4ms, 369µs, 20ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 705µs, 523ns | 4ms, 902ns | 7ms, 828µs, 950ns |
| Phalcon(Configured, Transient) | ^5 | 295ms, 362µs, 567ns | 260ms, 221µs, 958ns | 315ms, 669µs, 59ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 303µs, 839ns | 1ms, 245µs, 21ns | 1ms, 483µs, 917ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 417µs, 944ns | 101ms, 594µs, 924ns | 106ms, 503µs, 963ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 129µs, 961ns | 1ms, 96µs, 10ns | 1ms, 152µs, 992ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 866µs, 910ns | 3ms, 829µs, 2ns | 3ms, 938µs, 913ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 386ms, 715µs, 483ns | 1s, 964ms, 395µs, 46ns | 3s, 601ms, 388µs, 931ns |
| Symfony(Compiled, Singleton) | ^7.0 | 805µs, 377ns | 763µs, 893ns | 866µs, 889ns |
| Zen(Compiled, Singleton) | ^3.1 | 844µs, 717ns | 767µs, 946ns | 1ms, 430µs, 988ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 86µs, 305ns | 1ms, 667µs, 976ns | 3ms, 296µs, 136ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 864µs, 528ns | 1ms, 761µs, 913ns | 2ms, 146µs, 959ns |
| Laravel(Configured, Transient) | ^12.28 | 372ms, 814µs, 679ns | 332ms, 95µs, 861ns | 383ms, 250µs, 951ns |
| League(Configured, Transient) | ^5.1 | 4s, 180ms, 598µs, 592ns | 3s, 387ms, 454µs, 32ns | 4s, 463ms, 328µs, 838ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 440µs, 451ns | 3ms, 343µs, 105ns | 3ms, 785µs, 133ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 92µs, 311ns | 3ms, 962µs, 993ns | 4ms, 241µs, 943ns |
| Phalcon(Configured, Transient) | ^5 | 290ms, 45µs, 499ns | 262ms, 240µs, 886ns | 295ms, 892µs, 953ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 364µs, 40ns | 1ms, 310µs, 110ns | 1ms, 616µs, 1ns |
| Pimple(Configured, Transient) | ^3.5 | 107ms, 90µs, 806ns | 102ms, 555µs, 36ns | 121ms, 824µs, 979ns |
| Quickly(Compiled, Singleton) | dev-master | 992µs, 226ns | 781µs, 59ns | 1ms, 169µs, 919ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 136µs, 109ns | 4ms, 28µs, 81ns | 4ms, 768µs, 848ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 538ms, 672µs, 423ns | 3s, 471ms, 426µs, 963ns | 3s, 582ms, 831µs, 144ns |
| Symfony(Compiled, Singleton) | ^7.0 | 759µs, 601ns | 735µs, 998ns | 808µs, 954ns |
| Zen(Compiled, Singleton) | ^3.1 | 816µs, 798ns | 645µs, 875ns | 2ms, 238µs, 35ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 453µs, 896ns | 4ms, 719µs, 18ns | 6ms, 138µs, 86ns |
| Dice(Configured, Singleton) | ^4.0 | 923µs, 180ns | 751µs, 972ns | 1ms, 425µs, 27ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 302ms, 154µs, 254ns | 10s, 176ms, 782µs, 846ns | 10s, 471ms, 702µs, 98ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 795µs, 197ns | 765µs, 85ns | 926µs, 17ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 593µs, 206ns | 2ms, 977µs, 132ns | 3ms, 925µs, 85ns |
| Laravel(Reflection, Transient) | ^12.28 | 85s, 817ms, 829µs, 966ns | 73s, 565ms, 932µs, 989ns | 90s, 108ms, 329µs, 57ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 559µs, 231ns | 3ms, 271µs, 102ns | 4ms, 673µs, 4ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 125µs, 499ns | 3ms, 994µs, 941ns | 4ms, 300µs, 832ns |
| Php-baseline |  | 616µs, 478ns | 465µs, 154ns | 844µs, 1ns |
| Php-di(Reflection, Singleton) | ^7.0 | 871µs, 610ns | 818µs, 14ns | 1ms, 271µs, 9ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 362µs, 490ns | 1ms, 329µs, 898ns | 1ms, 433µs, 134ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 68ms, 137µs, 145ns | 13s, 72ms, 383µs, 880ns | 14s, 354ms, 721µs, 69ns |
| Quickly(Compiled, Singleton) | dev-master | 824µs, 69ns | 785µs, 112ns | 852µs, 823ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 413µs, 106ns | 1ms, 379µs, 13ns | 1ms, 450µs, 61ns |
| Quickly(Reflection, Singleton) | dev-master | 2ms, 375µs, 316ns | 2ms, 335µs, 786ns | 2ms, 506µs, 971ns |
| Symfony(Compiled, Singleton) | ^7.0 | 768µs, 89ns | 744µs, 104ns | 802µs, 40ns |
| Zen(Compiled, Singleton) | ^3.1 | 876µs, 283ns | 793µs, 933ns | 1ms, 517µs, 57ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 485µs, 818ns | 5ms, 720µs, 138ns | 12ms, 658µs, 119ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 396µs, 917ns | 1ms, 864µs, 194ns | 3ms, 875µs, 17ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 123ms, 756µs, 74ns | 8s, 693ms, 716µs, 49ns | 10s, 448ms, 308µs, 944ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 6µs, 674ns | 887µs, 155ns | 2ms, 22µs, 981ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 881µs, 310ns | 4ms, 766µs, 941ns | 5ms, 25µs, 148ns |
| Laravel(Reflection, Transient) | ^12.28 | 85s, 897ms, 428µs, 393ns | 73s, 867ms, 430µs, 925ns | 89s, 386ms, 105µs, 60ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 338µs, 932ns | 3ms, 248µs, 929ns | 3ms, 642µs, 82ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 693µs, 913ns | 4ms, 190µs, 921ns | 8ms, 219µs, 957ns |
| Php-baseline |  | 654µs, 411ns | 613µs, 927ns | 799µs, 179ns |
| Php-di(Reflection, Singleton) | ^7.0 | 939µs, 750ns | 751µs, 972ns | 2ms, 473µs, 831ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 471µs, 757ns | 1ms, 402µs, 854ns | 1ms, 694µs, 917ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 275ms, 461µs, 483ns | 13s, 114ms, 73µs, 38ns | 14s, 845ms, 868µs, 110ns |
| Quickly(Compiled, Singleton) | dev-master | 795µs, 626ns | 771µs, 999ns | 808µs |
| Quickly(Configured, Singleton) | dev-master | 2ms, 92µs, 218ns | 1ms, 670µs, 122ns | 3ms, 122µs, 91ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 502µs, 203ns | 1ms, 407µs, 861ns | 2ms, 237µs, 81ns |
| Symfony(Compiled, Singleton) | ^7.0 | 785µs, 517ns | 723µs, 838ns | 853µs, 61ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 49µs, 995ns | 834µs, 941ns | 2ms, 893µs, 924ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 878µs, 285ns | 1ms, 544µs, 952ns | 2ms, 17µs, 21ns |
| Dice(Configured, Singleton) | ^4.0 | 906µs, 634ns | 734µs, 90ns | 1ms, 399µs, 993ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 676µs, 247ns | 3ms, 600µs, 835ns | 4ms, 22µs, 836ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 69µs, 590ns | 3ms, 550µs, 52ns | 4ms, 549µs, 980ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 311µs, 635ns | 1ms, 247µs, 882ns | 1ms, 358µs, 32ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 324ms, 100µs, 65ns | 13s, 120ms, 57µs, 106ns | 14s, 629ms, 402µs, 875ns |
| Quickly(Compiled, Singleton) | dev-master | 875µs, 186ns | 782µs, 12ns | 1ms, 134µs, 157ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 874µs, 39ns | 3ms, 812µs, 74ns | 4ms, 286µs, 50ns |
| Symfony(Compiled, Singleton) | ^7.0 | 898µs, 909ns | 873µs, 804ns | 967µs, 979ns |
| Zen(Compiled, Singleton) | ^3.1 | 846µs, 266ns | 743µs, 150ns | 1ms, 534µs, 223ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 241µs, 944ns | 2ms, 660µs, 989ns | 3ms, 391µs, 981ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 202µs, 653ns | 1ms, 906µs, 871ns | 2ms, 359µs, 867ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 420µs, 90ns | 3ms, 348µs, 112ns | 3ms, 779µs, 888ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 524µs, 183ns | 4ms, 163µs, 26ns | 5ms, 434µs, 36ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 372µs, 385ns | 1ms, 321µs, 792ns | 1ms, 632µs, 928ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 279ms, 617µs, 547ns | 13s, 160ms, 936µs, 117ns | 14s, 462ms, 935µs, 924ns |
| Quickly(Compiled, Singleton) | dev-master | 820µs, 636ns | 753µs, 879ns | 894µs, 69ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 667µs, 568ns | 4ms, 509µs, 925ns | 5ms, 326µs, 32ns |
| Symfony(Compiled, Singleton) | ^7.0 | 798µs, 821ns | 778µs, 913ns | 828µs, 27ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 70µs, 284ns | 850µs, 200ns | 2ms, 917µs, 51ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 817µs, 322ns | 787µs, 19ns | 997µs, 66ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 262µs, 948ns | 3ms, 176µs, 927ns | 3ms, 740µs, 72ns |
| Php-di(Reflection, Singleton) | ^7.0 | 868µs, 606ns | 808µs | 1ms, 275µs, 62ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 282µs, 978ns | 1ms, 240µs, 968ns | 1ms, 338µs, 5ns |
| Quickly(Compiled, Singleton) | dev-master | 789µs, 690ns | 776µs, 52ns | 812µs, 53ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 615µs, 405ns | 1ms, 374µs, 6ns | 2ms, 290µs, 10ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 501µs, 202ns | 1ms, 394µs, 33ns | 1ms, 961µs, 946ns |
| Symfony(Compiled, Singleton) | ^7.0 | 804µs, 281ns | 777µs, 6ns | 852µs, 823ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 233µs, 959ns | 1ms, 91µs, 3ns | 2ms, 371µs, 72ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 216µs, 220ns | 939µs, 130ns | 3ms, 68µs, 208ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 983µs, 829ns | 3ms, 252µs, 983ns | 7ms, 4µs, 22ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 204µs, 466ns | 957µs, 12ns | 3ms, 316µs, 879ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 384µs, 115ns | 1ms, 329µs, 898ns | 1ms, 626µs, 14ns |
| Quickly(Compiled, Singleton) | dev-master | 799µs, 703ns | 772µs, 953ns | 854µs, 15ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 375µs, 888ns | 2ms, 84µs, 16ns | 3ms, 535µs, 32ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 597µs, 309ns | 1ms, 482µs, 963ns | 2ms, 324µs, 104ns |
| Symfony(Compiled, Singleton) | ^7.0 | 840µs, 306ns | 808µs | 901µs, 222ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 158µs, 642ns | 915µs, 50ns | 2ms, 996µs, 206ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 681µs, 778ns | 3ms, 606µs, 81ns | 4ms, 120µs, 111ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 730µs, 108ns | 1ms, 217µs, 126ns | 2ms, 154µs, 111ns |
| Quickly(Compiled, Singleton) | dev-master | 663µs, 661ns | 644µs, 922ns | 694µs, 990ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 863µs, 430ns | 3ms, 842µs, 115ns | 3ms, 910µs, 64ns |
| Symfony(Compiled, Singleton) | ^7.0 | 792µs, 145ns | 753µs, 164ns | 874µs, 42ns |
| Zen(Compiled, Singleton) | ^3.1 | 829µs, 887ns | 732µs, 898ns | 1ms, 527µs, 70ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 717µs, 541ns | 3ms, 645µs, 181ns | 4ms, 153µs, 966ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 54µs, 406ns | 1ms, 23µs, 54ns | 1ms, 263µs, 141ns |
| Quickly(Compiled, Singleton) | dev-master | 882µs, 172ns | 788µs, 927ns | 1ms, 159µs, 906ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 212µs, 236ns | 4ms, 99µs, 130ns | 4ms, 918µs, 98ns |
| Symfony(Compiled, Singleton) | ^7.0 | 654µs, 411ns | 609µs, 159ns | 694µs, 36ns |
| Zen(Compiled, Singleton) | ^3.1 | 891µs, 780ns | 727µs, 176ns | 2ms, 221µs, 822ns |

</details>

Questions, issues, and new containers are welcome!
