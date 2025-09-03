# PHP Dependency Injection Benchmark

This repository benchmarks different dependency injection containers.

## Test Results

Results from the latest automated run of the Dockerized benchmarks (triggered on pushes to main and a monthly schedule):

```
### php-di
run 0: 0.0011839866638184 seconds per 10000
run 1: 0.00085186958312988 seconds per 10000
run 2: 0.00079011917114258 seconds per 10000
run 3: 0.00079607963562012 seconds per 10000
run 4: 0.00082492828369141 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.00088939666748047 | 0.00079011917114258 | 0.0011839866638184

### pimple
run 0: 0.080466985702515 seconds per 10000
run 1: 0.070311069488525 seconds per 10000
run 2: 0.070129871368408 seconds per 10000
run 3: 0.069601058959961 seconds per 10000
run 4: 0.069319009780884 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.071965599060059 | 0.069319009780884 | 0.080466985702515

### quickly-configured
run 0: 0.0038321018218994 seconds per 10000
run 1: 0.0038549900054932 seconds per 10000
run 2: 0.003795862197876 seconds per 10000
run 3: 0.0037901401519775 seconds per 10000
run 4: 0.003803014755249 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.003815221786499 | 0.0037901401519775 | 0.0038549900054932

### quickly-reflection
run 0: 0.18246912956238 seconds per 10000
run 1: 0.18323707580566 seconds per 10000
run 2: 0.18305706977844 seconds per 10000
run 3: 0.18365406990051 seconds per 10000
run 4: 0.18320298194885 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.18312406539917 | 0.18246912956238 | 0.18365406990051

```
