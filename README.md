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
| aura-di | ^5.0 | 1ms, 743µs, 197ns | 1ms, 713µs, 37ns | 1ms, 796µs, 960ns |
| auryn | ^1.4 | 413ms, 942µs, 193ns | 403ms, 230µs, 905ns | 448ms, 914µs, 51ns |
| dice | ^4.0 | 71ms, 309µs, 995ns | 69ms, 611µs, 787ns | 77ms, 322µs, 6ns |
| laminas-servicemanager | ^3.21 | 774µs, 836ns | 758µs, 171ns | 802µs, 993ns |
| laravel(singletons) | ^12.28 | 3ms, 416µs, 419ns | 3ms, 344µs, 58ns | 3ms, 707µs, 885ns |
| laravel(unconfigured) | ^12.28 | 630ms, 229µs, 210ns | 619ms, 166µs, 135ns | 655ms, 365µs, 943ns |
| league-container | ^5.1 | 664ms, 202µs, 94ns | 660ms, 331µs, 964ns | 668ms, 748µs, 855ns |
| nette-di | ^3.2 | 3ms, 548µs, 669ns | 3ms, 421µs, 68ns | 4ms, 229µs, 68ns |
| php-di | ^7.0 | 830µs, 6ns | 780µs, 105ns | 1ms, 193µs, 46ns |
| pimple | ^3.5 | 70ms, 877µs, 861ns | 70ms, 288µs, 181ns | 72ms, 390µs, 79ns |
| quickly(configured) | dev-master | 1ms, 339µs, 650ns | 1ms, 317µs, 977ns | 1ms, 380µs, 920ns |
| quickly(reflection) | dev-master | 1ms, 423µs, 382ns | 1ms, 325µs, 845ns | 2ms, 15µs, 113ns |
| symfony(compiled) | ^7.0 | 2ms, 181µs, 792ns | 2ms, 160µs, 72ns | 2ms, 205µs, 848ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 588µs, 223ns | 3ms, 45µs, 82ns | 5ms, 151µs, 987ns |
| auryn | ^1.4 | 413ms, 231µs, 229ns | 404ms, 43ns | 420ms, 907µs, 20ns |
| dice | ^4.0 | 73ms, 437µs, 452ns | 70ms, 348µs, 978ns | 90ms, 976µs, 953ns |
| laminas-servicemanager | ^3.21 | 874µs, 304ns | 768µs, 184ns | 1ms, 639µs, 127ns |
| laravel(singletons) | ^12.28 | 3ms, 749µs, 394ns | 3ms, 385µs, 782ns | 5ms, 827µs, 188ns |
| laravel(unconfigured) | ^12.28 | 640ms, 505µs, 170ns | 628ms, 551µs, 6ns | 678ms, 359µs, 985ns |
| league-container | ^5.1 | 657ms, 178µs, 759ns | 653ms, 163µs, 909ns | 663ms, 163µs, 900ns |
| nette-di | ^3.2 | 5ms, 549µs, 49ns | 3ms, 301µs, 143ns | 23ms, 842µs, 96ns |
| php-di | ^7.0 | 1ms, 134µs, 85ns | 857µs, 830ns | 3ms, 400µs, 87ns |
| pimple | ^3.5 | 71ms, 784µs, 496ns | 69ms, 97µs, 995ns | 86ms, 30µs, 960ns |
| quickly(configured) | dev-master | 1ms, 470µs, 422ns | 1ms, 375µs, 913ns | 2ms, 164µs, 125ns |
| quickly(reflection) | dev-master | 1ms, 440µs, 405ns | 1ms, 348µs, 18ns | 2ms, 110µs, 958ns |
| symfony(compiled) | ^7.0 | 7ms, 170µs, 104ns | 5ms, 743µs, 26ns | 18ms, 467µs, 903ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 55ms, 163µs, 955ns | 9s, 882ms, 14µs, 36ns | 10s, 214ms, 326µs, 858ns |
| laminas-servicemanager | ^3.21 | 769µs, 972ns | 749µs, 111ns | 829µs, 935ns |
| laravel(singletons) | ^12.28 | 3ms, 427µs, 386ns | 3ms, 354µs, 72ns | 3ms, 787µs, 994ns |
| league-container | ^5.1 | 94s, 716ms, 213µs, 679ns | 93s, 985ms, 370µs, 159ns | 95s, 800ms, 846µs, 99ns |
| nette-di | ^3.2 | 3ms, 465µs, 318ns | 3ms, 399µs, 848ns | 3ms, 558µs, 158ns |
| php-di | ^7.0 | 837µs, 922ns | 772µs, 953ns | 1ms, 267µs, 194ns |
| pimple | ^3.5 | 10s, 343ms, 690µs, 61ns | 9s, 886ms, 482µs, 954ns | 12s, 122ms, 504µs, 949ns |
| quickly(configured) | dev-master | 1ms, 345µs, 300ns | 1ms, 325µs, 130ns | 1ms, 393µs, 79ns |
| quickly(reflection) | dev-master | 1ms, 346µs, 921ns | 1ms, 303µs, 195ns | 1ms, 497µs, 30ns |
| symfony(compiled) | ^7.0 | 3ms, 618µs, 192ns | 2ms, 177µs, 953ns | 3ms, 996µs, 133ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 85ms, 846µs, 805ns | 9s, 940ms, 68µs, 960ns | 10s, 265ms, 496µs, 969ns |
| laminas-servicemanager | ^3.21 | 919µs, 580ns | 805µs, 139ns | 1ms, 714µs, 944ns |
| laravel(singletons) | ^12.28 | 3ms, 673µs, 28ns | 3ms, 485µs, 918ns | 4ms, 812µs, 2ns |
| league-container | ^5.1 | 95s, 78ms, 667µs, 759ns | 93s, 991ms, 303µs, 920ns | 98s, 915ms, 714µs, 25ns |
| nette-di | ^3.2 | 5ms, 584µs, 430ns | 3ms, 401µs, 994ns | 25ms, 11µs, 62ns |
| php-di | ^7.0 | 1ms, 163µs, 792ns | 895µs, 977ns | 3ms, 376µs, 960ns |
| pimple | ^3.5 | 10s, 15ms, 542µs, 387ns | 9s, 867ms, 109µs, 60ns | 10s, 152ms, 889µs, 13ns |
| quickly(configured) | dev-master | 1ms, 482µs, 319ns | 1ms, 376µs, 152ns | 2ms, 213µs, 954ns |
| quickly(reflection) | dev-master | 1ms, 485µs, 800ns | 1ms, 392µs, 126ns | 2ms, 178µs, 907ns |
| symfony(compiled) | ^7.0 | 7ms, 411µs, 479ns | 5ms, 845µs, 69ns | 18ms, 630µs, 981ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 838µs, 232ns | 752µs, 210ns | 1ms, 161µs, 98ns |
| laravel(singletons) | ^12.28 | 3ms, 376µs, 102ns | 3ms, 297µs, 90ns | 3ms, 759µs, 860ns |
| nette-di | ^3.2 | 3ms, 514µs, 528ns | 3ms, 464µs, 221ns | 3ms, 577µs, 947ns |
| php-di | ^7.0 | 863µs, 289ns | 805µs, 139ns | 1ms, 298µs, 904ns |
| quickly(configured) | dev-master | 1ms, 394µs, 915ns | 1ms, 351µs, 118ns | 1ms, 452µs, 207ns |
| quickly(reflection) | dev-master | 1ms, 372µs, 385ns | 1ms, 328µs, 945ns | 1ms, 567µs, 840ns |
| symfony(compiled) | ^7.0 | 2ms, 190µs, 661ns | 2ms, 142µs, 906ns | 2ms, 329µs, 111ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 925µs, 183ns | 825µs, 881ns | 1ms, 703µs, 23ns |
| laravel(singletons) | ^12.28 | 4ms, 223µs, 179ns | 3ms, 893µs, 136ns | 5ms, 328µs, 893ns |
| nette-di | ^3.2 | 5ms, 732µs, 965ns | 3ms, 561µs, 19ns | 24ms, 750µs, 947ns |
| php-di | ^7.0 | 1ms, 208µs, 567ns | 938µs, 892ns | 3ms, 411µs, 54ns |
| quickly(configured) | dev-master | 1ms, 538µs, 610ns | 1ms, 410µs, 961ns | 2ms, 225µs, 160ns |
| quickly(reflection) | dev-master | 1ms, 590µs, 538ns | 1ms, 479µs, 864ns | 2ms, 251µs, 148ns |
| symfony(compiled) | ^7.0 | 7ms, 512µs, 116ns | 5ms, 948µs, 66ns | 20ms, 946µs, 25ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
