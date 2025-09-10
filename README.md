# PHP Dependency Injection Benchmark

![PHP Version](https://img.shields.io/badge/PHP-8.4-blue?logo=php) ![Docker Version](https://img.shields.io/badge/Docker-%2A-lightgrey?logo=docker) ![OS](https://img.shields.io/badge/OS-ubuntu%20latest-blue?logo=ubuntu)

> Docker environment runs without network access and with limited CPU and memory resources.

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

Run from 2025-09-10

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 769µs, 614ns | 1ms, 543µs, 998ns | 2ms, 701µs, 44ns |
| Auryn(Reflection, Transient) | ^1.4 | 415ms, 651µs, 512ns | 403ms, 876µs, 66ns | 455ms, 554µs, 8ns |
| Dice(Configured, Singleton) | ^4.0 | 842µs, 22ns | 819µs, 921ns | 885µs, 963ns |
| Dice(Reflection, Transient) | ^4.0 | 71ms, 199µs, 774ns | 69ms, 958µs, 925ns | 73ms, 208µs, 93ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 778µs, 603ns | 755µs, 786ns | 843µs, 48ns |
| Laravel(Configured, Transient) | ^12.28 | 409ms, 521µs, 436ns | 400ms, 288µs, 105ns | 452ms, 718µs, 973ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 473µs, 353ns | 3ms, 369µs, 92ns | 3ms, 626µs, 823ns |
| Laravel(Reflection, Transient) | ^12.28 | 634ms, 389µs, 376ns | 629ms, 189µs, 14ns | 643ms, 256µs, 902ns |
| League(Configured, Transient) | ^5.1 | 863ms, 57µs, 470ns | 850ms, 836µs, 992ns | 882ms, 68µs, 872ns |
| League(Reflection, Transient) | ^5.1 | 664ms, 36µs, 250ns | 654ms, 502µs, 868ns | 681ms, 699µs, 991ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 384µs, 113ns | 3ms, 318µs, 71ns | 3ms, 787µs, 994ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 72µs, 928ns | 3ms, 963µs, 232ns | 4ms, 724µs, 25ns |
| Phalcon(Configured, Transient) | ^5 | 293ms, 892µs, 693ns | 289ms, 119µs, 5ns | 304ms, 566µs, 144ns |
| Php-baseline |  | 603µs, 8ns | 580µs, 72ns | 657µs, 81ns |
| Php-di(Reflection, Singleton) | ^7.0 | 840µs, 520ns | 785µs, 112ns | 1ms, 214µs, 981ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 278µs, 996ns | 1ms, 230µs, 955ns | 1ms, 327µs, 37ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 553µs, 11ns | 98ms, 572µs, 15ns | 103ms, 383µs, 64ns |
| Quickly(Compiled, Singleton) | dev-master | 818µs, 443ns | 789µs, 165ns | 929µs, 117ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 464µs, 414ns | 1ms, 374µs, 959ns | 1ms, 693µs, 964ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 352µs, 620ns | 1ms, 312µs, 17ns | 1ms, 451µs, 15ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 497ms, 317µs, 409ns | 3s, 471ms, 276µs, 44ns | 3s, 531ms, 581µs, 878ns |
| Ray-di(Reflection, Transient) | ^2.16 | 350ms, 388µs, 646ns | 344ms, 509µs, 840ns | 355ms, 387µs, 926ns |
| Symfony(Compiled, Singleton) | ^7.0 | 837µs, 993ns | 823µs, 20ns | 880µs, 956ns |
| Zen(Compiled, Singleton) | ^3.1 | 865µs, 983ns | 778µs, 913ns | 1ms, 518µs, 11ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 823µs, 710ns | 1ms, 767µs, 158ns | 5ms, 468µs, 130ns |
| Auryn(Reflection, Transient) | ^1.4 | 415ms, 932µs, 655ns | 405ms, 444µs, 860ns | 427ms, 803µs, 39ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 894µs, 927ns | 1ms, 771µs, 926ns | 2ms, 279µs, 43ns |
| Dice(Reflection, Transient) | ^4.0 | 74ms, 348µs, 711ns | 70ms, 952µs, 892ns | 80ms, 575µs, 942ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 951µs, 266ns | 791µs, 72ns | 2ms, 179µs, 145ns |
| Laravel(Configured, Transient) | ^12.28 | 410ms, 201µs, 120ns | 401ms, 837µs, 110ns | 426ms, 405µs, 906ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 9µs, 699ns | 3ms, 565µs, 73ns | 5ms, 166µs, 53ns |
| Laravel(Reflection, Transient) | ^12.28 | 635ms, 11µs, 816ns | 629ms, 137µs, 992ns | 642ms, 550µs, 945ns |
| League(Configured, Transient) | ^5.1 | 865ms, 880µs, 250ns | 852ms, 482µs, 795ns | 875ms, 900µs, 983ns |
| League(Reflection, Transient) | ^5.1 | 668ms, 590µs, 426ns | 656ms, 178µs, 951ns | 689ms, 759µs, 969ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 361µs, 582ns | 3ms, 285µs, 884ns | 3ms, 711µs, 938ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 173µs, 898ns | 4ms, 46µs, 916ns | 4ms, 289µs, 150ns |
| Phalcon(Configured, Transient) | ^5 | 295ms, 226µs, 502ns | 287ms, 369µs, 966ns | 305ms, 6µs, 980ns |
| Php-baseline |  | 710µs, 582ns | 562µs, 906ns | 894µs, 69ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 199µs, 388ns | 931µs, 24ns | 3ms, 413µs, 915ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 300µs, 454ns | 1ms, 236µs, 915ns | 1ms, 601µs, 934ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 517µs, 82ns | 98ms, 996µs, 877ns | 102ms, 949µs, 142ns |
| Quickly(Compiled, Singleton) | dev-master | 860µs, 95ns | 844µs, 955ns | 919µs, 103ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 191µs, 209ns | 2ms, 21µs, 74ns | 2ms, 874µs, 135ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 480µs, 7ns | 1ms, 382µs, 827ns | 2ms, 230µs, 167ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 511ms, 649µs, 775ns | 3s, 461ms, 900µs, 949ns | 3s, 549ms, 949µs, 884ns |
| Ray-di(Reflection, Transient) | ^2.16 | 384ms, 876µs, 12ns | 377ms, 125µs, 978ns | 392ms, 973µs, 184ns |
| Symfony(Compiled, Singleton) | ^7.0 | 786µs, 709ns | 764µs, 131ns | 804µs, 901ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 73µs, 145ns | 808µs | 3ms, 63µs, 917ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 650µs, 190ns | 1ms, 499µs, 891ns | 1ms, 832µs, 962ns |
| Dice(Configured, Singleton) | ^4.0 | 811µs, 791ns | 785µs, 827ns | 833µs, 34ns |
| Laravel(Configured, Transient) | ^12.28 | 382ms, 285µs, 141ns | 374ms, 298µs, 95ns | 393ms, 617µs, 153ns |
| League(Configured, Transient) | ^5.1 | 4s, 149ms, 762µs, 701ns | 4s, 124ms, 658µs, 107ns | 4s, 209ms, 136µs, 962ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 776µs, 764ns | 3ms, 636µs, 837ns | 4ms, 709µs, 959ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 53µs, 877ns | 3ms, 929µs, 853ns | 8ms, 33µs, 37ns |
| Phalcon(Configured, Transient) | ^5 | 302ms, 226µs, 257ns | 292ms, 203µs, 903ns | 339ms, 649µs, 200ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 249µs, 146ns | 1ms, 230µs, 955ns | 1ms, 270µs, 55ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 47µs, 705ns | 100ms, 650µs, 72ns | 105ms, 656µs, 862ns |
| Quickly(Compiled, Singleton) | dev-master | 800µs, 585ns | 784µs, 873ns | 819µs, 921ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 105µs, 854ns | 3ms, 872µs, 871ns | 5ms, 825µs, 996ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 545ms, 25µs, 753ns | 3s, 512ms, 832µs, 164ns | 3s, 611ms, 211µs, 61ns |
| Symfony(Compiled, Singleton) | ^7.0 | 832µs, 486ns | 756µs, 25ns | 998µs, 973ns |
| Zen(Compiled, Singleton) | ^3.1 | 854µs, 468ns | 759µs, 124ns | 1ms, 507µs, 43ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 66µs, 636ns | 1ms, 664µs, 161ns | 3ms, 743µs, 886ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 932µs, 477ns | 1ms, 828µs, 908ns | 2ms, 270µs, 936ns |
| Laravel(Configured, Transient) | ^12.28 | 384ms, 883µs, 236ns | 378ms, 614µs, 902ns | 390ms, 666µs, 7ns |
| League(Configured, Transient) | ^5.1 | 4s, 144ms, 833µs, 588ns | 4s, 95ms, 2µs, 889ns | 4s, 189ms, 698µs, 934ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 750µs, 920ns | 3ms, 686µs, 904ns | 4ms, 151µs, 105ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 232µs, 835ns | 4ms, 91µs, 978ns | 4ms, 416µs, 942ns |
| Phalcon(Configured, Transient) | ^5 | 295ms, 334µs, 815ns | 290ms, 383µs, 100ns | 299ms, 443µs, 960ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 349µs, 306ns | 1ms, 308µs, 917ns | 1ms, 611µs, 948ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 186µs, 870ns | 101ms, 137µs, 876ns | 104ms, 392µs, 51ns |
| Quickly(Compiled, Singleton) | dev-master | 876µs, 307ns | 777µs, 6ns | 1ms, 161µs, 813ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 649µs, 710ns | 4ms, 435µs, 62ns | 5ms, 290µs, 985ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 534ms, 16µs, 418ns | 3s, 498ms, 913µs, 49ns | 3s, 608ms, 222µs, 7ns |
| Symfony(Compiled, Singleton) | ^7.0 | 824µs, 809ns | 808µs | 860µs, 929ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 44µs, 392ns | 800µs, 132ns | 3ms, 55µs, 95ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 878µs, 806ns | 5ms, 261µs, 898ns | 10ms, 119µs, 915ns |
| Dice(Configured, Singleton) | ^4.0 | 874µs, 471ns | 840µs, 902ns | 931µs, 24ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 88ms, 194µs, 489ns | 9s, 945ms, 112µs, 943ns | 10s, 219ms, 322µs, 919ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 803µs, 804ns | 780µs, 105ns | 903µs, 129ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 238µs, 319ns | 3ms, 693µs, 103ns | 6ms, 798µs, 28ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 860ms, 921µs, 883ns | 88s, 84ms, 218µs, 978ns | 89s, 619ms, 291µs, 67ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 397µs, 202ns | 3ms, 318µs, 786ns | 3ms, 810µs, 882ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 298µs, 925ns | 3ms, 954µs, 887ns | 6ms, 608µs, 963ns |
| Php-baseline |  | 612µs, 497ns | 560µs, 45ns | 689µs, 29ns |
| Php-di(Reflection, Singleton) | ^7.0 | 861µs, 930ns | 797µs, 986ns | 1ms, 302µs, 957ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 299µs, 929ns | 1ms, 264µs, 95ns | 1ms, 334µs, 905ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 101ms, 630µs, 830ns | 13s, 905ms, 573µs, 129ns | 14s, 394ms, 808µs, 53ns |
| Quickly(Compiled, Singleton) | dev-master | 820µs, 493ns | 801µs, 86ns | 878µs, 95ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 407µs, 742ns | 1ms, 373µs, 52ns | 1ms, 487µs, 970ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 356µs, 196ns | 1ms, 298µs, 189ns | 1ms, 510µs, 143ns |
| Symfony(Compiled, Singleton) | ^7.0 | 765µs, 514ns | 746µs, 11ns | 832µs, 80ns |
| Zen(Compiled, Singleton) | ^3.1 | 873µs, 661ns | 777µs, 6ns | 1ms, 551µs, 866ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 916µs, 522ns | 6ms, 772µs, 41ns | 7ms, 798µs, 910ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 586µs, 78ns | 2ms, 153µs, 873ns | 3ms, 863µs, 811ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 70ms, 748µs, 853ns | 9s, 935ms, 220µs, 956ns | 10s, 246ms, 634µs, 960ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 978µs, 207ns | 828µs, 27ns | 2ms, 96µs, 891ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 190µs, 491ns | 4ms, 769µs, 802ns | 8ms, 249µs, 998ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 707ms, 298µs, 660ns | 87s, 954ms, 80µs, 104ns | 89s, 550ms, 664µs, 901ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 7ms, 202µs, 529ns | 7ms, 62µs, 196ns | 7ms, 766µs, 8ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 257µs, 82ns | 4ms, 194µs, 974ns | 4ms, 331µs, 827ns |
| Php-baseline |  | 635µs, 838ns | 586µs, 32ns | 712µs, 156ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 173µs, 329ns | 924µs, 110ns | 3ms, 356µs, 933ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 490µs, 974ns | 1ms, 326µs, 84ns | 2ms, 344µs, 131ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 164ms, 312µs, 28ns | 14s, 11ms, 615µs, 991ns | 14s, 353ms, 593µs, 111ns |
| Quickly(Compiled, Singleton) | dev-master | 842µs, 618ns | 810µs, 861ns | 874µs, 996ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 134µs, 394ns | 2ms, 808ns | 2ms, 854µs, 108ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 512µs, 2ns | 1ms, 410µs, 961ns | 2ms, 228µs, 975ns |
| Symfony(Compiled, Singleton) | ^7.0 | 871µs, 610ns | 761µs, 985ns | 1ms, 193µs, 46ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 149µs, 725ns | 837µs, 87ns | 3ms, 65µs, 109ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 844µs, 167ns | 1ms, 769µs, 65ns | 2ms, 366µs, 65ns |
| Dice(Configured, Singleton) | ^4.0 | 954µs, 389ns | 831µs, 127ns | 1ms, 538µs, 991ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 724µs, 479ns | 3ms, 623µs, 8ns | 4ms, 111µs, 51ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 424µs, 881ns | 4ms, 9µs, 8ns | 6ms, 24µs, 837ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 259µs, 708ns | 1ms, 235µs, 8ns | 1ms, 282µs, 930ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 264ms, 407µs, 110ns | 14s, 151ms, 217µs, 937ns | 14s, 351ms, 553µs, 201ns |
| Quickly(Compiled, Singleton) | dev-master | 827µs, 741ns | 814µs, 914ns | 844µs, 955ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 947µs, 377ns | 3ms, 823µs, 41ns | 4ms, 765µs, 987ns |
| Symfony(Compiled, Singleton) | ^7.0 | 766µs, 801ns | 741µs, 958ns | 818µs, 967ns |
| Zen(Compiled, Singleton) | ^3.1 | 848µs, 293ns | 751µs, 18ns | 1ms, 551µs, 866ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 962µs, 564ns | 3ms, 193µs, 855ns | 5ms, 657µs, 911ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 420µs, 616ns | 2ms, 210µs, 140ns | 3ms, 804µs, 922ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 797µs, 125ns | 3ms, 673µs, 76ns | 4ms, 99µs, 130ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 288µs, 339ns | 4ms, 100µs, 84ns | 4ms, 388µs, 93ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 363µs, 992ns | 1ms, 307µs, 10ns | 1ms, 634µs, 120ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 163ms, 994µs, 693ns | 13s, 973ms, 475µs, 933ns | 14s, 623ms, 989µs, 820ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 396ns | 793µs, 933ns | 830µs, 173ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 794µs, 430ns | 4ms, 622µs, 936ns | 5ms, 429µs, 983ns |
| Symfony(Compiled, Singleton) | ^7.0 | 794µs, 76ns | 777µs, 959ns | 834µs, 941ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 126µs, 646ns | 888µs, 109ns | 3ms, 86µs, 90ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 834µs, 918ns | 782µs, 12ns | 973µs, 939ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 517µs, 580ns | 3ms, 350µs, 973ns | 3ms, 798µs, 7ns |
| Php-di(Reflection, Singleton) | ^7.0 | 916µs, 99ns | 810µs, 146ns | 1ms, 508µs, 951ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 269µs, 912ns | 1ms, 246µs, 929ns | 1ms, 287µs, 937ns |
| Quickly(Compiled, Singleton) | dev-master | 840µs, 258ns | 804µs, 185ns | 897µs, 884ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 437µs, 20ns | 1ms, 418µs, 113ns | 1ms, 455µs, 68ns |
| Quickly(Reflection, Singleton) | dev-master | 2ms, 342µs, 820ns | 2ms, 271µs, 890ns | 2ms, 807µs, 140ns |
| Symfony(Compiled, Singleton) | ^7.0 | 760µs, 54ns | 744µs, 104ns | 808µs, 954ns |
| Zen(Compiled, Singleton) | ^3.1 | 870µs, 275ns | 777µs, 959ns | 1ms, 544µs, 952ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 224µs, 803ns | 855µs, 922ns | 2ms, 117µs, 872ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 631µs, 782ns | 3ms, 389µs, 120ns | 4ms, 916µs, 906ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 941µs, 704ns | 1ms, 529µs, 932ns | 5ms, 346µs, 59ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 356µs, 983ns | 1ms, 301µs, 50ns | 1ms, 609µs, 86ns |
| Quickly(Compiled, Singleton) | dev-master | 816µs, 631ns | 797µs, 33ns | 834µs, 941ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 192µs, 234ns | 2ms, 62µs, 82ns | 2ms, 948µs, 999ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 612µs, 877ns | 1ms, 492µs, 977ns | 2ms, 373µs, 933ns |
| Symfony(Compiled, Singleton) | ^7.0 | 819µs, 706ns | 792µs, 26ns | 864µs, 28ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 128µs, 77ns | 906µs, 944ns | 3ms, 37µs, 929ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 696µs, 155ns | 3ms, 630µs, 876ns | 4ms, 128µs, 932ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 267µs, 194ns | 1ms, 247µs, 882ns | 1ms, 285µs, 76ns |
| Quickly(Compiled, Singleton) | dev-master | 825µs, 977ns | 811µs, 815ns | 838µs, 41ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 788µs, 781ns | 3ms, 726µs, 959ns | 3ms, 929µs, 853ns |
| Symfony(Compiled, Singleton) | ^7.0 | 770µs, 521ns | 755µs, 71ns | 796µs, 79ns |
| Zen(Compiled, Singleton) | ^3.1 | 848µs, 603ns | 746µs, 11ns | 1ms, 590µs, 967ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 787µs, 88ns | 3ms, 710µs, 31ns | 4ms, 89µs, 832ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 406µs, 264ns | 1ms, 280µs, 69ns | 1ms, 627µs, 922ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 492ns | 802µs, 993ns | 850µs, 200ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 648µs, 113ns | 4ms, 539µs, 12ns | 5ms, 399µs, 942ns |
| Symfony(Compiled, Singleton) | ^7.0 | 779µs, 342ns | 754µs, 117ns | 798µs, 940ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 167µs, 464ns | 909µs, 805ns | 3ms, 100µs, 872ns |

</details>

Questions, issues, and new containers are welcome!
