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
| aura-di | ^5.0 | 1ms, 985µs, 192ns | 1ms, 720µs, 905ns | 3ms, 170µs, 13ns |
| auryn | ^1.4 | 408ms, 96µs, 337ns | 402ms, 72µs, 906ns | 416ms, 537µs, 46ns |
| dice | ^4.0 | 70ms, 449µs, 709ns | 69ms, 370µs, 985ns | 72ms, 736µs, 24ns |
| laminas-servicemanager | ^3.21 | 792µs, 407ns | 771µs, 45ns | 813µs, 961ns |
| laravel(singletons) | ^12.28 | 3ms, 685µs, 92ns | 3ms, 477µs, 811ns | 5ms, 115µs, 985ns |
| laravel(unconfigured) | ^12.28 | 631ms, 490µs, 659ns | 604ms, 912µs, 996ns | 663ms, 403µs, 987ns |
| league-container | ^5.1 | 659ms, 912µs, 61ns | 655ms, 283µs, 927ns | 664ms, 12µs, 908ns |
| nette-di | ^3.2 | 3ms, 429µs, 245ns | 3ms, 374µs, 99ns | 3ms, 467µs, 82ns |
| php-di | ^7.0 | 842µs, 404ns | 787µs, 19ns | 1ms, 204µs, 13ns |
| pimple | ^3.5 | 74ms, 294µs, 686ns | 70ms, 141µs, 77ns | 101ms, 407µs, 51ns |
| quickly(configured) | dev-master | 1ms, 390µs, 290ns | 1ms, 343µs, 965ns | 1ms, 477µs, 956ns |
| quickly(reflection) | dev-master | 1ms, 403µs, 379ns | 1ms, 294µs, 136ns | 2ms, 45µs, 154ns |
| symfony(compiled) | ^7.0 | 2ms, 231µs, 73ns | 2ms, 158µs, 880ns | 2ms, 588µs, 33ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 157µs, 925ns | 3ms, 67µs, 970ns | 3ms, 437µs, 995ns |
| auryn | ^1.4 | 409ms, 272µs, 861ns | 398ms, 673µs, 57ns | 418ms, 361µs, 902ns |
| dice | ^4.0 | 72ms, 254µs, 681ns | 70ms, 360µs, 898ns | 79ms, 212µs, 903ns |
| laminas-servicemanager | ^3.21 | 895µs, 786ns | 792µs, 26ns | 1ms, 704µs, 931ns |
| laravel(singletons) | ^12.28 | 3ms, 626µs, 227ns | 3ms, 422µs, 975ns | 4ms, 806µs, 995ns |
| laravel(unconfigured) | ^12.28 | 636ms, 935µs, 305ns | 627ms, 766µs, 132ns | 647ms, 811µs, 889ns |
| league-container | ^5.1 | 658ms, 648µs, 443ns | 653ms, 930µs, 902ns | 672ms, 68µs, 119ns |
| nette-di | ^3.2 | 5ms, 715µs, 632ns | 3ms, 476µs, 142ns | 25ms, 501µs, 966ns |
| php-di | ^7.0 | 1ms, 123µs, 809ns | 863µs, 75ns | 3ms, 362µs, 894ns |
| pimple | ^3.5 | 73ms, 571µs, 62ns | 70ms, 513µs, 10ns | 83ms, 580µs, 17ns |
| quickly(configured) | dev-master | 1ms, 498µs, 103ns | 1ms, 385µs, 927ns | 2ms, 125µs, 24ns |
| quickly(reflection) | dev-master | 1ms, 446µs, 723ns | 1ms, 350µs, 164ns | 2ms, 1µs, 47ns |
| symfony(compiled) | ^7.0 | 7ms, 121µs, 992ns | 5ms, 803µs, 108ns | 18ms, 573µs, 45ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 29ms, 459µs, 619ns | 9s, 908ms, 339µs, 977ns | 10s, 171ms, 287µs, 59ns |
| laminas-servicemanager | ^3.21 | 793µs, 695ns | 769µs, 853ns | 833µs, 988ns |
| laravel(singletons) | ^12.28 | 3ms, 433µs, 346ns | 3ms, 365µs, 39ns | 3ms, 646µs, 135ns |
| league-container | ^5.1 | 94s, 439ms, 393µs, 496ns | 93s, 989ms, 285µs, 945ns | 94s, 956ms, 547µs, 975ns |
| nette-di | ^3.2 | 3ms, 352µs, 618ns | 3ms, 269µs, 910ns | 3ms, 695µs, 11ns |
| php-di | ^7.0 | 845µs, 861ns | 759µs, 124ns | 1ms, 230µs, 1ns |
| pimple | ^3.5 | 10s, 168ms, 408µs, 274ns | 9s, 918ms, 779µs, 850ns | 10s, 986ms, 203µs, 908ns |
| quickly(configured) | dev-master | 1ms, 352µs | 1ms, 312µs, 17ns | 1ms, 411µs, 914ns |
| quickly(reflection) | dev-master | 1ms, 957µs, 607ns | 1ms, 317µs, 977ns | 2ms, 641µs, 916ns |
| symfony(compiled) | ^7.0 | 2ms, 86µs, 973ns | 2ms, 61µs, 843ns | 2ms, 120µs, 971ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice | ^4.0 | 10s, 89ms, 553µs, 928ns | 9s, 910ms, 838µs, 842ns | 10s, 355ms, 547µs, 189ns |
| laminas-servicemanager | ^3.21 | 917µs, 29ns | 799µs, 894ns | 1ms, 724µs, 958ns |
| laravel(singletons) | ^12.28 | 3ms, 712µs, 368ns | 3ms, 553µs, 152ns | 4ms, 822µs, 15ns |
| league-container | ^5.1 | 94s, 685ms, 603µs, 618ns | 93s, 981ms, 298µs, 208ns | 96s, 334ms, 304µs, 94ns |
| nette-di | ^3.2 | 5ms, 724µs, 620ns | 3ms, 441µs, 95ns | 26ms, 40µs, 792ns |
| php-di | ^7.0 | 1ms, 142µs, 120ns | 870µs, 943ns | 3ms, 382µs, 205ns |
| pimple | ^3.5 | 10s, 2ms, 288µs, 103ns | 9s, 891ms, 567µs, 945ns | 10s, 144ms, 313µs, 97ns |
| quickly(configured) | dev-master | 1ms, 527µs, 547ns | 1ms, 347µs, 64ns | 2ms, 121µs, 925ns |
| quickly(reflection) | dev-master | 1ms, 495µs, 933ns | 1ms, 386µs, 165ns | 2ms, 115µs, 964ns |
| symfony(compiled) | ^7.0 | 7ms, 268µs, 619ns | 5ms, 795µs, 1ns | 18ms, 445µs, 14ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 771µs, 665ns | 751µs, 18ns | 855µs, 922ns |
| laravel(singletons) | ^12.28 | 3ms, 504µs, 586ns | 3ms, 381µs, 967ns | 3ms, 854µs, 36ns |
| nette-di | ^3.2 | 3ms, 393µs, 793ns | 3ms, 354µs, 72ns | 3ms, 459µs, 215ns |
| php-di | ^7.0 | 893µs, 115ns | 747µs, 919ns | 1ms, 636µs, 28ns |
| quickly(configured) | dev-master | 2ms, 300µs, 691ns | 2ms, 220µs, 153ns | 2ms, 487µs, 897ns |
| quickly(reflection) | dev-master | 1ms, 344µs, 609ns | 1ms, 288µs, 890ns | 1ms, 611µs, 948ns |
| symfony(compiled) | ^7.0 | 2ms, 153µs, 682ns | 2ms, 120µs, 971ns | 2ms, 243µs, 41ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 929µs, 999ns | 820µs, 875ns | 1ms, 708µs, 30ns |
| laravel(singletons) | ^12.28 | 4ms, 41µs, 695ns | 3ms, 654µs, 3ns | 5ms, 622µs, 148ns |
| nette-di | ^3.2 | 5ms, 486µs, 106ns | 3ms, 390µs, 73ns | 24ms, 58µs, 103ns |
| php-di | ^7.0 | 1ms, 506µs, 900ns | 1ms, 214µs, 981ns | 3ms, 720µs, 45ns |
| quickly(configured) | dev-master | 1ms, 627µs, 87ns | 1ms, 523µs, 971ns | 2ms, 301µs, 931ns |
| quickly(reflection) | dev-master | 1ms, 559µs, 948ns | 1ms, 454µs, 830ns | 2ms, 187µs, 967ns |
| symfony(compiled) | ^7.0 | 7ms, 263µs, 898ns | 5ms, 811µs, 929ns | 18ms, 557µs, 71ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
