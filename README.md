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
| aura-di | ^5.0 | 1ms, 899µs, 170ns | 1ms, 695µs, 871ns | 3ms, 166µs, 913ns |
| auryn | ^1.4 | 414ms, 308µs, 691ns | 401ms, 768µs, 922ns | 455ms, 765µs, 962ns |
| dice | ^4.0 | 71ms, 140µs, 241ns | 69ms, 465µs, 160ns | 72ms, 365µs, 45ns |
| laminas-servicemanager | ^3.21 | 773µs, 72ns | 750µs, 64ns | 804µs, 901ns |
| laravel(singletons) | ^12.28 | 3ms, 487µs, 777ns | 3ms, 331µs, 899ns | 3ms, 686µs, 904ns |
| laravel(unconfigured) | ^12.28 | 626ms, 533µs, 508ns | 618ms, 288µs, 993ns | 638ms, 764µs, 858ns |
| league-container | ^5.1 | 661ms, 561µs, 775ns | 658ms, 728µs, 837ns | 665ms, 158µs, 33ns |
| nette-di | ^3.2 | 3ms, 375µs, 124ns | 3ms, 293µs, 37ns | 3ms, 463µs, 983ns |
| php-di | ^7.0 | 831µs, 794ns | 771µs, 999ns | 1ms, 198µs, 53ns |
| pimple | ^3.5 | 71ms, 301µs, 293ns | 70ms, 243µs, 120ns | 73ms, 390µs, 7ns |
| quickly(configured) | dev-master | 4ms, 735µs, 326ns | 4ms, 418µs, 134ns | 5ms, 833µs, 864ns |
| quickly(reflection) | dev-master | 5ms, 212µs, 68ns | 4ms, 387µs, 140ns | 8ms, 223µs, 56ns |
| symfony(compiled) | ^7.0 | 2ms, 153µs, 277ns | 2ms, 81µs, 871ns | 2ms, 653µs, 837ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 102µs, 183ns | 2ms, 979µs, 40ns | 3ms, 172µs, 159ns |
| auryn | ^1.4 | 410ms, 985µs, 827ns | 402ms, 73µs, 144ns | 419ms, 480µs, 85ns |
| dice | ^4.0 | 73ms, 640µs, 799ns | 71ms, 186µs, 780ns | 90ms, 435µs, 28ns |
| laminas-servicemanager | ^3.21 | 876µs, 307ns | 774µs, 860ns | 1ms, 640µs, 81ns |
| laravel(singletons) | ^12.28 | 3ms, 666µs, 496ns | 3ms, 519µs, 58ns | 4ms, 770µs, 994ns |
| laravel(unconfigured) | ^12.28 | 637ms, 958µs, 908ns | 623ms, 654µs, 842ns | 687ms, 345µs, 981ns |
| league-container | ^5.1 | 667ms, 108µs, 11ns | 657ms, 142µs, 162ns | 701ms, 272µs, 964ns |
| nette-di | ^3.2 | 5ms, 462µs, 956ns | 3ms, 343µs, 105ns | 24ms, 233µs, 102ns |
| php-di | ^7.0 | 1ms, 105µs, 403ns | 833µs, 988ns | 3ms, 321µs, 170ns |
| pimple | ^3.5 | 72ms, 38µs, 793ns | 68ms, 768µs, 978ns | 81ms, 431µs, 865ns |
| quickly(configured) | dev-master | 4ms, 613µs, 113ns | 4ms, 494µs, 905ns | 5ms, 212µs, 68ns |
| quickly(reflection) | dev-master | 4ms, 610µs, 610ns | 4ms, 503µs, 965ns | 5ms, 192µs, 995ns |
| symfony(compiled) | ^7.0 | 7ms, 203µs, 602ns | 5ms, 814µs, 790ns | 19ms, 35µs, 100ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 56ms, 442µs, 713ns | 9s, 940ms, 404µs, 176ns | 10s, 192ms, 726µs, 850ns |
| laminas-servicemanager | ^3.21 | 779µs, 104ns | 761µs, 985ns | 823µs, 20ns |
| laravel(singletons) | ^12.28 | 3ms, 433µs, 299ns | 3ms, 340µs, 5ns | 3ms, 687µs, 858ns |
| league-container | ^5.1 | 94s, 708ms, 274µs, 960ns | 94s, 330ms, 320µs, 835ns | 95s, 506ms, 41ns |
| nette-di | ^3.2 | 3ms, 353µs, 285ns | 3ms, 248µs, 929ns | 3ms, 684µs, 43ns |
| php-di | ^7.0 | 846µs, 195ns | 787µs, 973ns | 1ms, 238µs, 822ns |
| pimple | ^3.5 | 10s, 53ms, 872µs, 799ns | 9s, 853ms, 417µs, 873ns | 10s, 243ms, 137µs, 121ns |
| quickly(configured) | dev-master | 4ms, 510µs, 450ns | 4ms, 421µs, 949ns | 4ms, 987µs, 1ns |
| quickly(reflection) | dev-master | 4ms, 542µs, 446ns | 4ms, 453µs, 897ns | 4ms, 881µs, 858ns |
| symfony(compiled) | ^7.0 | 2ms, 248µs, 96ns | 2ms, 201µs, 80ns | 2ms, 416µs, 849ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 113ms, 526µs, 320ns | 9s, 984ms, 419µs, 107ns | 10s, 332ms, 826µs, 852ns |
| laminas-servicemanager | ^3.21 | 936µs, 484ns | 823µs, 20ns | 1ms, 677µs, 989ns |
| laravel(singletons) | ^12.28 | 3ms, 821µs, 659ns | 3ms, 589µs, 868ns | 4ms, 969µs, 120ns |
| league-container | ^5.1 | 94s, 498ms, 745µs, 870ns | 94s, 27ms, 50µs, 18ns | 95s, 32ms, 691µs, 1ns |
| nette-di | ^3.2 | 5ms, 732µs, 178ns | 3ms, 552µs, 198ns | 23ms, 808µs, 956ns |
| php-di | ^7.0 | 1ms, 130µs, 652ns | 871µs, 896ns | 3ms, 356µs, 933ns |
| pimple | ^3.5 | 9s, 989ms, 182µs, 901ns | 9s, 845ms, 810µs, 174ns | 10s, 176ms, 341µs, 772ns |
| quickly(configured) | dev-master | 4ms, 612µs, 302ns | 4ms, 498µs, 958ns | 5ms, 146µs, 980ns |
| quickly(reflection) | dev-master | 4ms, 901µs, 885ns | 4ms, 538µs, 59ns | 7ms, 689µs, 952ns |
| symfony(compiled) | ^7.0 | 7ms, 160µs, 925ns | 5ms, 792µs, 140ns | 18ms, 252µs, 134ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 825µs, 524ns | 750µs, 780ns | 1ms, 5µs, 172ns |
| laravel(singletons) | ^12.28 | 3ms, 593µs, 15ns | 3ms, 376µs, 7ns | 4ms, 554µs, 33ns |
| nette-di | ^3.2 | 3ms, 441µs, 190ns | 3ms, 419µs, 876ns | 3ms, 457µs, 69ns |
| php-di | ^7.0 | 974µs, 678ns | 862µs, 836ns | 1ms, 400µs, 232ns |
| quickly(configured) | dev-master | 4ms, 504µs, 561ns | 4ms, 417µs, 181ns | 4ms, 899µs, 978ns |
| quickly(reflection) | dev-master | 4ms, 543µs, 662ns | 4ms, 462µs, 957ns | 4ms, 925µs, 966ns |
| symfony(compiled) | ^7.0 | 2ms, 376µs, 198ns | 2ms, 115µs, 964ns | 3ms, 377µs, 914ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 977µs, 301ns | 860µs, 929ns | 1ms, 732µs, 110ns |
| laravel(singletons) | ^12.28 | 3ms, 742µs, 3ns | 3ms, 538µs, 131ns | 4ms, 939µs, 79ns |
| nette-di | ^3.2 | 5ms, 604µs, 910ns | 3ms, 433µs, 942ns | 24ms, 843µs, 931ns |
| php-di | ^7.0 | 1ms, 280µs, 975ns | 978µs, 946ns | 3ms, 587µs, 7ns |
| quickly(configured) | dev-master | 4ms, 583µs, 978ns | 4ms, 495µs, 859ns | 5ms, 245µs, 923ns |
| quickly(reflection) | dev-master | 4ms, 740µs, 118ns | 4ms, 615µs, 68ns | 5ms, 306µs, 5ns |
| symfony(compiled) | ^7.0 | 7ms, 276µs, 296ns | 5ms, 768µs, 60ns | 18ms, 374µs, 919ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
