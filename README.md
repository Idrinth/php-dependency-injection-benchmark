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
| aura-di | ^5.0 | 1ms, 755µs, 189ns | 1ms, 713µs, 991ns | 1ms, 827µs, 1ns |
| auryn | ^1.4 | 408ms, 293µs, 819ns | 401ms, 175µs, 22ns | 422ms, 135µs, 114ns |
| dice | ^4.0 | 70ms, 465µs, 207ns | 69ms, 997µs, 72ns | 71ms, 376µs, 800ns |
| laminas-servicemanager | ^3.21 | 763µs, 201ns | 741µs, 958ns | 805µs, 854ns |
| laravel(singletons) | ^12.28 | 3ms, 562µs, 116ns | 3ms, 417µs, 968ns | 4ms, 232µs, 168ns |
| laravel(unconfigured) | ^12.28 | 629ms, 17µs, 901ns | 624ms, 475µs, 2ns | 635ms, 467µs, 52ns |
| league-container | ^5.1 | 658ms, 632µs, 302ns | 654ms, 533µs, 863ns | 669ms, 353µs, 961ns |
| nette-di | ^3.2 | 3ms, 871µs, 488ns | 3ms, 592µs, 967ns | 5ms, 407µs, 94ns |
| php-di | ^7.0 | 825µs, 333ns | 763µs, 177ns | 1ms, 206µs, 159ns |
| pimple | ^3.5 | 73ms, 45µs, 372ns | 69ms, 679µs, 975ns | 81ms, 298µs, 828ns |
| quickly(compiled) | dev-master | 1ms, 61µs, 177ns | 1ms, 10µs, 894ns | 1ms, 181µs, 125ns |
| quickly(configured) | dev-master | 1ms, 369µs, 380ns | 1ms, 309µs, 871ns | 1ms, 640µs, 81ns |
| quickly(reflection) | dev-master | 1ms, 349µs, 67ns | 1ms, 317µs, 24ns | 1ms, 450µs, 61ns |
| symfony(compiled) | ^7.0 | 2ms, 162µs, 528ns | 2ms, 133µs, 131ns | 2ms, 187µs, 13ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 140µs, 282ns | 3ms, 44µs, 843ns | 3ms, 429µs, 889ns |
| auryn | ^1.4 | 408ms, 506µs, 727ns | 401ms, 489µs, 973ns | 416ms, 202µs, 68ns |
| dice | ^4.0 | 71ms, 673µs, 870ns | 70ms, 927µs, 143ns | 72ms, 81µs, 89ns |
| laminas-servicemanager | ^3.21 | 903µs, 81ns | 803µs, 947ns | 1ms, 669µs, 883ns |
| laravel(singletons) | ^12.28 | 3ms, 626µs, 942ns | 3ms, 445µs, 863ns | 4ms, 764µs, 80ns |
| laravel(unconfigured) | ^12.28 | 636ms, 994µs, 147ns | 622ms, 552µs, 156ns | 665ms, 606µs, 975ns |
| league-container | ^5.1 | 664ms, 909µs, 934ns | 660ms, 953µs, 998ns | 673ms, 570µs, 156ns |
| nette-di | ^3.2 | 5ms, 793µs, 166ns | 3ms, 311µs, 157ns | 27ms, 774µs, 810ns |
| php-di | ^7.0 | 1ms, 96µs, 439ns | 799µs, 179ns | 3ms, 448µs, 9ns |
| pimple | ^3.5 | 70ms, 841µs, 360ns | 70ms, 164µs, 918ns | 71ms, 708µs, 917ns |
| quickly(compiled) | dev-master | 1ms, 19µs, 239ns | 993µs, 967ns | 1ms, 67µs, 876ns |
| quickly(configured) | dev-master | 1ms, 794µs, 338ns | 1ms, 423µs, 120ns | 2ms, 849µs, 102ns |
| quickly(reflection) | dev-master | 1ms, 489µs, 138ns | 1ms, 370µs, 906ns | 2ms, 203µs, 941ns |
| symfony(compiled) | ^7.0 | 7ms, 85µs, 824ns | 5ms, 732µs, 59ns | 18ms, 263µs, 816ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 50ms, 46µs, 157ns | 9s, 959ms, 627µs, 866ns | 10s, 206ms, 276µs, 893ns |
| laminas-servicemanager | ^3.21 | 1ms, 404ns | 781µs, 59ns | 1ms, 228µs, 94ns |
| laravel(singletons) | ^12.28 | 3ms, 560µs, 709ns | 3ms, 455µs, 877ns | 3ms, 796µs, 100ns |
| league-container | ^5.1 | 94s, 636ms, 800µs, 837ns | 93s, 989ms, 258µs, 50ns | 95s, 454ms, 158µs, 67ns |
| nette-di | ^3.2 | 3ms, 400µs, 611ns | 3ms, 357µs, 172ns | 3ms, 453µs, 969ns |
| php-di | ^7.0 | 835µs, 394ns | 752µs, 925ns | 1ms, 240µs, 15ns |
| pimple | ^3.5 | 10s, 10ms, 855µs, 579ns | 9s, 886ms, 640µs, 71ns | 10s, 205ms, 790µs, 996ns |
| quickly(compiled) | dev-master | 1ms, 36µs, 810ns | 1ms, 11µs, 133ns | 1ms, 73µs, 122ns |
| quickly(configured) | dev-master | 1ms, 348µs, 280ns | 1ms, 324µs, 892ns | 1ms, 372µs, 814ns |
| quickly(reflection) | dev-master | 1ms, 337µs, 623ns | 1ms, 286µs, 983ns | 1ms, 487µs, 970ns |
| symfony(compiled) | ^7.0 | 2ms, 156µs, 972ns | 2ms, 120µs, 971ns | 2ms, 187µs, 13ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 91ms, 519µs, 93ns | 9s, 976ms, 66µs, 112ns | 10s, 250ms, 841µs, 856ns |
| laminas-servicemanager | ^3.21 | 906µs, 991ns | 813µs, 7ns | 1ms, 636µs, 981ns |
| laravel(singletons) | ^12.28 | 3ms, 783µs, 988ns | 3ms, 390µs, 73ns | 5ms, 282µs, 878ns |
| league-container | ^5.1 | 94s, 864ms, 645µs, 51ns | 93s, 607ms, 353µs, 925ns | 95s, 766ms, 502µs, 857ns |
| nette-di | ^3.2 | 5ms, 612µs, 778ns | 3ms, 350µs, 973ns | 24ms, 134µs, 874ns |
| php-di | ^7.0 | 1ms, 122µs, 808ns | 852µs, 108ns | 3ms, 332µs, 138ns |
| pimple | ^3.5 | 9s, 997ms, 694µs, 468ns | 9s, 634ms, 896µs, 39ns | 10s, 364ms, 716µs, 53ns |
| quickly(compiled) | dev-master | 1ms, 21µs, 99ns | 987µs, 52ns | 1ms, 63µs, 108ns |
| quickly(configured) | dev-master | 2ms, 522µs, 826ns | 2ms, 411µs, 127ns | 3ms, 403µs, 186ns |
| quickly(reflection) | dev-master | 1ms, 483µs, 988ns | 1ms, 372µs, 98ns | 2ms, 186µs, 59ns |
| symfony(compiled) | ^7.0 | 7ms, 255µs, 721ns | 5ms, 747µs, 79ns | 18ms, 304µs, 109ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 778µs, 7ns | 755µs, 71ns | 831µs, 127ns |
| laravel(singletons) | ^12.28 | 3ms, 536µs, 200ns | 3ms, 454µs, 923ns | 3ms, 800µs, 868ns |
| nette-di | ^3.2 | 3ms, 455µs, 805ns | 3ms, 388µs, 881ns | 3ms, 634µs, 929ns |
| php-di | ^7.0 | 859µs, 141ns | 790µs, 119ns | 1ms, 270µs, 55ns |
| quickly(compiled) | dev-master | 1ms, 21µs, 170ns | 1ms, 8µs, 987ns | 1ms, 54µs, 48ns |
| quickly(configured) | dev-master | 1ms, 333µs, 832ns | 1ms, 291µs, 990ns | 1ms, 435µs, 995ns |
| quickly(reflection) | dev-master | 1ms, 356µs, 506ns | 1ms, 306µs, 56ns | 1ms, 555µs, 919ns |
| symfony(compiled) | ^7.0 | 2ms, 157µs, 473ns | 2ms, 117µs, 872ns | 2ms, 213µs, 1ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 947µs, 403ns | 815µs, 153ns | 1ms, 983µs, 880ns |
| laravel(singletons) | ^12.28 | 3ms, 737µs, 950ns | 3ms, 496µs, 885ns | 4ms, 843µs, 950ns |
| nette-di | ^3.2 | 5ms, 551µs, 815ns | 3ms, 353µs, 118ns | 23ms, 957µs, 967ns |
| php-di | ^7.0 | 1ms, 215µs, 767ns | 958µs, 919ns | 3ms, 454µs, 923ns |
| quickly(compiled) | dev-master | 1ms, 45µs, 274ns | 1ms, 6µs, 126ns | 1ms, 112µs, 937ns |
| quickly(configured) | dev-master | 1ms, 499µs, 485ns | 1ms, 384µs, 973ns | 2ms, 189µs, 874ns |
| quickly(reflection) | dev-master | 1ms, 543µs, 593ns | 1ms, 453µs, 876ns | 2ms, 228µs, 21ns |
| symfony(compiled) | ^7.0 | 7ms, 549µs, 381ns | 5ms, 916µs, 118ns | 19ms, 123µs, 77ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
