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
| aura-di | ^5.0 | 2ms, 18µs, 237ns | 1ms, 696µs, 109ns | 3ms, 110µs, 885ns |
| auryn | ^1.4 | 408ms, 688µs, 664ns | 401ms, 850µs, 938ns | 421ms, 12µs, 878ns |
| dice | ^4.0 | 73ms, 70µs, 836ns | 69ms, 692µs, 134ns | 78ms, 903µs, 913ns |
| laminas-servicemanager | ^3.21 | 799µs, 584ns | 772µs, 953ns | 852µs, 823ns |
| laravel(singletons) | ^12.28 | 4ms, 33µs, 875ns | 3ms, 378µs, 868ns | 6ms, 815µs, 910ns |
| laravel(unconfigured) | ^12.28 | 636ms, 746µs, 859ns | 621ms, 976µs, 137ns | 663ms, 830µs, 41ns |
| league-container | ^5.1 | 667ms, 506µs, 694ns | 659ms, 850µs, 120ns | 678ms, 210µs, 973ns |
| nette-di | ^3.2 | 3ms, 511µs, 95ns | 3ms, 297µs, 90ns | 5ms, 290µs, 985ns |
| php-di | ^7.0 | 847µs, 196ns | 791µs, 72ns | 1ms, 237µs, 869ns |
| pimple | ^3.5 | 71ms, 500µs, 945ns | 69ms, 928µs, 884ns | 77ms, 849µs, 149ns |
| quickly(compiled) | dev-master | 782µs, 299ns | 762µs, 939ns | 828µs, 27ns |
| quickly(configured) | dev-master | 1ms, 343µs, 846ns | 1ms, 316µs, 70ns | 1ms, 394µs, 987ns |
| quickly(reflection) | dev-master | 1ms, 353µs, 573ns | 1ms, 325µs, 845ns | 1ms, 460µs, 75ns |
| symfony(compiled) | ^7.0 | 2ms, 291µs, 822ns | 2ms, 122µs, 879ns | 3ms, 426µs, 790ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 121µs, 900ns | 3ms, 40µs, 75ns | 3ms, 193µs, 140ns |
| auryn | ^1.4 | 411ms, 682µs, 200ns | 400ms, 805µs, 950ns | 431ms, 442µs, 975ns |
| dice | ^4.0 | 72ms, 278µs, 189ns | 70ms, 539µs, 951ns | 82ms, 722µs, 187ns |
| laminas-servicemanager | ^3.21 | 877µs, 737ns | 782µs, 12ns | 1ms, 646µs, 41ns |
| laravel(singletons) | ^12.28 | 3ms, 717µs, 613ns | 3ms, 458µs, 23ns | 4ms, 914µs, 999ns |
| laravel(unconfigured) | ^12.28 | 635ms, 620µs, 737ns | 624ms, 73µs, 28ns | 656ms, 400µs, 203ns |
| league-container | ^5.1 | 663ms, 575µs, 530ns | 653ms, 909µs, 921ns | 693ms, 593µs, 978ns |
| nette-di | ^3.2 | 5ms, 497µs, 694ns | 3ms, 427µs, 982ns | 23ms, 788µs, 213ns |
| php-di | ^7.0 | 1ms, 84µs, 303ns | 821µs, 828ns | 3ms, 284µs, 931ns |
| pimple | ^3.5 | 70ms, 449µs, 256ns | 69ms, 204µs, 92ns | 72ms, 154µs, 998ns |
| quickly(compiled) | dev-master | 766µs, 682ns | 753µs, 879ns | 797µs, 986ns |
| quickly(configured) | dev-master | 1ms, 460µs, 99ns | 1ms, 349µs, 925ns | 2ms, 105µs, 951ns |
| quickly(reflection) | dev-master | 1ms, 462µs, 316ns | 1ms, 358µs, 32ns | 2ms, 187µs, 967ns |
| symfony(compiled) | ^7.0 | 7ms, 564µs, 449ns | 5ms, 737µs, 66ns | 18ms, 593µs, 72ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 26ms, 875µs, 805ns | 9s, 950ms, 232µs, 982ns | 10s, 97ms, 174µs, 167ns |
| laminas-servicemanager | ^3.21 | 756µs, 120ns | 735µs, 44ns | 813µs, 961ns |
| laravel(singletons) | ^12.28 | 3ms, 416µs, 872ns | 3ms, 335µs, 952ns | 3ms, 715µs, 38ns |
| league-container | ^5.1 | 94s, 595ms, 794µs, 153ns | 94s, 8ms, 777µs, 141ns | 96s, 617ms, 712µs, 974ns |
| nette-di | ^3.2 | 3ms, 413µs, 391ns | 3ms, 344µs, 58ns | 3ms, 444µs, 910ns |
| php-di | ^7.0 | 852µs, 704ns | 784µs, 873ns | 1ms, 267µs, 910ns |
| pimple | ^3.5 | 10s, 36ms, 944µs, 937ns | 9s, 952ms, 785µs, 968ns | 10s, 143ms, 667µs, 221ns |
| quickly(compiled) | dev-master | 841µs, 188ns | 820µs, 159ns | 860µs, 214ns |
| quickly(configured) | dev-master | 1ms, 403µs, 546ns | 1ms, 294µs, 136ns | 2ms, 50µs, 876ns |
| quickly(reflection) | dev-master | 1ms, 362µs, 657ns | 1ms, 333µs, 951ns | 1ms, 515µs, 865ns |
| symfony(compiled) | ^7.0 | 2ms, 480µs, 697ns | 2ms, 190µs, 113ns | 3ms, 870µs, 964ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 42ms, 160µs, 105ns | 9s, 915ms, 210µs, 8ns | 10s, 138ms, 899µs, 87ns |
| laminas-servicemanager | ^3.21 | 955µs, 700ns | 829µs, 935ns | 1ms, 832µs, 8ns |
| laravel(singletons) | ^12.28 | 3ms, 755µs, 903ns | 3ms, 494µs, 24ns | 4ms, 869µs, 937ns |
| league-container | ^5.1 | 94s, 684ms, 505µs, 939ns | 94s, 3ms, 710µs, 31ns | 96s, 108ms, 168µs, 125ns |
| nette-di | ^3.2 | 5ms, 479µs, 884ns | 3ms, 404µs, 140ns | 23ms, 782µs, 14ns |
| php-di | ^7.0 | 1ms, 162µs, 147ns | 887µs, 870ns | 3ms, 391µs, 981ns |
| pimple | ^3.5 | 10s, 10ms, 963µs, 630ns | 9s, 888ms, 382µs, 911ns | 10s, 141ms, 746µs, 997ns |
| quickly(compiled) | dev-master | 810µs, 384ns | 778µs, 198ns | 839µs, 948ns |
| quickly(configured) | dev-master | 1ms, 502µs, 227ns | 1ms, 390µs, 933ns | 2ms, 200µs, 126ns |
| quickly(reflection) | dev-master | 1ms, 494µs, 121ns | 1ms, 394µs, 987ns | 2ms, 140µs, 45ns |
| symfony(compiled) | ^7.0 | 7ms, 242µs, 608ns | 5ms, 753µs, 993ns | 19ms, 709µs, 110ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 777µs, 959ns | 750µs, 64ns | 864µs, 28ns |
| laravel(singletons) | ^12.28 | 3ms, 513µs, 26ns | 3ms, 411µs, 54ns | 3ms, 885µs, 984ns |
| nette-di | ^3.2 | 3ms, 346µs, 204ns | 3ms, 278µs, 17ns | 3ms, 379µs, 106ns |
| php-di | ^7.0 | 902µs, 509ns | 809µs, 907ns | 1ms, 344µs, 203ns |
| quickly(compiled) | dev-master | 781µs, 106ns | 753µs, 879ns | 835µs, 895ns |
| quickly(configured) | dev-master | 1ms, 327µs, 323ns | 1ms, 280µs, 784ns | 1ms, 399µs, 40ns |
| quickly(reflection) | dev-master | 1ms, 389µs, 50ns | 1ms, 334µs, 905ns | 1ms, 599µs, 788ns |
| symfony(compiled) | ^7.0 | 3ms, 767µs, 371ns | 2ms, 222µs, 61ns | 4ms, 407µs, 167ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 948µs, 786ns | 854µs, 969ns | 1ms, 720µs, 905ns |
| laravel(singletons) | ^12.28 | 3ms, 688µs, 907ns | 3ms, 488µs, 63ns | 4ms, 777µs, 908ns |
| nette-di | ^3.2 | 5ms, 565µs, 953ns | 3ms, 338µs, 813ns | 25ms, 37µs, 50ns |
| php-di | ^7.0 | 1ms, 186µs, 13ns | 926µs, 17ns | 3ms, 388µs, 166ns |
| quickly(compiled) | dev-master | 894µs, 999ns | 795µs, 125ns | 1ms, 235µs, 961ns |
| quickly(configured) | dev-master | 1ms, 533µs, 746ns | 1ms, 415µs, 14ns | 2ms, 189µs, 159ns |
| quickly(reflection) | dev-master | 1ms, 728µs, 200ns | 1ms, 558µs, 65ns | 2ms, 635µs, 2ns |
| symfony(compiled) | ^7.0 | 7ms, 842µs, 922ns | 5ms, 951µs, 881ns | 19ms, 596µs, 99ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
