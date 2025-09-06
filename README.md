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
| aura-di | ^5.0 | 1ms 592ns | 1ms 960ns | 1ms 927ns |
| auryn | ^1.4 | 406ms 943ns | 402ms 56ns | 413ms 7ns |
| dice | ^4.0 | 71ms 0ns | 70ms 994ns | 72ms 26ns |
| laminas-servicemanager | ^3.21 | 486ns | 972ns | 802ns |
| laravel(singletons) | ^12.28 | 3ms 897ns | 3ms 936ns | 3ms 32ns |
| laravel(unconfigured) | ^12.28 | 632ms 890ns | 625ms 960ns | 643ms 69ns |
| league-container | ^5.1 | 663ms 997ns | 658ms 47ns | 667ms 33ns |
| nette-di | ^3.2 | 3ms 110ns | 3ms 84ns | 3ms 999ns |
| php-di | ^7.0 | 854ns | 855ns | 1ms 914ns |
| pimple | ^3.5 | 72ms 664ns | 69ms 783ns | 76ms 881ns |
| quickly(configured) | dev-master | 3ms 71ns | 3ms 1ns | 4ms 91ns |
| quickly(reflection) | dev-master | 3ms 260ns | 3ms 34ns | 4ms 131ns |
| symfony(compiled) | ^7.0 | 2ms 556ns | 2ms 946ns | 4ms 824ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms 912ns | 1ms 975ns | 3ms 162ns |
| auryn | ^1.4 | 409ms 956ns | 404ms 988ns | 415ms 58ns |
| dice | ^4.0 | 71ms 960ns | 70ms 970ns | 73ms 994ns |
| laminas-servicemanager | ^3.21 | 544ns | 165ns | 1ms 850ns |
| laravel(singletons) | ^12.28 | 3ms 831ns | 3ms 61ns | 4ms 172ns |
| laravel(unconfigured) | ^12.28 | 636ms 378ns | 624ms 971ns | 662ms 115ns |
| league-container | ^5.1 | 659ms 402ns | 656ms 940ns | 662ms 40ns |
| nette-di | ^3.2 | 5ms 414ns | 3ms 26ns | 25ms 820ns |
| php-di | ^7.0 | 1ms 892ns | 43ns | 3ms 940ns |
| pimple | ^3.5 | 72ms 494ns | 70ms 872ns | 74ms 42ns |
| quickly(configured) | dev-master | 3ms 372ns | 3ms 809ns | 4ms 967ns |
| quickly(reflection) | dev-master | 4ms 313ns | 3ms 994ns | 5ms 139ns |
| symfony(compiled) | ^7.0 | 7ms 9ns | 5ms 80ns | 18ms 973ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms 601ns | 1ms 972ns | 5ms 46ns |
| auryn | ^1.4 | 56s 920ms 72ns | 56s 62ms 998ns | 57s 731ms 930ns |
| dice | ^4.0 | 10s 58ms 983ns | 9s 887ms 827ns | 10s 231ms 972ns |
| laminas-servicemanager | ^3.21 | 516ns | 906ns | 67ns |
| laravel(singletons) | ^12.28 | 3ms 74ns | 3ms 943ns | 3ms 963ns |
| laravel(unconfigured) | ^12.28 | 0ns | 0ns | 0ns |
| league-container | ^5.1 | 94s 554ms 284ns | 92s 884ms 926ns | 95s 842ms 819ns |
| nette-di | ^3.2 | 3ms 643ns | 3ms 969ns | 3ms 124ns |
| php-di | ^7.0 | 269ns | 132ns | 1ms 922ns |
| pimple | ^3.5 | 9s 965ms 140ns | 9s 590ms 149ns | 10s 140ms 48ns |
| quickly(configured) | dev-master | 3ms 12ns | 3ms 982ns | 3ms 198ns |
| quickly(reflection) | dev-master | 3ms 203ns | 3ms 40ns | 4ms 916ns |
| symfony(compiled) | ^7.0 | 2ms 128ns | 2ms 14ns | 2ms 96ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 5ms 109ns | 5ms 967ns | 6ms 59ns |
| auryn | ^1.4 | 56s 921ms 734ns | 56s 350ms 901ns | 57s 453ms 15ns |
| dice | ^4.0 | 10s 63ms 418ns | 9s 920ms 98ns | 10s 177ms 944ns |
| laminas-servicemanager | ^3.21 | 119ns | 81ns | 1ms 123ns |
| laravel(singletons) | ^12.28 | 4ms 823ns | 4ms 899ns | 5ms 918ns |
| laravel(unconfigured) | ^12.28 | 0ns | 0ns | 0ns |
| league-container | ^5.1 | 94s 636ms 43ns | 93s 666ms 902ns | 95s 411ms 172ns |
| nette-di | ^3.2 | 5ms 613ns | 3ms 843ns | 23ms 11ns |
| php-di | ^7.0 | 1ms 216ns | 63ns | 3ms 187ns |
| pimple | ^3.5 | 10s 26ms 382ns | 9s 865ms 48ns | 10s 520ms 842ns |
| quickly(configured) | dev-master | 3ms 894ns | 3ms 883ns | 4ms 817ns |
| quickly(reflection) | dev-master | 3ms 201ns | 3ms 904ns | 4ms 909ns |
| symfony(compiled) | ^7.0 | 7ms 339ns | 5ms 59ns | 18ms 109ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 343ms 736ns | 1ms 985ns | 3s 425ms 970ns |
| auryn | ^1.4 | 0ns | 0ns | 0ns |
| dice | ^4.0 | 0ns | 0ns | 0ns |
| laminas-servicemanager | ^3.21 | 298ns | 839ns | 949ns |
| laravel(singletons) | ^12.28 | 0ns | 0ns | 0ns |
| laravel(unconfigured) | ^12.28 | 0ns | 0ns | 0ns |
| league-container | ^5.1 | 0ns | 0ns | 0ns |
| nette-di | ^3.2 | 3ms 709ns | 3ms 51ns | 3ms 0ns |
| php-di | ^7.0 | 595ns | 972ns | 1ms 11ns |
| pimple | ^3.5 | 0ns | 0ns | 0ns |
| quickly(configured) | dev-master | 3ms 602ns | 3ms 48ns | 3ms 131ns |
| quickly(reflection) | dev-master | 3ms 581ns | 3ms 16ns | 4ms 58ns |
| symfony(compiled) | ^7.0 | 2ms 569ns | 2ms 38ns | 2ms 796ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3s 395ms 80ns | 3s 354ms 969ns | 3s 424ms 832ns |
| auryn | ^1.4 | 0ns | 0ns | 0ns |
| dice | ^4.0 | 0ns | 0ns | 0ns |
| laminas-servicemanager | ^3.21 | 619ns | 154ns | 1ms 231ns |
| laravel(singletons) | ^12.28 | 0ns | 0ns | 0ns |
| laravel(unconfigured) | ^12.28 | 0ns | 0ns | 0ns |
| league-container | ^5.1 | 0ns | 0ns | 0ns |
| nette-di | ^3.2 | 5ms 286ns | 3ms 922ns | 23ms 964ns |
| php-di | ^7.0 | 1ms 198ns | 985ns | 3ms 226ns |
| pimple | ^3.5 | 0ns | 0ns | 0ns |
| quickly(configured) | dev-master | 3ms 695ns | 3ms 196ns | 4ms 134ns |
| quickly(reflection) | dev-master | 4ms 717ns | 4ms 8ns | 4ms 985ns |
| symfony(compiled) | ^7.0 | 7ms 726ns | 5ms 88ns | 18ms 31ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
