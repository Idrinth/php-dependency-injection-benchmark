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
| [PHP (baseline)](https://www.php.net/) | Manual instantiation of dependencies without a container |
| [Quickly](https://github.com/Idrinth/quickly) | A fast dependency injection container featuring build time resolution. |
| [Ray.Di](https://github.com/ray-di/Ray.Di) | DI and AOP framework for PHP inspired by Google Guice |
| Zen | |
## Latest Results

Run from 2025-09-09

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 655µs, 173ns | 1ms, 585µs, 6ns | 1ms, 752µs, 853ns |
| auryn | ^1.4 | 408ms, 425µs, 688ns | 399ms, 839µs, 162ns | 417ms, 499µs, 780ns |
| dice(configured) | ^4.0 | 71ms, 744µs, 799ns | 70ms, 162µs, 57ns | 76ms, 874µs, 971ns |
| dice(unconfigured) | ^4.0 | 74ms, 491µs, 143ns | 69ms, 378µs, 852ns | 107ms, 184µs, 171ns |
| laminas-servicemanager | ^3.21 | 775µs, 98ns | 764µs, 131ns | 789µs, 880ns |
| laravel(cached) | ^12.28 | 407ms, 830µs, 381ns | 398ms, 20µs, 29ns | 428ms, 293µs, 943ns |
| laravel(singletons) | ^12.28 | 6ms, 167µs, 840ns | 4ms, 909µs, 38ns | 6ms, 814µs, 2ns |
| laravel(unconfigured) | ^12.28 | 633ms, 509µs, 659ns | 622ms, 960µs, 90ns | 648ms, 643µs, 970ns |
| league(predefined) | ^5.1 | 860ms, 303µs, 926ns | 847ms, 277µs, 879ns | 889ms, 935µs, 16ns |
| league(unconfigured) | ^5.1 | 665ms, 698µs, 3ns | 657ms, 676µs, 935ns | 677ms, 85µs, 161ns |
| nette-di | ^3.2 | 3ms, 418µs, 302ns | 3ms, 384µs, 113ns | 3ms, 453µs, 969ns |
| phalcon(shared) | ^5 | 3ms, 975µs, 653ns | 3ms, 952µs, 26ns | 4ms, 3µs, 47ns |
| phalcon(transient) | ^5 | 253ms, 798µs, 127ns | 251ms, 65µs, 15ns | 260ms, 442µs, 972ns |
| php-di | ^7.0 | 882µs, 840ns | 800µs, 132ns | 1ms, 248µs, 121ns |
| pimple | ^3.5 | 76ms, 402µs, 950ns | 69ms, 812µs, 59ns | 123ms, 842µs |
| quickly(compiled) | dev-master | 782µs, 346ns | 766µs, 992ns | 793µs, 933ns |
| quickly(configured) | dev-master | 1ms, 511µs, 931ns | 1ms, 324µs, 176ns | 2ms, 228µs, 975ns |
| quickly(reflection) | dev-master | 1ms, 357µs, 412ns | 1ms, 271µs, 9ns | 1ms, 725µs, 196ns |
| symfony(compiled) | ^7.0 | 3ms, 872µs, 108ns | 2ms, 490µs, 43ns | 4ms, 95µs, 77ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 769µs, 447ns | 1ms, 598µs, 834ns | 3ms, 57µs, 956ns |
| auryn | ^1.4 | 419ms, 169µs, 974ns | 405ms, 689µs, 954ns | 452ms, 811µs, 2ns |
| dice(configured) | ^4.0 | 71ms, 624µs, 207ns | 70ms, 560µs, 932ns | 73ms, 421µs, 1ns |
| dice(unconfigured) | ^4.0 | 72ms, 386µs, 717ns | 70ms, 918µs, 798ns | 73ms, 932µs, 170ns |
| laminas-servicemanager | ^3.21 | 1ms, 422µs, 262ns | 1ms, 276µs, 16ns | 2ms, 605µs, 915ns |
| laravel(cached) | ^12.28 | 404ms, 578µs, 685ns | 399ms, 45µs, 944ns | 412ms, 127µs, 17ns |
| laravel(singletons) | ^12.28 | 3ms, 595µs, 113ns | 3ms, 424µs, 882ns | 4ms, 756µs, 212ns |
| laravel(unconfigured) | ^12.28 | 632ms, 573µs, 318ns | 626ms, 882µs, 76ns | 639ms, 369µs, 10ns |
| league(predefined) | ^5.1 | 869ms, 245µs, 338ns | 859ms, 835µs, 863ns | 882ms, 943µs, 868ns |
| league(unconfigured) | ^5.1 | 676ms, 136µs, 88ns | 656ms, 805µs, 38ns | 704ms, 288µs, 959ns |
| nette-di | ^3.2 | 5ms, 607µs, 318ns | 3ms, 340µs, 959ns | 24ms, 675µs, 130ns |
| phalcon(shared) | ^5 | 4ms, 395µs, 508ns | 4ms, 47µs, 155ns | 6ms, 958µs, 7ns |
| phalcon(transient) | ^5 | 257ms, 370µs, 495ns | 251ms, 991µs, 987ns | 265ms, 642µs, 881ns |
| php-di | ^7.0 | 1ms, 96µs, 916ns | 828µs, 981ns | 3ms, 294µs, 944ns |
| pimple | ^3.5 | 71ms, 507µs, 167ns | 69ms, 164µs, 37ns | 77ms, 226µs, 161ns |
| quickly(compiled) | dev-master | 819µs, 396ns | 793µs, 933ns | 850µs, 915ns |
| quickly(configured) | dev-master | 1ms, 761µs, 54ns | 1ms, 659µs, 870ns | 2ms, 439µs, 22ns |
| quickly(reflection) | dev-master | 1ms, 446µs, 843ns | 1ms, 343µs, 11ns | 2ms, 192µs, 20ns |
| symfony(compiled) | ^7.0 | 7ms, 249µs, 641ns | 5ms, 729µs, 198ns | 18ms, 548µs, 11ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 994µs, 276ns | 1ms, 559µs, 19ns | 5ms, 400µs, 180ns |
| dice(configured) | ^4.0 | 9s, 999ms, 155µs, 616ns | 9s, 899ms, 167µs, 60ns | 10s, 137ms, 601µs, 852ns |
| dice(unconfigured) | ^4.0 | 10s, 89ms, 189µs, 410ns | 9s, 959ms, 183µs, 216ns | 10s, 151ms, 607µs, 990ns |
| laminas-servicemanager | ^3.21 | 1ms, 227µs, 498ns | 1ms, 194µs | 1ms, 353µs, 979ns |
| laravel(singletons) | ^12.28 | 3ms, 646µs, 63ns | 3ms, 417µs, 968ns | 4ms, 796µs, 981ns |
| nette-di | ^3.2 | 3ms, 393µs, 101ns | 3ms, 252µs, 29ns | 4ms, 46µs, 916ns |
| phalcon(shared) | ^5 | 4ms, 43µs, 78ns | 3ms, 993µs, 34ns | 4ms, 253µs, 864ns |
| php-di | ^7.0 | 871µs, 38ns | 813µs, 7ns | 1ms, 276µs, 969ns |
| pimple | ^3.5 | 9s, 965ms, 174µs, 150ns | 9s, 797ms, 334µs, 909ns | 10s, 99ms, 890µs, 232ns |
| quickly(compiled) | dev-master | 801µs, 682ns | 780µs, 105ns | 829µs, 935ns |
| quickly(configured) | dev-master | 1ms, 356µs, 315ns | 1ms, 343µs, 965ns | 1ms, 387µs, 119ns |
| quickly(reflection) | dev-master | 1ms, 362µs, 633ns | 1ms, 306µs, 56ns | 1ms, 559µs, 972ns |
| symfony(compiled) | ^7.0 | 2ms, 170µs, 586ns | 2ms, 80µs, 917ns | 2ms, 506µs, 971ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 5ms, 293µs, 154ns | 5ms, 121µs, 946ns | 6ms, 551µs, 980ns |
| dice(configured) | ^4.0 | 10s, 39ms, 557µs, 313ns | 9s, 840ms, 650µs, 81ns | 10s, 643ms, 98µs, 831ns |
| dice(unconfigured) | ^4.0 | 10s, 68ms, 332µs, 457ns | 9s, 939ms, 954µs, 42ns | 10s, 299ms, 932µs, 3ns |
| laminas-servicemanager | ^3.21 | 924µs, 825ns | 813µs, 961ns | 1ms, 724µs, 4ns |
| laravel(singletons) | ^12.28 | 3ms, 827µs, 476ns | 3ms, 516µs, 912ns | 6ms, 55µs, 831ns |
| nette-di | ^3.2 | 5ms, 604µs, 910ns | 3ms, 299µs, 951ns | 24ms, 693µs, 12ns |
| phalcon(shared) | ^5 | 4ms, 23µs, 122ns | 3ms, 998µs, 41ns | 4ms, 101µs, 37ns |
| php-di | ^7.0 | 1ms, 159µs, 620ns | 896µs, 215ns | 3ms, 337µs, 144ns |
| pimple | ^3.5 | 10s, 39ms, 676µs, 380ns | 9s, 910ms, 877µs, 943ns | 10s, 229ms, 297µs, 876ns |
| quickly(compiled) | dev-master | 810µs, 265ns | 761µs, 985ns | 828µs, 981ns |
| quickly(configured) | dev-master | 1ms, 766µs, 204ns | 1ms, 630µs, 67ns | 2ms, 508µs, 878ns |
| quickly(reflection) | dev-master | 1ms, 535µs, 773ns | 1ms, 419µs, 67ns | 2ms, 254µs, 962ns |
| symfony(compiled) | ^7.0 | 7ms, 325µs, 458ns | 5ms, 772µs, 829ns | 18ms, 557µs, 71ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 337ms, 878µs, 894ns | 1ms, 527µs, 70ns | 3s, 363ms, 770µs, 8ns |
| laminas-servicemanager | ^3.21 | 1ms, 250µs, 386ns | 1ms, 218µs, 80ns | 1ms, 406µs, 908ns |
| laravel(singletons) | ^12.28 | 3ms, 637µs, 242ns | 3ms, 309µs, 965ns | 5ms, 190µs, 134ns |
| nette-di | ^3.2 | 3ms, 411µs, 221ns | 3ms, 371µs, 953ns | 3ms, 448µs, 9ns |
| phalcon(shared) | ^5 | 4ms, 642µs, 9ns | 3ms, 993µs, 34ns | 7ms, 870µs, 912ns |
| php-di | ^7.0 | 882µs, 291ns | 813µs, 7ns | 1ms, 302µs, 957ns |
| quickly(compiled) | dev-master | 807µs, 499ns | 795µs, 125ns | 820µs, 875ns |
| quickly(configured) | dev-master | 1ms, 428µs, 318ns | 1ms, 320µs, 123ns | 1ms, 693µs, 10ns |
| quickly(reflection) | dev-master | 1ms, 380µs, 419ns | 1ms, 338µs, 5ns | 1ms, 600µs, 980ns |
| symfony(compiled) | ^7.0 | 2ms, 205µs, 228ns | 2ms, 149µs, 105ns | 2ms, 249µs, 956ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3s, 412ms, 862µs, 563ns | 3s, 386ms, 727µs, 809ns | 3s, 444ms, 819µs, 927ns |
| laminas-servicemanager | ^3.21 | 954µs, 723ns | 854µs, 969ns | 1ms, 739µs, 25ns |
| laravel(singletons) | ^12.28 | 3ms, 790µs, 903ns | 3ms, 556µs, 966ns | 4ms, 915µs, 952ns |
| nette-di | ^3.2 | 5ms, 407µs, 953ns | 3ms, 317µs, 117ns | 23ms, 483µs, 37ns |
| phalcon(shared) | ^5 | 4ms, 241µs, 394ns | 4ms, 98µs, 176ns | 4ms, 904µs, 985ns |
| php-di | ^7.0 | 1ms, 205µs, 778ns | 939µs, 846ns | 3ms, 436µs, 88ns |
| quickly(compiled) | dev-master | 824µs, 880ns | 807µs, 46ns | 856µs, 876ns |
| quickly(configured) | dev-master | 1ms, 898µs, 479ns | 1ms, 773µs, 834ns | 2ms, 651µs, 929ns |
| quickly(reflection) | dev-master | 1ms, 612µs, 91ns | 1ms, 499µs, 891ns | 2ms, 341µs, 32ns |
| symfony(compiled) | ^7.0 | 7ms, 518µs, 792ns | 5ms, 856µs, 37ns | 18ms, 593µs, 72ns |

</details>

Questions, issues, and new containers are welcome!
