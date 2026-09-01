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

Run from 2026-09-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 343µs, 178ns | 1ms, 24µs, 7ns | 1ms, 745µs, 939ns |
| Auryn(Reflection, Transient) | ^1.4 | 380ms, 653µs, 381ns | 234ms, 624µs, 147ns | 454ms, 73µs, 190ns |
| Dice(Configured, Singleton) | ^4.0 | 738µs, 596ns | 488µs, 996ns | 964µs, 879ns |
| Dice(Reflection, Transient) | ^4.0 | 65ms, 362µs, 620ns | 58ms, 673µs, 143ns | 71ms, 694µs, 850ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 466µs, 918ns | 447µs, 34ns | 519µs, 990ns |
| Laravel(Configured, Transient) | ^12.28 | 365ms, 840µs, 196ns | 266ms, 925µs, 811ns | 445ms, 242µs, 881ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 82µs, 990ns | 2ms, 593µs, 994ns | 3ms, 663µs, 63ns |
| Laravel(Reflection, Transient) | ^12.28 | 570ms, 43µs, 945ns | 562ms, 12µs, 195ns | 577ms, 80µs, 965ns |
| League(Configured, Transient) | ^5.1 | 1s, 74ms, 801µs, 898ns | 842ms, 686µs, 891ns | 1s, 186ms, 519µs, 861ns |
| League(Reflection, Transient) | ^5.1 | 658ms, 200µs, 669ns | 400ms, 213µs, 3ns | 718ms, 447µs, 923ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 680µs, 706ns | 3ms, 560µs, 781ns | 4ms, 50µs, 16ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 715µs, 967ns | 4ms, 321µs, 813ns | 5ms, 74µs, 24ns |
| Phalcon(Configured, Transient) | ^5 | 260ms, 62µs, 551ns | 199ms, 199µs, 914ns | 292ms, 488µs, 98ns |
| Php-baseline |  | 630µs, 211ns | 430µs, 822ns | 840µs, 187ns |
| Php-di(Reflection, Singleton) | ^7.0 | 817µs, 799ns | 772µs, 953ns | 1ms, 149µs, 892ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 288µs, 866ns | 1ms, 266µs, 2ns | 1ms, 358µs, 32ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 394µs, 414ns | 97ms, 388µs, 29ns | 105ms, 61µs, 54ns |
| Quickly(Compiled, Singleton) | dev-master | 772µs, 809ns | 753µs, 879ns | 794µs, 887ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 95µs, 819ns | 1ms, 55µs, 2ns | 1ms, 167µs, 58ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 378µs, 250ns | 1ms, 327µs, 37ns | 1ms, 484µs, 155ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 106ms, 887µs, 722ns | 1s, 666ms, 566µs, 133ns | 3s, 450ms, 654µs, 983ns |
| Ray-di(Reflection, Transient) | ^2.16 | 280ms, 560µs, 16ns | 164ms, 812µs, 88ns | 300ms, 76µs, 7ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 180µs, 791ns | 1ms, 153µs, 945ns | 1ms, 232µs, 147ns |
| Zen(Compiled, Singleton) | ^3.1 | 912µs, 952ns | 813µs, 961ns | 1ms, 525µs, 878ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 60µs, 532ns | 1ms, 724µs, 958ns | 3ms, 295µs, 898ns |
| Auryn(Reflection, Transient) | ^1.4 | 378ms, 547µs, 787ns | 285ms, 459µs, 41ns | 422ms, 225µs, 952ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 412µs, 843ns | 1ms, 780µs, 986ns | 3ms, 801µs, 107ns |
| Dice(Reflection, Transient) | ^4.0 | 74ms, 903µs, 988ns | 73ms, 713µs, 64ns | 76ms, 914µs, 787ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 950µs, 694ns | 793µs, 218ns | 2ms, 115µs, 11ns |
| Laravel(Configured, Transient) | ^12.28 | 393ms, 61µs, 423ns | 205ms, 145µs, 120ns | 452ms, 400µs, 922ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 366µs, 468ns | 3ms, 391µs, 981ns | 8ms, 786µs, 916ns |
| Laravel(Reflection, Transient) | ^12.28 | 567ms, 804µs, 718ns | 553ms, 612µs, 947ns | 593ms, 62µs, 162ns |
| League(Configured, Transient) | ^5.1 | 1s, 55ms, 96µs, 912ns | 744ms, 245µs, 52ns | 1s, 192ms, 135µs, 95ns |
| League(Reflection, Transient) | ^5.1 | 631ms, 53µs, 233ns | 467ms, 20µs, 988ns | 759ms, 21µs, 997ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 444µs, 480ns | 3ms, 272µs, 56ns | 4ms, 4µs, 955ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 943µs, 13ns | 4ms, 511µs, 117ns | 5ms, 270µs, 4ns |
| Phalcon(Configured, Transient) | ^5 | 248ms, 160µs, 99ns | 155ms, 911µs, 922ns | 288ms, 529µs, 157ns |
| Php-baseline |  | 575µs, 804ns | 532µs, 150ns | 632µs, 47ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 79µs, 34ns | 784µs, 158ns | 3ms, 201µs, 7ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 10µs, 894ns | 964µs, 879ns | 1ms, 199µs, 960ns |
| Pimple(Configured, Transient) | ^3.5 | 97ms, 119µs, 92ns | 95ms, 953µs, 941ns | 99ms, 181µs, 890ns |
| Quickly(Compiled, Singleton) | dev-master | 779µs, 104ns | 750µs, 64ns | 802µs, 40ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 157µs, 115ns | 2ms, 38µs, 2ns | 3ms, 5µs, 981ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 194µs, 357ns | 1ms, 105µs, 70ns | 1ms, 811µs, 981ns |
| Ray-di(Compiled, Transient) | ^2.16 | 2s, 731ms, 990µs, 694ns | 1s, 423ms, 488µs, 855ns | 3s, 469ms, 797µs, 134ns |
| Ray-di(Reflection, Transient) | ^2.16 | 268ms, 894µs, 720ns | 171ms, 416µs, 44ns | 329ms, 112µs, 52ns |
| Symfony(Compiled, Singleton) | ^7.0 | 803µs, 637ns | 777µs, 6ns | 832µs, 80ns |
| Zen(Compiled, Singleton) | ^3.1 | 993µs, 180ns | 751µs, 972ns | 2ms, 872µs, 943ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 336µs, 622ns | 991µs, 106ns | 1ms, 763µs, 105ns |
| Dice(Configured, Singleton) | ^4.0 | 723µs, 886ns | 578µs, 880ns | 869µs, 35ns |
| Laravel(Configured, Transient) | ^12.28 | 328ms, 664µs, 970ns | 215ms, 465µs, 68ns | 392ms, 96µs, 42ns |
| League(Configured, Transient) | ^5.1 | 8s, 258ms, 927µs, 464ns | 5s, 602ms, 442µs, 979ns | 9s, 433ms, 303µs, 117ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 49µs, 515ns | 3ms, 948µs, 926ns | 4ms, 518µs, 985ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 716µs, 682ns | 4ms, 355µs, 907ns | 4ms, 996µs, 61ns |
| Phalcon(Configured, Transient) | ^5 | 261ms, 894µs, 965ns | 158ms, 953µs, 189ns | 289ms, 31µs, 982ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 263µs, 499ns | 1ms, 235µs, 961ns | 1ms, 302µs, 3ns |
| Pimple(Configured, Transient) | ^3.5 | 83ms, 774µs, 209ns | 72ms, 302µs, 103ns | 95ms, 860µs, 4ns |
| Quickly(Compiled, Singleton) | dev-master | 394µs, 916ns | 380µs, 39ns | 411µs, 987ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 306µs, 151ns | 2ms, 265µs, 930ns | 2ms, 381µs, 86ns |
| Ray-di(Compiled, Transient) | ^2.16 | 2s, 651ms, 973µs, 295ns | 1s, 148ms, 306µs, 846ns | 3s, 503ms, 707µs, 885ns |
| Symfony(Compiled, Singleton) | ^7.0 | 750µs, 994ns | 730µs, 37ns | 776µs, 52ns |
| Zen(Compiled, Singleton) | ^3.1 | 872µs, 588ns | 787µs, 19ns | 1ms, 518µs, 11ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 965µs, 308ns | 1ms, 642µs, 942ns | 3ms, 123µs, 44ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 583µs, 433ns | 1ms, 207µs, 828ns | 2ms, 205µs, 133ns |
| Laravel(Configured, Transient) | ^12.28 | 368ms, 132µs, 328ns | 270ms, 490µs, 884ns | 413ms, 608µs, 74ns |
| League(Configured, Transient) | ^5.1 | 8s, 481ms, 485µs, 128ns | 4s, 862ms, 526µs, 178ns | 9s, 580ms, 479µs, 860ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 129µs, 958ns | 4ms, 17µs, 114ns | 4ms, 474µs, 878ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 403µs, 233ns | 3ms, 552µs, 913ns | 7ms, 789µs, 850ns |
| Phalcon(Configured, Transient) | ^5 | 256ms, 953µs, 549ns | 198ms, 920µs, 11ns | 299ms, 169µs, 63ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 438µs, 999ns | 1ms, 363µs, 992ns | 1ms, 662µs, 15ns |
| Pimple(Configured, Transient) | ^3.5 | 82ms, 482µs, 504ns | 73ms, 865µs, 890ns | 95ms, 270µs, 872ns |
| Quickly(Compiled, Singleton) | dev-master | 596µs, 46ns | 576µs, 972ns | 606µs, 60ns |
| Quickly(Configured, Singleton) | dev-master | 6ms, 370µs, 592ns | 4ms, 534µs, 6ns | 9ms, 16µs, 990ns |
| Ray-di(Compiled, Transient) | ^2.16 | 2s, 918ms, 115µs, 782ns | 1s, 378ms, 814µs, 935ns | 3s, 455ms, 660µs, 104ns |
| Symfony(Compiled, Singleton) | ^7.0 | 794µs, 291ns | 785µs, 112ns | 811µs, 815ns |
| Zen(Compiled, Singleton) | ^3.1 | 981µs, 640ns | 774µs, 145ns | 2ms, 750µs, 158ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 4ms, 844µs, 188ns | 2ms, 913µs, 951ns | 5ms, 391µs, 120ns |
| Dice(Configured, Singleton) | ^4.0 | 760µs, 984ns | 483µs, 989ns | 877µs, 857ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 396ms, 122µs, 527ns | 10s, 33ms, 176µs, 183ns | 10s, 712ms, 510µs, 108ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 796µs, 961ns | 758µs, 171ns | 895µs, 23ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 364µs, 682ns | 2ms, 179µs, 145ns | 5ms, 63µs, 56ns |
| Laravel(Reflection, Transient) | ^12.28 | 75s, 224ms, 135µs, 756ns | 63s, 31ms, 893µs, 968ns | 82s, 602ms, 879µs, 47ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 1ms, 939µs, 272ns | 1ms, 875µs, 877ns | 2ms, 202µs, 33ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 417µs, 467ns | 3ms, 337µs, 144ns | 5ms, 193µs, 948ns |
| Php-baseline |  | 564µs, 885ns | 294µs, 923ns | 726µs, 938ns |
| Php-di(Reflection, Singleton) | ^7.0 | 438µs, 165ns | 405µs, 73ns | 665µs, 903ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 286µs, 721ns | 1ms, 256µs, 942ns | 1ms, 325µs, 845ns |
| Pimple(Configured, Transient) | ^3.5 | 12s, 420ms, 735µs, 979ns | 8s, 186ms, 488µs, 866ns | 14s, 570ms, 440µs, 53ns |
| Quickly(Compiled, Singleton) | dev-master | 778µs, 675ns | 756µs, 25ns | 813µs, 961ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 133µs, 680ns | 1ms, 75µs, 29ns | 1ms, 240µs, 15ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 353µs, 144ns | 1ms, 320µs, 123ns | 1ms, 497µs, 983ns |
| Symfony(Compiled, Singleton) | ^7.0 | 728µs, 774ns | 555µs, 992ns | 884µs, 56ns |
| Zen(Compiled, Singleton) | ^3.1 | 797µs, 224ns | 718µs, 832ns | 1ms, 385µs, 927ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 623µs, 316ns | 3ms, 514µs, 51ns | 6ms, 767µs, 34ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 476µs, 310ns | 1ms, 620µs, 54ns | 3ms, 818µs, 988ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 589ms, 388µs, 227ns | 7s, 726ms, 291µs, 894ns | 10s, 559ms, 751µs, 987ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 832µs, 700ns | 724µs, 77ns | 1ms, 658µs, 916ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 400µs, 300ns | 2ms, 957µs, 105ns | 5ms, 80µs, 938ns |
| Laravel(Reflection, Transient) | ^12.28 | 73s, 275ms, 409µs, 579ns | 54s, 767ms, 848µs, 968ns | 82s, 94ms, 579µs, 935ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 375µs, 864ns | 3ms, 299µs, 951ns | 3ms, 800µs, 868ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 634µs, 928ns | 3ms, 725µs, 51ns | 5ms, 569µs, 934ns |
| Php-baseline |  | 536µs, 990ns | 309µs, 944ns | 677µs, 108ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 148µs, 796ns | 883µs, 102ns | 3ms, 387µs, 928ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 381µs, 897ns | 1ms, 338µs, 5ns | 1ms, 648µs, 902ns |
| Pimple(Configured, Transient) | ^3.5 | 12s, 415ms, 699µs, 219ns | 8s, 147ms, 659µs, 63ns | 14s, 509ms, 166µs, 955ns |
| Quickly(Compiled, Singleton) | dev-master | 762µs, 104ns | 735µs, 998ns | 782µs, 12ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 254µs, 533ns | 2ms, 94µs, 984ns | 2ms, 986µs, 907ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 560µs, 354ns | 1ms, 434µs, 803ns | 2ms, 321µs, 958ns |
| Symfony(Compiled, Singleton) | ^7.0 | 775µs, 575ns | 741µs, 958ns | 835µs, 180ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 413µs, 750ns | 1ms, 75µs, 29ns | 4ms, 247µs, 188ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 704µs, 1ns | 1ms, 119µs, 136ns | 2ms, 32µs, 995ns |
| Dice(Configured, Singleton) | ^4.0 | 797µs, 271ns | 478µs, 29ns | 903µs, 844ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 139µs, 161ns | 4ms, 12µs, 107ns | 4ms, 556µs, 894ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 736µs, 661ns | 2ms, 917µs, 51ns | 5ms, 162µs |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 291µs, 918ns | 1ms, 253µs, 843ns | 1ms, 387µs, 119ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 25ms, 956µs, 988ns | 8s, 110ms, 722µs, 64ns | 14s, 456ms, 199µs, 169ns |
| Quickly(Compiled, Singleton) | dev-master | 750µs, 207ns | 720µs, 24ns | 802µs, 40ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 835µs, 773ns | 3ms, 782µs, 987ns | 3ms, 877µs, 878ns |
| Symfony(Compiled, Singleton) | ^7.0 | 385µs, 46ns | 375µs, 986ns | 411µs, 987ns |
| Zen(Compiled, Singleton) | ^3.1 | 437µs, 68ns | 356µs, 912ns | 1ms, 6µs, 126ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 954µs, 316ns | 2ms, 210µs, 140ns | 3ms, 434µs, 896ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 84µs, 16ns | 1ms, 348µs, 972ns | 3ms, 931µs, 45ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 123µs, 163ns | 4ms, 30µs, 942ns | 4ms, 626µs, 35ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 255µs, 866ns | 3ms, 731µs, 966ns | 8ms, 162µs, 21ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 319µs, 980ns | 1ms, 271µs, 9ns | 1ms, 560µs, 926ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 401ms, 521µs, 992ns | 14s, 298ms, 897µs, 27ns | 14s, 479ms, 768µs, 991ns |
| Quickly(Compiled, Singleton) | dev-master | 805µs, 711ns | 787µs, 973ns | 844µs, 1ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 579µs, 354ns | 3ms, 458µs, 976ns | 4ms, 101µs, 991ns |
| Symfony(Compiled, Singleton) | ^7.0 | 403µs, 618ns | 388µs, 860ns | 429µs, 153ns |
| Zen(Compiled, Singleton) | ^3.1 | 890µs, 612ns | 708µs, 103ns | 2ms, 378µs, 940ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 787µs, 377ns | 751µs, 972ns | 963µs, 926ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 522µs, 633ns | 3ms, 666µs, 877ns | 7ms, 421µs, 970ns |
| Php-di(Reflection, Singleton) | ^7.0 | 865µs, 173ns | 802µs, 993ns | 1ms, 268µs, 863ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 310µs, 205ns | 1ms, 257µs, 896ns | 1ms, 341µs, 104ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 12µs, 516ns | 992µs, 59ns | 1ms, 37µs, 120ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 65µs, 707ns | 1ms, 47µs, 134ns | 1ms, 121µs, 44ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 382µs, 17ns | 1ms, 323µs, 223ns | 1ms, 695µs, 156ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 261µs, 878ns | 792µs, 980ns | 4ms, 888µs, 57ns |
| Zen(Compiled, Singleton) | ^3.1 | 878µs, 238ns | 769µs, 853ns | 1ms, 585µs, 6ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 816µs, 965ns | 707µs, 864ns | 1ms, 618µs, 862ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 841µs, 900ns | 3ms, 770µs, 828ns | 4ms, 192µs, 113ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 195µs, 120ns | 916µs, 957ns | 3ms, 481µs, 149ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 383µs, 781ns | 1ms, 314µs, 163ns | 1ms, 605µs, 987ns |
| Quickly(Compiled, Singleton) | dev-master | 826µs, 96ns | 795µs, 841ns | 906µs, 944ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 175µs, 212ns | 1ms, 88µs, 857ns | 1ms, 677µs, 36ns |
| Quickly(Reflection, Singleton) | dev-master | 2ms, 142µs, 214ns | 1ms, 528µs, 24ns | 2ms, 879µs, 142ns |
| Symfony(Compiled, Singleton) | ^7.0 | 844µs, 264ns | 806µs, 808ns | 896µs, 930ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 95µs, 223ns | 864µs, 28ns | 2ms, 886µs, 56ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 365µs, 682ns | 3ms, 983µs, 20ns | 7ms, 209µs, 777ns |
| Pimple(Configured, Singleton) | ^3.5 | 985µs, 312ns | 977µs, 39ns | 1ms, 6µs, 126ns |
| Quickly(Compiled, Singleton) | dev-master | 780µs, 606ns | 749µs, 826ns | 828µs, 981ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 836µs, 83ns | 3ms, 752µs, 946ns | 3ms, 931µs, 45ns |
| Symfony(Compiled, Singleton) | ^7.0 | 790µs, 810ns | 768µs, 899ns | 823µs, 974ns |
| Zen(Compiled, Singleton) | ^3.1 | 488µs, 162ns | 412µs, 940ns | 982µs, 999ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 761µs, 339ns | 3ms, 699µs, 64ns | 4ms, 160µs, 165ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 411µs, 700ns | 1ms, 358µs, 985ns | 1ms, 664µs, 876ns |
| Quickly(Compiled, Singleton) | dev-master | 773µs, 382ns | 746µs, 965ns | 832µs, 80ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 659µs, 8ns | 4ms, 521µs, 846ns | 5ms, 358µs, 219ns |
| Symfony(Compiled, Singleton) | ^7.0 | 628µs, 399ns | 542µs, 879ns | 793µs, 933ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 551µs, 246ns | 1ms, 196µs, 861ns | 4ms, 426µs, 956ns |

</details>

Questions, issues, and new containers are welcome!
