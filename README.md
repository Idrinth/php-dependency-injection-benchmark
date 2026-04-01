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

Run from 2026-04-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 654µs, 434ns | 1ms, 603µs, 126ns | 1ms, 774µs, 72ns |
| Auryn(Reflection, Transient) | ^1.4 | 401ms, 26µs, 535ns | 394ms, 872µs, 903ns | 412ms, 240µs, 982ns |
| Dice(Configured, Singleton) | ^4.0 | 690µs, 460ns | 674µs, 9ns | 716µs, 924ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 195µs, 817ns | 68ms, 495µs, 988ns | 72ms, 543µs, 859ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 793µs, 4ns | 756µs, 25ns | 854µs, 969ns |
| Laravel(Configured, Transient) | ^12.28 | 396ms, 724µs, 843ns | 374ms, 551µs, 57ns | 404ms, 254µs, 913ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 111µs, 314ns | 2ms, 749µs, 919ns | 3ms, 572µs, 940ns |
| Laravel(Reflection, Transient) | ^12.28 | 577ms, 353µs, 906ns | 570ms, 50µs, 954ns | 586ms, 820µs, 840ns |
| League(Configured, Transient) | ^5.1 | 1s, 120ms, 171µs, 952ns | 979ms, 231µs, 834ns | 1s, 160ms, 6µs, 46ns |
| League(Reflection, Transient) | ^5.1 | 689ms, 728µs, 784ns | 600ms, 961µs, 208ns | 718ms, 899µs, 11ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 617µs, 525ns | 3ms, 537µs, 893ns | 3ms, 968µs |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 190µs, 158ns | 3ms, 455µs, 877ns | 7ms, 747µs, 888ns |
| Phalcon(Configured, Transient) | ^5 | 288ms, 733µs, 386ns | 266ms, 170µs, 24ns | 307ms, 255µs, 983ns |
| Php-baseline |  | 589µs, 919ns | 560µs, 998ns | 607µs, 13ns |
| Php-di(Reflection, Singleton) | ^7.0 | 857µs, 400ns | 801µs, 86ns | 1ms, 228µs, 94ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 220µs, 11ns | 1ms, 199µs, 7ns | 1ms, 246µs, 213ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 511µs, 73ns | 99ms, 607µs, 944ns | 103ms, 888µs, 988ns |
| Quickly(Compiled, Singleton) | dev-master | 860µs, 786ns | 805µs, 854ns | 1ms, 38µs, 74ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 380µs, 896ns | 1ms, 348µs, 972ns | 1ms, 534µs, 938ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 368µs, 689ns | 1ms, 81µs, 943ns | 2ms, 192µs, 974ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 441ms, 208µs, 720ns | 2s, 39ms, 566µs, 993ns | 3s, 898ms, 287µs, 57ns |
| Ray-di(Reflection, Transient) | ^2.16 | 391ms, 12µs, 263ns | 345ms, 395µs, 88ns | 424ms, 239µs, 158ns |
| Symfony(Compiled, Singleton) | ^7.0 | 764µs, 989ns | 738µs, 859ns | 818µs, 14ns |
| Zen(Compiled, Singleton) | ^3.1 | 824µs, 69ns | 750µs, 64ns | 1ms, 412µs, 868ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 984µs, 95ns | 1ms, 491µs, 69ns | 3ms, 675µs, 937ns |
| Auryn(Reflection, Transient) | ^1.4 | 405ms, 976µs, 629ns | 394ms, 285µs, 917ns | 428ms, 122µs, 997ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 885µs, 318ns | 1ms, 770µs, 973ns | 2ms, 200µs, 841ns |
| Dice(Reflection, Transient) | ^4.0 | 72ms, 392µs, 845ns | 70ms, 630µs, 73ns | 77ms, 279µs, 90ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 767µs, 230ns | 656µs, 127ns | 1ms, 605µs, 987ns |
| Laravel(Configured, Transient) | ^12.28 | 400ms, 180µs, 935ns | 357ms, 918µs, 977ns | 422ms, 509µs, 908ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 811µs, 478ns | 3ms, 422µs, 975ns | 5ms, 2µs, 975ns |
| Laravel(Reflection, Transient) | ^12.28 | 583ms, 161µs, 44ns | 568ms, 706µs, 989ns | 605ms, 356µs, 216ns |
| League(Configured, Transient) | ^5.1 | 1s, 133ms, 184µs, 218ns | 1s, 86ms, 998µs, 939ns | 1s, 153ms, 7µs, 984ns |
| League(Reflection, Transient) | ^5.1 | 692ms, 238µs, 68ns | 614ms, 753µs, 961ns | 724ms, 833µs, 965ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 577µs, 423ns | 3ms, 504µs, 37ns | 3ms, 938µs, 198ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 124µs, 522ns | 4ms, 15µs, 922ns | 4ms, 757µs, 165ns |
| Phalcon(Configured, Transient) | ^5 | 292ms, 1µs, 795ns | 263ms, 6µs, 925ns | 303ms, 548µs, 97ns |
| Php-baseline |  | 621µs, 366ns | 583µs, 887ns | 682µs, 115ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 120µs, 376ns | 864µs, 28ns | 3ms, 279µs, 924ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 351µs, 571ns | 1ms, 308µs, 917ns | 1ms, 591µs, 920ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 947µs, 115ns | 98ms, 603µs, 10ns | 120ms, 191µs, 97ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 17µs, 451ns | 986µs, 99ns | 1ms, 44µs, 34ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 157µs, 378ns | 2ms, 61µs, 843ns | 2ms, 838µs, 134ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 519µs, 536ns | 1ms, 379µs, 966ns | 2ms, 246µs, 141ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 135ms, 570µs, 73ns | 2s, 20ms, 829µs, 916ns | 3s, 682ms, 3µs, 974ns |
| Ray-di(Reflection, Transient) | ^2.16 | 400ms, 314µs, 307ns | 387ms, 882µs, 947ns | 426ms, 461µs, 935ns |
| Symfony(Compiled, Singleton) | ^7.0 | 774µs, 717ns | 736µs, 951ns | 853µs, 61ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 51µs, 211ns | 817µs, 60ns | 2ms, 918µs, 958ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 626µs, 992ns | 1ms, 573µs, 85ns | 1ms, 751µs, 899ns |
| Dice(Configured, Singleton) | ^4.0 | 830µs, 483ns | 800µs, 848ns | 856µs, 876ns |
| Laravel(Configured, Transient) | ^12.28 | 380ms, 402µs, 541ns | 372ms, 565µs, 984ns | 397ms, 38µs, 936ns |
| League(Configured, Transient) | ^5.1 | 9s, 20ms, 280µs, 838ns | 7s, 642ms, 740µs, 11ns | 9s, 323ms, 927µs, 164ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 88µs, 68ns | 3ms, 999µs, 948ns | 4ms, 470µs, 825ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 336µs, 190ns | 3ms, 967µs, 46ns | 5ms, 346µs, 59ns |
| Phalcon(Configured, Transient) | ^5 | 293ms, 103µs, 289ns | 277ms, 774µs, 95ns | 298ms, 851µs, 13ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 249µs, 885ns | 1ms, 219µs, 34ns | 1ms, 267µs, 910ns |
| Pimple(Configured, Transient) | ^3.5 | 105ms, 232µs, 453ns | 100ms, 17µs, 70ns | 134ms, 145µs, 975ns |
| Quickly(Compiled, Singleton) | dev-master | 818µs, 300ns | 792µs, 980ns | 849µs, 962ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 156µs, 923ns | 4ms, 91µs, 978ns | 4ms, 269µs, 123ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 440ms, 707µs, 325ns | 2s, 27ms, 148µs, 8ns | 3s, 655ms, 98µs, 915ns |
| Symfony(Compiled, Singleton) | ^7.0 | 775µs, 885ns | 735µs, 44ns | 912µs, 904ns |
| Zen(Compiled, Singleton) | ^3.1 | 833µs, 654ns | 745µs, 58ns | 1ms, 449µs, 823ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 4µs, 575ns | 1ms, 663µs, 923ns | 3ms, 212µs, 928ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 894µs, 903ns | 1ms, 752µs, 853ns | 2ms, 259µs, 16ns |
| Laravel(Configured, Transient) | ^12.28 | 378ms, 674µs, 54ns | 326ms, 35µs, 976ns | 408ms, 110µs, 141ns |
| League(Configured, Transient) | ^5.1 | 9s, 191ms, 42µs, 518ns | 8s, 846ms, 998µs, 929ns | 9s, 845ms, 879µs, 77ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 82µs, 703ns | 3ms, 985µs, 166ns | 4ms, 408µs, 836ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 94µs, 4ns | 3ms, 957µs, 33ns | 4ms, 519µs, 939ns |
| Phalcon(Configured, Transient) | ^5 | 289ms, 292µs, 311ns | 274ms, 325µs, 847ns | 298ms, 722µs, 28ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 568µs, 365ns | 1ms, 271µs, 9ns | 1ms, 966µs, 953ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 718µs, 570ns | 93ms, 528µs, 985ns | 110ms, 619µs, 68ns |
| Quickly(Compiled, Singleton) | dev-master | 793µs, 886ns | 773µs, 906ns | 819µs, 921ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 200µs, 935ns | 4ms, 91µs, 24ns | 4ms, 925µs, 12ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 419ms, 577µs, 479ns | 2s, 40ms, 969µs, 848ns | 3s, 664ms, 466µs, 857ns |
| Symfony(Compiled, Singleton) | ^7.0 | 779µs, 795ns | 741µs, 958ns | 811µs, 100ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 1µs, 143ns | 773µs, 191ns | 2ms, 879µs, 142ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 611µs, 634ns | 4ms, 657µs, 983ns | 8ms, 664µs, 131ns |
| Dice(Configured, Singleton) | ^4.0 | 883µs, 316ns | 852µs, 108ns | 896µs, 930ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 786ms, 61µs, 24ns | 8s, 652ms, 639µs, 150ns | 10s, 218ms, 19µs, 962ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 804µs, 615ns | 775µs, 98ns | 910µs, 997ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 717µs, 947ns | 3ms, 618µs, 1ns | 3ms, 921µs, 985ns |
| Laravel(Reflection, Transient) | ^12.28 | 79s, 537ms, 636µs, 709ns | 69s, 81ms, 824µs, 64ns | 82s, 104ms, 170µs, 799ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 929µs, 708ns | 3ms, 566µs, 26ns | 7ms, 148µs, 27ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 817µs, 224ns | 3ms, 421µs, 68ns | 4ms, 32µs, 850ns |
| Php-baseline |  | 611µs, 472ns | 480µs, 175ns | 743µs, 865ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 69µs, 426ns | 988µs, 6ns | 1ms, 427µs, 173ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 40µs, 697ns | 1ms, 20µs, 908ns | 1ms, 78µs, 844ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 788ms, 615µs, 822ns | 12s, 963ms, 770µs, 866ns | 13s, 981ms, 202µs, 840ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 516ns | 806µs, 93ns | 859µs, 22ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 369µs, 976ns | 1ms, 343µs, 11ns | 1ms, 432µs, 895ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 390µs, 266ns | 1ms, 345µs, 872ns | 1ms, 546µs, 859ns |
| Symfony(Compiled, Singleton) | ^7.0 | 771µs, 427ns | 745µs, 58ns | 806µs, 93ns |
| Zen(Compiled, Singleton) | ^3.1 | 852µs, 799ns | 759µs, 124ns | 1ms, 500µs, 129ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 348µs, 442ns | 6ms, 622µs, 791ns | 12ms, 470µs, 960ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 253µs, 603ns | 1ms, 821µs, 994ns | 2ms, 480µs, 30ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 749ms, 192µs, 70ns | 8s, 669ms, 337µs, 987ns | 10s, 119ms, 671µs, 821ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 308ns | 878µs, 95ns | 2ms, 50µs, 161ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 886µs, 507ns | 4ms, 714µs, 965ns | 5ms, 451µs, 917ns |
| Laravel(Reflection, Transient) | ^12.28 | 81s, 339ms, 909µs, 362ns | 80s, 382ms, 334µs, 947ns | 83s, 608ms, 992µs, 99ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 589µs, 509ns | 3ms, 480µs, 911ns | 7ms, 294µs, 178ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 143µs, 500ns | 3ms, 952µs, 26ns | 4ms, 224µs, 61ns |
| Php-baseline |  | 563µs, 788ns | 453µs, 948ns | 638µs, 8ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 173µs, 853ns | 912µs, 189ns | 3ms, 307µs, 104ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 393µs, 246ns | 1ms, 329µs, 898ns | 1ms, 606µs, 941ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 798ms, 122µs, 572ns | 12s, 951ms, 467µs, 990ns | 14s, 334ms, 276µs, 914ns |
| Quickly(Compiled, Singleton) | dev-master | 815µs, 606ns | 792µs, 980ns | 878µs, 95ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 158µs, 880ns | 2ms, 65µs, 896ns | 2ms, 880µs, 96ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 518µs, 416ns | 1ms, 415µs, 14ns | 2ms, 220µs, 869ns |
| Symfony(Compiled, Singleton) | ^7.0 | 819µs, 897ns | 790µs, 119ns | 876µs, 903ns |
| Zen(Compiled, Singleton) | ^3.1 | 905µs, 179ns | 683µs, 69ns | 2ms, 230µs, 882ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 779µs, 198ns | 1ms, 546µs, 144ns | 1ms, 884µs, 937ns |
| Dice(Configured, Singleton) | ^4.0 | 850µs, 558ns | 711µs, 202ns | 903µs, 129ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 55µs, 571ns | 3ms, 927µs, 946ns | 4ms, 352µs, 807ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 918µs, 600ns | 3ms, 448µs, 9ns | 4ms, 144µs, 906ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 195µs, 216ns | 1ms, 168µs, 12ns | 1ms, 271µs, 963ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 769ms, 376µs, 468ns | 12s, 977ms, 953µs, 910ns | 14s, 57ms, 820µs, 796ns |
| Quickly(Compiled, Singleton) | dev-master | 911µs, 474ns | 808µs, 954ns | 1ms, 92µs, 910ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 148µs, 387ns | 4ms, 54µs, 69ns | 4ms, 179µs, 954ns |
| Symfony(Compiled, Singleton) | ^7.0 | 760µs, 245ns | 725µs, 30ns | 795µs, 125ns |
| Zen(Compiled, Singleton) | ^3.1 | 839µs, 710ns | 740µs, 766ns | 1ms, 510µs, 143ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 246µs, 402ns | 2ms, 762µs, 79ns | 3ms, 474µs, 950ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 177µs, 95ns | 1ms, 859µs, 188ns | 2ms, 337µs, 932ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 988µs, 75ns | 3ms, 924µs, 131ns | 4ms, 302µs, 24ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 292µs, 702ns | 3ms, 613µs, 948ns | 5ms, 597µs, 829ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 380µs, 991ns | 1ms, 327µs, 37ns | 1ms, 608µs, 133ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 905ms, 231µs, 547ns | 13s, 434ms, 777µs, 975ns | 14s, 91ms, 58µs, 969ns |
| Quickly(Compiled, Singleton) | dev-master | 789µs, 690ns | 773µs, 906ns | 803µs, 947ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 945µs, 492ns | 4ms, 794µs, 120ns | 5ms, 687µs, 952ns |
| Symfony(Compiled, Singleton) | ^7.0 | 784µs, 182ns | 735µs, 998ns | 828µs, 981ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 42µs, 675ns | 810µs, 146ns | 2ms, 856µs, 16ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 882µs, 124ns | 786µs, 66ns | 1ms, 168µs, 12ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 625µs, 440ns | 3ms, 534µs, 793ns | 4ms, 30µs, 942ns |
| Php-di(Reflection, Singleton) | ^7.0 | 856µs, 590ns | 785µs, 112ns | 1ms, 312µs, 971ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 244µs, 282ns | 1ms, 230µs, 955ns | 1ms, 271µs, 9ns |
| Quickly(Compiled, Singleton) | dev-master | 826µs, 954ns | 787µs, 973ns | 915µs, 765ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 412µs, 630ns | 1ms, 397µs, 132ns | 1ms, 446µs, 8ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 415µs, 348ns | 1ms, 350µs, 164ns | 1ms, 608µs, 133ns |
| Symfony(Compiled, Singleton) | ^7.0 | 797µs, 820ns | 771µs, 999ns | 818µs, 967ns |
| Zen(Compiled, Singleton) | ^3.1 | 683µs, 93ns | 605µs, 106ns | 1ms, 219µs, 34ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 74µs, 194ns | 929µs, 832ns | 2ms, 77µs, 102ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 590µs, 774ns | 3ms, 523µs, 111ns | 3ms, 922µs, 939ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 226µs, 305ns | 967µs, 25ns | 3ms, 328µs, 84ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 357µs, 388ns | 1ms, 306µs, 56ns | 1ms, 688µs, 3ns |
| Quickly(Compiled, Singleton) | dev-master | 809µs, 121ns | 789µs, 165ns | 838µs, 994ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 219µs, 200ns | 2ms, 49µs, 922ns | 2ms, 952µs, 98ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 632µs, 905ns | 1ms, 517µs, 57ns | 2ms, 394µs, 914ns |
| Symfony(Compiled, Singleton) | ^7.0 | 845µs, 909ns | 812µs, 768ns | 909µs, 90ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 138µs, 377ns | 910µs, 43ns | 2ms, 935µs, 886ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 8µs, 435ns | 3ms, 901µs, 4ns | 8ms, 96µs, 933ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 237µs, 630ns | 1ms, 222µs, 133ns | 1ms, 262µs, 903ns |
| Quickly(Compiled, Singleton) | dev-master | 844µs, 383ns | 783µs, 920ns | 1ms, 8µs, 33ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 216µs, 217ns | 4ms, 98µs, 176ns | 4ms, 700µs, 899ns |
| Symfony(Compiled, Singleton) | ^7.0 | 765µs, 609ns | 741µs, 4ns | 814µs, 914ns |
| Zen(Compiled, Singleton) | ^3.1 | 844µs, 97ns | 745µs, 58ns | 1ms, 570µs, 940ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 131µs, 817ns | 4ms, 44µs, 55ns | 4ms, 441µs, 976ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 372µs, 694ns | 1ms, 336µs, 97ns | 1ms, 591µs, 920ns |
| Quickly(Compiled, Singleton) | dev-master | 824µs, 761ns | 798µs, 940ns | 877µs, 857ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 950µs, 523ns | 4ms, 791µs, 975ns | 5ms, 634µs, 69ns |
| Symfony(Compiled, Singleton) | ^7.0 | 814µs, 318ns | 778µs, 913ns | 854µs, 15ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 225µs, 113ns | 969µs, 171ns | 3ms, 23µs, 147ns |

</details>

Questions, issues, and new containers are welcome!
