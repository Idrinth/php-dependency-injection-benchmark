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

Run from 2026-06-01

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 649µs, 45ns | 1ms, 588µs, 106ns | 1ms, 806µs, 974ns |
| Auryn(Reflection, Transient) | ^1.4 | 370ms, 502µs, 209ns | 197ms, 279µs, 930ns | 412ms, 418µs, 127ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 14µs, 757ns | 802µs, 40ns | 1ms, 408µs, 815ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 250µs, 606ns | 69ms, 251µs, 60ns | 71ms, 490µs, 49ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 779µs, 199ns | 756µs, 978ns | 828µs, 981ns |
| Laravel(Configured, Transient) | ^12.28 | 391ms, 144µs, 13ns | 319ms, 370µs, 31ns | 432ms, 435µs, 35ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 456µs, 640ns | 3ms, 324µs, 31ns | 3ms, 731µs, 966ns |
| Laravel(Reflection, Transient) | ^12.28 | 534ms, 558µs, 701ns | 485ms, 388µs, 40ns | 583ms, 675µs, 146ns |
| League(Configured, Transient) | ^5.1 | 1s, 106ms, 118µs, 488ns | 876ms, 734µs, 18ns | 1s, 164ms, 705µs, 38ns |
| League(Reflection, Transient) | ^5.1 | 644ms, 258µs, 499ns | 533ms, 452µs, 987ns | 708ms, 163µs, 22ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 210µs, 711ns | 3ms, 117µs, 84ns | 3ms, 668µs, 69ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 536µs, 746ns | 5ms, 306µs, 959ns | 5ms, 756µs, 139ns |
| Phalcon(Configured, Transient) | ^5 | 339ms, 482µs, 378ns | 325ms, 395µs, 107ns | 350ms, 132µs, 942ns |
| Php-baseline |  | 618µs, 410ns | 582µs, 933ns | 652µs, 74ns |
| Php-di(Reflection, Singleton) | ^7.0 | 889µs, 182ns | 843µs, 48ns | 1ms, 221µs, 895ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 889µs, 181ns | 1ms, 821µs, 41ns | 1ms, 914µs, 978ns |
| Pimple(Configured, Transient) | ^3.5 | 99ms, 136µs, 137ns | 97ms, 177µs, 982ns | 101ms, 554µs, 870ns |
| Quickly(Compiled, Singleton) | dev-master | 783µs, 896ns | 764µs, 846ns | 829µs, 219ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 367µs, 902ns | 1ms, 328µs, 945ns | 1ms, 497µs, 983ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 808µs, 691ns | 1ms, 368µs, 45ns | 2ms, 57µs, 75ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 217ms, 285µs, 966ns | 2s, 26ms, 803µs, 16ns | 3s, 907ms, 539µs, 844ns |
| Ray-di(Reflection, Transient) | ^2.16 | 398ms, 907µs, 399ns | 354ms, 825µs, 973ns | 424ms, 343µs, 109ns |
| Symfony(Compiled, Singleton) | ^7.0 | 635µs, 981ns | 617µs, 27ns | 655µs, 889ns |
| Zen(Compiled, Singleton) | ^3.1 | 816µs, 607ns | 730µs, 991ns | 1ms, 425µs, 27ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 54µs, 619ns | 1ms, 730µs, 918ns | 3ms, 272µs, 56ns |
| Auryn(Reflection, Transient) | ^1.4 | 394ms, 942µs, 259ns | 311ms, 100µs, 959ns | 418ms, 318µs, 986ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 908µs, 230ns | 1ms, 757µs, 860ns | 2ms, 247µs, 95ns |
| Dice(Reflection, Transient) | ^4.0 | 73ms, 104µs, 190ns | 68ms, 769µs, 931ns | 81ms, 461µs, 906ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 984µs, 573ns | 817µs, 775ns | 2ms, 74µs, 956ns |
| Laravel(Configured, Transient) | ^12.28 | 410ms, 237µs, 693ns | 400ms, 244µs, 951ns | 435ms, 101µs, 985ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 805µs, 232ns | 3ms, 373µs, 861ns | 5ms, 79µs, 984ns |
| Laravel(Reflection, Transient) | ^12.28 | 577ms, 586µs, 770ns | 569ms, 443µs, 941ns | 603ms, 164µs, 911ns |
| League(Configured, Transient) | ^5.1 | 1s, 57ms, 287µs, 144ns | 655ms, 615µs, 91ns | 1s, 146ms, 165µs, 132ns |
| League(Reflection, Transient) | ^5.1 | 676ms, 414µs, 847ns | 534ms, 981µs, 12ns | 713ms, 412µs, 46ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 173µs, 971ns | 3ms, 110µs, 885ns | 3ms, 544µs, 92ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 366µs, 968ns | 6ms, 254µs, 911ns | 6ms, 678µs, 104ns |
| Phalcon(Configured, Transient) | ^5 | 318ms, 418µs, 121ns | 255ms, 502µs, 939ns | 344ms, 840µs, 49ns |
| Php-baseline |  | 523µs, 543ns | 442µs, 981ns | 638µs, 8ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 58µs, 936ns | 826µs, 120ns | 3ms, 37µs, 929ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 18µs, 953ns | 988µs, 960ns | 1ms, 214µs, 27ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 670µs, 192ns | 100ms, 503µs, 921ns | 113ms, 350µs, 868ns |
| Quickly(Compiled, Singleton) | dev-master | 772µs, 166ns | 756µs, 25ns | 818µs, 14ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 784µs, 324ns | 1ms, 679µs, 182ns | 2ms, 422µs, 94ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 452µs, 660ns | 1ms, 343µs, 11ns | 2ms, 245µs, 903ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 495ms, 51µs, 741ns | 2s, 41ms, 476µs, 964ns | 3s, 918ms, 635µs, 129ns |
| Ray-di(Reflection, Transient) | ^2.16 | 406ms, 308µs, 579ns | 397ms, 477µs, 865ns | 421ms, 567µs, 916ns |
| Symfony(Compiled, Singleton) | ^7.0 | 674µs, 176ns | 658µs, 35ns | 708µs, 103ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 84µs, 184ns | 851µs, 154ns | 2ms, 962µs, 112ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 662µs, 278ns | 1ms, 586µs, 914ns | 1ms, 783µs, 847ns |
| Dice(Configured, Singleton) | ^4.0 | 999µs, 689ns | 798µs, 940ns | 1ms, 219µs, 34ns |
| Laravel(Configured, Transient) | ^12.28 | 369ms, 888µs, 138ns | 291ms, 425µs, 228ns | 389ms, 297µs, 962ns |
| League(Configured, Transient) | ^5.1 | 8s, 341ms, 202µs, 592ns | 4s, 652ms, 751µs, 922ns | 9s, 417ms, 569µs, 875ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 634µs, 595ns | 3ms, 525µs, 18ns | 4ms, 359µs, 6ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 620µs, 74ns | 5ms, 270µs, 4ns | 6ms, 227µs, 970ns |
| Phalcon(Configured, Transient) | ^5 | 335ms, 127µs, 67ns | 258ms, 12µs, 56ns | 370ms, 288µs, 133ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 211µs, 47ns | 1ms, 183µs, 986ns | 1ms, 253µs, 843ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 900µs, 315ns | 95ms, 801µs, 830ns | 116ms, 950µs, 988ns |
| Quickly(Compiled, Singleton) | dev-master | 816µs, 202ns | 797µs, 986ns | 849µs, 8ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 872µs, 942ns | 3ms, 818µs, 988ns | 3ms, 905µs, 57ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 572ms, 197µs, 723ns | 3s, 52ms, 438µs, 974ns | 3s, 923ms, 609µs, 18ns |
| Symfony(Compiled, Singleton) | ^7.0 | 971µs, 317ns | 747µs, 919ns | 1ms, 219µs, 34ns |
| Zen(Compiled, Singleton) | ^3.1 | 878µs | 752µs, 925ns | 1ms, 655µs, 101ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 14µs, 780ns | 1ms, 686µs, 96ns | 3ms, 289µs, 937ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 878µs, 952ns | 1ms, 747µs, 846ns | 2ms, 300µs, 24ns |
| Laravel(Configured, Transient) | ^12.28 | 379ms, 313µs, 540ns | 328ms, 938µs, 961ns | 395ms, 575µs, 46ns |
| League(Configured, Transient) | ^5.1 | 9s, 219ms, 917µs, 58ns | 7s, 555ms, 559µs, 873ns | 9s, 736ms, 145µs, 973ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 872µs, 395ns | 2ms, 754µs, 926ns | 3ms, 126µs, 859ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 211µs, 400ns | 4ms, 466µs, 56ns | 6ms, 6µs, 2ns |
| Phalcon(Configured, Transient) | ^5 | 335ms, 815µs, 72ns | 323ms, 508µs, 977ns | 357ms, 398µs, 986ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 345µs, 396ns | 1ms, 281µs, 23ns | 1ms, 587µs, 152ns |
| Pimple(Configured, Transient) | ^3.5 | 96ms, 78µs, 753ns | 91ms, 753µs, 5ns | 108ms, 841µs, 896ns |
| Quickly(Compiled, Singleton) | dev-master | 832µs, 653ns | 794µs, 887ns | 890µs, 970ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 799µs, 914ns | 4ms, 567µs, 146ns | 5ms, 650µs, 43ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 229ms, 768µs, 800ns | 2s, 40ms, 278µs, 911ns | 3s, 922ms, 704µs, 935ns |
| Symfony(Compiled, Singleton) | ^7.0 | 628µs, 566ns | 613µs, 927ns | 663µs, 995ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 60µs, 581ns | 835µs, 895ns | 2ms, 907µs, 37ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 145µs, 812ns | 4ms, 153µs, 966ns | 5ms, 316µs, 19ns |
| Dice(Configured, Singleton) | ^4.0 | 934µs, 815ns | 874µs, 42ns | 1ms, 327µs, 991ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 168ms, 702µs, 602ns | 8s, 779ms, 311µs, 895ns | 10s, 544ms, 162µs, 34ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 834µs, 465ns | 784µs, 873ns | 933µs, 885ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 323µs, 267ns | 3ms, 757µs, 953ns | 5ms, 900µs, 144ns |
| Laravel(Reflection, Transient) | ^12.28 | 76s, 699ms, 198µs, 985ns | 62s, 75ms, 568µs, 914ns | 81s, 956ms, 658µs, 124ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 476µs, 333ns | 3ms, 396µs, 34ns | 3ms, 885µs, 30ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 153µs, 345ns | 5ms, 328µs, 893ns | 8ms, 268µs, 117ns |
| Php-baseline |  | 564µs, 670ns | 314µs, 950ns | 711µs, 917ns |
| Php-di(Reflection, Singleton) | ^7.0 | 834µs, 918ns | 775µs, 98ns | 1ms, 286µs, 983ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 276µs, 540ns | 1ms, 264µs, 95ns | 1ms, 297µs, 950ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 470ms, 441µs, 317ns | 12s, 660ms, 151µs, 958ns | 14s, 30ms, 28µs, 104ns |
| Quickly(Compiled, Singleton) | dev-master | 615µs, 763ns | 590µs, 85ns | 688µs, 76ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 370µs, 906ns | 1ms, 358µs, 32ns | 1ms, 406µs, 908ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 380µs, 753ns | 1ms, 350µs, 879ns | 1ms, 540µs, 899ns |
| Symfony(Compiled, Singleton) | ^7.0 | 769µs, 209ns | 739µs, 97ns | 807µs, 46ns |
| Zen(Compiled, Singleton) | ^3.1 | 817µs, 346ns | 716µs, 924ns | 1ms, 443µs, 147ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 33µs, 181ns | 5ms, 765µs, 914ns | 10ms, 710µs, 954ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 259µs, 540ns | 1ms, 856µs, 88ns | 2ms, 740µs, 859ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 193ms, 556µs, 571ns | 9s, 830ms, 704µs, 927ns | 10s, 526ms, 977µs, 62ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 828µs, 75ns | 712µs, 156ns | 1ms, 650µs, 94ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 372µs, 428ns | 3ms, 902µs, 912ns | 7ms, 590µs, 55ns |
| Laravel(Reflection, Transient) | ^12.28 | 81s, 189ms, 745µs, 259ns | 80s, 504ms, 89µs, 117ns | 82s, 616ms, 200µs, 923ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 542µs, 757ns | 2ms, 444µs, 982ns | 2ms, 876µs, 43ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 126µs, 809ns | 5ms, 87µs, 852ns | 7ms, 416µs, 963ns |
| Php-baseline |  | 594µs, 878ns | 471µs, 830ns | 714µs, 63ns |
| Php-di(Reflection, Singleton) | ^7.0 | 938µs, 606ns | 735µs, 998ns | 2ms, 496µs, 4ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 437µs, 902ns | 1ms, 333µs, 951ns | 1ms, 725µs, 196ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 795ms, 111µs, 441ns | 12s, 673ms, 215µs, 866ns | 14s, 309ms, 373µs, 855ns |
| Quickly(Compiled, Singleton) | dev-master | 602µs, 793ns | 584µs, 125ns | 618µs, 934ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 163µs, 743ns | 2ms, 56µs, 121ns | 2ms, 892µs, 17ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 526µs, 474ns | 1ms, 415µs, 967ns | 2ms, 295µs, 17ns |
| Symfony(Compiled, Singleton) | ^7.0 | 777µs, 578ns | 748µs, 157ns | 797µs, 986ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 204µs, 705ns | 965µs, 833ns | 3ms, 93µs, 4ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 970µs, 171ns | 1ms, 397µs, 132ns | 3ms, 739µs, 833ns |
| Dice(Configured, Singleton) | ^4.0 | 882µs, 935ns | 685µs, 930ns | 981µs, 92ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 2ms, 826µs, 261ns | 2ms, 691µs, 30ns | 3ms, 96µs, 103ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 469µs, 11ns | 5ms, 292µs, 177ns | 10ms, 636µs, 91ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 103µs, 401ns | 941µs, 38ns | 1ms, 442µs, 909ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 766ms, 802µs, 191ns | 13s, 502ms, 283µs, 96ns | 14s, 170ms, 96µs, 874ns |
| Quickly(Compiled, Singleton) | dev-master | 815µs, 81ns | 779µs, 867ns | 866µs, 889ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 937µs, 792ns | 3ms, 853µs, 82ns | 4ms, 371µs, 881ns |
| Symfony(Compiled, Singleton) | ^7.0 | 779µs, 318ns | 761µs, 32ns | 795µs, 841ns |
| Zen(Compiled, Singleton) | ^3.1 | 862µs, 264ns | 767µs, 946ns | 1ms, 518µs, 964ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 241µs, 300ns | 2ms, 696µs, 990ns | 3ms, 987µs, 73ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 351µs, 498ns | 2ms, 219µs, 915ns | 3ms, 15µs, 995ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 876µs, 113ns | 3ms, 782µs, 33ns | 4ms, 289µs, 865ns |
| Phalcon(Configured, Singleton) | ^5 | 6ms, 352µs, 615ns | 5ms, 922µs, 79ns | 6ms, 762µs, 27ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 321µs, 887ns | 1ms, 267µs, 910ns | 1ms, 682µs, 996ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 392ms, 58µs, 348ns | 10s, 639ms, 948µs, 129ns | 14s, 208ms, 41µs, 906ns |
| Quickly(Compiled, Singleton) | dev-master | 777µs, 459ns | 744µs, 819ns | 841µs, 856ns |
| Quickly(Configured, Singleton) | dev-master | 8ms, 268µs, 618ns | 4ms, 718µs, 65ns | 10ms, 257µs, 5ns |
| Symfony(Compiled, Singleton) | ^7.0 | 739µs, 73ns | 722µs, 885ns | 756µs, 978ns |
| Zen(Compiled, Singleton) | ^3.1 | 940µs, 132ns | 710µs, 10ns | 2ms, 629µs, 41ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 808µs, 501ns | 773µs, 906ns | 992µs, 59ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 497µs, 910ns | 3ms, 437µs, 42ns | 3ms, 890µs, 991ns |
| Php-di(Reflection, Singleton) | ^7.0 | 947µs, 403ns | 858µs, 68ns | 1ms, 401µs, 901ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 240µs, 873ns | 1ms, 226µs, 902ns | 1ms, 255µs, 989ns |
| Quickly(Compiled, Singleton) | dev-master | 772µs, 976ns | 755µs, 71ns | 812µs, 53ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 333µs, 522ns | 1ms, 307µs, 10ns | 1ms, 435µs, 995ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 369µs, 524ns | 1ms, 328µs, 945ns | 1ms, 605µs, 33ns |
| Symfony(Compiled, Singleton) | ^7.0 | 782µs, 942ns | 749µs, 111ns | 817µs, 60ns |
| Zen(Compiled, Singleton) | ^3.1 | 854µs, 420ns | 755µs, 71ns | 1ms, 523µs, 971ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 77µs, 699ns | 918µs, 865ns | 2ms, 264µs, 22ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 253µs, 626ns | 3ms, 165µs, 960ns | 3ms, 718µs, 852ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 1µs, 811ns | 808µs | 2ms, 608µs, 60ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 444µs, 602ns | 1ms, 396µs, 894ns | 1ms, 693µs, 964ns |
| Quickly(Compiled, Singleton) | dev-master | 788µs, 712ns | 771µs, 45ns | 856µs, 161ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 177µs, 309ns | 2ms, 70µs, 903ns | 2ms, 923µs, 965ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 606µs, 822ns | 1ms, 502µs, 37ns | 2ms, 319µs, 97ns |
| Symfony(Compiled, Singleton) | ^7.0 | 824µs, 260ns | 776µs, 52ns | 953µs, 912ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 66µs, 684ns | 814µs, 914ns | 2ms, 984µs, 46ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 361µs, 10ns | 3ms, 287µs, 792ns | 3ms, 692µs, 150ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 301µs, 383ns | 1ms, 223µs, 87ns | 1ms, 322µs, 984ns |
| Quickly(Compiled, Singleton) | dev-master | 776µs, 219ns | 738µs, 859ns | 854µs, 969ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 84µs, 897ns | 3ms, 939µs, 151ns | 4ms, 722µs, 118ns |
| Symfony(Compiled, Singleton) | ^7.0 | 729µs, 680ns | 694µs, 36ns | 777µs, 6ns |
| Zen(Compiled, Singleton) | ^3.1 | 809µs, 121ns | 715µs, 970ns | 1ms, 531µs, 124ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 577µs, 183ns | 3ms, 777µs, 980ns | 7ms, 652µs, 997ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 401µs, 376ns | 1ms, 348µs, 18ns | 1ms, 610µs, 994ns |
| Quickly(Compiled, Singleton) | dev-master | 776µs, 243ns | 757µs, 932ns | 802µs, 993ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 782µs, 104ns | 4ms, 641µs, 56ns | 5ms, 537µs, 986ns |
| Symfony(Compiled, Singleton) | ^7.0 | 809µs, 431ns | 778µs, 913ns | 842µs, 94ns |
| Zen(Compiled, Singleton) | ^3.1 | 897µs, 97ns | 716µs, 924ns | 2ms, 265µs, 930ns |

</details>

Questions, issues, and new containers are welcome!
