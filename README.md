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

Run from 2025-09-19

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 671µs, 409ns | 1ms, 557µs, 111ns | 1ms, 893µs, 43ns |
| Auryn(Reflection, Transient) | ^1.4 | 409ms, 631µs, 824ns | 403ms, 569µs, 936ns | 415ms, 151µs, 119ns |
| Dice(Configured, Singleton) | ^4.0 | 823µs, 259ns | 787µs, 973ns | 854µs, 15ns |
| Dice(Reflection, Transient) | ^4.0 | 72ms, 261µs, 667ns | 68ms, 525µs, 75ns | 77ms, 672µs, 4ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 781µs, 726ns | 749µs, 111ns | 896µs, 215ns |
| Laravel(Configured, Transient) | ^12.28 | 404ms, 866µs, 3ns | 399ms, 600µs, 28ns | 410ms, 49µs, 915ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 490µs, 281ns | 3ms, 376µs, 7ns | 3ms, 690µs, 4ns |
| Laravel(Reflection, Transient) | ^12.28 | 625ms, 762µs, 462ns | 617ms, 53µs, 985ns | 646ms, 224µs, 21ns |
| League(Configured, Transient) | ^5.1 | 865ms, 870µs, 356ns | 848ms, 750µs, 114ns | 890ms, 846µs, 14ns |
| League(Reflection, Transient) | ^5.1 | 669ms, 674µs, 62ns | 656ms, 78µs, 815ns | 693ms, 166µs, 971ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 456µs, 687ns | 3ms, 279µs, 924ns | 4ms, 50µs, 970ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 949µs, 809ns | 3ms, 927µs, 946ns | 3ms, 992µs, 80ns |
| Phalcon(Configured, Transient) | ^5 | 298ms, 959µs, 994ns | 288ms, 974µs, 46ns | 324ms, 74µs, 29ns |
| Php-baseline |  | 624µs, 36ns | 573µs, 158ns | 785µs, 827ns |
| Php-di(Reflection, Singleton) | ^7.0 | 860µs, 238ns | 802µs, 993ns | 1ms, 201µs, 152ns |
| Pimple(Configured, Singleton) | ^3.5 | 2ms, 179µs, 646ns | 1ms, 543µs, 998ns | 2ms, 305µs, 30ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 569µs, 200ns | 98ms, 896µs, 980ns | 103ms, 489µs, 875ns |
| Quickly(Compiled, Singleton) | dev-master | 775µs, 694ns | 756µs, 978ns | 805µs, 139ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 346µs, 39ns | 1ms, 322µs, 31ns | 1ms, 373µs, 52ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 359µs, 987ns | 1ms, 328µs, 945ns | 1ms, 469µs, 135ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 507ms, 826µs, 828ns | 3s, 459ms, 828µs, 138ns | 3s, 546ms, 478µs, 986ns |
| Ray-di(Reflection, Transient) | ^2.16 | 354ms, 665µs, 207ns | 341ms, 630µs, 935ns | 435ms, 987µs, 949ns |
| Symfony(Compiled, Singleton) | ^7.0 | 811µs, 743ns | 790µs, 119ns | 858µs, 68ns |
| Zen(Compiled, Singleton) | ^3.1 | 862µs, 979ns | 778µs, 913ns | 1ms, 461µs, 29ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 60µs, 294ns | 1ms, 662µs, 15ns | 3ms, 263µs, 950ns |
| Auryn(Reflection, Transient) | ^1.4 | 411ms, 411µs, 23ns | 404ms, 493µs, 93ns | 419ms, 146µs, 60ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 924µs, 347ns | 1ms, 792µs, 907ns | 2ms, 254µs, 962ns |
| Dice(Reflection, Transient) | ^4.0 | 72ms, 18µs, 170ns | 70ms, 786µs, 952ns | 76ms, 213µs, 836ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 988µs, 721ns | 823µs, 20ns | 2ms, 14µs, 160ns |
| Laravel(Configured, Transient) | ^12.28 | 406ms, 981µs, 325ns | 400ms, 204µs, 181ns | 417ms, 134µs, 46ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 822µs, 16ns | 3ms, 475µs, 904ns | 4ms, 865µs, 884ns |
| Laravel(Reflection, Transient) | ^12.28 | 636ms, 705µs, 994ns | 628ms, 216µs, 981ns | 646ms, 26µs, 849ns |
| League(Configured, Transient) | ^5.1 | 858ms, 712µs, 339ns | 846ms, 354µs, 7ns | 867ms, 61µs, 853ns |
| League(Reflection, Transient) | ^5.1 | 681ms, 67µs, 466ns | 658ms, 123µs, 970ns | 735ms, 389µs, 947ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 411µs, 912ns | 3ms, 249µs, 883ns | 3ms, 811µs, 120ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 173µs, 517ns | 4ms, 100µs, 84ns | 4ms, 297µs, 18ns |
| Phalcon(Configured, Transient) | ^5 | 295ms, 897µs, 30ns | 290ms, 732µs, 145ns | 303ms, 275µs, 108ns |
| Php-baseline |  | 593µs, 352ns | 560µs, 45ns | 633µs, 1ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 108µs, 622ns | 850µs, 200ns | 3ms, 133µs, 58ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 309µs, 990ns | 1ms, 246µs, 929ns | 1ms, 563µs, 72ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 538µs, 251ns | 99ms, 236µs, 11ns | 107ms, 297µs, 897ns |
| Quickly(Compiled, Singleton) | dev-master | 817µs, 632ns | 800µs, 848ns | 833µs, 988ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 131µs, 80ns | 2ms, 16µs, 782ns | 2ms, 814µs, 54ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 460µs, 123ns | 1ms, 372µs, 98ns | 2ms, 156µs, 19ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 499ms, 817µs, 895ns | 3s, 470ms, 125µs, 913ns | 3s, 530ms, 652µs, 46ns |
| Ray-di(Reflection, Transient) | ^2.16 | 383ms, 227µs, 324ns | 375ms, 396µs, 966ns | 399ms, 973µs, 154ns |
| Symfony(Compiled, Singleton) | ^7.0 | 769µs, 305ns | 746µs, 11ns | 804µs, 901ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 74µs, 123ns | 843µs, 48ns | 2ms, 955µs, 913ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 425µs, 813ns | 1ms, 559µs, 19ns | 3ms, 143µs, 72ns |
| Dice(Configured, Singleton) | ^4.0 | 822µs, 305ns | 807µs, 46ns | 855µs, 922ns |
| Laravel(Configured, Transient) | ^12.28 | 383ms, 471µs, 107ns | 373ms, 52µs, 120ns | 408ms, 93µs, 929ns |
| League(Configured, Transient) | ^5.1 | 4s, 134ms, 333µs, 586ns | 4s, 115ms, 834µs, 951ns | 4s, 162ms, 346µs, 124ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 121µs, 732ns | 3ms, 658µs, 56ns | 7ms, 981µs, 61ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 56µs, 334ns | 3ms, 958µs, 940ns | 4ms, 212µs, 856ns |
| Phalcon(Configured, Transient) | ^5 | 300ms, 342µs, 893ns | 293ms, 155µs, 908ns | 321ms, 709µs, 156ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 262µs, 140ns | 1ms, 209µs, 20ns | 1ms, 292µs, 943ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 169µs, 895ns | 100ms, 282µs, 907ns | 107ms, 515µs, 811ns |
| Quickly(Compiled, Singleton) | dev-master | 828µs, 409ns | 811µs, 100ns | 876µs, 903ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 872µs, 823ns | 3ms, 729µs, 104ns | 4ms, 563µs, 93ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 541ms, 261µs, 29ns | 3s, 500ms, 171µs, 184ns | 3s, 602ms, 155µs, 923ns |
| Symfony(Compiled, Singleton) | ^7.0 | 887µs, 370ns | 782µs, 12ns | 1ms, 356µs, 840ns |
| Zen(Compiled, Singleton) | ^3.1 | 856µs, 661ns | 772µs, 953ns | 1ms, 455µs, 783ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 950µs, 454ns | 1ms, 616µs, 1ns | 3ms, 180µs, 980ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 892µs, 685ns | 1ms, 785µs, 993ns | 2ms, 185µs, 106ns |
| Laravel(Configured, Transient) | ^12.28 | 385ms, 209µs, 751ns | 377ms, 437µs, 114ns | 394ms, 659µs, 42ns |
| League(Configured, Transient) | ^5.1 | 4s, 137ms, 949µs, 204ns | 4s, 101ms, 4µs, 123ns | 4s, 214ms, 668µs, 989ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 935µs, 170ns | 3ms, 638µs, 29ns | 5ms, 560µs, 874ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 154µs, 62ns | 3ms, 995µs, 895ns | 4ms, 329µs, 919ns |
| Phalcon(Configured, Transient) | ^5 | 299ms, 755µs, 406ns | 294ms, 212µs, 102ns | 307ms, 526µs, 826ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 357µs, 7ns | 1ms, 294µs, 851ns | 1ms, 605µs, 987ns |
| Pimple(Configured, Transient) | ^3.5 | 102ms, 324µs, 390ns | 100ms, 146µs, 55ns | 105ms, 119µs, 943ns |
| Quickly(Compiled, Singleton) | dev-master | 832µs, 176ns | 810µs, 146ns | 866µs, 889ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 539µs, 108ns | 4ms, 379µs, 34ns | 5ms, 278µs, 110ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 524ms, 50µs, 760ns | 3s, 471ms, 479µs, 892ns | 3s, 556ms, 320µs, 905ns |
| Symfony(Compiled, Singleton) | ^7.0 | 791µs, 716ns | 730µs, 37ns | 870µs, 943ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 42µs, 819ns | 828µs, 27ns | 2ms, 865µs, 76ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 379µs, 319ns | 5ms, 282µs, 163ns | 5ms, 616µs, 903ns |
| Dice(Configured, Singleton) | ^4.0 | 980µs, 710ns | 859µs, 975ns | 1ms, 549µs, 5ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 137ms, 815µs, 141ns | 9s, 977ms, 81µs, 60ns | 10s, 276ms, 582µs, 956ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 901µs, 31ns | 749µs, 826ns | 1ms, 228µs, 94ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 719µs, 472ns | 3ms, 634µs, 929ns | 3ms, 957µs, 33ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 645ms, 525µs, 550ns | 87s, 852ms, 267µs, 26ns | 88s, 968ms, 593µs, 120ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 453µs, 660ns | 3ms, 381µs, 13ns | 3ms, 879µs, 70ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 216µs, 599ns | 4ms, 31µs, 181ns | 5ms, 426µs, 883ns |
| Php-baseline |  | 640µs, 58ns | 559µs, 91ns | 852µs, 108ns |
| Php-di(Reflection, Singleton) | ^7.0 | 865µs, 483ns | 808µs | 1ms, 221µs, 895ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 304µs, 316ns | 1ms, 288µs, 175ns | 1ms, 348µs, 972ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 114ms, 698µs, 696ns | 13s, 869ms, 728µs, 803ns | 14s, 278ms, 342µs, 8ns |
| Quickly(Compiled, Singleton) | dev-master | 889µs, 968ns | 853µs, 61ns | 931µs, 978ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 274µs, 560ns | 2ms, 224µs, 922ns | 2ms, 367µs, 19ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 343µs, 393ns | 1ms, 302µs, 3ns | 1ms, 495µs, 122ns |
| Symfony(Compiled, Singleton) | ^7.0 | 805µs, 377ns | 771µs, 999ns | 845µs, 909ns |
| Zen(Compiled, Singleton) | ^3.1 | 827µs, 717ns | 751µs, 18ns | 1ms, 455µs, 68ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 8ms, 240µs, 580ns | 6ms, 657µs, 123ns | 12ms, 914µs, 896ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 381µs, 610ns | 2ms, 225µs, 875ns | 3ms, 380µs, 60ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 82ms, 80µs, 578ns | 9s, 894ms, 943µs, 952ns | 10s, 295ms, 304µs, 59ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 985µs, 503ns | 849µs, 962ns | 1ms, 991µs, 987ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 90µs, 689ns | 4ms, 635µs, 810ns | 8ms, 270µs, 25ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 374ms, 175µs, 47ns | 87s, 413ms, 78µs, 69ns | 89s, 253ms, 844µs, 976ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 532µs, 862ns | 3ms, 463µs, 983ns | 3ms, 874µs, 778ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 301µs, 452ns | 4ms, 140µs, 853ns | 4ms, 859µs, 924ns |
| Php-baseline |  | 639µs, 533ns | 575µs, 780ns | 835µs, 180ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 131µs, 844ns | 878µs, 810ns | 3ms, 239µs, 154ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 407µs, 694ns | 1ms, 345µs, 872ns | 1ms, 612µs, 901ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 115ms, 220µs, 737ns | 13s, 917ms, 788µs, 28ns | 14s, 320ms, 745µs, 944ns |
| Quickly(Compiled, Singleton) | dev-master | 809µs, 574ns | 796µs, 79ns | 830µs, 888ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 195µs, 596ns | 2ms, 71µs, 857ns | 3ms, 41µs, 28ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 521µs, 730ns | 1ms, 422µs, 882ns | 2ms, 223µs, 968ns |
| Symfony(Compiled, Singleton) | ^7.0 | 925µs, 278ns | 730µs, 991ns | 1ms, 304µs, 864ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 64µs, 801ns | 813µs, 961ns | 2ms, 977µs, 848ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 866µs, 865ns | 1ms, 752µs, 138ns | 2ms, 233µs, 982ns |
| Dice(Configured, Singleton) | ^4.0 | 962µs, 591ns | 852µs, 108ns | 1ms, 540µs, 184ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 374µs, 909ns | 3ms, 537µs, 893ns | 8ms, 549µs, 928ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 123µs, 544ns | 3ms, 900µs, 51ns | 4ms, 287µs, 4ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 248µs, 2ns | 1ms, 222µs, 133ns | 1ms, 315µs, 116ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 113ms, 264µs, 83ns | 13s, 943ms, 271µs, 875ns | 14s, 238ms, 386µs, 869ns |
| Quickly(Compiled, Singleton) | dev-master | 809µs, 788ns | 796µs, 79ns | 846µs, 147ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 794µs, 145ns | 3ms, 702µs, 163ns | 3ms, 854µs, 990ns |
| Symfony(Compiled, Singleton) | ^7.0 | 781µs, 59ns | 763µs, 893ns | 810µs, 861ns |
| Zen(Compiled, Singleton) | ^3.1 | 840µs, 401ns | 761µs, 32ns | 1ms, 487µs, 970ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 455µs, 901ns | 3ms, 144µs, 25ns | 5ms, 422µs, 115ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 398µs, 681ns | 2ms, 146µs, 959ns | 3ms, 968µs, 954ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 14µs, 301ns | 3ms, 727µs, 912ns | 5ms, 742µs, 73ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 419µs, 302ns | 4ms, 204µs, 988ns | 5ms, 434µs, 989ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 354µs, 384ns | 1ms, 317µs, 977ns | 1ms, 557µs, 826ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 179ms, 989µs, 624ns | 13s, 974ms, 122µs, 47ns | 14s, 914ms, 749µs, 145ns |
| Quickly(Compiled, Singleton) | dev-master | 764µs, 870ns | 749µs, 826ns | 777µs, 6ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 623µs, 723ns | 4ms, 446µs, 29ns | 5ms, 204µs, 916ns |
| Symfony(Compiled, Singleton) | ^7.0 | 803µs, 470ns | 784µs, 158ns | 839µs, 948ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 89µs, 596ns | 872µs, 850ns | 2ms, 872µs, 943ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 834µs, 631ns | 795µs, 841ns | 985µs, 145ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 651µs, 881ns | 3ms, 352µs, 165ns | 5ms, 64µs, 10ns |
| Php-di(Reflection, Singleton) | ^7.0 | 873µs, 398ns | 808µs | 1ms, 296µs, 997ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 257µs, 419ns | 1ms, 241µs, 922ns | 1ms, 294µs, 136ns |
| Quickly(Compiled, Singleton) | dev-master | 783µs, 729ns | 761µs, 985ns | 822µs, 67ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 355µs, 886ns | 1ms, 302µs, 3ns | 1ms, 484µs, 870ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 376µs, 414ns | 1ms, 332µs, 44ns | 1ms, 577µs, 138ns |
| Symfony(Compiled, Singleton) | ^7.0 | 786µs, 66ns | 769µs, 853ns | 812µs, 53ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 273µs, 679ns | 1ms, 118µs, 183ns | 2ms, 455µs, 949ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 66µs, 875ns | 918µs, 865ns | 2ms, 106µs, 904ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 584µs, 980ns | 3ms, 338µs, 98ns | 4ms, 443µs, 883ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 248µs, 884ns | 983µs, 953ns | 3ms, 496µs, 170ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 368µs, 737ns | 1ms, 311µs, 63ns | 1ms, 624µs, 107ns |
| Quickly(Compiled, Singleton) | dev-master | 818µs, 85ns | 805µs, 854ns | 833µs, 988ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 156µs, 138ns | 2ms, 58µs, 29ns | 2ms, 810µs, 955ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 601µs, 99ns | 1ms, 492µs, 23ns | 2ms, 326µs, 11ns |
| Symfony(Compiled, Singleton) | ^7.0 | 812µs, 5ns | 785µs, 827ns | 859µs, 22ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 143µs, 193ns | 918µs, 149ns | 2ms, 979µs, 993ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 747µs, 868ns | 3ms, 665µs, 208ns | 4ms, 110µs, 813ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 271µs, 390ns | 1ms, 250µs, 28ns | 1ms, 296µs, 997ns |
| Quickly(Compiled, Singleton) | dev-master | 776µs, 767ns | 751µs, 972ns | 844µs, 1ns |
| Quickly(Configured, Singleton) | dev-master | 7ms, 141µs, 351ns | 3ms, 795µs, 862ns | 7ms, 699µs, 966ns |
| Symfony(Compiled, Singleton) | ^7.0 | 971µs, 317ns | 803µs, 947ns | 1ms, 389µs, 26ns |
| Zen(Compiled, Singleton) | ^3.1 | 905µs, 346ns | 771µs, 999ns | 1ms, 652µs, 2ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 843µs, 951ns | 3ms, 711µs, 938ns | 4ms, 336µs, 118ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 370µs, 692ns | 1ms, 316µs, 785ns | 1ms, 612µs, 901ns |
| Quickly(Compiled, Singleton) | dev-master | 813µs, 674ns | 800µs, 132ns | 831µs, 842ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 776µs, 859ns | 4ms, 513µs, 25ns | 5ms, 862µs, 951ns |
| Symfony(Compiled, Singleton) | ^7.0 | 802µs, 183ns | 785µs, 112ns | 844µs, 1ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 157µs, 522ns | 921µs, 964ns | 2ms, 963µs, 66ns |

</details>

Questions, issues, and new containers are welcome!
