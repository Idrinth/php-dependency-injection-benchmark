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
| aura-di | ^5.0 | 1ms 103ns | 1ms 24ns | 1ms 856ns |
| auryn | ^1.4 | 403ms 848ns | 399ms 92ns | 415ms 156ns |
| dice | ^4.0 | 71ms 263ns | 69ms 180ns | 76ms 34ns |
| laminas-servicemanager | ^3.21 | 894ns | 919ns | 52ns |
| laravel(singletons) | ^12.28 | 3ms 916ns | 3ms 953ns | 3ms 19ns |
| laravel(unconfigured) | ^12.28 | 627ms 962ns | 608ms 911ns | 638ms 918ns |
| league-container | ^5.1 | 665ms 904ns | 654ms 175ns | 677ms 199ns |
| nette-di | ^3.2 | 3ms 729ns | 3ms 918ns | 3ms 175ns |
| php-di | ^7.0 | 971ns | 986ns | 1ms 927ns |
| pimple | ^3.5 | 70ms 375ns | 69ms 59ns | 72ms 956ns |
| quickly(configured) | dev-master | 2ms 329ns | 2ms 997ns | 2ms 86ns |
| quickly(reflection) | dev-master | 2ms 795ns | 2ms 138ns | 2ms 5ns |
| symfony(compiled) | ^7.0 | 2ms 634ns | 2ms 177ns | 4ms 49ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms 499ns | 2ms 947ns | 3ms 0ns |
| auryn | ^1.4 | 405ms 405ns | 397ms 846ns | 411ms 86ns |
| dice | ^4.0 | 71ms 325ns | 70ms 14ns | 74ms 99ns |
| laminas-servicemanager | ^3.21 | 1ms 260ns | 973ns | 1ms 982ns |
| laravel(singletons) | ^12.28 | 3ms 601ns | 3ms 151ns | 4ms 24ns |
| laravel(unconfigured) | ^12.28 | 636ms 120ns | 626ms 992ns | 653ms 932ns |
| league-container | ^5.1 | 662ms 822ns | 659ms 946ns | 669ms 976ns |
| nette-di | ^3.2 | 5ms 413ns | 3ms 908ns | 27ms 6ns |
| php-di | ^7.0 | 1ms 945ns | 909ns | 3ms 853ns |
| pimple | ^3.5 | 72ms 194ns | 69ms 937ns | 77ms 905ns |
| quickly(configured) | dev-master | 2ms 999ns | 2ms 165ns | 3ms 916ns |
| quickly(reflection) | dev-master | 2ms 809ns | 2ms 45ns | 3ms 918ns |
| symfony(compiled) | ^7.0 | 7ms 395ns | 5ms 909ns | 19ms 153ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| auryn | ^1.4 | 56s 915ms 517ns | 55s 873ms 133ns | 57s 533ms 856ns |
| dice | ^4.0 | 10s 43ms 223ns | 9s 752ms 873ns | 10s 208ms 186ns |
| laminas-servicemanager | ^3.21 | 839ns | 906ns | 868ns |
| laravel(singletons) | ^12.28 | 5ms 776ns | 3ms 771ns | 6ms 11ns |
| league-container | ^5.1 | 94s 453ms 702ns | 93s 911ms 19ns | 95s 84ms 122ns |
| nette-di | ^3.2 | 3ms 426ns | 3ms 890ns | 3ms 92ns |
| php-di | ^7.0 | 1ms 427ns | 1ms 870ns | 2ms 916ns |
| pimple | ^3.5 | 9s 993ms 89ns | 9s 831ms 976ns | 10s 156ms 848ns |
| quickly(configured) | dev-master | 3ms 220ns | 2ms 860ns | 5ms 911ns |
| quickly(reflection) | dev-master | 2ms 165ns | 2ms 5ns | 4ms 969ns |
| symfony(compiled) | ^7.0 | 2ms 996ns | 2ms 977ns | 2ms 192ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| auryn | ^1.4 | 57s 91ms 949ns | 56s 415ms 969ns | 58s 228ms 871ns |
| dice | ^4.0 | 10s 67ms 903ns | 9s 942ms 996ns | 10s 243ms 874ns |
| laminas-servicemanager | ^3.21 | 194ns | 40ns | 1ms 911ns |
| laravel(singletons) | ^12.28 | 3ms 589ns | 3ms 65ns | 4ms 897ns |
| league-container | ^5.1 | 94s 680ms 45ns | 94s 35ms 928ns | 95s 476ms 52ns |
| nette-di | ^3.2 | 5ms 771ns | 3ms 127ns | 23ms 947ns |
| php-di | ^7.0 | 1ms 606ns | 49ns | 3ms 982ns |
| pimple | ^3.5 | 10s 9ms 330ns | 9s 823ms 120ns | 10s 155ms 160ns |
| quickly(configured) | dev-master | 2ms 362ns | 2ms 906ns | 3ms 115ns |
| quickly(reflection) | dev-master | 2ms 782ns | 2ms 854ns | 3ms 936ns |
| symfony(compiled) | ^7.0 | 7ms 97ns | 5ms 942ns | 18ms 967ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 808ns | 979ns | 1ms 5ns |
| laravel(singletons) | ^12.28 | 3ms 341ns | 3ms 974ns | 4ms 3ns |
| nette-di | ^3.2 | 3ms 601ns | 3ms 997ns | 4ms 974ns |
| php-di | ^7.0 | 672ns | 60ns | 1ms 872ns |
| quickly(configured) | dev-master | 2ms 199ns | 2ms 79ns | 2ms 62ns |
| quickly(reflection) | dev-master | 2ms 777ns | 2ms 5ns | 2ms 961ns |
| symfony(compiled) | ^7.0 | 4ms 788ns | 4ms 955ns | 4ms 196ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 614ns | 62ns | 1ms 887ns |
| laravel(singletons) | ^12.28 | 3ms 779ns | 3ms 61ns | 4ms 15ns |
| nette-di | ^3.2 | 5ms 996ns | 3ms 824ns | 23ms 81ns |
| php-di | ^7.0 | 1ms 121ns | 894ns | 3ms 166ns |
| quickly(configured) | dev-master | 2ms 421ns | 2ms 93ns | 3ms 155ns |
| quickly(reflection) | dev-master | 2ms 99ns | 2ms 917ns | 3ms 961ns |
| symfony(compiled) | ^7.0 | 7ms 923ns | 5ms 55ns | 18ms 2ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
