# PHP Dependency Injection Benchmark

This repository benchmarks different dependency injection containers.

## Environment

| Component | Version |
| --- | --- |
| PHP | 8.4 |

## f06

Small dependency graph including 6 classes total (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms 717ns | 1ms 91ns | 1ms 81ns |
| auryn | ^1.4 | 400ms 435ns | 398ms 17ns | 403ms 34ns |
| dice | ^4.0 | 71ms 553ns | 70ms 878ns | 73ms 823ns |
| laminas-servicemanager | ^3.21 | 728ns | 64ns | 960ns |
| laravel(singletons) | ^12.28 | 3ms 714ns | 3ms 195ns | 3ms 886ns |
| laravel(unconfigured) | ^12.28 | 643ms 169ns | 624ms 807ns | 739ms 54ns |
| league-container | ^5.1 | 668ms 639ns | 665ms 930ns | 672ms 963ns |
| nette-di | ^3.2 | 3ms 108ns | 3ms 937ns | 3ms 172ns |
| php-di | ^7.0 | 181ns | 954ns | 1ms 862ns |
| pimple | ^3.5 | 73ms 196ns | 70ms 34ns | 82ms 967ns |
| quickly(configured) | dev-master | 3ms 702ns | 3ms 77ns | 3ms 60ns |
| quickly(reflection) | dev-master | 4ms 499ns | 3ms 929ns | 5ms 74ns |
| symfony(compiled) | ^7.0 | 2ms 20ns | 2ms 947ns | 2ms 193ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms 984ns | 3ms 22ns | 3ms 945ns |
| auryn | ^1.4 | 411ms 28ns | 402ms 860ns | 440ms 895ns |
| dice | ^4.0 | 73ms 534ns | 71ms 959ns | 87ms 71ns |
| laminas-servicemanager | ^3.21 | 188ns | 987ns | 1ms 950ns |
| laravel(singletons) | ^12.28 | 3ms 529ns | 3ms 56ns | 5ms 969ns |
| laravel(unconfigured) | ^12.28 | 634ms 309ns | 626ms 15ns | 649ms 47ns |
| league-container | ^5.1 | 662ms 801ns | 655ms 116ns | 670ms 45ns |
| nette-di | ^3.2 | 7ms 503ns | 3ms 3ns | 29ms 882ns |
| php-di | ^7.0 | 1ms 977ns | 836ns | 3ms 4ns |
| pimple | ^3.5 | 72ms 234ns | 70ms 96ns | 74ms 990ns |
| quickly(configured) | dev-master | 3ms 900ns | 3ms 95ns | 4ms 983ns |
| quickly(reflection) | dev-master | 3ms 734ns | 3ms 15ns | 4ms 177ns |
| symfony(compiled) | ^7.0 | 7ms 131ns | 5ms 13ns | 18ms 24ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| auryn | ^1.4 | 56s 337ms 505ns | 52s 220ms 28ns | 57s 334ms 863ns |
| dice | ^4.0 | 10s 168ms 16ns | 9s 979ms 60ns | 11s 156ms 33ns |
| laminas-servicemanager | ^3.21 | 693ns | 886ns | 21ns |
| laravel(singletons) | ^12.28 | 3ms 321ns | 3ms 15ns | 3ms 61ns |
| league-container | ^5.1 | 94s 830ms 620ns | 94s 322ms 163ns | 95s 623ms 884ns |
| nette-di | ^3.2 | 3ms 179ns | 3ms 852ns | 4ms 998ns |
| php-di | ^7.0 | 557ns | 967ns | 1ms 823ns |
| pimple | ^3.5 | 10s 40ms 962ns | 9s 872ms 47ns | 10s 210ms 57ns |
| quickly(configured) | dev-master | 3ms 11ns | 3ms 914ns | 3ms 24ns |
| quickly(reflection) | dev-master | 3ms 722ns | 3ms 20ns | 4ms 82ns |
| symfony(compiled) | ^7.0 | 2ms 824ns | 2ms 878ns | 2ms 125ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| auryn | ^1.4 | 56s 841ms 700ns | 55s 975ms 151ns | 57s 901ms 31ns |
| dice | ^4.0 | 10s 63ms 71ns | 9s 960ms 29ns | 10s 255ms 53ns |
| laminas-servicemanager | ^3.21 | 889ns | 1ns | 1ms 45ns |
| laravel(singletons) | ^12.28 | 3ms 146ns | 3ms 124ns | 4ms 937ns |
| league-container | ^5.1 | 94s 905ms 951ns | 94s 243ms 27ns | 95s 325ms 182ns |
| nette-di | ^3.2 | 5ms 499ns | 3ms 116ns | 23ms 998ns |
| php-di | ^7.0 | 1ms 884ns | 917ns | 3ms 785ns |
| pimple | ^3.5 | 9s 988ms 668ns | 9s 807ms 860ns | 10s 226ms 10ns |
| quickly(configured) | dev-master | 4ms 406ns | 3ms 987ns | 4ms 41ns |
| quickly(reflection) | dev-master | 4ms 980ns | 3ms 879ns | 4ms 898ns |
| symfony(compiled) | ^7.0 | 7ms 436ns | 5ms 99ns | 18ms 985ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 542ns | 99ns | 82ns |
| laravel(singletons) | ^12.28 | 3ms 690ns | 3ms 19ns | 4ms 20ns |
| nette-di | ^3.2 | 3ms 907ns | 3ms 934ns | 3ms 75ns |
| php-di | ^7.0 | 583ns | 986ns | 1ms 11ns |
| quickly(configured) | dev-master | 4ms 320ns | 3ms 928ns | 5ms 34ns |
| quickly(reflection) | dev-master | 3ms 985ns | 3ms 867ns | 4ms 953ns |
| symfony(compiled) | ^7.0 | 3ms 512ns | 2ms 37ns | 4ms 63ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 838ns | 9ns | 1ms 97ns |
| laravel(singletons) | ^12.28 | 3ms 755ns | 3ms 22ns | 4ms 999ns |
| nette-di | ^3.2 | 5ms 304ns | 3ms 873ns | 24ms 968ns |
| php-di | ^7.0 | 1ms 293ns | 892ns | 3ms 166ns |
| quickly(configured) | dev-master | 3ms 636ns | 3ms 989ns | 4ms 114ns |
| quickly(reflection) | dev-master | 7ms 523ns | 7ms 118ns | 8ms 93ns |
| symfony(compiled) | ^7.0 | 7ms 76ns | 5ms 983ns | 18ms 997ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
