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
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 633µs | 1ms, 590µs, 13ns | 1ms, 784µs, 86ns |
| Auryn(Reflection, Transient) | ^1.4 | 409ms, 514µs, 760ns | 406ms, 201µs, 124ns | 418ms, 864µs, 11ns |
| Dice(Configured, Singleton) | ^4.0 | 814µs, 390ns | 798µs, 940ns | 829µs, 935ns |
| Dice(Reflection, Transient) | ^4.0 | 75ms, 694µs, 60ns | 70ms, 630µs, 73ns | 103ms, 40µs, 933ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 791µs, 907ns | 761µs, 32ns | 864µs, 982ns |
| Laravel(Configured, Transient) | ^12.28 | 408ms, 427µs, 906ns | 399ms, 887µs, 84ns | 425ms, 122µs, 976ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 502µs, 583ns | 3ms, 371µs | 4ms, 24µs, 28ns |
| Laravel(Reflection, Transient) | ^12.28 | 636ms, 644µs, 363ns | 632ms, 826µs, 805ns | 658ms, 670µs, 902ns |
| League(Configured, Transient) | ^5.1 | 855ms, 493µs, 474ns | 848ms, 530µs, 54ns | 865ms, 436µs, 77ns |
| League(Reflection, Transient) | ^5.1 | 664ms, 965µs, 176ns | 656ms, 942µs, 129ns | 677ms, 76µs, 101ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 404µs, 353ns | 3ms, 259µs, 181ns | 7ms, 699µs, 966ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 957µs, 700ns | 3ms, 901µs, 958ns | 4ms, 13µs, 61ns |
| Phalcon(Configured, Transient) | ^5 | 299ms, 418µs, 115ns | 290ms, 119µs, 886ns | 332ms, 626µs, 104ns |
| Php-baseline |  | 600µs, 528ns | 572µs, 919ns | 643µs, 14ns |
| Php-di(Reflection, Singleton) | ^7.0 | 832µs, 223ns | 775µs, 814ns | 1ms, 202µs, 106ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 271µs, 510ns | 1ms, 224µs, 994ns | 1ms, 310µs, 110ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 720µs, 763ns | 98ms, 616µs, 123ns | 105ms, 91µs, 94ns |
| Quickly(Compiled, Singleton) | dev-master | 911µs, 45ns | 787µs, 19ns | 1ms, 186µs, 132ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 394µs, 367ns | 1ms, 349µs, 925ns | 1ms, 485µs, 824ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 381µs, 802ns | 1ms, 314µs, 878ns | 1ms, 742µs, 124ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 501ms, 491µs, 975ns | 3s, 466ms, 476µs, 202ns | 3s, 545ms, 273µs, 65ns |
| Ray-di(Reflection, Transient) | ^2.16 | 355ms, 28µs, 104ns | 345ms, 551µs, 13ns | 385ms, 770µs, 797ns |
| Symfony(Compiled, Singleton) | ^7.0 | 792µs, 837ns | 762µs, 939ns | 853µs, 61ns |
| Zen(Compiled, Singleton) | ^3.1 | 851µs, 821ns | 761µs, 985ns | 1ms, 503µs, 944ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 19µs, 762ns | 1ms, 595µs, 973ns | 3ms, 249µs, 883ns |
| Auryn(Reflection, Transient) | ^1.4 | 411ms, 588µs, 335ns | 401ms, 821µs, 851ns | 422ms, 264µs, 814ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 809µs, 71ns | 1ms, 927µs, 852ns | 3ms, 993µs, 34ns |
| Dice(Reflection, Transient) | ^4.0 | 71ms, 676µs, 158ns | 70ms, 168µs, 972ns | 78ms, 553µs, 915ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 206µs, 207ns | 827µs, 789ns | 2ms, 29µs, 180ns |
| Laravel(Configured, Transient) | ^12.28 | 415ms, 797µs, 877ns | 399ms, 204µs, 969ns | 446ms, 19µs, 172ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 924µs, 655ns | 3ms, 432µs, 35ns | 6ms, 393µs, 194ns |
| Laravel(Reflection, Transient) | ^12.28 | 631ms, 8µs, 744ns | 625ms, 593µs, 900ns | 633ms, 782µs, 863ns |
| League(Configured, Transient) | ^5.1 | 865ms, 805µs, 387ns | 857ms, 639µs, 74ns | 875ms, 565µs, 52ns |
| League(Reflection, Transient) | ^5.1 | 671ms, 51µs, 621ns | 658ms, 788µs, 919ns | 691ms, 868µs, 66ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 409µs, 790ns | 3ms, 343µs, 820ns | 3ms, 732µs, 919ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 183µs, 959ns | 4ms, 45µs, 9ns | 4ms, 457µs, 950ns |
| Phalcon(Configured, Transient) | ^5 | 298ms, 76µs, 486ns | 291ms, 980µs, 981ns | 310ms, 196µs, 876ns |
| Php-baseline |  | 622µs, 510ns | 599µs, 145ns | 665µs, 903ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 178µs, 383ns | 868µs, 82ns | 3ms, 419µs, 876ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 364µs, 231ns | 1ms, 307µs, 964ns | 1ms, 612µs, 901ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 555µs, 584ns | 100ms, 335µs, 836ns | 104ms, 904µs, 890ns |
| Quickly(Compiled, Singleton) | dev-master | 827µs, 527ns | 799µs, 894ns | 852µs, 108ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 201µs, 390ns | 2ms, 27µs, 34ns | 2ms, 964µs, 973ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 439µs, 714ns | 1ms, 332µs, 998ns | 2ms, 179µs, 145ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 504ms, 100µs, 894ns | 3s, 439ms, 315µs, 80ns | 3s, 567ms, 862µs, 33ns |
| Ray-di(Reflection, Transient) | ^2.16 | 383ms, 727µs, 931ns | 377ms, 892µs, 17ns | 393ms, 347µs, 978ns |
| Symfony(Compiled, Singleton) | ^7.0 | 752µs, 615ns | 736µs, 951ns | 776µs, 52ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 48µs, 970ns | 823µs, 20ns | 2ms, 969µs, 980ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 212µs, 639ns | 5ms, 300µs, 998ns | 10ms, 360µs, 956ns |
| Dice(Configured, Singleton) | ^4.0 | 933µs, 194ns | 845µs, 909ns | 1ms, 507µs, 43ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 41ms, 934µs, 823ns | 9s, 963ms, 421µs, 821ns | 10s, 154ms, 438µs, 18ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 778µs, 222ns | 743µs, 150ns | 895µs, 977ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 731µs, 513ns | 3ms, 657µs, 102ns | 3ms, 831µs, 863ns |
| Laravel(Reflection, Transient) | ^12.28 | 89s, 218ms, 154µs, 644ns | 88s, 214ms, 391µs, 231ns | 90s, 833ms, 804µs, 130ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 386µs, 235ns | 3ms, 306µs, 150ns | 3ms, 754µs, 854ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 97µs, 533ns | 3ms, 999µs, 948ns | 4ms, 369µs, 20ns |
| Php-baseline |  | 648µs, 593ns | 604µs, 867ns | 831µs, 127ns |
| Php-di(Reflection, Singleton) | ^7.0 | 842µs, 475ns | 773µs, 906ns | 1ms, 246µs, 929ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 267µs, 814ns | 1ms, 241µs, 207ns | 1ms, 299µs, 142ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 66ms, 412µs, 329ns | 13s, 959ms, 442µs, 853ns | 14s, 232ms, 753µs, 992ns |
| Quickly(Compiled, Singleton) | dev-master | 836µs, 920ns | 808µs, 954ns | 885µs, 9ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 386µs, 117ns | 1ms, 343µs, 965ns | 1ms, 451µs, 15ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 360µs, 487ns | 1ms, 313µs, 924ns | 1ms, 539µs, 945ns |
| Symfony(Compiled, Singleton) | ^7.0 | 761µs, 270ns | 738µs, 143ns | 823µs, 974ns |
| Zen(Compiled, Singleton) | ^3.1 | 870µs, 60ns | 755µs, 71ns | 1ms, 698µs, 970ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 7ms, 394µs, 27ns | 6ms, 720µs, 66ns | 12ms, 592µs, 77ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 333µs, 140ns | 2ms, 307µs, 176ns | 2ms, 382µs, 993ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 20ms, 82µs, 378ns | 9s, 889ms, 631µs, 986ns | 10s, 231ms, 612µs, 920ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 997µs, 686ns | 864µs, 982ns | 2ms, 67µs, 89ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 223µs, 751ns | 4ms, 748µs, 106ns | 8ms, 419µs, 36ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 605ms, 417µs, 180ns | 87s, 384ms, 889µs, 125ns | 89s, 718ms, 643µs, 903ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 355µs, 121ns | 3ms, 186µs, 225ns | 3ms, 810µs, 167ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 963µs, 588ns | 4ms, 172µs, 86ns | 8ms, 348µs, 941ns |
| Php-baseline |  | 638µs, 198ns | 582µs, 933ns | 848µs, 54ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 164µs, 78ns | 896µs, 930ns | 3ms, 429µs, 889ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 489µs, 114ns | 1ms, 368µs, 45ns | 2ms, 103µs, 90ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 118ms, 703µs, 937ns | 13s, 983ms, 978µs, 986ns | 14s, 262ms, 83ns |
| Quickly(Compiled, Singleton) | dev-master | 804µs, 305ns | 791µs, 72ns | 818µs, 14ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 189µs, 135ns | 2ms, 38µs, 955ns | 2ms, 952µs, 98ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 486µs, 539ns | 1ms, 381µs, 158ns | 2ms, 206µs, 87ns |
| Symfony(Compiled, Singleton) | ^7.0 | 805µs, 330ns | 782µs, 12ns | 844µs, 1ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 76µs, 78ns | 837µs, 87ns | 2ms, 951µs, 860ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 788µs, 903ns | 761µs, 32ns | 968µs, 217ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 458µs, 809ns | 3ms, 339µs, 52ns | 3ms, 754µs, 854ns |
| Php-di(Reflection, Singleton) | ^7.0 | 854µs, 587ns | 787µs, 19ns | 1ms, 318µs, 931ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 324µs, 534ns | 1ms, 298µs, 904ns | 1ms, 353µs, 25ns |
| Quickly(Compiled, Singleton) | dev-master | 810µs, 599ns | 797µs, 33ns | 838µs, 41ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 414µs, 179ns | 1ms, 371µs, 145ns | 1ms, 474µs, 857ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 662µs, 349ns | 1ms, 612µs, 186ns | 1ms, 865µs, 863ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 327µs, 276ns | 1ms, 289µs, 129ns | 1ms, 386µs, 880ns |
| Zen(Compiled, Singleton) | ^3.1 | 836µs, 396ns | 742µs, 912ns | 1ms, 595µs, 20ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 82µs, 873ns | 912µs, 904ns | 2ms, 353µs, 191ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 5ms, 107µs, 212ns | 3ms, 341µs, 913ns | 7ms, 250µs, 70ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 190µs, 114ns | 905µs, 990ns | 3ms, 436µs, 88ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 407µs, 27ns | 1ms, 312µs, 971ns | 1ms, 972µs, 198ns |
| Quickly(Compiled, Singleton) | dev-master | 814µs, 867ns | 792µs, 26ns | 839µs, 948ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 187µs, 800ns | 2ms, 63µs, 35ns | 2ms, 898µs, 931ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 704µs, 764ns | 1ms, 609µs, 86ns | 2ms, 456µs, 903ns |
| Symfony(Compiled, Singleton) | ^7.0 | 817µs, 322ns | 776µs, 52ns | 945µs, 91ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 114µs, 606ns | 884µs, 56ns | 3ms, 6µs, 935ns |

</details>

Questions, issues, and new containers are welcome!
