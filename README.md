# PHP Dependency Injection Benchmark

This repository benchmarks different dependency injection containers.

## Test Results

Results from the latest automated run of the Dockerized benchmarks (triggered on pushes to main and a monthly schedule):

```
### php-di
run 0: 0.0011749267578125 seconds per 10000
run 1: 0.0013360977172852 seconds per 10000
run 2: 0.00087499618530273 seconds per 10000
run 3: 0.00083303451538086 seconds per 10000
run 4: 0.00085186958312988 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.0010141849517822 | 0.00083303451538086 | 0.0013360977172852

### pimple
run 0: 0.068784236907959 seconds per 10000
run 1: 0.075504064559937 seconds per 10000
run 2: 0.068849086761475 seconds per 10000
run 3: 0.068152904510498 seconds per 10000
run 4: 0.069414138793945 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.070140886306763 | 0.068152904510498 | 0.075504064559937

### quickly-configured
run 0: 0.0036981105804443 seconds per 10000
run 1: 0.0038042068481445 seconds per 10000
run 2: 0.0038118362426758 seconds per 10000
run 3: 0.0038318634033203 seconds per 10000
run 4: 0.003838062286377 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.0037968158721924 | 0.0036981105804443 | 0.003838062286377

### quickly-reflection
run 0: 0.18163895606995 seconds per 10000
run 1: 0.18366003036499 seconds per 10000
run 2: 0.18115997314453 seconds per 10000
run 3: 0.18184995651245 seconds per 10000
run 4: 0.18178701400757 seconds per 10000

AVERAGE | MINIMUM | MAXIMUM
0.1820191860199 | 0.18115997314453 | 0.18366003036499

```

## Summary

| Container | Average | Minimum | Maximum |
| --- | --- | --- | --- |
| php-di | 0.0010141849517822 | 0.00083303451538086 | 0.0013360977172852 |
| pimple | 0.070140886306763 | 0.068152904510498 | 0.075504064559937 |
| quickly-configured | 0.0037968158721924 | 0.0036981105804443 | 0.003838062286377 |
| quickly-reflection | 0.1820191860199 | 0.18115997314453 | 0.18366003036499 |
