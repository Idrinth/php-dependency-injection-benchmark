<?php

use Ray\Di\Injector;

class AdapterImplementation {
    private Injector $injector;

    public function __construct() {
        $this->injector = new Injector();
    }

    public function get(string $class): object {
        return $this->injector->getInstance($class);
    }
}
