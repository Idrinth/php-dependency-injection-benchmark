# PHP Dependency Injection Benchmark

This repository benchmarks different dependency injection containers.

## Environment

| Component | Version |
| --- | --- |
| PHP | 8.4 |

## f06

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms 592ns | 1ms 960ns | 1ms 927ns |
| auryn | ^1.4 | 406ms 943ns | 402ms 56ns | 413ms 7ns |
| dice | ^4.0 | 71ms 0ns | 70ms 994ns | 72ms 26ns |
| laminas-servicemanager | ^3.21 | 486ns | 972ns | 802ns |
| laravel(singletons) | ^12.28 | 3ms 897ns | 3ms 936ns | 3ms 32ns |
| laravel(unconfigured) | ^12.28 | 632ms 890ns | 625ms 960ns | 643ms 69ns |
| league-container | ^5.1 | 663ms 997ns | 658ms 47ns | 667ms 33ns |
| nette-di | ^3.2 | 3ms 110ns | 3ms 84ns | 3ms 999ns |
| php-di | ^7.0 | 854ns | 855ns | 1ms 914ns |
| pimple | ^3.5 | 72ms 664ns | 69ms 783ns | 76ms 881ns |
| quickly(configured) | dev-master | 3ms 71ns | 3ms 1ns | 4ms 91ns |
| quickly(reflection) | dev-master | 3ms 260ns | 3ms 34ns | 4ms 131ns |
| symfony(compiled) | ^7.0 | 2ms 556ns | 2ms 946ns | 4ms 824ns |

![f06](speed_comparison_without_startup06.jpg)

## f06 startup

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms 912ns | 1ms 975ns | 3ms 162ns |
| auryn | ^1.4 | 409ms 956ns | 404ms 988ns | 415ms 58ns |
| dice | ^4.0 | 71ms 960ns | 70ms 970ns | 73ms 994ns |
| laminas-servicemanager | ^3.21 | 544ns | 165ns | 1ms 850ns |
| laravel(singletons) | ^12.28 | 3ms 831ns | 3ms 61ns | 4ms 172ns |
| laravel(unconfigured) | ^12.28 | 636ms 378ns | 624ms 971ns | 662ms 115ns |
| league-container | ^5.1 | 659ms 402ns | 656ms 940ns | 662ms 40ns |
| nette-di | ^3.2 | 5ms 414ns | 3ms 26ns | 25ms 820ns |
| php-di | ^7.0 | 1ms 892ns | 43ns | 3ms 940ns |
| pimple | ^3.5 | 72ms 494ns | 70ms 872ns | 74ms 42ns |
| quickly(configured) | dev-master | 3ms 372ns | 3ms 809ns | 4ms 967ns |
| quickly(reflection) | dev-master | 4ms 313ns | 3ms 994ns | 5ms 139ns |
| symfony(compiled) | ^7.0 | 7ms 9ns | 5ms 80ns | 18ms 973ns |

![f06 startup](speed_comparison_with_startup06.jpg)

## p16

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 0.001935601234436 | 0.0015239715576172 | 0.0053360462188721 |
| auryn | ^1.4 | 56.920225071907 | 56.062252998352 | 57.731900930405 |
| dice | ^4.0 | 10.058168983459 | 9.8878288269043 | 10.231369972229 |
| laminas-servicemanager | ^3.21 | 0.00076651573181152 | 0.00073790550231934 | 0.00082206726074219 |
| laravel(singletons) | ^12.28 | 0.0037410736083984 | 0.0036449432373047 | 0.0038349628448486 |
| league-container | ^5.1 | 94.554370284081 | 92.884249925613 | 95.842878818512 |
| nette-di | ^3.2 | 0.0034586429595947 | 0.00341796875 | 0.0034971237182617 |
| php-di | ^7.0 | 0.00091826915740967 | 0.00076413154602051 | 0.00124192237854 |
| pimple | ^3.5 | 9.9657631397247 | 9.5901031494141 | 10.140274047852 |
| quickly(configured) | dev-master | 0.0038540124893188 | 0.0038139820098877 | 0.0039381980895996 |
| quickly(reflection) | dev-master | 0.0038012027740479 | 0.0037510395050049 | 0.0040109157562256 |
| symfony(compiled) | ^7.0 | 0.0022711277008057 | 0.0021870136260986 | 0.002669095993042 |

![p16](speed_comparison_without_startup16.jpg)

## p16 startup

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 0.0053651094436646 | 0.0051369667053223 | 0.0067150592803955 |
| auryn | ^1.4 | 56.921222734451 | 56.350102901459 | 57.453171014786 |
| dice | ^4.0 | 10.063756418228 | 9.9208590984344 | 10.177135944366 |
| laminas-servicemanager | ^3.21 | 0.00093011856079102 | 0.00083208084106445 | 0.0017061233520508 |
| laravel(singletons) | ^12.28 | 0.0048728227615356 | 0.0047008991241455 | 0.00506591796875 |
| league-container | ^5.1 | 94.63632004261 | 93.666184902191 | 95.411398172379 |
| nette-di | ^3.2 | 0.0055256128311157 | 0.0034308433532715 | 0.023674011230469 |
| php-di | ^7.0 | 0.0011602163314819 | 0.00088906288146973 | 0.0034031867980957 |
| pimple | ^3.5 | 10.026159381866 | 9.8651690483093 | 10.520985841751 |
| quickly(configured) | dev-master | 0.0039068937301636 | 0.0038108825683594 | 0.004429817199707 |
| quickly(reflection) | dev-master | 0.0039932012557983 | 0.0038619041442871 | 0.0046029090881348 |
| symfony(compiled) | ^7.0 | 0.007149338722229 | 0.0057320594787598 | 0.01869010925293 |

![p16 startup](speed_comparison_with_startup16.jpg)

## z26

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 0.3439067363739 | 0.0015339851379395 | 3.4251179695129 |
| laminas-servicemanager | ^3.21 | 0.00076429843902588 | 0.00072383880615234 | 0.0008399486541748 |
| nette-di | ^3.2 | 0.0033317089080811 | 0.003303050994873 | 0.003371000289917 |
| php-di | ^7.0 | 0.00084259510040283 | 0.00075197219848633 | 0.0013070106506348 |
| quickly(configured) | dev-master | 0.0038496017456055 | 0.0037920475006104 | 0.0039241313934326 |
| quickly(reflection) | dev-master | 0.0039045810699463 | 0.0038390159606934 | 0.0041160583496094 |
| symfony(compiled) | ^7.0 | 0.0021575689315796 | 0.0021350383758545 | 0.0022017955780029 |

![z26](speed_comparison_without_startup26.jpg)

## z26 startup

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3.3955820798874 | 3.3548929691315 | 3.4243848323822 |
| laminas-servicemanager | ^3.21 | 0.00096561908721924 | 0.00085115432739258 | 0.0017502307891846 |
| nette-di | ^3.2 | 0.0055302858352661 | 0.0034189224243164 | 0.023849964141846 |
| php-di | ^7.0 | 0.001199197769165 | 0.00093698501586914 | 0.0033972263336182 |
| quickly(configured) | dev-master | 0.0039886951446533 | 0.0038661956787109 | 0.0045931339263916 |
| quickly(reflection) | dev-master | 0.0041807174682617 | 0.0040090084075928 | 0.0049049854278564 |
| symfony(compiled) | ^7.0 | 0.0072067260742188 | 0.0057880878448486 | 0.01891303062439 |

![z26 startup](speed_comparison_with_startup26.jpg)
