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
| aura-di | ^5.0 | 1ms, 774µs, 883ns | 1ms, 702µs, 70ns | 1ms, 911µs, 163ns |
| auryn | ^1.4 | 408ms, 240µs, 199ns | 397ms, 87µs, 97ns | 424ms, 471µs, 855ns |
| dice | ^4.0 | 72ms, 602µs, 748ns | 70ms, 263µs, 147ns | 81ms, 540µs, 107ns |
| laminas-servicemanager | ^3.21 | 774µs, 2ns | 741µs, 4ns | 808µs, 954ns |
| laravel(singletons) | ^12.28 | 3ms, 540µs, 492ns | 3ms, 416µs, 61ns | 3ms, 747µs, 940ns |
| laravel(unconfigured) | ^12.28 | 631ms, 177µs, 783ns | 622ms, 40µs, 33ns | 653ms, 496µs, 980ns |
| league-container | ^5.1 | 660ms, 244µs, 679ns | 655ms, 389µs, 70ns | 666ms, 259µs, 50ns |
| nette-di | ^3.2 | 3ms, 350µs, 400ns | 3ms, 319µs, 978ns | 3ms, 391µs, 981ns |
| php-di | ^7.0 | 829µs, 291ns | 775µs, 98ns | 1ms, 189µs, 947ns |
| pimple | ^3.5 | 71ms, 217µs, 203ns | 69ms, 103µs, 2ns | 73ms, 796µs, 33ns |
| quickly(configured) | dev-master | 1ms, 355µs, 314ns | 1ms, 317µs, 24ns | 1ms, 398µs, 86ns |
| quickly(reflection) | dev-master | 1ms, 362µs, 490ns | 1ms, 324µs, 176ns | 1ms, 565µs, 933ns |
| symfony(compiled) | ^7.0 | 2ms, 180µs, 147ns | 2ms, 70µs, 903ns | 2ms, 393µs, 7ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 182µs, 935ns | 3ms, 26µs, 8ns | 4ms, 142µs, 45ns |
| auryn | ^1.4 | 416ms, 2µs, 416ns | 404ms, 86µs, 828ns | 457ms, 406µs, 44ns |
| dice | ^4.0 | 77ms, 657µs, 103ns | 70ms, 677µs, 995ns | 110ms, 733µs, 32ns |
| laminas-servicemanager | ^3.21 | 892µs, 901ns | 788µs, 211ns | 1ms, 671µs, 75ns |
| laravel(singletons) | ^12.28 | 3ms, 617µs, 215ns | 3ms, 460µs, 168ns | 4ms, 744µs, 52ns |
| laravel(unconfigured) | ^12.28 | 638ms, 72µs, 204ns | 629ms, 223µs, 108ns | 650ms, 833µs, 845ns |
| league-container | ^5.1 | 665ms, 16µs, 508ns | 657ms, 814µs, 979ns | 675ms, 282µs, 955ns |
| nette-di | ^3.2 | 5ms, 499µs, 29ns | 3ms, 432µs, 989ns | 23ms, 705µs, 959ns |
| php-di | ^7.0 | 1ms, 164µs, 889ns | 838µs, 41ns | 3ms, 353µs, 118ns |
| pimple | ^3.5 | 71ms, 586µs, 251ns | 69ms, 8µs, 827ns | 83ms, 93µs, 881ns |
| quickly(configured) | dev-master | 1ms, 435µs, 112ns | 1ms, 338µs, 5ns | 2ms, 89µs, 977ns |
| quickly(reflection) | dev-master | 1ms, 438µs, 474ns | 1ms, 329µs, 898ns | 2ms, 135µs, 38ns |
| symfony(compiled) | ^7.0 | 7ms, 232µs, 499ns | 5ms, 810µs, 22ns | 18ms, 440µs, 8ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 41ms, 451µs, 954ns | 9s, 933ms, 770µs, 179ns | 10s, 147ms, 87µs, 97ns |
| laminas-servicemanager | ^3.21 | 810µs, 813ns | 734µs, 90ns | 1ms, 3µs, 26ns |
| laravel(singletons) | ^12.28 | 3ms, 594µs, 350ns | 3ms, 472µs, 805ns | 4ms, 351µs, 854ns |
| league-container | ^5.1 | 94s, 552ms, 977µs, 657ns | 93s, 978ms, 352µs, 69ns | 95s, 703ms, 505µs, 992ns |
| nette-di | ^3.2 | 3ms, 404µs, 116ns | 3ms, 357µs, 887ns | 3ms, 437µs, 995ns |
| php-di | ^7.0 | 912µs, 499ns | 794µs, 172ns | 1ms, 261µs, 949ns |
| pimple | ^3.5 | 10s, 33ms, 810µs, 687ns | 9s, 855ms, 245µs, 113ns | 10s, 197ms, 814µs, 941ns |
| quickly(configured) | dev-master | 1ms, 345µs, 62ns | 1ms, 319µs, 885ns | 1ms, 360µs, 893ns |
| quickly(reflection) | dev-master | 1ms, 402µs, 235ns | 1ms, 326µs, 799ns | 1ms, 711µs, 130ns |
| symfony(compiled) | ^7.0 | 2ms, 150µs, 368ns | 2ms, 99µs, 37ns | 2ms, 184µs, 152ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 53ms, 9µs, 915ns | 9s, 965ms, 423µs, 822ns | 10s, 152ms, 238µs, 130ns |
| laminas-servicemanager | ^3.21 | 901µs, 484ns | 805µs, 139ns | 1ms, 671µs, 75ns |
| laravel(singletons) | ^12.28 | 3ms, 649µs, 401ns | 3ms, 455µs, 162ns | 4ms, 869µs, 937ns |
| league-container | ^5.1 | 95s, 141ms, 970µs, 753ns | 93s, 827ms, 168µs, 941ns | 96s, 697ms, 990µs, 894ns |
| nette-di | ^3.2 | 5ms, 523µs, 228ns | 3ms, 467µs, 82ns | 23ms, 829µs, 936ns |
| php-di | ^7.0 | 1ms, 122µs, 593ns | 855µs, 922ns | 3ms, 365µs, 39ns |
| pimple | ^3.5 | 10s, 43ms, 285µs, 799ns | 9s, 909ms, 780µs, 25ns | 10s, 242ms, 336µs, 988ns |
| quickly(configured) | dev-master | 1ms, 475µs, 572ns | 1ms, 375µs, 913ns | 2ms, 45µs, 154ns |
| quickly(reflection) | dev-master | 1ms, 478µs, 838ns | 1ms, 363µs, 992ns | 2ms, 179µs, 145ns |
| symfony(compiled) | ^7.0 | 7ms, 216µs, 906ns | 5ms, 738µs, 973ns | 19ms, 911µs, 50ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 1ms, 242µs, 375ns | 1ms, 193µs, 46ns | 1ms, 430µs, 34ns |
| laravel(singletons) | ^12.28 | 3ms, 481µs, 841ns | 3ms, 355µs, 979ns | 3ms, 777µs, 27ns |
| nette-di | ^3.2 | 3ms, 435µs, 826ns | 3ms, 373µs, 146ns | 3ms, 703µs, 832ns |
| php-di | ^7.0 | 835µs, 943ns | 772µs, 953ns | 1ms, 260µs, 42ns |
| quickly(configured) | dev-master | 1ms, 379µs, 36ns | 1ms, 337µs, 51ns | 1ms, 419µs, 67ns |
| quickly(reflection) | dev-master | 1ms, 351µs, 904ns | 1ms, 303µs, 911ns | 1ms, 606µs, 941ns |
| symfony(compiled) | ^7.0 | 2ms, 165µs, 222ns | 2ms, 110µs, 958ns | 2ms, 336µs, 25ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 1ms, 23µs, 530ns | 863µs, 75ns | 1ms, 744µs, 31ns |
| laravel(singletons) | ^12.28 | 3ms, 742µs, 456ns | 3ms, 563µs, 880ns | 4ms, 914µs, 45ns |
| nette-di | ^3.2 | 5ms, 521µs, 273ns | 3ms, 438µs, 949ns | 23ms, 675µs, 918ns |
| php-di | ^7.0 | 1ms, 260µs, 662ns | 961µs, 780ns | 3ms, 612µs, 995ns |
| quickly(configured) | dev-master | 1ms, 486µs, 444ns | 1ms, 392µs, 126ns | 2ms, 111µs, 196ns |
| quickly(reflection) | dev-master | 1ms, 581µs, 668ns | 1ms, 471µs, 996ns | 2ms, 249µs, 2ns |
| symfony(compiled) | ^7.0 | 7ms, 554µs, 745ns | 5ms, 957µs, 126ns | 20ms, 385µs, 26ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
