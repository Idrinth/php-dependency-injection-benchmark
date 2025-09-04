<?php

use Aura\Di\ContainerBuilder;

class AdapterImplementation {
    private \Aura\Di\Container $container;
    public function __construct() {
        $builder = new ContainerBuilder();
        $c = $builder->newInstance(ContainerBuilder::AUTO_RESOLVE);
        $c->set(F06::class, $c->lazyNew(F06::class));
        $c->set(Z26::class, $c->lazyNew(Z26::class));
        $this->container = $c;
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
