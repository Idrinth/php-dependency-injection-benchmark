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

Run from 2025-09-11

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 682µs, 114ns | 1ms, 558µs, 780ns | 1ms, 910µs, 924ns |
| Auryn(Reflection, Transient) | ^1.4 | 412ms, 122µs, 82ns | 405ms, 303µs, 1ns | 420ms, 626µs, 878ns |
| Dice(Configured, Singleton) | ^4.0 | 818µs, 824ns | 792µs, 980ns | 840µs, 902ns |
| Dice(Reflection, Transient) | ^4.0 | 70ms, 901µs, 155ns | 68ms, 249µs, 940ns | 75ms, 502µs, 872ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 792µs, 908ns | 764µs, 131ns | 883µs, 817ns |
| Laravel(Configured, Transient) | ^12.28 | 408ms, 180µs, 189ns | 399ms, 344µs, 921ns | 441ms, 434µs, 144ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 468µs, 822ns | 3ms, 410µs, 100ns | 6ms, 683µs, 111ns |
| Laravel(Reflection, Transient) | ^12.28 | 636ms, 911µs, 559ns | 626ms, 30µs, 921ns | 648ms, 802µs, 42ns |
| League(Configured, Transient) | ^5.1 | 858ms, 102µs, 941ns | 845ms, 988µs, 988ns | 866ms, 630µs, 77ns |
| League(Reflection, Transient) | ^5.1 | 666ms, 775µs, 298ns | 659ms, 768µs, 104ns | 677ms, 81µs, 108ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 690µs, 505ns | 3ms, 188µs, 848ns | 7ms, 15µs, 943ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 379µs, 558ns | 4ms, 19µs, 975ns | 6ms, 603µs, 956ns |
| Phalcon(Configured, Transient) | ^5 | 294ms, 974µs, 780ns | 290ms, 983µs, 915ns | 303ms, 475µs, 856ns |
| Php-baseline |  | 684µs, 499ns | 586µs, 32ns | 791µs, 788ns |
| Php-di(Reflection, Singleton) | ^7.0 | 857µs, 615ns | 802µs, 993ns | 1ms, 234µs, 54ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 244µs, 306ns | 1ms, 219µs, 987ns | 1ms, 279µs, 115ns |
| Pimple(Configured, Transient) | ^3.5 | 100ms, 820µs, 64ns | 99ms, 258µs, 184ns | 103ms, 644µs, 132ns |
| Quickly(Compiled, Singleton) | dev-master | 803µs, 685ns | 792µs, 26ns | 827µs, 789ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 351µs, 618ns | 1ms, 321µs, 77ns | 1ms, 450µs, 61ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 349µs, 282ns | 1ms, 312µs, 17ns | 1ms, 469µs, 850ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 495ms, 815µs, 682ns | 3s, 438ms, 231µs, 945ns | 3s, 538ms, 926µs, 839ns |
| Ray-di(Reflection, Transient) | ^2.16 | 350ms, 511µs, 121ns | 346ms, 600µs, 55ns | 362ms, 104µs, 892ns |
| Symfony(Compiled, Singleton) | ^7.0 | 780µs, 701ns | 770µs, 92ns | 797µs, 986ns |
| Zen(Compiled, Singleton) | ^3.1 | 847µs, 411ns | 763µs, 893ns | 1ms, 490µs, 116ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 781µs, 81ns | 1ms, 724µs, 958ns | 5ms, 474µs, 90ns |
| Auryn(Reflection, Transient) | ^1.4 | 411ms, 690µs, 783ns | 402ms, 356µs, 863ns | 422ms, 957µs, 181ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 925µs, 182ns | 1ms, 801µs, 13ns | 2ms, 331µs, 972ns |
| Dice(Reflection, Transient) | ^4.0 | 71ms, 915µs, 197ns | 69ms, 998µs, 979ns | 73ms, 925µs, 971ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 919µs, 342ns | 767µs, 946ns | 2ms, 11µs, 60ns |
| Laravel(Configured, Transient) | ^12.28 | 411ms, 970µs, 520ns | 400ms, 840µs, 997ns | 446ms, 768µs, 45ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 714µs, 752ns | 3ms, 401µs, 994ns | 4ms, 796µs, 981ns |
| Laravel(Reflection, Transient) | ^12.28 | 638ms, 824µs, 534ns | 630ms, 968µs, 93ns | 652ms, 428µs, 150ns |
| League(Configured, Transient) | ^5.1 | 873ms, 828µs, 864ns | 854ms, 753µs, 971ns | 916ms, 823µs, 148ns |
| League(Reflection, Transient) | ^5.1 | 668ms, 918µs, 633ns | 659ms, 725µs, 904ns | 712ms, 98µs, 836ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 603µs, 339ns | 3ms, 247µs, 22ns | 5ms, 603µs, 75ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 212µs, 236ns | 4ms, 147µs, 52ns | 4ms, 326µs, 105ns |
| Phalcon(Configured, Transient) | ^5 | 293ms, 261µs, 909ns | 288ms, 357µs, 19ns | 297ms, 393µs, 83ns |
| Php-baseline |  | 603µs, 103ns | 575µs, 65ns | 620µs, 841ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 130µs, 700ns | 859µs, 975ns | 3ms, 344µs, 58ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 346µs, 826ns | 1ms, 285µs, 76ns | 1ms, 636µs, 28ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 67µs, 111ns | 98ms, 558µs, 902ns | 118ms, 581µs, 56ns |
| Quickly(Compiled, Singleton) | dev-master | 818µs, 896ns | 793µs, 933ns | 912µs, 189ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 612µs, 543ns | 2ms, 48µs, 969ns | 5ms, 911µs, 111ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 466µs, 655ns | 1ms, 367µs, 807ns | 2ms, 214µs, 908ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 512ms, 267µs, 303ns | 3s, 456ms, 941µs, 127ns | 3s, 556ms, 730µs, 985ns |
| Ray-di(Reflection, Transient) | ^2.16 | 384ms, 45µs, 815ns | 378ms, 369µs, 92ns | 392ms, 762µs, 899ns |
| Symfony(Compiled, Singleton) | ^7.0 | 777µs, 888ns | 754µs, 833ns | 804µs, 185ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 67µs, 876ns | 832µs, 796ns | 2ms, 978µs, 801ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 732µs, 826ns | 1ms, 601µs, 934ns | 2ms, 288µs, 103ns |
| Dice(Configured, Singleton) | ^4.0 | 809µs, 240ns | 787µs, 19ns | 831µs, 127ns |
| Laravel(Configured, Transient) | ^12.28 | 381ms, 543µs, 803ns | 378ms, 360µs, 986ns | 390ms, 981µs, 912ns |
| League(Configured, Transient) | ^5.1 | 4s, 155ms, 481µs, 553ns | 4s, 114ms, 843µs, 845ns | 4s, 215ms, 620µs, 994ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 723µs, 573ns | 3ms, 655µs, 910ns | 4ms, 91µs, 978ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 170µs, 83ns | 3ms, 883µs, 123ns | 5ms, 784µs, 34ns |
| Phalcon(Configured, Transient) | ^5 | 293ms, 179µs, 488ns | 288ms, 555µs, 145ns | 303ms, 535µs, 938ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 245µs, 760ns | 1ms, 219µs, 987ns | 1ms, 295µs, 89ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 555µs, 536ns | 101ms, 33µs, 926ns | 107ms, 546µs, 91ns |
| Quickly(Compiled, Singleton) | dev-master | 820µs, 684ns | 792µs, 980ns | 916µs, 957ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 17µs, 210ns | 3ms, 905µs, 57ns | 4ms, 394µs, 54ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 548ms, 192µs, 501ns | 3s, 495ms, 902µs, 61ns | 3s, 654ms, 383µs, 897ns |
| Symfony(Compiled, Singleton) | ^7.0 | 828µs, 170ns | 813µs, 7ns | 845µs, 909ns |
| Zen(Compiled, Singleton) | ^3.1 | 884µs, 652ns | 798µs, 940ns | 1ms, 510µs, 858ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 657µs, 8ns | 1ms, 646µs, 41ns | 4ms, 654µs, 169ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 897µs, 716ns | 1ms, 808µs, 881ns | 2ms, 218µs, 961ns |
| Laravel(Configured, Transient) | ^12.28 | 385ms, 66µs, 533ns | 378ms, 280µs, 162ns | 393ms, 963µs, 98ns |
| League(Configured, Transient) | ^5.1 | 4s, 149ms, 329µs, 90ns | 4s, 123ms, 333µs, 930ns | 4s, 190ms, 424µs, 919ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 943µs, 228ns | 3ms, 667µs, 831ns | 5ms, 465µs, 984ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 218µs, 149ns | 4ms, 184µs, 7ns | 4ms, 312µs, 38ns |
| Phalcon(Configured, Transient) | ^5 | 297ms, 106µs, 909ns | 291ms, 928µs, 52ns | 306ms, 877µs, 851ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 368µs, 45ns | 1ms, 305µs, 103ns | 1ms, 642µs, 942ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 249µs, 980ns | 99ms, 756µs, 2ns | 102ms, 627µs, 992ns |
| Quickly(Compiled, Singleton) | dev-master | 805µs, 306ns | 794µs, 887ns | 838µs, 41ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 115µs, 199ns | 4ms, 693µs, 984ns | 8ms, 332µs, 14ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 527ms, 915µs, 620ns | 3s, 487ms, 193µs, 107ns | 3s, 580ms, 214µs, 23ns |
| Symfony(Compiled, Singleton) | ^7.0 | 804µs, 185ns | 790µs, 119ns | 834µs, 941ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 93µs, 316ns | 863µs, 75ns | 3ms, 15µs, 41ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 969µs, 500ns | 5ms, 281µs, 925ns | 9ms, 850µs, 25ns |
| Dice(Configured, Singleton) | ^4.0 | 873µs, 41ns | 852µs, 108ns | 905µs, 36ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 103ms, 555µs, 321ns | 9s, 934ms, 82µs, 984ns | 10s, 282ms, 893µs, 896ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 784µs, 468ns | 742µs, 912ns | 910µs, 997ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 744µs, 649ns | 3ms, 607µs, 988ns | 3ms, 861µs, 904ns |
| Laravel(Reflection, Transient) | ^12.28 | 89s, 12ms, 723µs, 112ns | 88s, 25ms, 470µs, 18ns | 90s, 34ms, 330µs, 129ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 423µs, 738ns | 3ms, 333µs, 91ns | 3ms, 776µs, 73ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 56µs, 382ns | 3ms, 970µs, 146ns | 4ms, 162µs, 73ns |
| Php-baseline |  | 628µs, 42ns | 552µs, 892ns | 846µs, 862ns |
| Php-di(Reflection, Singleton) | ^7.0 | 881µs, 52ns | 792µs, 26ns | 1ms, 278µs, 877ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 285µs, 910ns | 1ms, 260µs, 42ns | 1ms, 307µs, 964ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 113ms, 31µs, 196ns | 13s, 949ms, 101µs, 924ns | 14s, 408ms, 494µs, 949ns |
| Quickly(Compiled, Singleton) | dev-master | 893µs, 712ns | 866µs, 174ns | 916µs, 4ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 576µs, 209ns | 1ms, 351µs, 118ns | 2ms, 424µs, 1ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 485µs, 61ns | 1ms, 349µs, 925ns | 2ms, 223µs, 968ns |
| Symfony(Compiled, Singleton) | ^7.0 | 777µs, 816ns | 760µs, 78ns | 802µs, 993ns |
| Zen(Compiled, Singleton) | ^3.1 | 876µs, 808ns | 784µs, 873ns | 1ms, 569µs, 986ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 965µs, 65ns | 6ms, 765µs, 127ns | 7ms, 743µs, 120ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 421µs, 116ns | 2ms, 205µs, 133ns | 3ms, 875µs, 970ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 39ms, 636µs, 588ns | 9s, 784ms, 986µs, 972ns | 10s, 220ms, 314µs, 979ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 987µs, 172ns | 852µs, 823ns | 2ms, 58µs, 982ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 33µs, 135ns | 4ms, 747µs, 867ns | 5ms, 604µs, 28ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 604ms, 181µs, 551ns | 87s, 589ms, 191µs, 913ns | 89s, 481ms, 670µs, 856ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 407µs, 692ns | 3ms, 335µs, 952ns | 3ms, 740µs, 72ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 687µs, 714ns | 4ms, 208µs, 87ns | 8ms, 260µs, 11ns |
| Php-baseline |  | 620µs, 746ns | 592µs, 947ns | 695µs, 943ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 260µs, 566ns | 986µs, 814ns | 3ms, 487µs, 825ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 386µs, 404ns | 1ms, 302µs, 3ns | 1ms, 628µs, 875ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 200ms, 513µs, 648ns | 14s, 55ms, 17µs, 948ns | 14s, 356ms, 863µs, 975ns |
| Quickly(Compiled, Singleton) | dev-master | 803µs, 732ns | 795µs, 125ns | 837µs, 87ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 161µs, 669ns | 2ms, 24µs, 888ns | 3ms, 7µs, 888ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 490µs, 20ns | 1ms, 387µs, 834ns | 2ms, 204µs, 895ns |
| Symfony(Compiled, Singleton) | ^7.0 | 783µs, 205ns | 756µs, 25ns | 805µs, 139ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 58µs, 268ns | 841µs, 140ns | 2ms, 883µs, 911ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 810µs, 717ns | 1ms, 759µs, 52ns | 1ms, 857µs, 42ns |
| Dice(Configured, Singleton) | ^4.0 | 981µs, 44ns | 837µs, 87ns | 1ms, 514µs, 911ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 808µs, 999ns | 3ms, 673µs, 76ns | 4ms, 123µs, 926ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 157µs, 280ns | 4ms, 14µs, 968ns | 4ms, 413µs, 127ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 297µs, 974ns | 1ms, 273µs, 870ns | 1ms, 363µs, 39ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 122ms, 295µs, 236ns | 13s, 986ms, 171µs, 7ns | 14s, 341ms, 81µs, 142ns |
| Quickly(Compiled, Singleton) | dev-master | 814µs, 32ns | 789µs, 880ns | 857µs, 114ns |
| Quickly(Configured, Singleton) | dev-master | 5ms, 559µs, 515ns | 3ms, 843µs, 69ns | 7ms, 750µs, 34ns |
| Symfony(Compiled, Singleton) | ^7.0 | 774µs, 788ns | 761µs, 985ns | 789µs, 880ns |
| Zen(Compiled, Singleton) | ^3.1 | 891µs, 208ns | 780µs, 105ns | 1ms, 677µs, 36ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 552µs, 675ns | 3ms, 251µs, 75ns | 5ms, 479µs, 97ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 450µs, 990ns | 2ms, 182µs, 960ns | 3ms, 895µs, 998ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 4ms, 949ns | 3ms, 628µs, 15ns | 6ms, 165µs, 981ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 317µs, 259ns | 4ms, 198µs, 74ns | 4ms, 444µs, 122ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 338µs, 386ns | 1ms, 272µs, 916ns | 1ms, 631µs, 21ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 117ms, 336µs, 440ns | 13s, 942ms, 260µs, 980ns | 14s, 288ms, 528µs, 203ns |
| Quickly(Compiled, Singleton) | dev-master | 829µs, 911ns | 802µs, 993ns | 846µs, 862ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 594µs, 969ns | 4ms, 452µs, 943ns | 5ms, 227µs, 804ns |
| Symfony(Compiled, Singleton) | ^7.0 | 789µs, 475ns | 769µs, 853ns | 832µs, 80ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 114µs, 392ns | 890µs, 16ns | 3ms, 29µs, 823ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 118µs, 254ns | 756µs, 25ns | 1ms, 426µs, 935ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 398µs, 60ns | 3ms, 180µs, 27ns | 4ms, 417µs, 181ns |
| Php-di(Reflection, Singleton) | ^7.0 | 847µs, 911ns | 780µs, 105ns | 1ms, 286µs, 29ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 268µs, 5ns | 1ms, 245µs, 21ns | 1ms, 291µs, 36ns |
| Quickly(Compiled, Singleton) | dev-master | 969µs, 219ns | 802µs, 40ns | 1ms, 195µs, 907ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 388µs, 96ns | 1ms, 342µs, 58ns | 1ms, 502µs, 990ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 373µs, 76ns | 1ms, 317µs, 24ns | 1ms, 595µs, 973ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 326µs, 227ns | 1ms, 286µs, 29ns | 1ms, 427µs, 888ns |
| Zen(Compiled, Singleton) | ^3.1 | 839µs, 591ns | 748µs, 872ns | 1ms, 520µs, 156ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 1ms, 45µs, 322ns | 916µs, 4ns | 2ms, 89µs, 977ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 470µs, 563ns | 3ms, 371µs | 3ms, 966µs, 808ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 239µs, 681ns | 945µs, 91ns | 3ms, 574µs, 848ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 429µs, 176ns | 1ms, 319µs, 169ns | 1ms, 757µs, 860ns |
| Quickly(Compiled, Singleton) | dev-master | 832µs, 605ns | 804µs, 185ns | 907µs, 897ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 226µs, 42ns | 2ms, 83µs, 63ns | 3ms, 55µs, 95ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 584µs, 839ns | 1ms, 481µs, 771ns | 2ms, 331µs, 18ns |
| Symfony(Compiled, Singleton) | ^7.0 | 779µs, 914ns | 725µs, 30ns | 806µs, 93ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 203µs, 203ns | 854µs, 15ns | 3ms, 15µs, 995ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 762µs, 578ns | 3ms, 689µs, 50ns | 4ms, 152µs, 59ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 280µs, 307ns | 1ms, 262µs, 903ns | 1ms, 307µs, 964ns |
| Quickly(Compiled, Singleton) | dev-master | 831µs, 294ns | 795µs, 841ns | 986µs, 99ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 855µs, 395ns | 3ms, 731µs, 12ns | 4ms, 374µs, 980ns |
| Symfony(Compiled, Singleton) | ^7.0 | 746µs, 297ns | 728µs, 845ns | 787µs, 19ns |
| Zen(Compiled, Singleton) | ^3.1 | 846µs, 290ns | 750µs, 64ns | 1ms, 569µs, 32ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 747µs, 224ns | 3ms, 656µs, 148ns | 4ms, 106µs, 998ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 375µs, 460ns | 1ms, 322µs, 984ns | 1ms, 631µs, 975ns |
| Quickly(Compiled, Singleton) | dev-master | 838µs, 828ns | 787µs, 973ns | 976µs, 85ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 616µs, 212ns | 4ms, 492µs, 44ns | 5ms, 388µs, 21ns |
| Symfony(Compiled, Singleton) | ^7.0 | 771µs, 498ns | 750µs, 64ns | 799µs, 894ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 216µs, 697ns | 993µs, 967ns | 3ms, 139µs, 972ns |

</details>

Questions, issues, and new containers are welcome!
