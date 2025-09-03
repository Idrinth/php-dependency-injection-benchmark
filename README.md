# PHP Dependency Injection Benchmark

This repository benchmarks different dependency injection containers.

## Test Results

Results from the latest automated run of the Dockerized benchmarks (triggered on pushes to main and a monthly schedule):

```
### php-di
run 0: 0.0011770725250244 seconds per 10000
run 1: 0.00087094306945801 seconds per 10000
run 2: 0.00086188316345215 seconds per 10000
run 3: 0.00084114074707031 seconds per 10000
run 4: 0.0008389949798584 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.00091800689697266 | 0.0008389949798584 | 0.0011770725250244

### pimple
run 0: 0.069572925567627 seconds per 10000
run 1: 0.069372892379761 seconds per 10000
run 2: 0.069346904754639 seconds per 10000
run 3: 0.069459915161133 seconds per 10000
run 4: 0.069473028182983 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.069445133209229 | 0.069346904754639 | 0.069572925567627

### quickly-configured
run 0: 0.003777027130127 seconds per 10000
run 1: 0.0038309097290039 seconds per 10000
run 2: 0.0037858486175537 seconds per 10000
run 3: 0.003849983215332 seconds per 10000
run 4: 0.0038201808929443 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.0038127899169922 | 0.003777027130127 | 0.003849983215332

### quickly-reflection
run 0: 0.18486595153809 seconds per 10000
run 1: 0.18758106231689 seconds per 10000
run 2: 0.18529891967773 seconds per 10000
run 3: 0.18543291091919 seconds per 10000
run 4: 0.18764710426331 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.18616518974304 | 0.18486595153809 | 0.18764710426331

```
