# PHP Dependency Injection Benchmark

This repository benchmarks different dependency injection containers.

The "quickly" container is maintained by the same author as this benchmark, and the results may be unconsciously biased.

## Environment

| Component | Version |
| --- | --- |
| PHP | 8.4 |

## f06

Small dependency graph including 6 classes total (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 931µs, 691ns | 1ms, 729µs, 965ns | 3ms, 113µs, 985ns |
| auryn | ^1.4 | 411ms, 792µs, 969ns | 402ms, 759µs, 75ns | 419ms, 886µs, 112ns |
| dice | ^4.0 | 70ms, 780µs, 86ns | 70ms, 32µs, 119ns | 72ms, 811µs, 126ns |
| laminas-servicemanager | ^3.21 | 809µs, 97ns | 745µs, 58ns | 1ms, 167µs, 58ns |
| laravel(singletons) | ^12.28 | 3ms, 750µs, 586ns | 3ms, 386µs, 974ns | 5ms, 868µs, 911ns |
| laravel(unconfigured) | ^12.28 | 631ms, 187µs, 81ns | 620ms, 640µs, 993ns | 640ms, 774µs, 965ns |
| league-container | ^5.1 | 664ms, 487µs, 457ns | 659ms, 137µs, 10ns | 671ms, 579µs, 837ns |
| nette-di | ^3.2 | 3ms, 423µs, 976ns | 3ms, 367µs, 185ns | 3ms, 528µs, 833ns |
| php-di | ^7.0 | 892µs, 329ns | 833µs, 988ns | 1ms, 244µs, 68ns |
| pimple | ^3.5 | 72ms, 908µs, 520ns | 69ms, 802µs, 45ns | 76ms, 972µs, 961ns |
| quickly(compiled) | dev-master | 808µs, 95ns | 775µs, 98ns | 941µs, 991ns |
| quickly(configured) | dev-master | 1ms, 408µs, 696ns | 1ms, 311µs, 63ns | 2ms, 17µs, 21ns |
| quickly(reflection) | dev-master | 1ms, 369µs, 404ns | 1ms, 337µs, 51ns | 1ms, 469µs, 135ns |
| symfony(compiled) | ^7.0 | 2ms, 213µs, 597ns | 2ms, 171µs, 993ns | 2ms, 259µs, 969ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 94µs, 124ns | 3ms, 45µs, 797ns | 3ms, 155µs, 946ns |
| auryn | ^1.4 | 409ms, 663µs, 81ns | 403ms, 403µs, 43ns | 423ms, 283µs, 100ns |
| dice | ^4.0 | 71ms, 358µs, 680ns | 70ms, 588µs, 111ns | 72ms, 736µs, 978ns |
| laminas-servicemanager | ^3.21 | 868µs, 535ns | 766µs, 992ns | 1ms, 646µs, 41ns |
| laravel(singletons) | ^12.28 | 3ms, 680µs, 968ns | 3ms, 485µs, 202ns | 4ms, 959µs, 821ns |
| laravel(unconfigured) | ^12.28 | 628ms, 980µs, 255ns | 623ms, 903µs, 36ns | 632ms, 767µs, 915ns |
| league-container | ^5.1 | 662ms, 480µs, 44ns | 657ms, 68µs, 967ns | 668ms, 638µs, 229ns |
| nette-di | ^3.2 | 5ms, 360µs, 341ns | 3ms, 301µs, 143ns | 23ms, 565µs, 53ns |
| php-di | ^7.0 | 1ms, 169µs, 347ns | 862µs, 121ns | 3ms, 620µs, 147ns |
| pimple | ^3.5 | 70ms, 690µs, 560ns | 69ms, 415µs, 807ns | 72ms, 613µs, 954ns |
| quickly(compiled) | dev-master | 790µs, 95ns | 770µs, 92ns | 855µs, 207ns |
| quickly(configured) | dev-master | 1ms, 466µs, 464ns | 1ms, 378µs, 59ns | 2ms, 113µs, 819ns |
| quickly(reflection) | dev-master | 1ms, 467µs, 227ns | 1ms, 360µs, 177ns | 2ms, 187µs, 13ns |
| symfony(compiled) | ^7.0 | 7ms, 309µs, 79ns | 5ms, 728µs, 960ns | 18ms, 315µs, 76ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 55ms, 988µs, 144ns | 9s, 859ms, 770µs, 774ns | 10s, 238ms, 904µs, 953ns |
| laminas-servicemanager | ^3.21 | 777µs, 316ns | 742µs, 912ns | 832µs, 80ns |
| laravel(singletons) | ^12.28 | 3ms, 659µs, 224ns | 3ms, 380µs, 60ns | 5ms, 136µs, 966ns |
| league-container | ^5.1 | 94s, 753ms, 268µs, 74ns | 93s, 985ms, 346µs, 78ns | 96s, 620ms, 261µs, 907ns |
| nette-di | ^3.2 | 3ms, 529µs, 953ns | 3ms, 303µs, 50ns | 4ms, 832µs, 983ns |
| php-di | ^7.0 | 844µs, 359ns | 789µs, 880ns | 1ms, 229µs, 47ns |
| pimple | ^3.5 | 10s, 20ms, 246µs, 505ns | 9s, 904ms, 633µs, 998ns | 10s, 128ms, 499µs, 31ns |
| quickly(compiled) | dev-master | 785µs, 827ns | 765µs, 85ns | 828µs, 27ns |
| quickly(configured) | dev-master | 1ms, 357µs, 293ns | 1ms, 312µs, 971ns | 1ms, 450µs, 777ns |
| quickly(reflection) | dev-master | 1ms, 349µs, 401ns | 1ms, 323µs, 938ns | 1ms, 467µs, 943ns |
| symfony(compiled) | ^7.0 | 2ms, 347µs, 493ns | 1ms, 997µs, 947ns | 3ms, 904µs, 104ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 31ms, 120µs, 896ns | 9s, 890ms, 293µs, 836ns | 10s, 134ms, 934µs, 902ns |
| laminas-servicemanager | ^3.21 | 922µs, 107ns | 764µs, 131ns | 1ms, 709µs, 938ns |
| laravel(singletons) | ^12.28 | 3ms, 655µs, 195ns | 3ms, 402µs, 948ns | 5ms, 367µs, 40ns |
| league-container | ^5.1 | 94s, 323ms, 582µs, 887ns | 91s, 578ms, 308µs, 105ns | 95s, 376ms, 930µs, 952ns |
| nette-di | ^3.2 | 6ms, 440µs, 997ns | 3ms, 304µs, 4ns | 34ms, 1µs, 111ns |
| php-di | ^7.0 | 1ms, 137µs, 614ns | 871µs, 896ns | 3ms, 369µs, 92ns |
| pimple | ^3.5 | 10s, 3ms, 661µs, 823ns | 9s, 855ms, 681µs, 180ns | 10s, 151ms, 304µs, 6ns |
| quickly(compiled) | dev-master | 806µs, 975ns | 796µs, 794ns | 825µs, 881ns |
| quickly(configured) | dev-master | 1ms, 483µs, 201ns | 1ms, 364µs, 946ns | 2ms, 120µs, 18ns |
| quickly(reflection) | dev-master | 1ms, 535µs, 701ns | 1ms, 446µs, 8ns | 2ms, 238µs, 35ns |
| symfony(compiled) | ^7.0 | 7ms, 36µs, 423ns | 5ms, 712µs, 985ns | 18ms, 169µs, 164ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 1ms, 77µs, 556ns | 751µs, 972ns | 1ms, 394µs, 987ns |
| laravel(singletons) | ^12.28 | 3ms, 858µs, 399ns | 3ms, 412µs, 8ns | 6ms, 896µs, 18ns |
| nette-di | ^3.2 | 3ms, 440µs, 403ns | 3ms, 379µs, 821ns | 3ms, 489µs, 971ns |
| php-di | ^7.0 | 845µs, 74ns | 780µs, 105ns | 1ms, 312µs, 17ns |
| quickly(compiled) | dev-master | 797µs, 486ns | 769µs, 853ns | 830µs, 888ns |
| quickly(configured) | dev-master | 1ms, 409µs, 196ns | 1ms, 383µs, 66ns | 1ms, 466µs, 989ns |
| quickly(reflection) | dev-master | 1ms, 386µs, 809ns | 1ms, 349µs, 925ns | 1ms, 574µs, 993ns |
| symfony(compiled) | ^7.0 | 2ms, 200µs, 293ns | 2ms, 159µs, 833ns | 2ms, 236µs, 127ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 947µs, 499ns | 836µs, 133ns | 1ms, 676µs, 82ns |
| laravel(singletons) | ^12.28 | 3ms, 796µs, 505ns | 3ms, 606µs, 81ns | 4ms, 968µs, 881ns |
| nette-di | ^3.2 | 5ms, 822µs, 181ns | 3ms, 458µs, 976ns | 24ms, 102µs, 926ns |
| php-di | ^7.0 | 1ms, 188µs, 921ns | 916µs, 4ns | 3ms, 463µs, 29ns |
| quickly(compiled) | dev-master | 789µs, 213ns | 764µs, 846ns | 809µs, 192ns |
| quickly(configured) | dev-master | 1ms, 509µs, 284ns | 1ms, 410µs, 961ns | 2ms, 196µs, 73ns |
| quickly(reflection) | dev-master | 1ms, 599µs, 73ns | 1ms, 497µs, 983ns | 2ms, 294µs, 778ns |
| symfony(compiled) | ^7.0 | 7ms, 192µs, 325ns | 5ms, 853µs, 891ns | 18ms, 653µs, 154ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
