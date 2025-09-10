<?php

use Aura\Di\ContainerBuilder;

class AdapterImplementation {
    private \Aura\Di\Container $container;
    public function __construct() {
        $builder = new ContainerBuilder();
        $c = $builder->newInstance(ContainerBuilder::AUTO_RESOLVE);
        $c->set(F06::class, $c->lazyNew(F06::class));
        $c->set(P16::class, $c->lazyNew(P16::class));
        $c->set(Z26::class, $c->lazyNew(Z26::class));
        foreach ([['F', '06'], ['P', '16'], ['Z', '26']] as [$max, $suffix]) {
            foreach (range('A', $max) as $letter) {
                $interface = $letter . 'In' . $suffix;
                $implementation = $letter . 'Im' . $suffix;
                $c->set($interface, $c->lazyNew($implementation));
            }
        }
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
