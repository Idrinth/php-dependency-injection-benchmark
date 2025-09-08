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

## Latest Results

Run from 2025-09-07

### 📊 f06

Small dependency graph including 6 classes total (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 787µs, 18ns | 1ms, 703µs, 977ns | 2ms, 210µs, 140ns |
| auryn | ^1.4 | 409ms, 219µs, 527ns | 399ms, 656µs, 57ns | 419ms, 545µs, 888ns |
| dice(configured) | ^4.0 | 71ms, 13µs, 426ns | 70ms, 32µs, 835ns | 72ms, 878µs, 122ns |
| dice(unconfigured) | ^4.0 | 71ms, 167µs, 182ns | 70ms, 91µs, 962ns | 72ms, 803µs, 974ns |
| laminas-servicemanager | ^3.21 | 778µs, 889ns | 761µs, 32ns | 791µs, 72ns |
| laravel(cached) | ^12.28 | 411ms, 561µs, 703ns | 396ms, 256µs, 923ns | 423ms, 575µs, 162ns |
| laravel(singletons) | ^12.28 | 3ms, 482µs, 151ns | 3ms, 413µs, 915ns | 3ms, 714µs, 84ns |
| laravel(unconfigured) | ^12.28 | 630ms, 961µs, 728ns | 624ms, 161µs, 958ns | 652ms, 454µs, 137ns |
| league-container | ^5.1 | 663ms, 153µs, 409ns | 657ms, 481µs, 908ns | 681ms, 262µs, 16ns |
| league(predefined) | ^5.1 | 861ms, 171µs, 317ns | 852ms, 881µs, 193ns | 872ms, 801µs, 65ns |
| nette-di | ^3.2 | 3ms, 570µs, 842ns | 3ms, 487µs, 110ns | 3ms, 817µs, 81ns |
| phalcon(shared) | ^5 | 7ms, 444µs, 596ns | 5ms, 3µs, 929ns | 8ms, 98µs, 840ns |
| phalcon(transient) | ^5 | 253ms, 98µs, 917ns | 249ms, 985µs, 218ns | 259ms, 52µs, 38ns |
| php-di | ^7.0 | 846µs, 815ns | 786µs, 66ns | 1ms, 243µs, 829ns |
| pimple | ^3.5 | 71ms, 245µs, 765ns | 69ms, 962µs, 24ns | 75ms, 814µs, 8ns |
| quickly(compiled) | dev-master | 824µs, 213ns | 792µs, 980ns | 880µs, 2ns |
| quickly(configured) | dev-master | 1ms, 340µs, 603ns | 1ms, 315µs, 832ns | 1ms, 375µs, 913ns |
| quickly(reflection) | dev-master | 1ms, 351µs, 213ns | 1ms, 323µs, 938ns | 1ms, 432µs, 180ns |
| symfony(compiled) | ^7.0 | 2ms, 223µs, 38ns | 2ms, 168µs, 178ns | 2ms, 254µs, 9ns |

![📊 f06](images/speed_comparison_without_startup06.jpg)

### 🚀 f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 146µs, 481ns | 3ms, 21µs, 955ns | 3ms, 690µs, 4ns |
| auryn | ^1.4 | 411ms, 962µs, 962ns | 397ms, 392µs, 988ns | 435ms, 474µs, 157ns |
| dice(configured) | ^4.0 | 71ms, 481µs, 418ns | 70ms, 376µs, 157ns | 72ms, 914µs, 123ns |
| dice(unconfigured) | ^4.0 | 72ms, 673µs, 249ns | 71ms, 113µs, 824ns | 78ms, 388µs, 929ns |
| laminas-servicemanager | ^3.21 | 907µs, 588ns | 806µs, 93ns | 1ms, 656µs, 55ns |
| laravel(cached) | ^12.28 | 402ms, 516µs, 198ns | 399ms, 654µs, 150ns | 406ms, 913µs, 42ns |
| laravel(singletons) | ^12.28 | 3ms, 637µs, 123ns | 3ms, 448µs, 963ns | 4ms, 885µs, 911ns |
| laravel(unconfigured) | ^12.28 | 637ms, 486µs, 124ns | 625ms, 924µs, 110ns | 661ms, 800µs, 146ns |
| league-container | ^5.1 | 664ms, 475µs, 35ns | 657ms, 974µs, 958ns | 679ms, 862µs, 22ns |
| league(predefined) | ^5.1 | 860ms, 21µs, 615ns | 844ms, 955µs, 921ns | 867ms, 882µs, 13ns |
| nette-di | ^3.2 | 5ms, 382µs, 704ns | 3ms, 298µs, 997ns | 23ms, 709µs, 58ns |
| phalcon(shared) | ^5 | 4ms, 239µs, 940ns | 3ms, 968µs, 954ns | 5ms, 873µs, 203ns |
| phalcon(transient) | ^5 | 253ms, 569µs, 793ns | 250ms, 180µs, 959ns | 257ms, 620µs, 96ns |
| php-di | ^7.0 | 1ms, 253µs, 223ns | 895µs, 23ns | 3ms, 728µs, 151ns |
| pimple | ^3.5 | 73ms, 70µs, 764ns | 69ms, 726µs, 943ns | 84ms, 84µs, 987ns |
| quickly(compiled) | dev-master | 829µs, 124ns | 802µs, 993ns | 902µs, 891ns |
| quickly(configured) | dev-master | 1ms, 950µs, 621ns | 1ms, 672µs, 29ns | 2ms, 837µs, 896ns |
| quickly(reflection) | dev-master | 1ms, 442µs, 885ns | 1ms, 336µs, 97ns | 2ms, 178µs, 907ns |
| symfony(compiled) | ^7.0 | 7ms, 736µs, 86ns | 5ms, 738µs, 19ns | 23ms, 174µs, 47ns |

![🚀 f06 startup](images/speed_comparison_with_startup06.jpg)

### 📊 p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice(configured) | ^4.0 | 10s, 13ms, 756µs, 155ns | 9s, 929ms, 104µs, 89ns | 10s, 102ms, 349µs, 996ns |
| dice(unconfigured) | ^4.0 | 10s, 58ms, 39µs, 999ns | 9s, 849ms, 689µs, 6ns | 10s, 410ms, 561µs, 800ns |
| laminas-servicemanager | ^3.21 | 783µs, 491ns | 761µs, 985ns | 818µs, 14ns |
| laravel(cached) | ^12.28 | 56s, 881ms, 350µs, 874ns | 55s, 870ms, 524µs, 883ns | 60s, 95ms, 266µs, 103ns |
| laravel(singletons) | ^12.28 | 3ms, 558µs, 397ns | 3ms, 401µs, 994ns | 4ms, 170µs, 894ns |
| league-container | ^5.1 | 94s, 685ms, 529µs, 518ns | 94s, 214ms, 739µs, 84ns | 95s, 261ms, 120µs, 796ns |
| league(predefined) | ^5.1 | 275s, 50ms, 925µs, 779ns | 269s, 810ms, 158µs, 967ns | 292s, 411ms, 633µs, 14ns |
| nette-di | ^3.2 | 3ms, 319µs, 334ns | 3ms, 278µs, 17ns | 3ms, 395µs, 80ns |
| phalcon(shared) | ^5 | 4ms, 228µs, 472ns | 4ms, 34µs, 996ns | 5ms, 245µs, 923ns |
| phalcon(transient) | ^5 | 35s, 586ms, 409µs, 902ns | 35s, 135ms, 556µs, 936ns | 36s, 50ms, 866µs, 842ns |
| php-di | ^7.0 | 879µs, 716ns | 817µs, 60ns | 1ms, 305µs, 103ns |
| pimple | ^3.5 | 10s, 6ms, 716µs, 203ns | 9s, 862ms, 587µs, 928ns | 10s, 187ms, 369µs, 108ns |
| quickly(compiled) | dev-master | 855µs, 207ns | 767µs, 946ns | 1ms, 108µs, 884ns |
| quickly(configured) | dev-master | 1ms, 362µs, 180ns | 1ms, 345µs, 157ns | 1ms, 395µs, 940ns |
| quickly(reflection) | dev-master | 1ms, 376µs, 628ns | 1ms, 333µs, 951ns | 1ms, 572µs, 132ns |
| symfony(compiled) | ^7.0 | 2ms, 328µs, 205ns | 2ms, 147µs, 912ns | 2ms, 974µs, 33ns |

![📊 p16](images/speed_comparison_without_startup16.jpg)

### 🚀 p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice(configured) | ^4.0 | 10s, 32ms, 409µs, 572ns | 9s, 874ms, 605µs, 894ns | 10s, 167ms, 244µs, 911ns |
| dice(unconfigured) | ^4.0 | 10s, 50ms, 790µs, 71ns | 9s, 918ms, 65µs, 786ns | 10s, 277ms, 251µs, 958ns |
| laminas-servicemanager | ^3.21 | 1ms, 105µs, 523ns | 823µs, 20ns | 1ms, 769µs, 65ns |
| laravel(cached) | ^12.28 | 56s, 291ms, 970µs, 276ns | 55s, 944ms, 379µs, 91ns | 57s, 25ms, 640µs, 964ns |
| laravel(singletons) | ^12.28 | 3ms, 710µs, 722ns | 3ms, 534µs, 78ns | 4ms, 837µs, 989ns |
| league-container | ^5.1 | 94s, 320ms, 853µs, 972ns | 93s, 747ms, 273µs, 921ns | 95s, 86ms, 271µs, 47ns |
| league(predefined) | ^5.1 | 272s, 127ms, 522µs, 349ns | 268s, 652ms, 624µs, 130ns | 274s, 975ms, 52µs, 118ns |
| nette-di | ^3.2 | 5ms, 427µs, 694ns | 3ms, 293µs, 991ns | 24ms, 309µs, 873ns |
| phalcon(shared) | ^5 | 4ms, 6µs, 624ns | 3ms, 961µs, 86ns | 4ms, 86µs, 17ns |
| phalcon(transient) | ^5 | 35s, 426ms, 464µs, 366ns | 35s, 13ms, 339µs, 996ns | 36s, 189ms, 268µs, 112ns |
| php-di | ^7.0 | 1ms, 108µs, 431ns | 833µs, 34ns | 3ms, 297µs, 90ns |
| pimple | ^3.5 | 10s, 23ms, 954µs, 105ns | 9s, 847ms, 373µs, 962ns | 10s, 144ms, 333µs, 124ns |
| quickly(compiled) | dev-master | 800µs, 180ns | 769µs, 853ns | 822µs, 67ns |
| quickly(configured) | dev-master | 1ms, 840µs, 305ns | 1ms, 643µs, 896ns | 2ms, 424µs, 1ns |
| quickly(reflection) | dev-master | 1ms, 478µs, 28ns | 1ms, 385µs, 927ns | 2ms, 171µs, 993ns |
| symfony(compiled) | ^7.0 | 7ms, 132µs, 53ns | 5ms, 751µs, 132ns | 18ms, 458µs, 127ns |

![🚀 p16 startup](images/speed_comparison_with_startup16.jpg)

### 📊 z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 783µs, 491ns | 754µs, 117ns | 844µs, 955ns |
| laravel(singletons) | ^12.28 | 3ms, 612µs, 899ns | 3ms, 481µs, 864ns | 4ms, 202µs, 127ns |
| nette-di | ^3.2 | 3ms, 412µs, 818ns | 3ms, 357µs, 887ns | 3ms, 484µs, 964ns |
| phalcon(shared) | ^5 | 4ms, 75µs, 789ns | 3ms, 994µs, 941ns | 4ms, 300µs, 832ns |
| php-di | ^7.0 | 1ms, 372µs, 957ns | 1ms, 250µs, 982ns | 2ms, 120µs, 971ns |
| quickly(compiled) | dev-master | 838µs, 184ns | 754µs, 117ns | 1ms, 94µs, 818ns |
| quickly(configured) | dev-master | 1ms, 367µs, 712ns | 1ms, 317µs, 24ns | 1ms, 428µs, 127ns |
| quickly(reflection) | dev-master | 1ms, 363µs, 897ns | 1ms, 323µs, 938ns | 1ms, 547µs, 813ns |
| symfony(compiled) | ^7.0 | 2ms, 207µs, 159ns | 2ms, 134µs, 84ns | 2ms, 271µs, 890ns |

![📊 z26](images/speed_comparison_without_startup26.jpg)

### 🚀 z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 945µs, 687ns | 839µs, 948ns | 1ms, 730µs, 918ns |
| laravel(singletons) | ^12.28 | 3ms, 953µs, 909ns | 3ms, 625µs, 154ns | 5ms, 748µs, 987ns |
| nette-di | ^3.2 | 6ms, 740µs, 713ns | 3ms, 470µs, 897ns | 35ms, 843µs, 133ns |
| phalcon(shared) | ^5 | 4ms, 168µs, 558ns | 4ms, 104µs, 852ns | 4ms, 263µs, 877ns |
| php-di | ^7.0 | 1ms, 164µs, 102ns | 905µs, 990ns | 3ms, 363µs, 132ns |
| quickly(compiled) | dev-master | 815µs, 820ns | 782µs, 12ns | 839µs, 948ns |
| quickly(configured) | dev-master | 1ms, 842µs, 498ns | 1ms, 708µs, 30ns | 2ms, 497µs, 911ns |
| quickly(reflection) | dev-master | 1ms, 610µs, 88ns | 1ms, 508µs, 951ns | 2ms, 321µs, 958ns |
| symfony(compiled) | ^7.0 | 7ms, 59µs, 693ns | 5ms, 701µs, 65ns | 18ms, 3µs, 940ns |

![🚀 z26 startup](images/speed_comparison_with_startup26.jpg)

Questions, issues, and new containers are welcome!
