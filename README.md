# PHP Dependency Injection Benchmark

This repository benchmarks different dependency injection containers.

The "quickly" container is maintained by the same author as this benchmark, and the results may be unconsciously biased.

To reduce favoritism, results are averaged over many runs and, where possible, multiple configurations of each container are benchmarked.

Detailed benchmark data, including environment details and dependency versions, is available in [`run_summary.yaml`](run_summary.yaml).
Raw outputs for each run are archived under the [`archive`](archive) directory with date-based subdirectories.

## Test Files

The benchmark defines three dependency graphs used for testing.

- `src/classes-06.php` (`f06`): 6 classes.
- `src/classes-16.php` (`p16`): 16 classes.
- `src/classes-26.php` (`z26`): 26 classes.

The class names (`f06`, `p16`, `z26`) follow a letter plus total class count to avoid overlap.

Each file contains all required classes and avoids autoloading so that container performance measurements exclude file-loading overhead.
Each test is executed with and without container startup time to measure resolution speed and initialization cost.

## Environment

| Component | Version |
| --- | --- |
| PHP | 8.4 |
| Docker | 24 (GitHub Actions) |
| OS | Ubuntu 22.04 (github runner ubuntu-latest) |

## Running individual benchmarks

Build the container and execute a benchmark using docker:

```sh
docker build -t di-benchmark-php-di -f containers/php-di/Dockerfile .
docker run --rm -v "$PWD:/out" di-benchmark-php-di php benchmark.php f06 1
```

The build step prepares the image for the chosen container, and the run command executes a single run of the specified test (for example, `f06`). The resulting `results.json` file will be written to the current directory.

## f06

