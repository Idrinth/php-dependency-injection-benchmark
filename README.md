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

Run from 2026-07-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 461µs, 887ns | 1ms, 204µs, 967ns | 1ms, 782µs, 894ns |
| Auryn(Reflection, Transient) | ^1.4 | 396ms, 294µs, 355ns | 312ms, 721µs, 967ns | 436ms, 880µs, 826ns |
| Dice(Configured, Singleton) | ^4.0 | 822µs, 448ns | 805µs, 139ns | 842µs, 94ns |
| Dice(Reflection, Transient) | ^4.0 | 67ms, 986µs, 202ns | 62ms, 461µs, 137ns | 75ms, 427µs, 55ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 673µs, 937ns | 646µs, 114ns | 726µs, 938ns |
| Laravel(Configured, Transient) | ^12.28 | 411ms, 781µs, 644ns | 400ms, 620µs, 937ns | 426ms, 811µs, 933ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 488µs, 540ns | 3ms, 338µs, 813ns | 3ms, 804µs, 922ns |
| Laravel(Reflection, Transient) | ^12.28 | 578ms, 365µs, 63ns | 574ms, 963µs, 808ns | 593ms, 367µs, 99ns |
| League(Configured, Transient) | ^5.1 | 1s, 142ms, 854µs, 928ns | 889ms, 757µs, 156ns | 1s, 199ms, 334µs, 859ns |
| League(Reflection, Transient) | ^5.1 | 661ms, 479µs, 592ns | 540ms, 430µs, 68ns | 734ms, 619µs, 855ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 677µs, 10ns | 3ms, 584µs, 146ns | 4ms, 261µs, 16ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 172µs, 657ns | 5ms, 897µs, 45ns | 6ms, 788µs, 969ns |
| Phalcon(Configured, Transient) | ^5 | 315ms, 197µs, 420ns | 185ms, 524µs, 940ns | 341ms, 779µs, 947ns |
| Php-baseline |  | 610µs, 113ns | 579µs, 118ns | 653µs, 28ns |
| Php-di(Reflection, Singleton) | ^7.0 | 937µs, 8ns | 854µs, 15ns | 1ms, 338µs, 958ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 222µs, 515ns | 1ms, 194µs | 1ms, 289µs, 129ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 260µs, 187ns | 98ms, 34µs, 143ns | 101ms, 145µs, 982ns |
| Quickly(Compiled, Singleton) | dev-master | 820µs, 16ns | 803µs, 947ns | 846µs, 147ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 379µs, 418ns | 1ms, 346µs, 111ns | 1ms, 428µs, 127ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 121µs, 68ns | 1ms, 101µs, 970ns | 1ms, 193µs, 46ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 738ms, 727µs, 68ns | 3s, 605ms, 775µs, 117ns | 3s, 892ms, 953µs, 157ns |
| Ray-di(Reflection, Transient) | ^2.16 | 399ms, 643µs, 754ns | 382ms, 20µs, 950ns | 406ms, 775µs, 951ns |
| Symfony(Compiled, Singleton) | ^7.0 | 790µs, 119ns | 771µs, 45ns | 810µs, 146ns |
| Zen(Compiled, Singleton) | ^3.1 | 806µs, 164ns | 717µs, 163ns | 1ms, 401µs, 185ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 11µs, 585ns | 1ms, 660µs, 823ns | 3ms, 215µs, 74ns |
| Auryn(Reflection, Transient) | ^1.4 | 387ms, 984µs, 371ns | 309ms, 231µs, 42ns | 419ms, 66µs, 190ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 735µs, 615ns | 1ms, 428µs, 842ns | 2ms, 238µs, 35ns |
| Dice(Reflection, Transient) | ^4.0 | 73ms, 605µs, 84ns | 72ms, 753µs, 906ns | 75ms, 163µs, 125ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 948µs, 452ns | 813µs, 7ns | 1ms, 981µs, 973ns |
| Laravel(Configured, Transient) | ^12.28 | 415ms, 784µs, 382ns | 403ms, 621µs, 912ns | 434ms, 650µs, 897ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 966µs, 546ns | 3ms, 471µs, 136ns | 5ms, 383µs, 968ns |
| Laravel(Reflection, Transient) | ^12.28 | 582ms, 744µs, 908ns | 574ms, 197µs, 53ns | 591ms, 459µs, 989ns |
| League(Configured, Transient) | ^5.1 | 1s, 120ms, 660µs, 829ns | 882ms, 678µs, 31ns | 1s, 196ms, 557µs, 998ns |
| League(Reflection, Transient) | ^5.1 | 675ms, 189µs, 566ns | 538ms, 609µs, 27ns | 747ms, 547µs, 149ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 792µs, 309ns | 3ms, 714µs, 84ns | 4ms, 162µs, 788ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 835µs, 57ns | 4ms, 333µs, 19ns | 5ms, 362µs, 987ns |
| Phalcon(Configured, Transient) | ^5 | 330ms, 36µs, 616ns | 295ms, 341µs, 14ns | 341ms, 675µs, 43ns |
| Php-baseline |  | 643µs, 920ns | 560µs, 998ns | 744µs, 104ns |
| Php-di(Reflection, Singleton) | ^7.0 | 894µs, 808ns | 708µs, 103ns | 2ms, 460µs, 956ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 252µs, 627ns | 1ms, 75µs, 983ns | 2ms, 407µs, 73ns |
| Pimple(Configured, Transient) | ^3.5 | 98ms, 987µs, 460ns | 95ms, 887µs, 899ns | 102ms, 957µs, 963ns |
| Quickly(Compiled, Singleton) | dev-master | 796µs, 723ns | 767µs, 946ns | 860µs, 929ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 882µs, 385ns | 2ms, 63µs, 35ns | 4ms, 934µs, 72ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 500µs, 678ns | 1ms, 406µs, 908ns | 2ms, 231µs, 121ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 518ms, 252µs, 205ns | 2s, 29ms, 798µs, 984ns | 3s, 899ms, 610µs, 42ns |
| Ray-di(Reflection, Transient) | ^2.16 | 410ms, 225µs, 200ns | 397ms, 233µs, 963ns | 421ms, 538µs, 114ns |
| Symfony(Compiled, Singleton) | ^7.0 | 747µs, 13ns | 725µs, 30ns | 785µs, 112ns |
| Zen(Compiled, Singleton) | ^3.1 | 954µs, 79ns | 742µs, 912ns | 2ms, 670µs, 49ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 506µs, 996ns | 1ms, 332µs, 998ns | 1ms, 723µs, 51ns |
| Dice(Configured, Singleton) | ^4.0 | 845µs, 980ns | 826µs, 835ns | 871µs, 896ns |
| Laravel(Configured, Transient) | ^12.28 | 384ms, 241µs, 104ns | 295ms, 781µs, 135ns | 423ms, 568µs, 964ns |
| League(Configured, Transient) | ^5.1 | 9s, 211ms, 676µs, 96ns | 7s, 666ms, 424µs, 36ns | 9s, 665ms, 439µs, 844ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 122µs, 42ns | 4ms, 40µs, 956ns | 4ms, 448µs, 890ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 182µs, 409ns | 4ms, 301µs, 71ns | 6ms, 57µs, 977ns |
| Phalcon(Configured, Transient) | ^5 | 322ms, 675µs, 395ns | 249ms, 677µs, 896ns | 342ms, 830µs, 896ns |
| Pimple(Configured, Singleton) | ^3.5 | 953µs, 197ns | 931µs, 24ns | 995µs, 874ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 392µs, 126ns | 99ms, 990µs, 129ns | 103ms, 956µs, 937ns |
| Quickly(Compiled, Singleton) | dev-master | 805µs, 568ns | 794µs, 887ns | 813µs, 7ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 957µs, 986ns | 3ms, 911µs, 18ns | 3ms, 998µs, 41ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 766ms, 725µs, 659ns | 3s, 616ms, 604µs, 89ns | 3s, 918ms, 662µs, 786ns |
| Symfony(Compiled, Singleton) | ^7.0 | 746µs, 130ns | 712µs, 871ns | 799µs, 179ns |
| Zen(Compiled, Singleton) | ^3.1 | 797µs, 915ns | 714µs, 63ns | 1ms, 443µs, 147ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 52µs, 330ns | 1ms, 643µs, 896ns | 3ms, 839µs, 15ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 902µs, 198ns | 1ms, 765µs, 12ns | 2ms, 290µs, 964ns |
| Laravel(Configured, Transient) | ^12.28 | 369ms, 601µs, 392ns | 295ms, 559µs, 167ns | 389ms, 91µs, 14ns |
| League(Configured, Transient) | ^5.1 | 9s, 428ms, 537µs, 321ns | 9s, 156ms, 339µs, 883ns | 9s, 596ms, 887µs, 111ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 915µs, 905ns | 3ms, 802µs, 61ns | 4ms, 409µs, 74ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 256µs, 55ns | 6ms, 122µs, 827ns | 6ms, 422µs, 996ns |
| Phalcon(Configured, Transient) | ^5 | 334ms, 891µs, 891ns | 280ms, 830µs, 860ns | 373ms, 627µs, 185ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 377µs, 105ns | 1ms, 303µs, 911ns | 1ms, 605µs, 987ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 169µs, 658ns | 98ms, 618µs, 30ns | 106ms, 127µs, 977ns |
| Quickly(Compiled, Singleton) | dev-master | 787µs, 210ns | 771µs, 45ns | 808µs |
| Quickly(Configured, Singleton) | dev-master | 4ms, 707µs, 527ns | 4ms, 540µs, 920ns | 5ms, 407µs, 94ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 693ms, 691µs, 110ns | 3s, 540ms, 112µs, 972ns | 3s, 913ms, 977µs, 861ns |
| Symfony(Compiled, Singleton) | ^7.0 | 781µs, 607ns | 735µs, 998ns | 849µs, 8ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 108µs, 26ns | 834µs, 941ns | 2ms, 863µs, 168ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 789µs, 375ns | 4ms, 699µs, 945ns | 10ms, 258µs, 913ns |
| Dice(Configured, Singleton) | ^4.0 | 894µs, 689ns | 716µs, 924ns | 1ms, 316µs, 70ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 964ms, 937µs, 996ns | 7s, 914ms, 649µs, 9ns | 10s, 527ms, 383µs, 89ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 810µs, 956ns | 773µs, 191ns | 897µs, 169ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 776µs, 73ns | 3ms, 46µs, 35ns | 4ms, 183µs, 53ns |
| Laravel(Reflection, Transient) | ^12.28 | 78s, 578ms, 765µs, 106ns | 64s, 585ms, 396µs, 51ns | 82s, 757ms, 823µs, 944ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 429µs, 269ns | 3ms, 330µs, 945ns | 3ms, 784µs, 894ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 938µs, 386ns | 5ms, 225µs, 896ns | 6ms, 392µs, 2ns |
| Php-baseline |  | 568µs, 246ns | 473µs, 22ns | 614µs, 881ns |
| Php-di(Reflection, Singleton) | ^7.0 | 911µs, 664ns | 859µs, 975ns | 1ms, 287µs, 937ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 381µs, 421ns | 1ms, 320µs, 838ns | 1ms, 461µs, 29ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 668ms, 383µs, 836ns | 12s, 811ms, 877µs, 965ns | 13s, 955ms, 962µs, 181ns |
| Quickly(Compiled, Singleton) | dev-master | 836µs, 539ns | 741µs, 958ns | 1ms, 47µs, 134ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 410µs, 722ns | 1ms, 374µs, 6ns | 1ms, 445µs, 55ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 380µs, 610ns | 1ms, 351µs, 833ns | 1ms, 533µs, 985ns |
| Symfony(Compiled, Singleton) | ^7.0 | 958µs, 371ns | 762µs, 939ns | 1ms, 253µs, 843ns |
| Zen(Compiled, Singleton) | ^3.1 | 870µs, 990ns | 791µs, 72ns | 1ms, 520µs, 872ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 668µs, 90ns | 5ms, 198µs, 955ns | 7ms, 288µs, 932ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 258µs, 801ns | 1ms, 904µs, 10ns | 2ms, 470µs, 16ns |
| Dice(Reflection, Transient) | ^4.0 | 9s, 990ms, 827µs, 894ns | 7s, 627ms, 8µs, 914ns | 10s, 511ms, 133µs, 909ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 277µs, 470ns | 1ms, 13µs, 994ns | 2ms, 684µs, 831ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 77µs, 910ns | 4ms, 968µs, 166ns | 5ms, 465µs, 984ns |
| Laravel(Reflection, Transient) | ^12.28 | 81s, 188ms, 228µs, 321ns | 77s, 758ms, 529µs, 186ns | 83s, 823ms, 904µs, 991ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 725µs, 695ns | 3ms, 614µs, 187ns | 4ms, 97µs, 938ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 192µs, 827ns | 5ms, 436µs, 182ns | 6ms, 515µs, 26ns |
| Php-baseline |  | 653µs, 290ns | 571µs, 12ns | 833µs, 34ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 124µs, 930ns | 852µs, 823ns | 3ms, 313µs, 64ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 377µs, 487ns | 1ms, 317µs, 24ns | 1ms, 646µs, 995ns |
| Pimple(Configured, Transient) | ^3.5 | 12s, 913ms, 78µs, 618ns | 7s, 470ms, 573µs, 902ns | 13s, 807ms, 65µs, 963ns |
| Quickly(Compiled, Singleton) | dev-master | 618µs, 553ns | 596µs, 46ns | 660µs, 181ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 233µs, 600ns | 2ms, 101µs, 182ns | 3ms, 53µs, 903ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 153µs, 87ns | 1ms, 75µs, 983ns | 1ms, 735µs, 925ns |
| Symfony(Compiled, Singleton) | ^7.0 | 803µs, 303ns | 767µs, 946ns | 870µs, 943ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 69µs, 784ns | 840µs, 187ns | 2ms, 929µs, 925ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 765µs, 84ns | 1ms, 441µs, 1ns | 1ms, 829µs, 147ns |
| Dice(Configured, Singleton) | ^4.0 | 844µs, 478ns | 694µs, 990ns | 900µs, 30ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 790µs, 616ns | 3ms, 702µs, 878ns | 4ms, 250µs, 49ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 15µs, 801ns | 4ms, 337µs, 72ns | 8ms, 404µs, 970ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 199µs, 221ns | 1ms, 175µs, 165ns | 1ms, 291µs, 990ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 786ms, 486µs, 792ns | 12s, 765ms, 626µs, 907ns | 14s, 211ms, 750µs, 984ns |
| Quickly(Compiled, Singleton) | dev-master | 665µs, 140ns | 640µs, 869ns | 702µs, 142ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 929µs, 328ns | 3ms, 825µs, 902ns | 4ms, 302µs, 24ns |
| Symfony(Compiled, Singleton) | ^7.0 | 792µs, 503ns | 749µs, 111ns | 875µs, 949ns |
| Zen(Compiled, Singleton) | ^3.1 | 817µs, 489ns | 716µs, 924ns | 1ms, 471µs, 996ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 255µs, 796ns | 2ms, 705µs, 812ns | 4ms, 181µs, 146ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 770µs, 900ns | 1ms, 929µs, 998ns | 4ms, 19µs, 21ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 129µs, 433ns | 4ms, 75µs, 50ns | 4ms, 476µs, 70ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 894µs, 374ns | 4ms, 514µs, 932ns | 6ms, 482µs, 839ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 395µs, 559ns | 1ms, 322µs, 984ns | 1ms, 697µs, 63ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 415ms, 230µs, 894ns | 10s, 552ms, 469µs, 968ns | 13s, 968ms, 712µs, 91ns |
| Quickly(Compiled, Singleton) | dev-master | 824µs, 22ns | 801µs, 86ns | 873µs, 88ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 55µs, 380ns | 3ms, 926µs, 992ns | 4ms, 626µs, 35ns |
| Symfony(Compiled, Singleton) | ^7.0 | 784µs, 444ns | 740µs, 51ns | 814µs, 914ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 98µs, 132ns | 871µs, 181ns | 2ms, 926µs, 111ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 796µs, 890ns | 735µs, 998ns | 1ms, 44µs, 34ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 507µs, 876ns | 3ms, 324µs, 985ns | 3ms, 931µs, 999ns |
| Php-di(Reflection, Singleton) | ^7.0 | 845µs, 408ns | 786µs, 66ns | 1ms, 259µs, 88ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 207µs, 590ns | 1ms, 190µs, 900ns | 1ms, 230µs, 955ns |
| Quickly(Compiled, Singleton) | dev-master | 825µs, 190ns | 808µs | 839µs, 948ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 403µs, 188ns | 1ms, 364µs, 946ns | 1ms, 451µs, 969ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 366µs, 925ns | 1ms, 311µs, 63ns | 1ms, 631µs, 21ns |
| Symfony(Compiled, Singleton) | ^7.0 | 658µs, 178ns | 638µs, 961ns | 694µs, 36ns |
| Zen(Compiled, Singleton) | ^3.1 | 635µs, 933ns | 565µs, 52ns | 1ms, 152µs, 992ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 889µs, 110ns | 766µs, 38ns | 1ms, 736µs, 164ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 845µs, 71ns | 3ms, 756µs, 999ns | 4ms, 300µs, 117ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 186µs, 656ns | 941µs, 991ns | 3ms, 309µs, 965ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 531µs, 767ns | 1ms, 391µs, 172ns | 2ms, 221µs, 822ns |
| Quickly(Compiled, Singleton) | dev-master | 829µs, 815ns | 812µs, 53ns | 882µs, 148ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 950µs, 120ns | 1ms, 840µs, 114ns | 2ms, 643µs, 108ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 226µs, 496ns | 1ms, 143µs, 932ns | 1ms, 801µs, 13ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 147µs, 317ns | 854µs, 969ns | 1ms, 279µs, 115ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 110µs, 29ns | 868µs, 82ns | 2ms, 971µs, 887ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 853µs, 607ns | 3ms, 782µs, 33ns | 4ms, 264µs, 116ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 224µs, 136ns | 1ms, 186µs, 132ns | 1ms, 302µs, 3ns |
| Quickly(Compiled, Singleton) | dev-master | 862µs, 812ns | 835µs, 895ns | 921µs, 10ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 14µs, 992ns | 3ms, 934µs, 860ns | 4ms, 374µs, 27ns |
| Symfony(Compiled, Singleton) | ^7.0 | 763µs, 106ns | 730µs, 37ns | 804µs, 901ns |
| Zen(Compiled, Singleton) | ^3.1 | 842µs, 499ns | 751µs, 18ns | 1ms, 538µs, 38ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 985µs, 95ns | 2ms, 887µs, 10ns | 3ms, 273µs, 10ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 464µs, 414ns | 1ms, 312µs, 17ns | 2ms, 408µs, 981ns |
| Quickly(Compiled, Singleton) | dev-master | 672µs, 793ns | 655µs, 889ns | 742µs, 912ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 754µs, 304ns | 4ms, 590µs, 988ns | 5ms, 424µs, 976ns |
| Symfony(Compiled, Singleton) | ^7.0 | 768µs, 804ns | 733µs, 852ns | 801µs, 86ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 114µs, 678ns | 864µs, 28ns | 3ms, 14µs, 802ns |

</details>

Questions, issues, and new containers are welcome!
