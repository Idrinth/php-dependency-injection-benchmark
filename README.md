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
| [Phalcon](https://github.com/phalcon/cphalcon) | A PHP extension built for performance |
| [PHP (baseline)](https://www.php.net/) | Manual instantiation of dependencies without a container |
| [Quickly](https://github.com/Idrinth/quickly) | A fast dependency injection container featuring build time resolution. |
| [Ray.Di](https://github.com/ray-di/Ray.Di) | DI and AOP framework for PHP inspired by Google Guice |
| [Zen](https://github.com/woohoolabs/zen) | Woohoo Labs. Zen DI Container and preload file generator |
## Latest Results

Run from 2025-09-09

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

![📊 f06](images/speed_comparison_without_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 2ms, 226µs, 805ns | 1ms, 570µs, 940ns | 3ms, 139µs, 972ns |
| auryn | ^1.4 | 412ms, 501µs, 525ns | 399ms, 846µs, 76ns | 449ms, 708µs, 938ns |
| dice(configured) | ^4.0 | 70ms, 125µs, 794ns | 69ms, 409µs, 132ns | 71ms, 922µs, 63ns |
| dice(unconfigured) | ^4.0 | 70ms, 618µs, 176ns | 69ms, 8µs, 827ns | 72ms, 974µs, 920ns |
| laminas-servicemanager | ^4.4 | 792µs, 431ns | 777µs, 959ns | 863µs, 75ns |
| laravel(cached) | ^12.28 | 404ms, 51µs, 613ns | 397ms, 921µs, 800ns | 417ms, 290µs, 210ns |
| laravel(singletons) | ^12.28 | 3ms, 554µs, 534ns | 3ms, 433µs, 942ns | 3ms, 769µs, 159ns |
| laravel(unconfigured) | ^12.28 | 633ms, 344µs, 888ns | 623ms, 327µs, 970ns | 667ms, 471µs, 885ns |
| league(predefined) | ^5.1 | 863ms, 450µs, 336ns | 847ms, 746µs, 849ns | 882ms, 596µs, 969ns |
| league(unconfigured) | ^5.1 | 667ms, 347µs, 49ns | 656ms, 293µs, 869ns | 697ms, 52µs, 1ns |
| nette-di | ^3.2 | 3ms, 505µs, 396ns | 3ms, 422µs, 21ns | 3ms, 633µs, 975ns |
| phalcon(shared) | ^5 | 4ms, 238µs, 843ns | 4ms, 8µs, 54ns | 5ms, 960µs, 941ns |
| phalcon(transient) | ^5 | 256ms, 680µs, 727ns | 250ms, 420µs, 93ns | 265ms, 318µs, 155ns |
| php-baseline |  | 3ms, 845µs, 47ns | 3ms, 778µs, 934ns | 4ms, 31µs, 896ns |
| php-di | ^7.0 | 841µs, 116ns | 785µs, 112ns | 1ms, 214µs, 981ns |
| pimple | ^3.5 | 71ms, 270µs, 275ns | 69ms, 542µs, 884ns | 73ms, 448µs, 181ns |
| quickly(compiled) | dev-master | 1ms, 173µs, 639ns | 1ms, 135µs, 110ns | 1ms, 326µs, 799ns |
| quickly(configured) | dev-master | 1ms, 348µs, 42ns | 1ms, 325µs, 130ns | 1ms, 384µs, 19ns |
| quickly(reflection) | dev-master | 1ms, 345µs, 586ns | 1ms, 297µs, 950ns | 1ms, 451µs, 969ns |
| ray-di(compiled) | ^2.16 | 3s, 518ms, 21µs, 440ns | 3s, 475ms, 370µs, 168ns | 3s, 652ms, 395µs, 963ns |
| ray-di(unconfigured) | ^2.16 | 344ms, 394µs, 230ns | 338ms, 411µs, 92ns | 354ms, 113µs, 817ns |
| symfony(compiled) | ^7.0 | 767µs, 540ns | 755µs, 71ns | 781µs, 59ns |
| zen(unconfigured) | ^3.1 | 884µs, 675ns | 788µs, 927ns | 1ms, 626µs, 14ns |

</details>

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 958µs, 751ns | 1ms, 629µs, 114ns | 3ms, 178µs, 119ns |
| auryn | ^1.4 | 413ms, 551µs, 402ns | 405ms, 458µs, 211ns | 428ms, 128µs, 4ns |
| dice(configured) | ^4.0 | 72ms, 792µs, 553ns | 71ms, 47µs, 67ns | 81ms, 312µs, 179ns |
| dice(unconfigured) | ^4.0 | 71ms, 750µs, 783ns | 69ms, 507µs, 837ns | 74ms, 223µs, 41ns |
| laminas-servicemanager | ^4.4 | 949µs, 382ns | 813µs, 7ns | 2ms, 18µs, 928ns |
| laravel(cached) | ^12.28 | 409ms, 773µs, 612ns | 398ms, 344µs, 39ns | 460ms, 243µs, 940ns |
| laravel(singletons) | ^12.28 | 3ms, 827µs, 309ns | 3ms, 465µs, 890ns | 5ms, 30µs, 870ns |
| laravel(unconfigured) | ^12.28 | 637ms, 130µs, 832ns | 623ms, 818µs, 159ns | 657ms, 512µs, 187ns |
| league(predefined) | ^5.1 | 870ms, 194µs, 5ns | 857ms, 663µs, 869ns | 939ms, 440µs, 965ns |
| league(unconfigured) | ^5.1 | 664ms, 619µs, 112ns | 656ms, 871µs, 80ns | 672ms, 250µs, 32ns |
| nette-di | ^3.2 | 5ms, 451µs, 917ns | 3ms, 333µs, 91ns | 24ms, 100µs, 65ns |
| phalcon(shared) | ^5 | 4ms, 135µs, 584ns | 3ms, 995µs, 895ns | 4ms, 449µs, 844ns |
| phalcon(transient) | ^5 | 256ms, 627µs, 154ns | 249ms, 722µs, 957ns | 271ms, 414µs, 41ns |
| php-baseline |  | 3ms, 871µs, 369ns | 3ms, 801µs, 822ns | 4ms, 31µs, 896ns |
| php-di | ^7.0 | 1ms, 127µs, 862ns | 855µs, 922ns | 3ms, 356µs, 933ns |
| pimple | ^3.5 | 70ms, 484µs, 471ns | 69ms, 177µs, 865ns | 71ms, 895µs, 122ns |
| quickly(compiled) | dev-master | 832µs, 796ns | 761µs, 32ns | 1ms, 38µs, 74ns |
| quickly(configured) | dev-master | 2ms, 78µs, 676ns | 1ms, 668µs, 930ns | 2ms, 595µs, 186ns |
| quickly(reflection) | dev-master | 1ms, 502µs, 418ns | 1ms, 374µs, 6ns | 2ms, 354µs, 860ns |
| ray-di(compiled) | ^2.16 | 3s, 515ms, 656µs, 256ns | 3s, 449ms, 431µs, 896ns | 3s, 583ms, 448µs, 886ns |
| ray-di(unconfigured) | ^2.16 | 379ms, 851µs, 841ns | 372ms, 974µs, 157ns | 388ms, 67µs, 960ns |
| symfony(compiled) | ^7.0 | 784µs, 420ns | 761µs, 32ns | 838µs, 994ns |
| zen(unconfigured) | ^3.1 | 981µs, 44ns | 770µs, 92ns | 2ms, 647µs, 161ns |

</details>

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

![📊 p16](images/speed_comparison_without_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 5ms, 558µs, 776ns | 5ms, 184µs, 173ns | 7ms, 553µs, 815ns |
| dice(configured) | ^4.0 | 10s, 113ms, 494µs, 467ns | 9s, 918ms, 184µs, 41ns | 10s, 518ms, 88µs, 102ns |
| dice(unconfigured) | ^4.0 | 10s, 100ms, 569µs, 605ns | 9s, 949ms, 902µs, 57ns | 10s, 274ms, 56µs, 911ns |
| laminas-servicemanager | ^4.4 | 779µs, 414ns | 749µs, 826ns | 904µs, 83ns |
| laravel(singletons) | ^12.28 | 3ms, 814µs, 792ns | 3ms, 633µs, 975ns | 4ms, 251µs, 3ns |
| nette-di | ^3.2 | 3ms, 476µs, 810ns | 3ms, 446µs, 102ns | 3ms, 532µs, 886ns |
| phalcon(shared) | ^5 | 4ms, 113µs, 54ns | 3ms, 980µs, 159ns | 4ms, 326µs, 820ns |
| php-baseline |  | 10ms, 221µs, 481ns | 9ms, 726µs, 47ns | 10ms, 809µs, 898ns |
| php-di | ^7.0 | 1ms, 81µs, 871ns | 822µs, 782ns | 2ms, 417µs, 87ns |
| pimple | ^3.5 | 10s, 73ms, 959µs, 612ns | 9s, 921ms, 453µs, 952ns | 10s, 206ms, 98µs, 79ns |
| quickly(compiled) | dev-master | 829µs, 768ns | 808µs | 891µs, 923ns |
| quickly(configured) | dev-master | 1ms, 320µs, 242ns | 1ms, 272µs, 916ns | 1ms, 358µs, 32ns |
| quickly(reflection) | dev-master | 1ms, 342µs, 678ns | 1ms, 293µs, 897ns | 1ms, 477µs, 3ns |
| symfony(compiled) | ^7.0 | 776µs, 696ns | 751µs, 18ns | 802µs, 40ns |
| zen(unconfigured) | ^3.1 | 850µs, 248ns | 761µs, 985ns | 1ms, 495µs, 122ns |

</details>

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 6ms, 728µs, 935ns | 6ms, 551µs, 980ns | 7ms, 279µs, 872ns |
| dice(configured) | ^4.0 | 10s, 150ms, 446µs, 867ns | 9s, 986ms, 171µs, 7ns | 10s, 883ms, 428µs, 96ns |
| dice(unconfigured) | ^4.0 | 10s, 142ms, 81µs, 999ns | 9s, 986ms, 768µs, 960ns | 10s, 537ms, 959µs, 98ns |
| laminas-servicemanager | ^4.4 | 978µs, 302ns | 831µs, 127ns | 2ms, 74µs, 956ns |
| laravel(singletons) | ^12.28 | 4ms, 973µs, 483ns | 4ms, 765µs, 33ns | 5ms, 892µs, 38ns |
| nette-di | ^3.2 | 5ms, 731µs, 391ns | 3ms, 463µs, 983ns | 24ms, 194µs, 2ns |
| phalcon(shared) | ^5 | 4ms, 450µs, 702ns | 4ms, 89µs, 117ns | 5ms, 939µs, 6ns |
| php-baseline |  | 11ms, 743µs, 927ns | 9ms, 676µs, 933ns | 17ms, 85µs, 75ns |
| php-di | ^7.0 | 1ms, 819µs, 181ns | 1ms, 435µs, 995ns | 5ms, 84µs, 37ns |
| pimple | ^3.5 | 10s, 38ms, 891µs, 839ns | 9s, 844ms, 232µs, 82ns | 10s, 160ms, 304µs, 69ns |
| quickly(compiled) | dev-master | 799µs, 441ns | 790µs, 119ns | 813µs, 7ns |
| quickly(configured) | dev-master | 1ms, 786µs, 994ns | 1ms, 688µs, 957ns | 2ms, 454µs, 996ns |
| quickly(reflection) | dev-master | 1ms, 502µs, 442ns | 1ms, 381µs, 158ns | 2ms, 274µs, 990ns |
| symfony(compiled) | ^7.0 | 776µs, 982ns | 755µs, 786ns | 864µs, 982ns |
| zen(unconfigured) | ^3.1 | 1ms, 15µs, 400ns | 792µs, 26ns | 2ms, 743µs, 5ns |

</details>

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

![📊 z26](images/speed_comparison_without_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^4.4 | 881µs, 886ns | 735µs, 998ns | 1ms, 225µs, 948ns |
| nette-di | ^3.2 | 6ms, 763µs, 195ns | 5ms, 568µs, 981ns | 7ms, 99µs, 866ns |
| php-di | ^7.0 | 851µs, 774ns | 775µs, 98ns | 1ms, 321µs, 77ns |
| quickly(compiled) | dev-master | 791µs, 478ns | 770µs, 807ns | 828µs, 27ns |
| quickly(configured) | dev-master | 1ms, 338µs, 28ns | 1ms, 290µs, 82ns | 1ms, 492µs, 977ns |
| quickly(reflection) | dev-master | 1ms, 376µs, 771ns | 1ms, 331µs, 90ns | 1ms, 595µs, 20ns |
| symfony(compiled) | ^7.0 | 945µs, 138ns | 751µs, 972ns | 1ms, 441µs, 1ns |
| zen(unconfigured) | ^3.1 | 853µs, 395ns | 769µs, 138ns | 1ms, 548µs, 51ns |

</details>

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

<details>
<summary>View results</summary>

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^4.4 | 1ms, 239µs, 991ns | 1ms, 3µs, 980ns | 2ms, 727µs, 985ns |
| nette-di | ^3.2 | 5ms, 428µs, 194ns | 3ms, 340µs, 959ns | 23ms, 773µs, 908ns |
| php-di | ^7.0 | 1ms, 952µs, 791ns | 1ms, 530µs, 885ns | 5ms, 500µs, 78ns |
| quickly(compiled) | dev-master | 807µs, 905ns | 795µs, 841ns | 818µs, 14ns |
| quickly(configured) | dev-master | 2ms, 369µs, 379ns | 1ms, 680µs, 850ns | 4ms, 133µs, 939ns |
| quickly(reflection) | dev-master | 1ms, 631µs, 140ns | 1ms, 516µs, 103ns | 2ms, 478µs, 122ns |
| symfony(compiled) | ^7.0 | 1ms, 102µs, 423ns | 729µs, 84ns | 1ms, 357µs, 78ns |
| zen(unconfigured) | ^3.1 | 1ms, 202µs, 178ns | 917µs, 911ns | 3ms, 44µs, 843ns |

</details>

Questions, issues, and new containers are welcome!
