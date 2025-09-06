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
| aura-di | ^5.0 | 1ms 212ns | 1ms 43ns | 1ms 909ns |
| auryn | ^1.4 | 409ms 80ns | 397ms 776ns | 420ms 70ns |
| dice | ^4.0 | 71ms 225ns | 69ms 105ns | 72ms 971ns |
| laminas-servicemanager | ^3.21 | 841ns | 65ns | 133ns |
| laravel(singletons) | ^12.28 | 3ms 231ns | 3ms 928ns | 3ms 913ns |
| laravel(unconfigured) | ^12.28 | 628ms 35ns | 621ms 206ns | 634ms 816ns |
| league-container | ^5.1 | 673ms 434ns | 654ms 934ns | 693ms 89ns |
| nette-di | ^3.2 | 3ms 992ns | 3ms 989ns | 3ms 32ns |
| php-di | ^7.0 | 622ns | 172ns | 1ms 901ns |
| pimple | ^3.5 | 71ms 480ns | 70ms 879ns | 75ms 867ns |
| quickly(configured) | dev-master | 5ms 261ns | 5ms 841ns | 5ms 937ns |
| quickly(reflection) | dev-master | 4ms 676ns | 4ms 10ns | 4ms 42ns |
| symfony(compiled) | ^7.0 | 2ms 565ns | 2ms 105ns | 2ms 917ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms 623ns | 3ms 989ns | 3ms 895ns |
| auryn | ^1.4 | 417ms 991ns | 402ms 994ns | 462ms 37ns |
| dice | ^4.0 | 71ms 501ns | 69ms 961ns | 76ms 134ns |
| laminas-servicemanager | ^3.21 | 124ns | 126ns | 1ms 76ns |
| laravel(singletons) | ^12.28 | 3ms 816ns | 3ms 894ns | 4ms 923ns |
| laravel(unconfigured) | ^12.28 | 631ms 333ns | 623ms 898ns | 640ms 84ns |
| league-container | ^5.1 | 665ms 594ns | 655ms 861ns | 670ms 949ns |
| nette-di | ^3.2 | 5ms 0ns | 3ms 69ns | 23ms 5ns |
| php-di | ^7.0 | 1ms 424ns | 1ms 7ns | 5ms 902ns |
| pimple | ^3.5 | 71ms 980ns | 69ms 47ns | 72ms 920ns |
| quickly(configured) | dev-master | 4ms 478ns | 4ms 991ns | 5ms 82ns |
| quickly(reflection) | dev-master | 4ms 150ns | 4ms 136ns | 5ms 954ns |
| symfony(compiled) | ^7.0 | 7ms 523ns | 5ms 53ns | 19ms 6ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s 33ms 244ns | 9s 919ms 103ns | 10s 231ms 118ns |
| laminas-servicemanager | ^3.21 | 867ns | 125ns | 915ns |
| laravel(singletons) | ^12.28 | 3ms 105ns | 3ms 109ns | 3ms 101ns |
| league-container | ^5.1 | 94s 642ms 611ns | 93s 916ms 10ns | 95s 890ms 37ns |
| nette-di | ^3.2 | 3ms 197ns | 3ms 805ns | 3ms 136ns |
| php-di | ^7.0 | 409ns | 93ns | 1ms 41ns |
| pimple | ^3.5 | 10s 7ms 395ns | 9s 834ms 142ns | 10s 113ms 922ns |
| quickly(configured) | dev-master | 4ms 62ns | 4ms 114ns | 4ms 831ns |
| quickly(reflection) | dev-master | 4ms 105ns | 4ms 8ns | 4ms 863ns |
| symfony(compiled) | ^7.0 | 2ms 615ns | 2ms 71ns | 2ms 27ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s 32ms 322ns | 9s 914ms 999ns | 10s 265ms 3ns |
| laminas-servicemanager | ^3.21 | 231ns | 933ns | 1ms 974ns |
| laravel(singletons) | ^12.28 | 3ms 240ns | 3ms 926ns | 4ms 23ns |
| league-container | ^5.1 | 94s 614ms 119ns | 92s 968ms 36ns | 95s 759ms 62ns |
| nette-di | ^3.2 | 5ms 10ns | 3ms 902ns | 23ms 891ns |
| php-di | ^7.0 | 1ms 969ns | 1ms 954ns | 5ms 39ns |
| pimple | ^3.5 | 10s 24ms 95ns | 9s 868ms 972ns | 10s 226ms 957ns |
| quickly(configured) | dev-master | 4ms 937ns | 4ms 196ns | 5ms 3ns |
| quickly(reflection) | dev-master | 4ms 882ns | 4ms 890ns | 6ms 48ns |
| symfony(compiled) | ^7.0 | 7ms 899ns | 5ms 985ns | 19ms 959ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 5ns | 960ns | 971ns |
| laravel(singletons) | ^12.28 | 3ms 547ns | 3ms 29ns | 3ms 891ns |
| nette-di | ^3.2 | 3ms 787ns | 3ms 120ns | 3ms 982ns |
| php-di | ^7.0 | 276ns | 927ns | 1ms 990ns |
| quickly(configured) | dev-master | 4ms 126ns | 4ms 127ns | 4ms 23ns |
| quickly(reflection) | dev-master | 4ms 401ns | 4ms 31ns | 4ms 896ns |
| symfony(compiled) | ^7.0 | 2ms 608ns | 2ms 97ns | 2ms 981ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 970ns | 969ns | 1ms 980ns |
| laravel(singletons) | ^12.28 | 3ms 507ns | 3ms 166ns | 5ms 936ns |
| nette-di | ^3.2 | 5ms 417ns | 3ms 940ns | 24ms 831ns |
| php-di | ^7.0 | 1ms 382ns | 78ns | 3ms 856ns |
| quickly(configured) | dev-master | 4ms 698ns | 4ms 172ns | 5ms 820ns |
| quickly(reflection) | dev-master | 4ms 281ns | 4ms 980ns | 5ms 23ns |
| symfony(compiled) | ^7.0 | 7ms 877ns | 6ms 863ns | 19ms 193ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
