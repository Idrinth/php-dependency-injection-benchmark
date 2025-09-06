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
| aura-di | ^5.0 | 1ms 180ns | 1ms 924ns | 3ms 976ns |
| auryn | ^1.4 | 407ms 221ns | 403ms 856ns | 413ms 868ns |
| dice | ^4.0 | 72ms 779ns | 69ms 887ns | 93ms 16ns |
| laminas-servicemanager | ^3.21 | 528ns | 5ns | 1ms 92ns |
| laravel(singletons) | ^12.28 | 3ms 75ns | 3ms 66ns | 3ms 979ns |
| laravel(unconfigured) | ^12.28 | 632ms 757ns | 619ms 912ns | 653ms 42ns |
| league-container | ^5.1 | 667ms 387ns | 663ms 940ns | 674ms 11ns |
| nette-di | ^3.2 | 3ms 295ns | 3ms 777ns | 5ms 88ns |
| php-di | ^7.0 | 996ns | 27ns | 1ms 60ns |
| pimple | ^3.5 | 70ms 494ns | 70ms 965ns | 72ms 2ns |
| quickly(configured) | dev-master | 6ms 516ns | 4ms 64ns | 9ms 125ns |
| quickly(reflection) | dev-master | 4ms 519ns | 4ms 1ns | 4ms 203ns |
| symfony(compiled) | ^7.0 | 2ms 267ns | 2ms 812ns | 2ms 994ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms 479ns | 3ms 910ns | 5ms 988ns |
| auryn | ^1.4 | 417ms 516ns | 412ms 113ns | 431ms 826ns |
| dice | ^4.0 | 72ms 424ns | 70ms 954ns | 74ms 0ns |
| laminas-servicemanager | ^3.21 | 786ns | 900ns | 1ms 996ns |
| laravel(singletons) | ^12.28 | 3ms 745ns | 3ms 782ns | 4ms 876ns |
| laravel(unconfigured) | ^12.28 | 640ms 755ns | 625ms 61ns | 700ms 963ns |
| league-container | ^5.1 | 666ms 392ns | 661ms 33ns | 673ms 199ns |
| nette-di | ^3.2 | 5ms 429ns | 3ms 21ns | 23ms 990ns |
| php-di | ^7.0 | 1ms 983ns | 961ns | 3ms 981ns |
| pimple | ^3.5 | 73ms 263ns | 70ms 101ns | 84ms 64ns |
| quickly(configured) | dev-master | 4ms 980ns | 4ms 904ns | 5ms 995ns |
| quickly(reflection) | dev-master | 6ms 69ns | 4ms 962ns | 9ms 982ns |
| symfony(compiled) | ^7.0 | 7ms 965ns | 5ms 863ns | 19ms 938ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| auryn | ^1.4 | 56s 863ms 793ns | 56s 69ms 109ns | 57s 709ms 936ns |
| dice | ^4.0 | 10s 62ms 2ns | 9s 922ms 910ns | 10s 342ms 4ns |
| laminas-servicemanager | ^3.21 | 491ns | 998ns | 841ns |
| laravel(singletons) | ^12.28 | 3ms 217ns | 3ms 40ns | 3ms 104ns |
| league-container | ^5.1 | 94s 945ms 495ns | 94s 59ms 843ns | 95s 665ms 158ns |
| nette-di | ^3.2 | 3ms 395ns | 3ms 995ns | 5ms 855ns |
| php-di | ^7.0 | 898ns | 953ns | 1ms 56ns |
| pimple | ^3.5 | 9s 994ms 791ns | 9s 895ms 864ns | 10s 190ms 141ns |
| quickly(configured) | dev-master | 4ms 337ns | 4ms 923ns | 4ms 993ns |
| quickly(reflection) | dev-master | 4ms 993ns | 4ms 50ns | 4ms 98ns |
| symfony(compiled) | ^7.0 | 2ms 91ns | 2ms 71ns | 2ms 938ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| auryn | ^1.4 | 56s 772ms 9ns | 55s 658ms 882ns | 58s 127ms 77ns |
| dice | ^4.0 | 10s 98ms 930ns | 9s 973ms 80ns | 10s 241ms 148ns |
| laminas-servicemanager | ^3.21 | 673ns | 829ns | 1ms 69ns |
| laravel(singletons) | ^12.28 | 3ms 705ns | 3ms 51ns | 4ms 3ns |
| league-container | ^5.1 | 94s 295ms 664ns | 93s 961ms 68ns | 95s 16ms 816ns |
| nette-di | ^3.2 | 5ms 984ns | 3ms 958ns | 24ms 932ns |
| php-di | ^7.0 | 1ms 0ns | 891ns | 3ms 947ns |
| pimple | ^3.5 | 9s 985ms 995ns | 9s 874ms 877ns | 10s 52ms 61ns |
| quickly(configured) | dev-master | 4ms 10ns | 4ms 884ns | 5ms 970ns |
| quickly(reflection) | dev-master | 4ms 84ns | 4ms 998ns | 5ms 188ns |
| symfony(compiled) | ^7.0 | 7ms 814ns | 5ms 96ns | 18ms 13ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 304ns | 991ns | 201ns |
| laravel(singletons) | ^12.28 | 3ms 647ns | 3ms 803ns | 4ms 984ns |
| nette-di | ^3.2 | 3ms 211ns | 3ms 879ns | 4ms 90ns |
| php-di | ^7.0 | 86ns | 987ns | 1ms 885ns |
| quickly(configured) | dev-master | 6ms 368ns | 4ms 947ns | 9ms 17ns |
| quickly(reflection) | dev-master | 4ms 911ns | 4ms 919ns | 4ms 930ns |
| symfony(compiled) | ^7.0 | 2ms 672ns | 2ms 17ns | 2ms 894ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 796ns | 168ns | 1ms 874ns |
| laravel(singletons) | ^12.28 | 3ms 817ns | 3ms 47ns | 4ms 901ns |
| nette-di | ^3.2 | 5ms 129ns | 3ms 957ns | 24ms 111ns |
| php-di | ^7.0 | 1ms 344ns | 906ns | 3ms 131ns |
| quickly(configured) | dev-master | 4ms 104ns | 4ms 868ns | 5ms 892ns |
| quickly(reflection) | dev-master | 4ms 210ns | 4ms 34ns | 5ms 200ns |
| symfony(compiled) | ^7.0 | 7ms 895ns | 5ms 163ns | 18ms 959ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
