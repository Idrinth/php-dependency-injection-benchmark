<?php

use Laminas\ServiceManager\ServiceManager;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;

class AdapterImplementation {
    private ServiceManager $container;
    public function __construct() {
        $this->container = new ServiceManager([
            'abstract_factories' => [
                ReflectionBasedAbstractFactory::class,
            ],
        ]);
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