Small dependency graph including 6 classes total (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 755µs, 428ns | 1ms, 683µs, 950ns | 1ms, 933µs, 97ns |
| auryn | ^1.4 | 417ms, 591µs, 333ns | 402ms, 37µs, 143ns | 464ms, 671µs, 134ns |
| dice(configured) | ^4.0 | 73ms, 333µs, 811ns | 71ms, 527µs, 957ns | 81ms, 154µs, 823ns |
| dice(unconfigured) | ^4.0 | 70ms, 639µs, 419ns | 69ms, 403µs, 886ns | 72ms, 98µs, 970ns |
| laminas-servicemanager | ^3.21 | 740µs, 313ns | 724µs, 77ns | 752µs, 925ns |
| laravel(cached) | ^12.28 | 398ms, 325µs, 800ns | 396ms, 162µs, 986ns | 399ms, 698µs, 972ns |
| laravel(singletons) | ^12.28 | 3ms, 507µs, 494ns | 3ms, 401µs, 41ns | 3ms, 695µs, 964ns |
| laravel(unconfigured) | ^12.28 | 638ms, 82µs, 242ns | 626ms, 734µs, 972ns | 671ms, 921µs, 14ns |
| league-container | ^5.1 | 667ms, 322µs, 468ns | 660ms, 516µs, 23ns | 685ms, 627µs, 937ns |
| league(predefined) | ^5.1 | 858ms, 624µs, 505ns | 851ms, 21µs, 51ns | 867ms, 256µs, 879ns |
| nette-di | ^3.2 | 3ms, 305µs, 196ns | 3ms, 280µs, 878ns | 3ms, 344µs, 58ns |
| phalcon(shared) | ^5 | 7ms, 13µs, 416ns | 4ms, 101µs, 991ns | 8ms, 311µs, 33ns |
| phalcon(transient) | ^5 | 256ms, 696µs, 486ns | 248ms, 506µs, 69ns | 271ms, 353µs, 960ns |
| php-di | ^7.0 | 869µs, 441ns | 798µs, 940ns | 1ms, 262µs, 903ns |
| pimple | ^3.5 | 70ms, 286µs, 345ns | 69ms, 401µs, 25ns | 71ms, 214µs, 914ns |
| quickly(compiled) | dev-master | 821µs, 185ns | 795µs, 841ns | 849µs, 962ns |
| quickly(configured) | dev-master | 1ms, 387µs, 739ns | 1ms, 345µs, 157ns | 1ms, 441µs, 1ns |
| quickly(reflection) | dev-master | 2ms, 328µs, 85ns | 2ms, 290µs, 10ns | 2ms, 503µs, 871ns |
| symfony(compiled) | ^7.0 | 2ms, 151µs, 894ns | 2ms, 105µs, 951ns | 2ms, 201µs, 80ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 299µs, 713ns | 2ms, 991µs, 914ns | 5ms, 187µs, 988ns |
| auryn | ^1.4 | 420ms, 14µs, 71ns | 402ms, 273µs, 178ns | 488ms, 372µs, 87ns |
| dice(configured) | ^4.0 | 71ms, 281µs, 27ns | 69ms, 792µs, 32ns | 73ms, 539µs, 972ns |
| dice(unconfigured) | ^4.0 | 72ms, 593µs, 808ns | 70ms, 713µs, 43ns | 75ms, 689µs, 77ns |
| laminas-servicemanager | ^3.21 | 873µs, 279ns | 772µs, 953ns | 1ms, 670µs, 837ns |
| laravel(cached) | ^12.28 | 404ms, 764µs, 580ns | 392ms, 785µs, 72ns | 442ms, 7µs, 64ns |
| laravel(singletons) | ^12.28 | 3ms, 578µs, 639ns | 3ms, 410µs, 100ns | 4ms, 738µs, 92ns |
| laravel(unconfigured) | ^12.28 | 639ms, 447µs, 188ns | 626ms, 727µs, 104ns | 679ms, 904µs, 937ns |
| league-container | ^5.1 | 660ms, 539µs, 531ns | 653ms, 473µs, 854ns | 668ms, 472µs, 51ns |
| league(predefined) | ^5.1 | 868ms, 551µs, 111ns | 862ms, 875µs, 938ns | 873ms, 454µs, 93ns |
| nette-di | ^3.2 | 5ms, 582µs, 94ns | 3ms, 301µs, 858ns | 23ms, 813µs, 9ns |
| phalcon(shared) | ^5 | 4ms, 358µs, 29ns | 4ms, 67µs, 897ns | 5ms, 969µs, 47ns |
| phalcon(transient) | ^5 | 253ms, 461µs, 432ns | 252ms, 166µs, 986ns | 255ms, 136µs, 13ns |
| php-di | ^7.0 | 1ms, 106µs, 619ns | 839µs, 948ns | 3ms, 349µs, 65ns |
| pimple | ^3.5 | 78ms, 51µs, 209ns | 70ms, 620µs, 59ns | 86ms, 638µs, 927ns |
| quickly(compiled) | dev-master | 1ms, 237µs, 630ns | 1ms, 199µs, 960ns | 1ms, 414µs, 60ns |
| quickly(configured) | dev-master | 1ms, 760µs, 149ns | 1ms, 657µs, 9ns | 2ms, 460µs, 2ns |
| quickly(reflection) | dev-master | 1ms, 489µs, 138ns | 1ms, 363µs, 992ns | 2ms, 199µs, 888ns |
| symfony(compiled) | ^7.0 | 7ms, 77µs, 622ns | 5ms, 782µs, 127ns | 18ms, 474µs, 817ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice(configured) | ^4.0 | 10s, 22ms, 113µs, 490ns | 9s, 902ms, 100µs, 86ns | 10s, 156ms, 522µs, 989ns |
| dice(unconfigured) | ^4.0 | 10s, 27ms, 344µs, 12ns | 9s, 923ms, 520µs, 803ns | 10s, 202ms, 101µs, 945ns |
| laminas-servicemanager | ^3.21 | 808µs, 358ns | 774µs, 860ns | 874µs, 42ns |
| laravel(cached) | ^12.28 | 56s, 245ms, 842µs, 218ns | 56s, 17ms, 756µs, 223ns | 56s, 442ms, 331µs, 75ns |
| laravel(singletons) | ^12.28 | 3ms, 441µs, 190ns | 3ms, 371µs, 953ns | 3ms, 721µs, 952ns |
| league-container | ^5.1 | 94s, 645ms, 360µs, 636ns | 94s, 69ms, 640µs, 874ns | 95s, 799ms, 209µs, 117ns |
| league(predefined) | ^5.1 | 272s, 991ms, 744µs, 303ns | 270s, 797ms, 523µs, 975ns | 281s, 593ms, 869µs, 924ns |
| nette-di | ^3.2 | 3ms, 271µs, 818ns | 3ms, 218µs, 889ns | 3ms, 320µs, 217ns |
| phalcon(shared) | ^5 | 3ms, 969µs, 287ns | 3ms, 952µs, 980ns | 4ms, 49µs, 777ns |
| phalcon(transient) | ^5 | 35s, 535ms, 440µs, 468ns | 35s, 64ms, 437µs, 866ns | 36s, 63ms, 468µs, 933ns |
| php-di | ^7.0 | 866µs, 365ns | 775µs, 98ns | 1ms, 233µs, 100ns |
| pimple | ^3.5 | 10s, 58ms, 121µs, 609ns | 9s, 922ms, 383µs, 69ns | 10s, 527ms, 287µs, 960ns |
| quickly(compiled) | dev-master | 794µs, 982ns | 761µs, 985ns | 834µs, 941ns |
| quickly(configured) | dev-master | 1ms, 347µs, 398ns | 1ms, 300µs, 96ns | 1ms, 505µs, 851ns |
| quickly(reflection) | dev-master | 1ms, 349µs, 377ns | 1ms, 308µs, 917ns | 1ms, 519µs, 918ns |
| symfony(compiled) | ^7.0 | 2ms, 249µs, 789ns | 2ms, 132µs, 892ns | 2ms, 975µs, 940ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice(configured) | ^4.0 | 10s, 121ms, 89µs, 649ns | 9s, 912ms, 726µs, 879ns | 10s, 371ms, 366µs, 977ns |
| dice(unconfigured) | ^4.0 | 10s, 130ms, 117µs, 273ns | 9s, 940ms, 511µs, 941ns | 10s, 447ms, 737µs, 932ns |
| laminas-servicemanager | ^3.21 | 1ms, 58µs, 6ns | 817µs, 60ns | 1ms, 693µs, 964ns |
| laravel(cached) | ^12.28 | 56s, 335ms, 39µs, 758ns | 56s, 66ms, 108µs, 942ns | 56s, 927ms, 326µs, 917ns |
| laravel(singletons) | ^12.28 | 6ms, 40µs, 668ns | 3ms, 521µs, 203ns | 8ms, 514µs, 881ns |
| league-container | ^5.1 | 94s, 510ms, 177µs, 755ns | 93s, 324ms, 505µs, 90ns | 95s, 154ms, 795µs, 885ns |
| league(predefined) | ^5.1 | 272s, 792ms, 433µs, 571ns | 269s, 385ms, 843µs, 38ns | 276s, 484ms, 72µs, 923ns |
| nette-di | ^3.2 | 5ms, 932µs, 426ns | 3ms, 297µs, 90ns | 29ms, 397µs, 10ns |
| phalcon(shared) | ^5 | 4ms, 326µs, 701ns | 4ms, 73µs, 143ns | 5ms, 979µs, 61ns |
| phalcon(transient) | ^5 | 35s, 311ms, 901µs, 617ns | 35s, 75ms, 232µs, 28ns | 35s, 740ms, 172µs, 147ns |
| php-di | ^7.0 | 1ms, 306µs, 796ns | 1ms, 35µs, 928ns | 3ms, 571µs, 987ns |
| pimple | ^3.5 | 9s, 981ms, 150µs, 746ns | 9s, 823ms, 970µs, 79ns | 10s, 90ms, 149µs, 879ns |
| quickly(compiled) | dev-master | 819µs, 754ns | 785µs, 112ns | 891µs, 923ns |
| quickly(configured) | dev-master | 1ms, 760µs, 244ns | 1ms, 672µs, 29ns | 2ms, 421µs, 855ns |
| quickly(reflection) | dev-master | 1ms, 535µs, 391ns | 1ms, 428µs, 842ns | 2ms, 259µs, 969ns |
| symfony(compiled) | ^7.0 | 7ms, 172µs, 751ns | 5ms, 758µs, 47ns | 18ms, 472µs, 909ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 768µs, 327ns | 745µs, 58ns | 855µs, 922ns |
| laravel(singletons) | ^12.28 | 3ms, 512µs, 287ns | 3ms, 429µs, 174ns | 3ms, 904µs, 819ns |
| nette-di | ^3.2 | 3ms, 340µs, 601ns | 3ms, 278µs, 17ns | 3ms, 414µs, 154ns |
| phalcon(shared) | ^5 | 3ms, 897µs, 619ns | 3ms, 850µs, 221ns | 4ms, 19µs, 975ns |
| php-di | ^7.0 | 854µs, 325ns | 796µs, 79ns | 1ms, 313µs, 209ns |
| quickly(compiled) | dev-master | 826µs, 215ns | 786µs, 66ns | 864µs, 28ns |
| quickly(configured) | dev-master | 1ms, 373µs, 147ns | 1ms, 332µs, 44ns | 1ms, 435µs, 995ns |
| quickly(reflection) | dev-master | 2ms, 356µs, 195ns | 2ms, 278µs, 804ns | 2ms, 799µs, 34ns |
| symfony(compiled) | ^7.0 | 2ms, 188µs, 205ns | 2ms, 154µs, 827ns | 2ms, 222µs, 61ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 928µs, 282ns | 825µs, 881ns | 1ms, 673µs, 936ns |
| laravel(singletons) | ^12.28 | 3ms, 831µs, 171ns | 3ms, 649µs, 950ns | 5ms, 42µs, 76ns |
| nette-di | ^3.2 | 5ms, 616µs, 68ns | 3ms, 427µs, 28ns | 23ms, 794µs, 174ns |
| phalcon(shared) | ^5 | 5ms, 524µs, 539ns | 4ms, 109µs, 859ns | 8ms, 237µs, 838ns |
| php-di | ^7.0 | 1ms, 787µs, 185ns | 1ms, 286µs, 29ns | 4ms, 615µs, 68ns |
| quickly(compiled) | dev-master | 888µs, 323ns | 809µs, 907ns | 1ms, 143µs, 932ns |
| quickly(configured) | dev-master | 1ms, 798µs, 224ns | 1ms, 698µs, 970ns | 2ms, 484µs, 83ns |
| quickly(reflection) | dev-master | 2ms, 704µs, 405ns | 2ms, 561µs, 92ns | 3ms, 799µs, 915ns |
| symfony(compiled) | ^7.0 | 7ms, 238µs, 817ns | 5ms, 857µs, 944ns | 18ms, 877µs, 29ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
