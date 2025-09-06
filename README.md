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
| aura-di | ^5.0 | 1ms 999ns | 1ms 47ns | 1ms 173ns |
| auryn | ^1.4 | 403ms 495ns | 399ms 796ns | 407ms 998ns |
| dice | ^4.0 | 71ms 136ns | 70ms 960ns | 72ms 65ns |
| laminas-servicemanager | ^3.21 | 193ns | 5ns | 813ns |
| laravel(singletons) | ^12.28 | 3ms 667ns | 3ms 30ns | 3ms 130ns |
| laravel(unconfigured) | ^12.28 | 636ms 143ns | 628ms 28ns | 648ms 907ns |
| league-container | ^5.1 | 664ms 445ns | 655ms 919ns | 671ms 880ns |
| nette-di | ^3.2 | 3ms 12ns | 3ms 919ns | 3ms 946ns |
| php-di | ^7.0 | 1ms 351ns | 1ms 804ns | 1ms 60ns |
| pimple | ^3.5 | 72ms 920ns | 70ms 63ns | 84ms 836ns |
| quickly(configured) | dev-master | 3ms 749ns | 3ms 32ns | 3ms 42ns |
| quickly(reflection) | dev-master | 3ms 994ns | 3ms 182ns | 4ms 942ns |
| symfony(compiled) | ^7.0 | 2ms 227ns | 2ms 953ns | 2ms 972ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms 839ns | 1ms 20ns | 3ms 766ns |
| auryn | ^1.4 | 403ms 898ns | 399ms 942ns | 414ms 920ns |
| dice | ^4.0 | 71ms 715ns | 69ms 958ns | 71ms 180ns |
| laminas-servicemanager | ^3.21 | 516ns | 99ns | 1ms 996ns |
| laravel(singletons) | ^12.28 | 3ms 882ns | 3ms 900ns | 6ms 904ns |
| laravel(unconfigured) | ^12.28 | 626ms 17ns | 587ms 52ns | 638ms 36ns |
| league-container | ^5.1 | 661ms 296ns | 655ms 56ns | 670ms 985ns |
| nette-di | ^3.2 | 6ms 688ns | 3ms 183ns | 29ms 878ns |
| php-di | ^7.0 | 1ms 603ns | 2ns | 3ms 966ns |
| pimple | ^3.5 | 71ms 488ns | 69ms 947ns | 73ms 83ns |
| quickly(configured) | dev-master | 4ms 754ns | 3ms 982ns | 5ms 852ns |
| quickly(reflection) | dev-master | 3ms 282ns | 3ms 23ns | 4ms 964ns |
| symfony(compiled) | ^7.0 | 7ms 807ns | 5ms 867ns | 18ms 131ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| auryn | ^1.4 | 57s 30ms 311ns | 56s 188ms 961ns | 58s 444ms 102ns |
| dice | ^4.0 | 10s 5ms 341ns | 9s 902ms 917ns | 10s 122ms 827ns |
| laminas-servicemanager | ^3.21 | 934ns | 953ns | 128ns |
| laravel(singletons) | ^12.28 | 3ms 345ns | 3ms 3ns | 3ms 193ns |
| league-container | ^5.1 | 94s 663ms 136ns | 94s 0ms 952ns | 95s 480ms 926ns |
| nette-di | ^3.2 | 3ms 346ns | 3ms 978ns | 5ms 903ns |
| php-di | ^7.0 | 615ns | 946ns | 1ms 134ns |
| pimple | ^3.5 | 10s 46ms 729ns | 9s 870ms 886ns | 10s 392ms 102ns |
| quickly(configured) | dev-master | 3ms 228ns | 3ms 106ns | 3ms 863ns |
| quickly(reflection) | dev-master | 3ms 806ns | 3ms 22ns | 4ms 951ns |
| symfony(compiled) | ^7.0 | 2ms 562ns | 2ms 904ns | 2ms 14ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| auryn | ^1.4 | 56s 521ms 934ns | 55s 994ms 925ns | 57s 433ms 905ns |
| dice | ^4.0 | 9s 973ms 203ns | 9s 563ms 971ns | 10s 157ms 955ns |
| laminas-servicemanager | ^3.21 | 734ns | 848ns | 1ms 832ns |
| laravel(singletons) | ^12.28 | 3ms 28ns | 3ms 892ns | 4ms 995ns |
| league-container | ^5.1 | 94s 372ms 312ns | 93s 901ms 907ns | 94s 966ms 1ns |
| nette-di | ^3.2 | 5ms 303ns | 3ms 939ns | 23ms 40ns |
| php-di | ^7.0 | 1ms 277ns | 104ns | 5ms 818ns |
| pimple | ^3.5 | 10s 72ms 73ns | 9s 928ms 209ns | 10s 391ms 92ns |
| quickly(configured) | dev-master | 4ms 570ns | 3ms 155ns | 5ms 993ns |
| quickly(reflection) | dev-master | 4ms 571ns | 4ms 108ns | 5ms 21ns |
| symfony(compiled) | ^7.0 | 7ms 787ns | 5ms 145ns | 25ms 133ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 87ns | 925ns | 901ns |
| laravel(singletons) | ^12.28 | 3ms 920ns | 3ms 17ns | 3ms 112ns |
| nette-di | ^3.2 | 3ms 53ns | 3ms 948ns | 3ms 906ns |
| php-di | ^7.0 | 582ns | 185ns | 1ms 910ns |
| quickly(configured) | dev-master | 3ms 234ns | 3ms 84ns | 4ms 2ns |
| quickly(reflection) | dev-master | 3ms 109ns | 3ms 99ns | 4ms 11ns |
| symfony(compiled) | ^7.0 | 2ms 687ns | 2ms 970ns | 2ms 871ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 88ns | 876ns | 1ms 13ns |
| laravel(singletons) | ^12.28 | 3ms 673ns | 3ms 3ns | 4ms 100ns |
| nette-di | ^3.2 | 5ms 588ns | 3ms 896ns | 23ms 17ns |
| php-di | ^7.0 | 1ms 385ns | 997ns | 3ms 973ns |
| quickly(configured) | dev-master | 3ms 911ns | 3ms 76ns | 4ms 42ns |
| quickly(reflection) | dev-master | 3ms 539ns | 3ms 77ns | 4ms 9ns |
| symfony(compiled) | ^7.0 | 7ms 432ns | 5ms 14ns | 18ms 91ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
