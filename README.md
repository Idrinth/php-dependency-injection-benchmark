# PHP Dependency Injection Benchmark

This repository benchmarks different dependency injection containers.

The "quickly" container is maintained by the same author as this benchmark, and the results may be unconsciously biased.

## Test Files

The benchmark defines three dependency graphs used for testing.

- `src/classes-06.php` (`f06`): 6 classes.
- `src/classes-16.php` (`p16`): 16 classes.
- `src/classes-26.php` (`z26`): 26 classes.

The class names (`f06`, `p16`, `z26`) follow a letter plus total class count to avoid overlap.

Each file contains all required classes and avoids autoloading so that container performance measurements exclude file-loading overhead.
Each test is executed with and without container startup time to measure resolution speed and initialization cost.

## Environment

| Component | Version |
| --- | --- |
| PHP | 8.4 |

## Running individual benchmarks

Build the container and execute a benchmark using focker (replace with docker if needed):

```sh
focker build -t di-benchmark-php-di -f containers/php-di/Dockerfile .
focker run --rm -v "$PWD:/out" di-benchmark-php-di php benchmark.php f06 1
```

The build step prepares the image for the chosen container, and the run command executes a single run of the specified test (for example, `f06`). The resulting `results.json` file will be written to the current directory.

## f06

Small dependency graph including 6 classes total (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 1ms, 867µs, 485ns | 1ms, 707µs, 77ns | 2ms, 467µs, 870ns |
| auryn | ^1.4 | 408ms, 837µs, 366ns | 402ms, 153µs, 15ns | 432ms, 380µs, 914ns |
| dice(configured) | ^4.0 | 70ms, 998µs, 144ns | 69ms, 525µs, 3ns | 75ms, 666µs, 189ns |
| dice(unconfigured) | ^4.0 | 73ms, 210µs, 644ns | 70ms, 334µs, 196ns | 88ms, 94µs, 949ns |
| laminas-servicemanager | ^3.21 | 783µs, 777ns | 770µs, 92ns | 799µs, 894ns |
| laravel(cached) | ^12.28 | 396ms, 157µs, 598ns | 391ms, 176µs, 939ns | 398ms, 967µs, 27ns |
| laravel(singletons) | ^12.28 | 3ms, 581µs, 571ns | 3ms, 399µs, 848ns | 4ms, 301µs, 71ns |
| laravel(unconfigured) | ^12.28 | 632ms, 256µs, 722ns | 621ms, 452µs, 808ns | 666ms, 487µs, 932ns |
| league-container | ^5.1 | 660ms, 851µs, 216ns | 658ms, 41µs, 954ns | 666ms, 167µs, 974ns |
| league(predefined) | ^5.1 | 855ms, 299µs, 19ns | 847ms, 569µs, 942ns | 890ms, 462µs, 875ns |
| nette-di | ^3.2 | 3ms, 271µs, 7ns | 3ms, 226µs, 41ns | 3ms, 315µs, 925ns |
| phalcon(shared) | ^5 | 4ms, 112µs, 529ns | 3ms, 973µs, 7ns | 4ms, 765µs, 33ns |
| phalcon(transient) | ^5 | 255ms, 51µs, 112ns | 248ms, 682µs, 975ns | 268ms, 309µs, 116ns |
| php-di | ^7.0 | 840µs, 806ns | 793µs, 933ns | 1ms, 198µs, 53ns |
| pimple | ^3.5 | 70ms, 675µs, 15ns | 69ms, 890µs, 22ns | 72ms, 345µs, 18ns |
| quickly(compiled) | dev-master | 794µs, 386ns | 773µs, 906ns | 826µs, 120ns |
| quickly(configured) | dev-master | 1ms, 358µs, 938ns | 1ms, 330µs, 137ns | 1ms, 396µs, 894ns |
| quickly(reflection) | dev-master | 1ms, 356µs, 434ns | 1ms, 337µs, 51ns | 1ms, 441µs, 1ns |
| symfony(compiled) | ^7.0 | 2ms, 197µs, 790ns | 2ms, 135µs, 992ns | 2ms, 281µs, 904ns |

![f06](images/speed_comparison_without_startup06.jpg)

## f06 startup

Small dependency graph including 6 classes total (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| aura-di | ^5.0 | 3ms, 549µs, 98ns | 3ms, 40µs, 75ns | 5ms, 246µs, 162ns |
| auryn | ^1.4 | 408ms, 596µs, 134ns | 405ms, 14µs, 38ns | 416ms, 625µs, 976ns |
| dice(configured) | ^4.0 | 72ms, 834µs, 467ns | 71ms, 297µs, 883ns | 80ms, 107µs, 927ns |
| dice(unconfigured) | ^4.0 | 71ms, 464µs, 967ns | 70ms, 91µs, 9ns | 74ms, 362µs, 993ns |
| laminas-servicemanager | ^3.21 | 885µs, 176ns | 782µs, 12ns | 1ms, 641µs, 35ns |
| laravel(cached) | ^12.28 | 402ms, 17µs, 378ns | 395ms, 590µs, 66ns | 409ms, 792µs, 900ns |
| laravel(singletons) | ^12.28 | 3ms, 570µs, 8ns | 3ms, 309µs, 965ns | 4ms, 758µs, 834ns |
| laravel(unconfigured) | ^12.28 | 630ms, 974µs, 817ns | 623ms, 679µs, 876ns | 640ms, 557µs, 50ns |
| league-container | ^5.1 | 659ms, 700µs, 965ns | 651ms, 692µs, 867ns | 679ms, 231µs, 882ns |
| league(predefined) | ^5.1 | 851ms, 58µs, 483ns | 842ms, 90µs, 129ns | 863ms, 253µs, 831ns |
| nette-di | ^3.2 | 5ms, 602µs, 240ns | 3ms, 303µs, 50ns | 25ms, 862µs, 216ns |
| phalcon(shared) | ^5 | 4ms, 46µs, 511ns | 4ms, 11µs, 154ns | 4ms, 100µs, 84ns |
| phalcon(transient) | ^5 | 251ms, 812µs, 243ns | 247ms, 779µs, 846ns | 259ms, 783µs, 29ns |
| php-di | ^7.0 | 1ms, 152µs, 86ns | 868µs, 82ns | 3ms, 424µs, 882ns |
| pimple | ^3.5 | 71ms, 784µs, 973ns | 69ms, 946µs, 50ns | 76ms, 73µs, 884ns |
| quickly(compiled) | dev-master | 811µs, 815ns | 795µs, 125ns | 834µs, 941ns |
| quickly(configured) | dev-master | 1ms, 778µs, 650ns | 1ms, 658µs, 916ns | 2ms, 579µs, 927ns |
| quickly(reflection) | dev-master | 1ms, 546µs, 454ns | 1ms, 338µs, 5ns | 2ms, 293µs, 825ns |
| symfony(compiled) | ^7.0 | 7ms, 76µs, 311ns | 5ms, 767µs, 107ns | 18ms, 316µs, 30ns |

![f06 startup](images/speed_comparison_with_startup06.jpg)

## p16

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice(configured) | ^4.0 | 10s, 71ms, 929µs, 1ns | 9s, 971ms, 657µs, 37ns | 10s, 344ms, 950µs, 914ns |
| dice(unconfigured) | ^4.0 | 10s, 56ms, 563µs, 67ns | 9s, 976ms, 873µs, 874ns | 10s, 143ms, 49µs, 955ns |
| laminas-servicemanager | ^3.21 | 739µs, 765ns | 713µs, 109ns | 787µs, 973ns |
| laravel(cached) | ^12.28 | 56s, 468ms, 152µs, 713ns | 55s, 463ms, 644µs, 981ns | 58s, 549ms, 287µs, 80ns |
| laravel(singletons) | ^12.28 | 3ms, 666µs, 710ns | 3ms, 341µs, 197ns | 5ms, 104µs, 64ns |
| league-container | ^5.1 | 94s, 717ms, 560µs, 482ns | 93s, 600ms, 419µs, 44ns | 95s, 828ms, 634µs, 977ns |
| league(predefined) | ^5.1 | 272s, 597ms, 99µs, 89ns | 269s, 235ms, 280µs, 990ns | 279s, 902ms, 286µs, 52ns |
| nette-di | ^3.2 | 3ms, 290µs, 653ns | 3ms, 262µs, 42ns | 3ms, 339µs, 52ns |
| phalcon(shared) | ^5 | 4ms, 328µs, 393ns | 3ms, 889µs, 83ns | 7ms, 993µs, 936ns |
| phalcon(transient) | ^5 | 35s, 900ms, 86µs, 808ns | 35s, 342ms, 202µs, 901ns | 38s, 495ms, 677µs, 947ns |
| php-di | ^7.0 | 857µs, 210ns | 790µs, 119ns | 1ms, 279µs, 830ns |
| pimple | ^3.5 | 10s, 54ms, 834µs, 461ns | 9s, 962ms, 620µs, 973ns | 10s, 209ms, 743µs, 976ns |
| quickly(compiled) | dev-master | 826µs, 96ns | 794µs, 887ns | 898µs, 122ns |
| quickly(configured) | dev-master | 1ms, 357µs, 507ns | 1ms, 307µs, 10ns | 1ms, 395µs, 940ns |
| quickly(reflection) | dev-master | 1ms, 776µs, 671ns | 1ms, 319µs, 169ns | 2ms, 321µs, 4ns |
| symfony(compiled) | ^7.0 | 2ms, 100µs, 753ns | 2ms, 43µs, 8ns | 2ms, 192µs, 974ns |

![p16](images/speed_comparison_without_startup16.jpg)

## p16 startup

Medium size dependency graph including 16 classes total. Skipped for the slowest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| dice(configured) | ^4.0 | 9s, 991ms, 52µs, 842ns | 9s, 870ms, 307µs, 922ns | 10s, 102ms, 470µs, 874ns |
| dice(unconfigured) | ^4.0 | 10s, 122ms, 914µs, 743ns | 9s, 958ms, 678µs, 7ns | 10s, 616ms, 795µs, 63ns |
| laminas-servicemanager | ^3.21 | 911µs, 998ns | 794µs, 887ns | 1ms, 733µs, 64ns |
| laravel(cached) | ^12.28 | 56s, 525ms, 542µs, 712ns | 56s, 282ms, 810µs, 926ns | 56s, 842ms, 473µs, 983ns |
| laravel(singletons) | ^12.28 | 3ms, 737µs, 163ns | 3ms, 543µs, 138ns | 4ms, 878µs, 997ns |
| league-container | ^5.1 | 94s, 524ms, 614µs, 310ns | 93s, 836ms, 20µs, 946ns | 95s, 144ms, 879µs, 102ns |
| league(predefined) | ^5.1 | 271s, 460ms, 236µs, 644ns | 270s, 677ms, 779µs, 912ns | 272s, 551ms, 221µs, 132ns |
| nette-di | ^3.2 | 5ms, 464µs, 625ns | 3ms, 385µs, 66ns | 23ms, 571µs, 14ns |
| phalcon(shared) | ^5 | 4ms, 124µs, 712ns | 4ms, 83µs, 871ns | 4ms, 237µs, 890ns |
| phalcon(transient) | ^5 | 35s, 336ms, 731µs, 457ns | 35s, 61ms, 61µs, 859ns | 35s, 493ms, 386µs, 983ns |
| php-di | ^7.0 | 1ms, 211µs, 404ns | 952µs, 5ns | 3ms, 392µs, 934ns |
| pimple | ^3.5 | 10s, 82ms, 99µs, 604ns | 9s, 910ms, 719µs, 871ns | 10s, 475ms, 29µs, 945ns |
| quickly(compiled) | dev-master | 801µs, 396ns | 784µs, 158ns | 815µs, 868ns |
| quickly(configured) | dev-master | 1ms, 830µs, 506ns | 1ms, 709µs, 938ns | 2ms, 534µs, 866ns |
| quickly(reflection) | dev-master | 1ms, 512µs, 2ns | 1ms, 414µs, 60ns | 2ms, 212µs, 47ns |
| symfony(compiled) | ^7.0 | 7ms, 201µs, 99ns | 5ms, 845µs, 69ns | 18ms, 702µs, 983ns |

![p16 startup](images/speed_comparison_with_startup16.jpg)

## z26

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (excluding container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 777µs, 792ns | 745µs, 58ns | 862µs, 121ns |
| laravel(singletons) | ^12.28 | 3ms, 442µs, 668ns | 3ms, 336µs, 906ns | 3ms, 805µs, 875ns |
| nette-di | ^3.2 | 3ms, 412µs, 8ns | 3ms, 381µs, 967ns | 3ms, 439µs, 903ns |
| phalcon(shared) | ^5 | 5ms, 304µs, 26ns | 3ms, 965µs, 854ns | 7ms, 845µs, 163ns |
| php-di | ^7.0 | 869µs, 989ns | 792µs, 26ns | 1ms, 355µs, 886ns |
| quickly(compiled) | dev-master | 797µs, 796ns | 784µs, 158ns | 822µs, 67ns |
| quickly(configured) | dev-master | 1ms, 353µs, 1ns | 1ms, 320µs, 123ns | 1ms, 409µs, 53ns |
| quickly(reflection) | dev-master | 1ms, 336µs, 812ns | 1ms, 291µs, 36ns | 1ms, 549µs, 5ns |
| symfony(compiled) | ^7.0 | 2ms, 166µs, 295ns | 2ms, 115µs, 964ns | 2ms, 225µs, 875ns |

![z26](images/speed_comparison_without_startup26.jpg)

## z26 startup

Large dependency graph including a total of 26 classes. Skipped for all but the fastest DI-Containers for runtime reasons. (includes container startup time)

| Container | Version | Average | Minimum | Maximum |
| --- | --- | --- | --- | --- |
| laminas-servicemanager | ^3.21 | 956µs, 82ns | 849µs, 8ns | 1ms, 752µs, 138ns |
| laravel(singletons) | ^12.28 | 3ms, 752µs, 803ns | 3ms, 587µs, 961ns | 4ms, 877µs, 90ns |
| nette-di | ^3.2 | 5ms, 584µs, 907ns | 3ms, 536µs, 939ns | 23ms, 743µs, 152ns |
| phalcon(shared) | ^5 | 4ms, 357µs, 576ns | 4ms, 91µs, 24ns | 5ms, 593µs, 61ns |
| php-di | ^7.0 | 1ms, 220µs, 512ns | 948µs, 190ns | 3ms, 437µs, 42ns |
| quickly(compiled) | dev-master | 866µs, 103ns | 786µs, 66ns | 1ms, 178µs, 979ns |
| quickly(configured) | dev-master | 1ms, 864µs, 218ns | 1ms, 753µs, 91ns | 2ms, 590µs, 894ns |
| quickly(reflection) | dev-master | 1ms, 579µs, 761ns | 1ms, 477µs, 956ns | 2ms, 280µs, 950ns |
| symfony(compiled) | ^7.0 | 7ms, 322µs, 72ns | 5ms, 887µs, 31ns | 18ms, 467µs, 903ns |

![z26 startup](images/speed_comparison_with_startup26.jpg)
