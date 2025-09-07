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
| aura-di | ^5.0 | 1ms, 735µs, 424ns | 1ms, 715µs, 898ns | 1ms, 754µs, 45ns |
| auryn | ^1.4 | 412ms, 97µs, 930ns | 403ms, 809µs, 785ns | 427ms, 95µs, 174ns |
| dice | ^4.0 | 72ms, 568µs, 488ns | 70ms, 106µs, 983ns | 78ms, 747µs, 34ns |
| laminas-servicemanager | ^3.21 | 802µs, 993ns | 782µs, 12ns | 823µs, 974ns |
| laravel(singletons) | ^12.28 | 4ms, 57µs, 192ns | 3ms, 921µs, 985ns | 4ms, 245µs, 42ns |
| laravel(unconfigured) | ^12.28 | 634ms, 393µs, 191ns | 625ms, 569µs, 105ns | 657ms, 989µs, 25ns |
| league-container | ^5.1 | 676ms, 953µs, 482ns | 655ms, 703µs, 67ns | 733ms, 712µs, 911ns |
| nette-di | ^3.2 | 3ms, 343µs, 9ns | 3ms, 258µs, 943ns | 3ms, 727µs, 197ns |
| php-di | ^7.0 | 846µs, 147ns | 797µs, 33ns | 1ms, 188µs, 993ns |
| pimple | ^3.5 | 78ms, 778µs, 767ns | 70ms, 54µs, 54ns | 92ms, 964µs, 887ns |
| quickly(configured) | dev-master | 1ms, 319µs, 742ns | 1ms, 301µs, 50ns | 1ms, 390µs, 218ns |
| quickly(reflection) | dev-master | 1ms, 313µs, 281ns | 1ms, 281µs, 976ns | 1ms, 478µs, 910ns |
| symfony(compiled) | ^7.0 | 2ms, 212µs, 500ns | 2ms, 187µs, 967ns | 2ms, 236µs, 127ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 89µs, 427ns | 3ms, 27µs, 915ns | 3ms, 239µs, 154ns |
| auryn | ^1.4 | 415ms, 675µs, 520ns | 401ms, 445µs, 865ns | 442ms, 844µs, 867ns |
| dice | ^4.0 | 71ms, 441µs, 316ns | 70ms, 682µs, 48ns | 72ms, 105µs, 169ns |
| laminas-servicemanager | ^3.21 | 874µs, 853ns | 768µs, 899ns | 1ms, 679µs, 182ns |
| laravel(singletons) | ^12.28 | 3ms, 660µs, 893ns | 3ms, 459µs, 930ns | 4ms, 798µs, 889ns |
| laravel(unconfigured) | ^12.28 | 632ms, 540µs, 583ns | 619ms, 821µs, 71ns | 650ms, 129µs, 79ns |
| league-container | ^5.1 | 663ms, 52µs, 248ns | 657ms, 196µs, 44ns | 667ms, 798µs, 995ns |
| nette-di | ^3.2 | 5ms, 708µs, 312ns | 3ms, 333µs, 91ns | 26ms, 806µs, 831ns |
| php-di | ^7.0 | 1ms, 272µs, 106ns | 907µs, 897ns | 3ms, 551µs, 6ns |
| pimple | ^3.5 | 70ms, 365µs, 285ns | 69ms, 555µs, 997ns | 72ms, 137µs, 832ns |
| quickly(configured) | dev-master | 1ms, 477µs, 909ns | 1ms, 376µs, 152ns | 2ms, 93µs, 76ns |
| quickly(reflection) | dev-master | 1ms, 476µs, 597ns | 1ms, 373µs, 52ns | 2ms, 80µs, 202ns |
| symfony(compiled) | ^7.0 | 7ms, 101µs, 440ns | 5ms, 721µs, 92ns | 18ms, 378µs, 973ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 57ms, 265µs, 615ns | 9s, 944ms, 921µs, 970ns | 10s, 241ms, 706µs, 132ns |
| laminas-servicemanager | ^3.21 | 799µs, 465ns | 769µs, 138ns | 825µs, 166ns |
| laravel(singletons) | ^12.28 | 3ms, 444µs, 504ns | 3ms, 391µs, 27ns | 3ms, 656µs, 864ns |
| league-container | ^5.1 | 94s, 674ms, 510µs, 216ns | 94s, 92ms, 565µs, 59ns | 96s, 110ms, 893µs, 11ns |
| nette-di | ^3.2 | 3ms, 406µs, 262ns | 3ms, 366µs, 947ns | 3ms, 580µs, 808ns |
| php-di | ^7.0 | 991µs, 773ns | 769µs, 138ns | 1ms, 282µs, 930ns |
| pimple | ^3.5 | 10s, 70ms, 46µs, 43ns | 9s, 885ms, 954µs, 141ns | 10s, 835ms, 78µs, 1ns |
| quickly(configured) | dev-master | 1ms, 338µs, 911ns | 1ms, 324µs, 892ns | 1ms, 373µs, 52ns |
| quickly(reflection) | dev-master | 1ms, 354µs, 718ns | 1ms, 311µs, 779ns | 1ms, 525µs, 878ns |
| symfony(compiled) | ^7.0 | 3ms, 245µs, 615ns | 2ms, 125µs, 978ns | 4ms, 121µs, 65ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 74ms, 887µs, 204ns | 9s, 949ms, 316µs, 24ns | 10s, 443ms, 830µs, 966ns |
| laminas-servicemanager | ^3.21 | 933µs, 408ns | 815µs, 868ns | 1ms, 720µs, 905ns |
| laravel(singletons) | ^12.28 | 3ms, 712µs, 439ns | 3ms, 515µs, 958ns | 4ms, 980µs, 87ns |
| league-container | ^5.1 | 94s, 808ms, 761µs, 668ns | 94s, 273ms, 654µs, 937ns | 95s, 470ms, 833µs, 63ns |
| nette-di | ^3.2 | 5ms, 669µs, 736ns | 3ms, 448µs, 963ns | 24ms, 80µs, 38ns |
| php-di | ^7.0 | 1ms, 195µs, 883ns | 886µs, 917ns | 3ms, 523µs, 111ns |
| pimple | ^3.5 | 9s, 958ms, 968µs, 949ns | 9s, 867ms, 820µs, 24ns | 10s, 88ms, 615µs, 894ns |
| quickly(configured) | dev-master | 1ms, 488µs, 900ns | 1ms, 404µs, 47ns | 2ms, 92µs, 838ns |
| quickly(reflection) | dev-master | 1ms, 468µs, 133ns | 1ms, 378µs, 59ns | 2ms, 123µs, 117ns |
| symfony(compiled) | ^7.0 | 7ms, 119µs, 226ns | 5ms, 810µs, 976ns | 18ms, 456µs, 935ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 868µs, 82ns | 778µs, 913ns | 1ms, 209µs, 974ns |
| laravel(singletons) | ^12.28 | 4ms, 580µs, 712ns | 4ms, 468µs, 202ns | 4ms, 926µs, 204ns |
| nette-di | ^3.2 | 3ms, 295µs, 588ns | 3ms, 245µs, 830ns | 3ms, 347µs, 873ns |
| php-di | ^7.0 | 858µs, 283ns | 787µs, 19ns | 1ms, 297µs, 950ns |
| quickly(configured) | dev-master | 1ms, 342µs, 177ns | 1ms, 316µs, 70ns | 1ms, 408µs, 815ns |
| quickly(reflection) | dev-master | 1ms, 391µs, 410ns | 1ms, 324µs, 176ns | 1ms, 655µs, 101ns |
| symfony(compiled) | ^7.0 | 2ms, 133µs, 83ns | 2ms, 91µs, 884ns | 2ms, 202µs, 33ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 1ms, 537µs, 942ns | 1ms, 363µs, 39ns | 2ms, 747µs, 58ns |
| laravel(singletons) | ^12.28 | 6ms, 74µs, 47ns | 3ms, 715µs, 991ns | 8ms, 640µs, 50ns |
| nette-di | ^3.2 | 5ms, 787µs, 324ns | 3ms, 587µs, 7ns | 24ms, 729µs, 13ns |
| php-di | ^7.0 | 1ms, 211µs, 524ns | 938µs, 892ns | 3ms, 481µs, 149ns |
| quickly(configured) | dev-master | 1ms, 501µs, 226ns | 1ms, 399µs, 40ns | 2ms, 92µs, 123ns |
| quickly(reflection) | dev-master | 1ms, 540µs, 17ns | 1ms, 441µs, 955ns | 2ms, 172µs, 946ns |
| symfony(compiled) | ^7.0 | 7ms, 282µs, 423ns | 5ms, 784µs, 34ns | 18ms, 434µs, 47ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
