<?php

declare(strict_types=1);

use League\Container\Container;
use League\Container\ReflectionContainer;

class AdapterImplementation
{
    private Container $container;
    public function __construct()
    {
        $c = new Container();
        $c->delegate(new ReflectionContainer());
        $this->container = $c;
    }
    public function get(string $class): object
    {
        return $this->container->get($class);
    }
}
