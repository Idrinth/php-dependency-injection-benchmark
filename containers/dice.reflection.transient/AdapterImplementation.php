<?php

use Dice\Dice;

class AdapterImplementation
{
    private Dice $container;
    public function __construct()
    {
        $this->container = new Dice();
    }
    public function get(string $class): object
    {
        return $this->container->create($class);
    }
}
