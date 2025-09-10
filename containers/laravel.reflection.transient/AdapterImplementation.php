<?php

use Illuminate\Container\Container;

class AdapterImplementation
{
    private Container $container;
    public function __construct()
    {
        $this->container = new Container();
    }
    public function get(string $class): object
    {
        return $this->container->make($class);
    }
}
