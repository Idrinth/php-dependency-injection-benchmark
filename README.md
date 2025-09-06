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
| aura-di | ^5.0 | 1ms 9ns | 1ms 130ns | 3ms 948ns |
| auryn | ^1.4 | 401ms 316ns | 397ms 115ns | 405ms 205ns |
| dice | ^4.0 | 71ms 431ns | 69ms 949ns | 73ms 152ns |
| laminas-servicemanager | ^3.21 | 290ns | 986ns | 947ns |
| laravel(singletons) | ^12.28 | 3ms 522ns | 3ms 48ns | 3ms 998ns |
| laravel(unconfigured) | ^12.28 | 630ms 481ns | 621ms 56ns | 645ms 974ns |
| league-container | ^5.1 | 662ms 413ns | 660ms 127ns | 663ms 138ns |
| nette-di | ^3.2 | 3ms 255ns | 3ms 68ns | 4ms 135ns |
| php-di | ^7.0 | 60ns | 80ns | 1ms 890ns |
| pimple | ^3.5 | 71ms 597ns | 70ms 173ns | 75ms 94ns |
| quickly(configured) | dev-master | 6ms 480ns | 4ms 996ns | 8ms 963ns |
| quickly(reflection) | dev-master | 4ms 573ns | 3ms 918ns | 9ms 91ns |
| symfony(compiled) | ^7.0 | 2ms 494ns | 2ms 990ns | 2ms 31ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms 104ns | 3ms 928ns | 3ms 835ns |
| auryn | ^1.4 | 410ms 777ns | 407ms 910ns | 414ms 866ns |
| dice | ^4.0 | 72ms 608ns | 70ms 96ns | 77ms 871ns |
| laminas-servicemanager | ^3.21 | 815ns | 967ns | 1ms 141ns |
| laravel(singletons) | ^12.28 | 3ms 938ns | 3ms 40ns | 4ms 79ns |
| laravel(unconfigured) | ^12.28 | 633ms 484ns | 623ms 197ns | 641ms 822ns |
| league-container | ^5.1 | 663ms 370ns | 658ms 994ns | 668ms 29ns |
| nette-di | ^3.2 | 5ms 25ns | 3ms 929ns | 23ms 84ns |
| php-di | ^7.0 | 1ms 966ns | 1ms 99ns | 5ms 961ns |
| pimple | ^3.5 | 69ms 591ns | 68ms 976ns | 70ms 159ns |
| quickly(configured) | dev-master | 4ms 510ns | 4ms 38ns | 4ms 943ns |
| quickly(reflection) | dev-master | 4ms 385ns | 4ms 97ns | 4ms 861ns |
| symfony(compiled) | ^7.0 | 7ms 98ns | 5ms 9ns | 18ms 920ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| auryn | ^1.4 | 56s 786ms 763ns | 56s 21ms 92ns | 57s 475ms 21ns |
| dice | ^4.0 | 10s 99ms 878ns | 9s 928ms 870ns | 10s 224ms 62ns |
| laminas-servicemanager | ^3.21 | 993ns | 847ns | 60ns |
| laravel(singletons) | ^12.28 | 3ms 816ns | 3ms 948ns | 3ms 996ns |
| league-container | ^5.1 | 94s 610ms 663ns | 93s 662ms 786ns | 95s 453ms 954ns |
| nette-di | ^3.2 | 3ms 994ns | 3ms 13ns | 5ms 34ns |
| php-di | ^7.0 | 716ns | 960ns | 1ms 49ns |
| pimple | ^3.5 | 10s 1ms 717ns | 9s 868ms 908ns | 10s 177ms 115ns |
| quickly(configured) | dev-master | 4ms 593ns | 4ms 124ns | 4ms 864ns |
| quickly(reflection) | dev-master | 4ms 94ns | 4ms 136ns | 4ms 11ns |
| symfony(compiled) | ^7.0 | 2ms 383ns | 2ms 833ns | 3ms 15ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| auryn | ^1.4 | 56s 761ms 22ns | 55s 860ms 50ns | 57s 695ms 157ns |
| dice | ^4.0 | 10s 62ms 196ns | 9s 957ms 26ns | 10s 201ms 6ns |
| laminas-servicemanager | ^3.21 | 735ns | 80ns | 1ms 100ns |
| laravel(singletons) | ^12.28 | 3ms 876ns | 3ms 963ns | 4ms 859ns |
| league-container | ^5.1 | 94s 903ms 876ns | 93s 975ms 180ns | 96s 345ms 976ns |
| nette-di | ^3.2 | 5ms 399ns | 3ms 885ns | 23ms 955ns |
| php-di | ^7.0 | 1ms 341ns | 978ns | 3ms 134ns |
| pimple | ^3.5 | 9s 988ms 157ns | 9s 739ms 890ns | 10s 245ms 916ns |
| quickly(configured) | dev-master | 4ms 317ns | 4ms 90ns | 5ms 77ns |
| quickly(reflection) | dev-master | 4ms 393ns | 4ms 79ns | 4ms 957ns |
| symfony(compiled) | ^7.0 | 7ms 510ns | 5ms 995ns | 19ms 942ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 977ns | 65ns | 1ms 883ns |
| laravel(singletons) | ^12.28 | 3ms 92ns | 3ms 970ns | 3ms 63ns |
| nette-di | ^3.2 | 3ms 40ns | 3ms 110ns | 5ms 997ns |
| php-di | ^7.0 | 1ms 45ns | 1ms 142ns | 2ms 151ns |
| quickly(configured) | dev-master | 6ms 237ns | 4ms 64ns | 8ms 984ns |
| quickly(reflection) | dev-master | 4ms 516ns | 4ms 992ns | 4ms 42ns |
| symfony(compiled) | ^7.0 | 2ms 380ns | 2ms 19ns | 2ms 840ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 1ms 504ns | 943ns | 2ms 909ns |
| laravel(singletons) | ^12.28 | 3ms 798ns | 3ms 888ns | 5ms 965ns |
| nette-di | ^3.2 | 6ms 188ns | 3ms 52ns | 30ms 0ns |
| php-di | ^7.0 | 1ms 290ns | 792ns | 3ms 981ns |
| quickly(configured) | dev-master | 4ms 310ns | 4ms 874ns | 4ms 129ns |
| quickly(reflection) | dev-master | 4ms 136ns | 4ms 948ns | 4ms 835ns |
| symfony(compiled) | ^7.0 | 10ms 292ns | 5ms 891ns | 18ms 63ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
