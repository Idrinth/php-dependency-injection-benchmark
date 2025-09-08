# PHP Dependency Injection Benchmark

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

## 🌍 Environment

| Component | Version |
| --- | --- |
| PHP | 8.4 |
| Docker | * |
| OS | ubuntu latest |

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
| [Quickly](https://github.com/Idrinth/quickly) | A fast dependency injection container featuring build time resolution. |
## Latest Results

Run from 2025-09-08

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 2ms, 831µs, 935ns | 2ms, 763µs, 986ns | 3ms, 165µs, 960ns |
| auryn | ^1.4 | 427ms, 649µs, 116ns | 401ms, 238µs, 918ns | 537ms, 986µs, 40ns |
| dice(configured) | ^4.0 | 71ms, 93µs, 750ns | 70ms, 354µs, 938ns | 71ms, 736µs, 812ns |
| dice(unconfigured) | ^4.0 | 70ms, 470µs, 643ns | 68ms, 876µs, 28ns | 72ms, 410µs, 106ns |
| laminas-servicemanager | ^3.21 | 762µs, 891ns | 740µs, 51ns | 813µs, 7ns |
| laravel(cached) | ^12.28 | 403ms, 41µs, 696ns | 394ms, 968µs, 32ns | 408ms, 710µs, 2ns |
| laravel(singletons) | ^12.28 | 3ms, 623µs, 104ns | 3ms, 376µs, 7ns | 4ms, 498µs, 958ns |
| laravel(unconfigured) | ^12.28 | 638ms, 846µs, 254ns | 629ms, 991µs, 54ns | 652ms, 682µs, 65ns |
| league(predefined) | ^5.1 | 874ms, 875µs, 450ns | 845ms, 336µs, 198ns | 920ms, 344µs, 114ns |
| league(unconfigured) | ^5.1 | 665ms, 731µs, 453ns | 654ms, 332µs, 160ns | 688ms, 935µs, 41ns |
| nette-di | ^3.2 | 3ms, 451µs, 704ns | 3ms, 383µs, 159ns | 3ms, 775µs, 119ns |
| phalcon(shared) | ^5 | 4ms, 55µs, 380ns | 4ms, 12µs, 107ns | 4ms, 179µs, 954ns |
| phalcon(transient) | ^5 | 256ms, 161µs, 379ns | 251ms, 438µs, 140ns | 270ms, 360µs, 946ns |
| php-di | ^7.0 | 852µs, 727ns | 781µs, 59ns | 1ms, 202µs, 106ns |
| pimple | ^3.5 | 72ms, 688µs, 817ns | 69ms, 424µs, 867ns | 79ms, 369µs, 68ns |
| quickly(compiled) | dev-master | 814µs, 676ns | 792µs, 26ns | 841µs, 856ns |
| quickly(configured) | dev-master | 1ms, 417µs, 112ns | 1ms, 384µs, 19ns | 1ms, 460µs, 75ns |
| quickly(reflection) | dev-master | 1ms, 332µs, 807ns | 1ms, 308µs, 202ns | 1ms, 464µs, 843ns |
| symfony(compiled) | ^7.0 | 2ms, 209µs, 115ns | 2ms, 131µs, 938ns | 2ms, 637µs, 863ns |

![📊 f06](images/speed_comparison_without_startup06.jpg)

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 764µs, 273ns | 1ms, 584µs, 53ns | 3ms, 71µs, 69ns |
| auryn | ^1.4 | 406ms, 196µs, 212ns | 397ms, 856µs, 950ns | 414ms, 314µs, 31ns |
| dice(configured) | ^4.0 | 72ms, 481µs, 465ns | 71ms, 619µs, 987ns | 73ms, 990µs, 821ns |
| dice(unconfigured) | ^4.0 | 72ms, 260µs, 69ns | 70ms, 602µs, 893ns | 77ms, 327µs, 966ns |
| laminas-servicemanager | ^3.21 | 927µs, 996ns | 806µs, 93ns | 1ms, 738µs, 71ns |
| laravel(cached) | ^12.28 | 408ms, 42µs, 836ns | 398ms, 905µs, 992ns | 433ms, 55µs, 877ns |
| laravel(singletons) | ^12.28 | 3ms, 851µs, 532ns | 3ms, 463µs, 983ns | 5ms, 86µs, 183ns |
| laravel(unconfigured) | ^12.28 | 633ms, 539µs, 676ns | 624ms, 237µs, 60ns | 644ms, 958µs, 19ns |
| league(predefined) | ^5.1 | 869ms, 817µs, 447ns | 852ms, 964µs, 878ns | 905ms, 21µs, 190ns |
| league(unconfigured) | ^5.1 | 671ms, 528µs, 959ns | 660ms, 229µs, 921ns | 683ms, 24µs, 883ns |
| nette-di | ^3.2 | 5ms, 651µs, 116ns | 3ms, 453µs, 969ns | 25ms, 44µs, 202ns |
| phalcon(shared) | ^5 | 4ms, 3µs, 596ns | 3ms, 954µs, 172ns | 4ms, 106µs, 998ns |
| phalcon(transient) | ^5 | 255ms, 172µs, 896ns | 248ms, 217µs, 105ns | 259ms, 768µs, 962ns |
| php-di | ^7.0 | 1ms, 194µs, 596ns | 895µs, 23ns | 3ms, 520µs, 11ns |
| pimple | ^3.5 | 70ms, 971µs, 417ns | 70ms, 111µs, 989ns | 74ms, 232µs, 101ns |
| quickly(compiled) | dev-master | 790µs, 882ns | 771µs, 45ns | 808µs |
| quickly(configured) | dev-master | 1ms, 763µs, 629ns | 1ms, 635µs, 74ns | 2ms, 447µs, 128ns |
| quickly(reflection) | dev-master | 1ms, 447µs, 796ns | 1ms, 356µs, 840ns | 2ms, 146µs, 959ns |
| symfony(compiled) | ^7.0 | 7ms, 54µs, 138ns | 5ms, 768µs, 60ns | 18ms, 298µs, 149ns |

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 910µs, 519ns | 1ms, 502µs, 990ns | 5ms, 352µs, 973ns |
| dice(configured) | ^4.0 | 10s, 124ms, 559µs, 283ns | 9s, 871ms, 733µs, 903ns | 10s, 435ms, 469µs, 150ns |
| dice(unconfigured) | ^4.0 | 10s, 17ms, 513µs, 203ns | 9s, 902ms, 8µs, 771ns | 10s, 211ms, 24µs, 999ns |
| laminas-servicemanager | ^3.21 | 742µs, 983ns | 715µs, 970ns | 835µs, 895ns |
| laravel(singletons) | ^12.28 | 3ms, 549µs, 194ns | 3ms, 474µs, 950ns | 3ms, 793µs, 1ns |
| nette-di | ^3.2 | 3ms, 685µs, 784ns | 3ms, 378µs, 152ns | 4ms, 832µs, 29ns |
| phalcon(shared) | ^5 | 4ms, 137µs, 182ns | 3ms, 907µs, 918ns | 5ms, 785µs, 942ns |
| php-di | ^7.0 | 849µs, 103ns | 787µs, 973ns | 1ms, 235µs, 8ns |
| pimple | ^3.5 | 10s, 49ms, 121µs, 928ns | 9s, 861ms, 76µs, 116ns | 10s, 139ms, 883µs, 41ns |
| quickly(compiled) | dev-master | 829µs, 911ns | 748µs, 872ns | 1ms, 108µs, 169ns |
| quickly(configured) | dev-master | 1ms, 350µs, 879ns | 1ms, 317µs, 24ns | 1ms, 411µs, 914ns |
| quickly(reflection) | dev-master | 1ms, 401µs, 400ns | 1ms, 353µs, 25ns | 1ms, 523µs, 17ns |
| symfony(compiled) | ^7.0 | 2ms, 201µs, 104ns | 2ms, 139µs, 91ns | 2ms, 238µs, 988ns |

![📊 p16](images/speed_comparison_without_startup16.jpg)

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 5ms, 452µs, 704ns | 5ms, 208µs, 15ns | 6ms, 721µs, 19ns |
| dice(configured) | ^4.0 | 9s, 981ms, 360µs, 626ns | 9s, 886ms, 248µs, 111ns | 10s, 119ms, 905µs, 948ns |
| dice(unconfigured) | ^4.0 | 10s, 54ms, 905µs, 486ns | 9s, 921ms, 368µs, 122ns | 10s, 196ms, 254µs, 14ns |
| laminas-servicemanager | ^3.21 | 1ms, 457µs, 929ns | 1ms, 307µs, 10ns | 2ms, 671µs, 957ns |
| laravel(singletons) | ^12.28 | 3ms, 736µs, 448ns | 3ms, 529µs, 71ns | 4ms, 930µs, 19ns |
| nette-di | ^3.2 | 5ms, 533µs, 123ns | 3ms, 454µs, 923ns | 23ms, 833µs, 36ns |
| phalcon(shared) | ^5 | 4ms, 131µs, 460ns | 4ms, 89µs, 117ns | 4ms, 299µs, 879ns |
| php-di | ^7.0 | 1ms, 143µs, 717ns | 885µs, 963ns | 3ms, 344µs, 58ns |
| pimple | ^3.5 | 10s, 95ms, 902µs, 776ns | 9s, 940ms, 186µs, 977ns | 10s, 494ms, 367µs, 122ns |
| quickly(compiled) | dev-master | 1ms, 181µs, 793ns | 1ms, 163µs, 959ns | 1ms, 204µs, 13ns |
| quickly(configured) | dev-master | 1ms, 859µs, 974ns | 1ms, 650µs, 810ns | 2ms, 709µs, 150ns |
| quickly(reflection) | dev-master | 1ms, 495µs, 885ns | 1ms, 390µs, 933ns | 2ms, 238µs, 35ns |
| symfony(compiled) | ^7.0 | 7ms, 38µs, 760ns | 5ms, 733µs, 966ns | 18ms, 207µs, 73ns |

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 341ms, 538µs, 691ns | 1ms, 528µs, 24ns | 3s, 401ms, 326µs, 894ns |
| laminas-servicemanager | ^3.21 | 1ms, 12µs, 825ns | 936µs, 31ns | 1ms, 230µs, 1ns |
| laravel(singletons) | ^12.28 | 3ms, 531µs, 408ns | 3ms, 448µs, 963ns | 3ms, 829µs, 956ns |
| nette-di | ^3.2 | 3ms, 495µs, 383ns | 3ms, 328µs, 84ns | 4ms, 282µs, 951ns |
| phalcon(shared) | ^5 | 3ms, 956µs, 341ns | 3ms, 906µs, 965ns | 4ms, 70µs, 43ns |
| php-di | ^7.0 | 883µs, 245ns | 814µs, 914ns | 1ms, 344µs, 203ns |
| quickly(compiled) | dev-master | 818µs, 586ns | 789µs, 165ns | 965µs, 118ns |
| quickly(configured) | dev-master | 1ms, 369µs, 285ns | 1ms, 332µs, 44ns | 1ms, 425µs, 27ns |
| quickly(reflection) | dev-master | 1ms, 353µs, 478ns | 1ms, 316µs, 70ns | 1ms, 545µs, 906ns |
| symfony(compiled) | ^7.0 | 2ms, 214µs, 884ns | 2ms, 124µs, 71ns | 2ms, 427µs, 101ns |

![📊 z26](images/speed_comparison_without_startup26.jpg)

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3s, 413ms, 152µs, 742ns | 3s, 387ms, 20µs, 111ns | 3s, 444ms, 511µs, 890ns |
| laminas-servicemanager | ^3.21 | 980µs, 114ns | 879µs, 49ns | 1ms, 763µs, 820ns |
| laravel(singletons) | ^12.28 | 3ms, 976µs, 774ns | 3ms, 515µs, 5ns | 5ms, 839µs, 824ns |
| nette-di | ^3.2 | 5ms, 690µs, 169ns | 3ms, 328µs, 800ns | 26ms, 731µs, 14ns |
| phalcon(shared) | ^5 | 4ms, 100µs, 799ns | 4ms, 48µs, 824ns | 4ms, 225µs, 15ns |
| php-di | ^7.0 | 1ms, 272µs, 320ns | 938µs, 892ns | 3ms, 392µs, 934ns |
| quickly(compiled) | dev-master | 810µs, 790ns | 782µs, 966ns | 834µs, 941ns |
| quickly(configured) | dev-master | 1ms, 785µs, 659ns | 1ms, 671µs, 75ns | 2ms, 477µs, 884ns |
| quickly(reflection) | dev-master | 1ms, 567µs, 482ns | 1ms, 466µs, 989ns | 2ms, 315µs, 44ns |
| symfony(compiled) | ^7.0 | 7ms, 218µs, 408ns | 5ms, 878µs, 925ns | 18ms, 435µs, 1ns |

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

Questions, issues, and new containers are welcome!
