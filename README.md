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
| [Yii3 DI](https://github.com/yiisoft/di) | configured singleton, reflection singleton | PSR-11 compatible DI container with definitions and auto-wiring |
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

Run from 2026-01-03

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 535µs, 487ns | 1ms, 366µs, 138ns | 1ms, 741µs, 886ns |
| Auryn(Reflection, Transient) | ^1.4 | 405ms, 330µs, 729ns | 356ms, 38µs, 93ns | 453ms, 262µs, 90ns |
| Dice(Configured, Singleton) | ^4.0 | 817µs, 704ns | 772µs, 953ns | 865µs, 936ns |
| Dice(Reflection, Transient) | ^4.0 | 72ms, 204µs, 422ns | 70ms, 553µs, 779ns | 76ms, 138µs, 973ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 805µs, 902ns | 778µs, 913ns | 858µs, 68ns |
| Laravel(Configured, Transient) | ^12.28 | 400ms, 317µs, 72ns | 346ms, 132µs, 993ns | 412ms, 69µs, 82ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 390µs, 407ns | 3ms, 310µs, 918ns | 3ms, 596µs, 67ns |
| Laravel(Reflection, Transient) | ^12.28 | 631ms, 353µs, 497ns | 624ms, 56µs, 100ns | 637ms, 625µs, 932ns |
| League(Configured, Transient) | ^5.1 | 865ms, 180µs, 277ns | 704ms, 300µs, 880ns | 899ms, 569µs, 34ns |
| League(Reflection, Transient) | ^5.1 | 649ms, 573µs, 516ns | 559ms, 736µs, 13ns | 676ms, 807µs, 880ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 440µs, 761ns | 3ms, 320µs, 932ns | 4ms, 9µs, 8ns |
| Phalcon(Configured, Singleton) | ^5 | 3ms, 900µs, 337ns | 3ms, 803µs, 968ns | 3ms, 977µs, 60ns |
| Phalcon(Configured, Transient) | ^5 | 298ms, 828µs, 411ns | 295ms, 758µs, 962ns | 302ms, 227µs, 20ns |
| Php-baseline |  | 699µs, 496ns | 545µs, 24ns | 899µs, 76ns |
| Php-di(Reflection, Singleton) | ^7.0 | 860µs, 381ns | 798µs, 940ns | 1ms, 223µs, 802ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 11µs, 538ns | 999µs, 927ns | 1ms, 24µs, 961ns |
| Pimple(Configured, Transient) | ^3.5 | 103ms, 584µs, 527ns | 99ms, 536µs, 895ns | 118ms, 145µs, 942ns |
| Quickly(Compiled, Singleton) | dev-master | 790µs, 238ns | 746µs, 11ns | 837µs, 87ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 433µs, 753ns | 1ms, 358µs, 985ns | 1ms, 688µs, 957ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 358µs, 604ns | 1ms, 334µs, 905ns | 1ms, 451µs, 969ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 217ms, 258µs, 787ns | 1s, 923ms, 753µs, 23ns | 3s, 587ms, 166µs, 786ns |
| Ray-di(Reflection, Transient) | ^2.16 | 396ms, 497µs, 344ns | 373ms, 892µs, 68ns | 423ms, 496µs, 961ns |
| Symfony(Compiled, Singleton) | ^7.0 | 793µs, 647ns | 767µs, 946ns | 850µs, 915ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 370µs, 382ns | 1ms, 301µs, 50ns | 1ms, 893µs, 43ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 872µs, 802ns | 771µs, 45ns | 1ms, 400µs, 947ns |
| Zen(Compiled, Singleton) | ^3.1 | 843µs, 95ns | 751µs, 18ns | 1ms, 570µs, 940ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup_f06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 5µs, 219ns | 1ms, 477µs, 956ns | 3ms, 132µs, 104ns |
| Auryn(Reflection, Transient) | ^1.4 | 405ms, 314µs, 326ns | 397ms, 954µs, 940ns | 414ms, 206µs, 27ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 864µs, 171ns | 1ms, 736µs, 879ns | 2ms, 161µs, 979ns |
| Dice(Reflection, Transient) | ^4.0 | 74ms, 746µs, 155ns | 71ms, 724µs, 891ns | 95ms, 484µs, 972ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 952µs, 816ns | 818µs, 14ns | 1ms, 991µs, 987ns |
| Laravel(Configured, Transient) | ^12.28 | 407ms, 819µs, 914ns | 403ms, 570µs, 175ns | 415ms, 433µs, 883ns |
| Laravel(Reflection, Singleton) | ^12.28 | 4ms, 946µs, 136ns | 2ms, 819µs, 61ns | 8ms, 488µs, 178ns |
| Laravel(Reflection, Transient) | ^12.28 | 625ms, 102µs, 519ns | 615ms, 847µs, 110ns | 642ms, 826µs, 80ns |
| League(Configured, Transient) | ^5.1 | 845ms, 533µs, 943ns | 713ms, 343µs, 143ns | 899ms, 706µs, 125ns |
| League(Reflection, Transient) | ^5.1 | 678ms, 400µs, 683ns | 662ms, 528µs, 991ns | 695ms, 430µs, 40ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 6ms, 709µs, 194ns | 5ms, 94µs, 51ns | 7ms, 61µs, 4ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 104µs, 113ns | 4ms, 45µs, 963ns | 4ms, 209µs, 995ns |
| Phalcon(Configured, Transient) | ^5 | 296ms, 975µs, 636ns | 277ms, 105µs, 93ns | 314ms, 378µs, 976ns |
| Php-baseline |  | 613µs, 546ns | 557µs, 184ns | 666µs, 856ns |
| Php-di(Reflection, Singleton) | ^7.0 | 870µs, 943ns | 689µs, 983ns | 2ms, 371µs, 72ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 352µs, 930ns | 1ms, 289µs, 129ns | 1ms, 619µs, 100ns |
| Pimple(Configured, Transient) | ^3.5 | 101ms, 34µs, 45ns | 100ms, 22µs, 77ns | 102ms, 341µs, 175ns |
| Quickly(Compiled, Singleton) | dev-master | 812µs, 196ns | 760µs, 78ns | 963µs, 926ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 142µs, 524ns | 2ms, 31µs, 87ns | 2ms, 843µs, 141ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 473µs, 379ns | 1ms, 374µs, 6ns | 2ms, 142µs, 906ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 545ms, 581µs, 483ns | 3s, 493ms, 541µs, 2ns | 3s, 610ms, 213µs, 41ns |
| Ray-di(Reflection, Transient) | ^2.16 | 402ms, 241µs, 301ns | 391ms, 447µs, 67ns | 452ms, 858µs, 924ns |
| Symfony(Compiled, Singleton) | ^7.0 | 792µs, 217ns | 756µs, 25ns | 859µs, 975ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 925µs, 87ns | 751µs, 18ns | 2ms, 319µs, 812ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 78µs, 701ns | 855µs, 922ns | 2ms, 851µs, 9ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 15µs, 543ns | 784µs, 158ns | 2ms, 830µs, 28ns |

</details>

### 📊 fin06

Small interface-based dependency graph including 6 interfaces total (excluding container startup time)

![📊 fin06](images/speed_comparison_interfaces_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 528µs, 692ns | 1ms, 398µs, 86ns | 1ms, 742µs, 839ns |
| Dice(Configured, Singleton) | ^4.0 | 790µs, 905ns | 702µs, 142ns | 890µs, 16ns |
| Laravel(Configured, Transient) | ^12.28 | 367ms, 794µs, 84ns | 321ms, 388µs, 959ns | 401ms, 779µs, 890ns |
| League(Configured, Transient) | ^5.1 | 4s, 241ms, 827µs, 702ns | 4s, 184ms, 681µs, 892ns | 4s, 288ms, 706µs, 64ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 937µs, 482ns | 3ms, 846µs, 883ns | 4ms, 297µs, 18ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 569µs, 172ns | 3ms, 842µs, 115ns | 7ms, 961µs, 34ns |
| Phalcon(Configured, Transient) | ^5 | 297ms, 339µs, 916ns | 263ms, 400µs, 77ns | 308ms, 362µs, 960ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 621µs, 294ns | 1ms, 245µs, 975ns | 2ms, 222µs, 61ns |
| Pimple(Configured, Transient) | ^3.5 | 111ms, 239µs, 600ns | 103ms, 746µs, 891ns | 122ms, 276µs, 67ns |
| Quickly(Compiled, Singleton) | dev-master | 792µs, 908ns | 763µs, 893ns | 813µs, 961ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 44µs, 222ns | 3ms, 827µs, 95ns | 5ms, 570µs, 173ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 409ms, 391µs, 641ns | 1s, 935ms, 801µs, 982ns | 3s, 648ms, 648µs, 23ns |
| Symfony(Compiled, Singleton) | ^7.0 | 796µs, 985ns | 776µs, 52ns | 859µs, 22ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 839µs, 805ns | 791µs, 72ns | 1ms, 137µs, 971ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 907µs, 707ns | 820µs, 159ns | 1ms, 536µs, 130ns |
| Zen(Compiled, Singleton) | ^3.1 | 846µs, 791ns | 757µs, 932ns | 1ms, 432µs, 895ns |

</details>

### 🚀 fin06 startup

Small interface-based dependency graph including 6 interfaces total (includes container startup time)

![🚀 fin06 startup](images/speed_comparison_interfaces_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 2ms, 37µs, 787ns | 1ms, 695µs, 156ns | 3ms, 371µs, 953ns |
| Dice(Configured, Singleton) | ^4.0 | 1ms, 909µs, 208ns | 1ms, 806µs, 20ns | 2ms, 161µs, 26ns |
| Laravel(Configured, Transient) | ^12.28 | 373ms, 399µs, 639ns | 329ms, 25µs, 30ns | 390ms, 141µs, 963ns |
| League(Configured, Transient) | ^5.1 | 4s, 103ms, 967µs, 738ns | 3s, 397ms, 665µs, 977ns | 4s, 342ms, 581µs, 987ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 786µs, 849ns | 3ms, 718µs, 137ns | 4ms, 228µs, 115ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 291µs, 963ns | 3ms, 989µs, 219ns | 5ms, 917µs, 72ns |
| Phalcon(Configured, Transient) | ^5 | 292ms, 5µs, 872ns | 260ms, 975µs, 837ns | 306ms, 980µs, 133ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 354µs, 289ns | 1ms, 290µs, 798ns | 1ms, 770µs, 19ns |
| Pimple(Configured, Transient) | ^3.5 | 107ms, 49µs, 12ns | 102ms, 270µs, 841ns | 130ms, 433µs, 82ns |
| Quickly(Compiled, Singleton) | dev-master | 820µs, 183ns | 797µs, 986ns | 838µs, 994ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 768µs, 323ns | 4ms, 496µs, 97ns | 6ms, 122µs, 112ns |
| Ray-di(Compiled, Transient) | ^2.16 | 3s, 404ms, 865µs, 622ns | 1s, 922ms, 525µs, 167ns | 3s, 631ms, 562µs, 948ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 302µs, 981ns | 1ms, 281µs, 976ns | 1ms, 326µs, 84ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 150µs, 703ns | 929µs, 117ns | 3ms, 12µs, 895ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 57µs, 195ns | 814µs, 914ns | 2ms, 902µs, 30ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 50µs, 186ns | 823µs, 974ns | 2ms, 817µs, 869ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 5ms, 213µs, 880ns | 4ms, 637µs, 956ns | 5ms, 473µs, 852ns |
| Dice(Configured, Singleton) | ^4.0 | 970µs, 911ns | 869µs, 35ns | 1ms, 483µs, 917ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 253ms, 888µs, 630ns | 10s, 122ms, 504µs, 949ns | 10s, 349ms, 45µs, 38ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 701µs, 665ns | 679µs, 969ns | 783µs, 920ns |
| Laravel(Reflection, Singleton) | ^12.28 | 3ms, 614µs, 306ns | 2ms, 972µs, 841ns | 4ms, 168µs, 33ns |
| Laravel(Reflection, Transient) | ^12.28 | 89s, 116ms, 450µs, 142ns | 87s, 982ms, 647µs, 895ns | 89s, 911ms, 864µs, 42ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 374µs, 242ns | 3ms, 289µs, 222ns | 3ms, 802µs, 61ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 371µs, 666ns | 3ms, 470µs, 897ns | 8ms, 4µs, 903ns |
| Php-baseline |  | 590µs, 62ns | 452µs, 41ns | 848µs, 770ns |
| Php-di(Reflection, Singleton) | ^7.0 | 867µs, 867ns | 793µs, 933ns | 1ms, 361µs, 131ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 261µs, 901ns | 1ms, 234µs, 54ns | 1ms, 319µs, 885ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 80ms, 484µs, 223ns | 14s, 11ms, 727µs, 94ns | 14s, 199ms, 307µs, 918ns |
| Quickly(Compiled, Singleton) | dev-master | 830µs, 698ns | 818µs, 14ns | 877µs, 141ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 366µs, 901ns | 1ms, 337µs, 51ns | 1ms, 429µs, 80ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 395µs, 964ns | 1ms, 358µs, 32ns | 1ms, 539µs, 945ns |
| Symfony(Compiled, Singleton) | ^7.0 | 1ms, 298µs, 499ns | 1ms, 280µs, 69ns | 1ms, 317µs, 24ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 842µs, 404ns | 792µs, 980ns | 1ms, 162µs, 52ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 877µs, 332ns | 794µs, 887ns | 1ms, 494µs, 884ns |
| Zen(Compiled, Singleton) | ^3.1 | 843µs, 501ns | 752µs, 925ns | 1ms, 489µs, 162ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup_p16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 6ms, 768µs, 989ns | 6ms, 664µs, 37ns | 6ms, 880µs, 998ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 253µs, 389ns | 2ms, 180µs, 814ns | 2ms, 312µs, 898ns |
| Dice(Reflection, Transient) | ^4.0 | 10s, 401ms, 869µs, 82ns | 10s, 138ms, 536µs, 930ns | 11s, 950ms, 22µs, 935ns |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 979µs, 685ns | 849µs, 962ns | 1ms, 976µs, 13ns |
| Laravel(Reflection, Singleton) | ^12.28 | 5ms, 449µs, 56ns | 4ms, 70µs, 43ns | 8ms, 517µs, 980ns |
| Laravel(Reflection, Transient) | ^12.28 | 88s, 349ms, 257µs, 922ns | 74s, 615ms, 272µs, 45ns | 91s, 179ms, 504µs, 156ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 498µs, 983ns | 3ms, 412µs, 961ns | 3ms, 906µs, 965ns |
| Phalcon(Configured, Singleton) | ^5 | 5ms, 176µs, 925ns | 3ms, 632µs, 68ns | 8ms, 311µs, 986ns |
| Php-baseline |  | 647µs, 926ns | 570µs, 58ns | 824µs, 928ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 148µs, 819ns | 887µs, 870ns | 3ms, 305µs, 912ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 365µs, 876ns | 1ms, 311µs, 63ns | 1ms, 590µs, 967ns |
| Pimple(Configured, Transient) | ^3.5 | 13s, 906ms, 608µs, 486ns | 13s, 13ms, 863µs, 86ns | 14s, 296ms, 41µs, 11ns |
| Quickly(Compiled, Singleton) | dev-master | 819µs, 993ns | 803µs, 947ns | 838µs, 994ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 742µs, 959ns | 1ms, 643µs, 896ns | 2ms, 333µs, 879ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 498µs, 794ns | 1ms, 387µs, 834ns | 2ms, 204µs, 895ns |
| Symfony(Compiled, Singleton) | ^7.0 | 801µs, 14ns | 771µs, 45ns | 859µs, 975ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 161µs, 122ns | 941µs, 38ns | 2ms, 985µs |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 93µs, 626ns | 881µs, 910ns | 2ms, 862µs, 930ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 30µs, 445ns | 798µs, 940ns | 2ms, 809µs, 47ns |

</details>

### 📊 pin16

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 pin16](images/speed_comparison_interfaces_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 1ms, 952µs, 219ns | 1ms, 569µs, 986ns | 3ms, 313µs, 64ns |
| Dice(Configured, Singleton) | ^4.0 | 921µs, 177ns | 745µs, 58ns | 1ms, 451µs, 969ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 827µs, 166ns | 3ms, 734µs, 111ns | 4ms, 270µs, 76ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 371µs, 976ns | 3ms, 900µs, 51ns | 8ms, 52µs, 825ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 251µs, 983ns | 1ms, 213µs, 73ns | 1ms, 351µs, 833ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 181ms, 313µs, 37ns | 13s, 171ms, 56µs, 985ns | 14s, 456ms, 628µs, 84ns |
| Quickly(Compiled, Singleton) | dev-master | 668µs, 478ns | 643µs, 968ns | 679µs, 969ns |
| Quickly(Configured, Singleton) | dev-master | 6ms, 163µs, 549ns | 3ms, 890µs, 991ns | 7ms, 768µs, 154ns |
| Symfony(Compiled, Singleton) | ^7.0 | 780µs, 81ns | 756µs, 25ns | 832µs, 80ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 711µs, 894ns | 658µs, 988ns | 946µs, 998ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 902µs, 915ns | 805µs, 854ns | 1ms, 617µs, 908ns |
| Zen(Compiled, Singleton) | ^3.1 | 863µs, 671ns | 759µs, 840ns | 1ms, 543µs, 45ns |

</details>

### 🚀 pin16 startup

Medium size interface-based dependency graph including 16 interfaces total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 pin16 startup](images/speed_comparison_interfaces_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Aura-di(Configured, Transient) | ^5.0 | 3ms, 674µs, 173ns | 2ms, 673µs, 864ns | 5ms, 580µs, 186ns |
| Dice(Configured, Singleton) | ^4.0 | 2ms, 160µs, 644ns | 1ms, 826µs, 47ns | 2ms, 449µs, 989ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 858µs, 280ns | 3ms, 791µs, 809ns | 4ms, 212µs, 856ns |
| Phalcon(Configured, Singleton) | ^5 | 4ms, 470µs, 348ns | 3ms, 569µs, 841ns | 7ms, 824µs, 897ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 285µs, 266ns | 1ms, 231µs, 908ns | 1ms, 512µs, 50ns |
| Pimple(Configured, Transient) | ^3.5 | 14s, 52ms, 682µs, 542ns | 13s, 99ms, 13µs, 90ns | 14s, 733ms, 27µs, 935ns |
| Quickly(Compiled, Singleton) | dev-master | 827µs, 598ns | 797µs, 986ns | 893µs, 831ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 796µs, 791ns | 4ms, 614µs, 114ns | 5ms, 565µs, 166ns |
| Symfony(Compiled, Singleton) | ^7.0 | 790µs, 715ns | 771µs, 999ns | 817µs, 60ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 951µs, 170ns | 746µs, 11ns | 2ms, 379µs, 894ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 839µs, 947ns | 1ms, 482µs, 963ns | 4ms, 627µs, 943ns |
| Zen(Compiled, Singleton) | ^3.1 | 864µs, 863ns | 681µs, 161ns | 2ms, 206µs, 87ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 791µs, 907ns | 752µs, 925ns | 961µs, 65ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 382µs, 968ns | 3ms, 316µs, 879ns | 3ms, 746µs, 986ns |
| Php-di(Reflection, Singleton) | ^7.0 | 721µs, 645ns | 667µs, 95ns | 1ms, 80µs, 36ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 288µs, 104ns | 1ms, 260µs, 995ns | 1ms, 316µs, 70ns |
| Quickly(Compiled, Singleton) | dev-master | 807µs, 356ns | 790µs, 834ns | 818µs, 14ns |
| Quickly(Configured, Singleton) | dev-master | 1ms, 91µs, 718ns | 1ms, 66µs, 923ns | 1ms, 155µs, 138ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 97µs, 369ns | 1ms, 55µs, 955ns | 1ms, 292µs, 943ns |
| Symfony(Compiled, Singleton) | ^7.0 | 841µs, 212ns | 817µs, 60ns | 865µs, 936ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 821µs, 471ns | 754µs, 833ns | 1ms, 220µs, 941ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 891µs, 89ns | 777µs, 6ns | 1ms, 481µs, 56ns |
| Zen(Compiled, Singleton) | ^3.1 | 843µs, 834ns | 749µs, 111ns | 1ms, 523µs, 17ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup_z26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Laminas-servicemanager(Reflection, Singleton) | ^4.4 | 905µs, 489ns | 802µs, 40ns | 1ms, 740µs, 932ns |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 548µs, 908ns | 3ms, 416µs, 61ns | 3ms, 951µs, 72ns |
| Php-di(Reflection, Singleton) | ^7.0 | 1ms, 193µs, 594ns | 942µs, 945ns | 3ms, 288µs, 30ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 375µs, 31ns | 1ms, 311µs, 63ns | 1ms, 675µs, 844ns |
| Quickly(Compiled, Singleton) | dev-master | 1ms, 157µs, 188ns | 1ms, 70µs, 22ns | 1ms, 177µs, 72ns |
| Quickly(Configured, Singleton) | dev-master | 2ms, 212µs, 619ns | 2ms, 110µs, 958ns | 2ms, 930µs, 164ns |
| Quickly(Reflection, Singleton) | dev-master | 1ms, 639µs, 56ns | 1ms, 468µs, 181ns | 2ms, 389µs, 907ns |
| Symfony(Compiled, Singleton) | ^7.0 | 823µs, 378ns | 794µs, 172ns | 854µs, 969ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 193µs, 428ns | 970µs, 840ns | 3ms, 14µs, 87ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 153µs, 182ns | 890µs, 970ns | 2ms, 928µs, 972ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 82µs, 777ns | 840µs, 187ns | 2ms, 915µs, 859ns |

</details>

### 📊 zin26

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 zin26](images/speed_comparison_interfaces_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 885µs, 793ns | 3ms, 784µs, 894ns | 4ms, 271µs, 30ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 30µs, 325ns | 1ms, 19µs, 1ns | 1ms, 78µs, 128ns |
| Quickly(Compiled, Singleton) | dev-master | 818µs, 991ns | 796µs, 79ns | 849µs, 962ns |
| Quickly(Configured, Singleton) | dev-master | 3ms, 914µs, 690ns | 3ms, 849µs, 29ns | 3ms, 984µs, 928ns |
| Symfony(Compiled, Singleton) | ^7.0 | 734µs, 472ns | 701µs, 904ns | 813µs, 961ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 865µs, 530ns | 790µs, 119ns | 1ms, 275µs, 62ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 898µs, 599ns | 793µs, 933ns | 1ms, 588µs, 821ns |
| Zen(Compiled, Singleton) | ^3.1 | 894µs, 21ns | 748µs, 157ns | 1ms, 564µs, 979ns |

</details>

### 🚀 zin26 startup

Large interface-based dependency graph including a total of 26 interfaces. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 zin26 startup](images/speed_comparison_interfaces_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| Nette-di(Compiled, Singleton) | ^3.2 | 3ms, 912µs, 115ns | 3ms, 831µs, 148ns | 4ms, 279µs, 851ns |
| Pimple(Configured, Singleton) | ^3.5 | 1ms, 713µs, 538ns | 1ms, 302µs, 3ns | 2ms, 503µs, 156ns |
| Quickly(Compiled, Singleton) | dev-master | 785µs, 923ns | 766µs, 992ns | 805µs, 854ns |
| Quickly(Configured, Singleton) | dev-master | 4ms, 624µs, 176ns | 4ms, 472µs, 17ns | 5ms, 511µs, 999ns |
| Symfony(Compiled, Singleton) | ^7.0 | 808µs, 238ns | 787µs, 19ns | 835µs, 180ns |
| Yiisoft-di(Configured, Singleton) | ^1.4 | 1ms, 181µs, 864ns | 963µs, 926ns | 3ms, 20µs, 48ns |
| Yiisoft-di(Reflection, Singleton) | ^1.4 | 1ms, 169µs, 180ns | 945µs, 91ns | 3ms, 48µs, 896ns |
| Zen(Compiled, Singleton) | ^3.1 | 1ms, 175µs, 141ns | 954µs, 151ns | 2ms, 990µs, 961ns |

</details>

Questions, issues, and new containers are welcome!
