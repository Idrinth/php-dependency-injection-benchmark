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
| aura-di | ^5.0 | 1ms, 781µs, 82ns | 1ms, 701µs, 116ns | 1ms, 964µs, 807ns |
| auryn | ^1.4 | 411ms, 144µs, 208ns | 403ms, 821µs, 945ns | 425ms, 949µs, 811ns |
| dice | ^4.0 | 71ms, 473µs, 2ns | 69ms, 774µs, 150ns | 77ms, 390µs, 193ns |
| laminas-servicemanager | ^3.21 | 797µs, 605ns | 774µs, 860ns | 840µs, 187ns |
| laravel(singletons) | ^12.28 | 3ms, 503µs, 251ns | 3ms, 440µs, 856ns | 3ms, 704µs, 71ns |
| laravel(unconfigured) | ^12.28 | 633ms, 799µs, 648ns | 627ms, 207µs, 40ns | 647ms, 363µs, 901ns |
| league-container | ^5.1 | 663ms, 82µs, 3ns | 658ms, 436µs, 59ns | 668ms, 51µs, 4ns |
| nette-di | ^3.2 | 3ms, 474µs, 20ns | 3ms, 415µs, 107ns | 3ms, 571µs, 987ns |
| php-di | ^7.0 | 850µs, 701ns | 791µs, 72ns | 1ms, 275µs, 62ns |
| pimple | ^3.5 | 71ms, 392µs, 655ns | 70ms, 37µs, 126ns | 72ms, 761µs, 58ns |
| quickly(compiled) | dev-master | 785µs, 255ns | 764µs, 846ns | 832µs, 796ns |
| quickly(configured) | dev-master | 1ms, 336µs, 193ns | 1ms, 302µs, 3ns | 1ms, 375µs, 913ns |
| quickly(reflection) | dev-master | 1ms, 375µs, 389ns | 1ms, 354µs, 932ns | 1ms, 455µs, 68ns |
| symfony(compiled) | ^7.0 | 2ms, 198µs, 362ns | 2ms, 175µs, 92ns | 2ms, 218µs, 8ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 113µs, 317ns | 3ms, 32µs, 922ns | 3ms, 261µs, 89ns |
| auryn | ^1.4 | 413ms, 340µs, 950ns | 405ms, 347µs, 108ns | 440ms, 99µs, 954ns |
| dice | ^4.0 | 75ms, 467µs, 491ns | 70ms, 665µs, 121ns | 95ms, 614µs, 910ns |
| laminas-servicemanager | ^3.21 | 843µs, 119ns | 724µs, 792ns | 1ms, 701µs, 116ns |
| laravel(singletons) | ^12.28 | 3ms, 774µs, 404ns | 3ms, 391µs, 981ns | 5ms, 192µs, 41ns |
| laravel(unconfigured) | ^12.28 | 637ms, 982µs, 487ns | 625ms, 293µs, 16ns | 709ms, 218µs, 978ns |
| league-container | ^5.1 | 678ms, 902µs, 578ns | 663ms, 856µs, 983ns | 694ms, 556µs, 951ns |
| nette-di | ^3.2 | 5ms, 489µs, 253ns | 3ms, 271µs, 818ns | 25ms, 71µs, 859ns |
| php-di | ^7.0 | 1ms, 100µs, 206ns | 844µs, 1ns | 3ms, 273µs, 10ns |
| pimple | ^3.5 | 73ms, 636µs, 221ns | 70ms, 718µs, 50ns | 77ms, 105µs, 998ns |
| quickly(compiled) | dev-master | 808µs | 784µs, 873ns | 836µs, 849ns |
| quickly(configured) | dev-master | 1ms, 496µs, 315ns | 1ms, 394µs, 987ns | 2ms, 150µs, 58ns |
| quickly(reflection) | dev-master | 1ms, 456µs, 22ns | 1ms, 350µs, 879ns | 2ms, 166µs, 986ns |
| symfony(compiled) | ^7.0 | 7ms, 122µs, 778ns | 5ms, 795µs, 1ns | 18ms, 643µs, 856ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 45ms, 691µs, 490ns | 9s, 842ms, 571µs, 973ns | 10s, 437ms, 299µs, 13ns |
| laminas-servicemanager | ^3.21 | 795µs, 197ns | 779µs, 867ns | 812µs, 53ns |
| laravel(singletons) | ^12.28 | 3ms, 541µs, 88ns | 3ms, 353µs, 118ns | 4ms, 289µs, 865ns |
| league-container | ^5.1 | 94s, 699ms, 480µs, 509ns | 93s, 663ms, 696µs, 50ns | 95s, 989ms, 327µs, 192ns |
| nette-di | ^3.2 | 3ms, 611µs, 445ns | 3ms, 334µs, 999ns | 4ms, 758µs, 834ns |
| php-di | ^7.0 | 831µs, 890ns | 766µs, 38ns | 1ms, 207µs, 828ns |
| pimple | ^3.5 | 9s, 948ms, 954µs, 81ns | 9s, 824ms, 749µs, 946ns | 10s, 101ms, 452µs, 112ns |
| quickly(compiled) | dev-master | 996µs, 232ns | 855µs, 922ns | 1ms, 295µs, 89ns |
| quickly(configured) | dev-master | 1ms, 341µs, 891ns | 1ms, 318µs, 931ns | 1ms, 363µs, 992ns |
| quickly(reflection) | dev-master | 1ms, 358µs, 318ns | 1ms, 331µs, 90ns | 1ms, 503µs, 944ns |
| symfony(compiled) | ^7.0 | 2ms, 183µs, 389ns | 2ms, 119µs, 64ns | 2ms, 523µs, 899ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 70ms, 850µs, 777ns | 9s, 872ms, 567µs, 892ns | 10s, 376ms, 974µs, 105ns |
| laminas-servicemanager | ^3.21 | 903µs, 558ns | 792µs, 26ns | 1ms, 665µs, 830ns |
| laravel(singletons) | ^12.28 | 3ms, 667µs, 283ns | 3ms, 477µs, 811ns | 4ms, 804µs, 849ns |
| league-container | ^5.1 | 94s, 750ms, 590µs, 896ns | 93s, 600ms, 183µs, 963ns | 95s, 693ms, 965µs, 911ns |
| nette-di | ^3.2 | 5ms, 529µs, 403ns | 3ms, 504µs, 991ns | 23ms, 423µs, 910ns |
| php-di | ^7.0 | 1ms, 130µs, 580ns | 856µs, 876ns | 3ms, 358µs, 840ns |
| pimple | ^3.5 | 9s, 985ms, 473µs, 418ns | 9s, 833ms, 837µs, 985ns | 10s, 96ms, 40µs, 10ns |
| quickly(compiled) | dev-master | 923µs, 943ns | 766µs, 992ns | 1ms, 82µs, 181ns |
| quickly(configured) | dev-master | 1ms, 507µs, 687ns | 1ms, 401µs, 901ns | 2ms, 115µs, 964ns |
| quickly(reflection) | dev-master | 1ms, 473µs, 259ns | 1ms, 379µs, 966ns | 2ms, 151µs, 966ns |
| symfony(compiled) | ^7.0 | 7ms, 276µs, 582ns | 5ms, 918µs, 25ns | 18ms, 435µs, 1ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 786µs, 209ns | 764µs, 131ns | 836µs, 133ns |
| laravel(singletons) | ^12.28 | 3ms, 571µs, 820ns | 3ms, 442µs, 49ns | 3ms, 855µs, 228ns |
| nette-di | ^3.2 | 3ms, 537µs, 988ns | 3ms, 453µs, 16ns | 3ms, 938µs, 198ns |
| php-di | ^7.0 | 833µs, 177ns | 751µs, 972ns | 1ms, 283µs, 884ns |
| quickly(compiled) | dev-master | 795µs, 292ns | 777µs, 6ns | 817µs, 60ns |
| quickly(configured) | dev-master | 1ms, 359µs, 367ns | 1ms, 332µs, 998ns | 1ms, 505µs, 851ns |
| quickly(reflection) | dev-master | 1ms, 369µs, 667ns | 1ms, 309µs, 871ns | 1ms, 587µs, 867ns |
| symfony(compiled) | ^7.0 | 2ms, 310µs, 538ns | 2ms, 274µs, 36ns | 2ms, 362µs, 966ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 955µs, 390ns | 856µs, 876ns | 1ms, 721µs, 858ns |
| laravel(singletons) | ^12.28 | 3ms, 837µs, 776ns | 3ms, 630µs, 876ns | 4ms, 920µs, 959ns |
| nette-di | ^3.2 | 5ms, 564µs, 808ns | 3ms, 444µs, 910ns | 24ms, 290µs, 84ns |
| php-di | ^7.0 | 1ms, 209µs, 44ns | 942µs, 230ns | 3ms, 420µs, 114ns |
| quickly(compiled) | dev-master | 836µs, 300ns | 807µs, 46ns | 860µs, 929ns |
| quickly(configured) | dev-master | 1ms, 556µs, 277ns | 1ms, 461µs, 29ns | 2ms, 221µs, 822ns |
| quickly(reflection) | dev-master | 1ms, 608µs, 490ns | 1ms, 497µs, 983ns | 2ms, 337µs, 217ns |
| symfony(compiled) | ^7.0 | 7ms, 121µs, 491ns | 5ms, 757µs, 93ns | 18ms, 71µs, 174ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
