# PHP Dependency Injection Benchmark

Dependency injection (DI) containers manage the creation and wiring of object dependencies, allowing applications to remain decoupled and easier to maintain.
Testing these containers verifies that they resolve dependencies correctly and perform efficiently, which is vital for application reliability.

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
| aura-di | ^5.0 | 2ms, 33µs, 901ns | 1ms, 716µs, 852ns | 3ms, 145µs, 933ns |
| auryn | ^1.4 | 408ms, 151µs, 936ns | 400ms, 176µs, 48ns | 427ms, 626µs, 848ns |
| dice(configured) | ^4.0 | 73ms, 549µs, 485ns | 71ms, 431µs, 159ns | 80ms, 744µs, 28ns |
| dice(unconfigured) | ^4.0 | 71ms, 403µs, 765ns | 70ms, 470µs, 809ns | 73ms, 271µs, 36ns |
| laminas-servicemanager | ^3.21 | 860µs, 142ns | 753µs, 879ns | 1ms, 217µs, 126ns |
| laravel(cached) | ^12.28 | 400ms, 738µs, 739ns | 393ms, 912µs, 76ns | 408ms, 101µs, 81ns |
| laravel(singletons) | ^12.28 | 3ms, 482µs, 794ns | 3ms, 429µs, 889ns | 3ms, 692µs, 865ns |
| laravel(unconfigured) | ^12.28 | 632ms, 718µs, 229ns | 618ms, 889µs, 808ns | 663ms, 892µs, 984ns |
| league-container | ^5.1 | 663ms, 161µs, 516ns | 657ms, 871µs, 961ns | 676ms, 851µs, 34ns |
| league(predefined) | ^5.1 | 857ms, 775µs, 878ns | 851ms, 921µs, 81ns | 861ms, 803µs, 54ns |
| nette-di | ^3.2 | 3ms, 469µs, 538ns | 3ms, 386µs, 974ns | 3ms, 583µs, 908ns |
| phalcon(shared) | ^5 | 3ms, 959µs, 202ns | 3ms, 914µs, 117ns | 4ms, 25µs, 936ns |
| phalcon(transient) | ^5 | 254ms, 272µs, 174ns | 251ms, 616µs, 954ns | 258ms, 939µs, 27ns |
| php-di | ^7.0 | 828µs, 695ns | 768µs, 899ns | 1ms, 198µs, 53ns |
| pimple | ^3.5 | 70ms, 728µs, 206ns | 70ms, 168µs, 18ns | 72ms, 391µs, 33ns |
| quickly(compiled) | dev-master | 796µs, 914ns | 768µs, 899ns | 804µs, 901ns |
| quickly(configured) | dev-master | 1ms, 556µs, 921ns | 1ms, 282µs, 930ns | 2ms, 399µs, 921ns |
| quickly(reflection) | dev-master | 1ms, 371µs, 312ns | 1ms, 318µs, 931ns | 1ms, 544µs, 952ns |
| symfony(compiled) | ^7.0 | 2ms, 158µs, 665ns | 2ms, 143µs, 144ns | 2ms, 186µs, 775ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 107µs, 166ns | 3ms, 41µs, 28ns | 3ms, 219µs, 842ns |
| auryn | ^1.4 | 409ms, 730µs, 195ns | 397ms, 450µs, 923ns | 426ms, 20µs, 860ns |
| dice(configured) | ^4.0 | 71ms, 283µs, 936ns | 70ms, 383µs, 71ns | 72ms, 24µs, 822ns |
| dice(unconfigured) | ^4.0 | 71ms, 918µs, 940ns | 70ms, 588µs, 111ns | 75ms, 250µs, 148ns |
| laminas-servicemanager | ^3.21 | 920µs, 391ns | 814µs, 914ns | 1ms, 691µs, 818ns |
| laravel(cached) | ^12.28 | 401ms, 758µs, 170ns | 395ms, 866µs, 155ns | 413ms, 96µs, 904ns |
| laravel(singletons) | ^12.28 | 3ms, 608µs, 369ns | 3ms, 435µs, 134ns | 4ms, 775µs, 47ns |
| laravel(unconfigured) | ^12.28 | 634ms, 825ns | 628ms, 684µs, 997ns | 642ms, 401µs, 933ns |
| league-container | ^5.1 | 660ms, 76µs, 665ns | 653ms, 548µs, 955ns | 667ms, 928µs, 934ns |
| league(predefined) | ^5.1 | 875ms, 807µs, 785ns | 860ms, 647µs, 916ns | 908ms, 398µs, 151ns |
| nette-di | ^3.2 | 5ms, 436µs, 635ns | 3ms, 258µs, 943ns | 24ms, 244µs, 70ns |
| phalcon(shared) | ^5 | 3ms, 979µs, 15ns | 3ms, 917µs, 932ns | 4ms, 123µs, 926ns |
| phalcon(transient) | ^5 | 251ms, 74µs, 194ns | 248ms, 974µs, 800ns | 254ms, 254µs, 102ns |
| php-di | ^7.0 | 1ms, 117µs, 563ns | 835µs, 895ns | 3ms, 458µs, 976ns |
| pimple | ^3.5 | 71ms, 406µs, 6ns | 70ms, 535µs, 898ns | 72ms, 532µs, 892ns |
| quickly(compiled) | dev-master | 811µs, 4ns | 789µs, 880ns | 875µs, 949ns |
| quickly(configured) | dev-master | 1ms, 968µs, 121ns | 1ms, 704µs, 216ns | 2ms, 840µs, 42ns |
| quickly(reflection) | dev-master | 1ms, 433µs, 396ns | 1ms, 338µs, 958ns | 2ms, 166µs, 986ns |
| symfony(compiled) | ^7.0 | 7ms, 707µs, 929ns | 5ms, 865µs, 97ns | 22ms, 22µs, 8ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice(configured) | ^4.0 | 9s, 998ms, 41µs, 892ns | 9s, 924ms, 361µs, 944ns | 10s, 113ms, 999µs, 128ns |
| dice(unconfigured) | ^4.0 | 10s, 80ms, 622µs, 887ns | 9s, 957ms, 619µs, 905ns | 10s, 319ms, 558µs, 858ns |
| laminas-servicemanager | ^3.21 | 793µs, 480ns | 769µs, 853ns | 823µs, 20ns |
| laravel(cached) | ^12.28 | 56s, 282ms, 825µs, 279ns | 55s, 850ms, 180µs, 864ns | 56s, 927ms, 527µs, 904ns |
| laravel(singletons) | ^12.28 | 4ms, 660µs, 868ns | 3ms, 397µs, 941ns | 6ms, 335µs, 973ns |
| league-container | ^5.1 | 94s, 375ms, 603µs, 294ns | 91s, 972ms, 581µs, 148ns | 95s, 652ms, 576µs, 923ns |
| league(predefined) | ^5.1 | 274s, 661ms, 821µs, 913ns | 269s, 885ms, 360µs, 2ns | 286s, 664ms, 858µs, 102ns |
| nette-di | ^3.2 | 3ms, 487µs, 801ns | 3ms, 448µs, 963ns | 3ms, 609µs, 895ns |
| phalcon(shared) | ^5 | 3ms, 913µs, 879ns | 3ms, 852µs, 128ns | 4ms, 47µs, 870ns |
| phalcon(transient) | ^5 | 35s, 522ms, 181µs, 439ns | 35s, 248ms, 641µs, 14ns | 35s, 899ms, 98µs, 157ns |
| php-di | ^7.0 | 1ms, 330µs, 637ns | 1ms, 234µs, 54ns | 1ms, 961µs, 946ns |
| pimple | ^3.5 | 10s, 74ms, 559µs, 783ns | 9s, 901ms, 530µs, 981ns | 10s, 438ms, 516µs, 139ns |
| quickly(compiled) | dev-master | 870µs, 466ns | 780µs, 820ns | 1ms, 187µs, 86ns |
| quickly(configured) | dev-master | 1ms, 389µs, 193ns | 1ms, 333µs, 951ns | 1ms, 468µs, 181ns |
| quickly(reflection) | dev-master | 1ms, 354µs, 479ns | 1ms, 323µs, 938ns | 1ms, 484µs, 870ns |
| symfony(compiled) | ^7.0 | 3ms, 882µs, 646ns | 3ms, 974ns | 4ms, 5µs, 908ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice(configured) | ^4.0 | 10s, 51ms, 892µs, 495ns | 9s, 908ms, 265µs, 113ns | 10s, 288ms, 810µs, 14ns |
| dice(unconfigured) | ^4.0 | 10s, 93ms, 536µs, 782ns | 9s, 911ms, 849µs, 21ns | 10s, 419ms, 116µs, 20ns |
| laminas-servicemanager | ^3.21 | 909µs, 328ns | 808µs, 954ns | 1ms, 690µs, 149ns |
| laravel(cached) | ^12.28 | 56s, 363ms, 237µs, 357ns | 55s, 974ms, 782µs, 943ns | 56s, 884ms, 612µs, 83ns |
| laravel(singletons) | ^12.28 | 3ms, 677µs, 368ns | 3ms, 509µs, 998ns | 4ms, 798µs, 889ns |
| league-container | ^5.1 | 94s, 649ms, 73µs, 576ns | 93s, 687ms, 853µs, 97ns | 95s, 981ms, 971µs, 979ns |
| league(predefined) | ^5.1 | 273s, 236ms, 147µs, 904ns | 270s, 448ms, 802µs, 232ns | 279s, 237ms, 951µs, 993ns |
| nette-di | ^3.2 | 5ms, 477µs, 833ns | 3ms, 309µs, 965ns | 24ms, 738µs, 73ns |
| phalcon(shared) | ^5 | 4ms, 167µs, 294ns | 4ms, 107µs, 952ns | 4ms, 215µs, 2ns |
| phalcon(transient) | ^5 | 35s, 431ms, 591µs, 200ns | 34s, 360ms, 363µs, 6ns | 37s, 350ms, 488µs, 901ns |
| php-di | ^7.0 | 1ms, 191µs, 186ns | 866µs, 174ns | 3ms, 677µs, 845ns |
| pimple | ^3.5 | 10s, 52ms, 272µs, 582ns | 9s, 884ms, 810µs, 924ns | 10s, 441ms, 743µs, 850ns |
| quickly(compiled) | dev-master | 804µs, 877ns | 792µs, 980ns | 828µs, 981ns |
| quickly(configured) | dev-master | 1ms, 782µs, 655ns | 1ms, 672µs, 983ns | 2ms, 528µs, 905ns |
| quickly(reflection) | dev-master | 1ms, 485µs, 919ns | 1ms, 384µs, 19ns | 2ms, 186µs, 59ns |
| symfony(compiled) | ^7.0 | 7ms, 374µs, 811ns | 5ms, 786µs, 895ns | 18ms, 609µs, 46ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 859µs, 880ns | 750µs, 64ns | 1ms, 185µs, 178ns |
| laravel(singletons) | ^12.28 | 3ms, 500µs, 103ns | 3ms, 384µs, 113ns | 3ms, 989µs, 934ns |
| nette-di | ^3.2 | 3ms, 318µs, 595ns | 3ms, 282µs, 70ns | 3ms, 372µs, 907ns |
| phalcon(shared) | ^5 | 4ms, 322µs, 838ns | 4ms, 14µs, 968ns | 5ms, 486µs, 965ns |
| php-di | ^7.0 | 996µs, 685ns | 752µs, 925ns | 1ms, 322µs, 31ns |
| quickly(compiled) | dev-master | 789µs, 928ns | 764µs, 131ns | 844µs, 955ns |
| quickly(configured) | dev-master | 1ms, 325µs, 464ns | 1ms, 296µs, 43ns | 1ms, 396µs, 894ns |
| quickly(reflection) | dev-master | 1ms, 357µs, 102ns | 1ms, 319µs, 885ns | 1ms, 574µs, 993ns |
| symfony(compiled) | ^7.0 | 2ms, 173µs, 89ns | 2ms, 147µs, 912ns | 2ms, 220µs, 869ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 975µs, 704ns | 870µs, 943ns | 1ms, 766µs, 204ns |
| laravel(singletons) | ^12.28 | 3ms, 793µs, 1ns | 3ms, 595µs, 113ns | 5ms, 177µs, 21ns |
| nette-di | ^3.2 | 5ms, 527µs, 496ns | 3ms, 368µs, 854ns | 24ms, 158µs, 954ns |
| phalcon(shared) | ^5 | 4ms, 25µs, 697ns | 3ms, 994µs, 941ns | 4ms, 111µs, 51ns |
| php-di | ^7.0 | 1ms, 221µs, 799ns | 943µs, 899ns | 3ms, 509µs, 44ns |
| quickly(compiled) | dev-master | 815µs, 320ns | 798µs, 225ns | 831µs, 127ns |
| quickly(configured) | dev-master | 1ms, 823µs, 19ns | 1ms, 724µs, 4ns | 2ms, 489µs, 89ns |
| quickly(reflection) | dev-master | 1ms, 605µs, 963ns | 1ms, 487µs, 16ns | 2ms, 325µs, 773ns |
| symfony(compiled) | ^7.0 | 7ms, 360µs, 100ns | 5ms, 780µs, 935ns | 20ms, 483µs, 970ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)

Questions, issues, and new containers are welcome!
