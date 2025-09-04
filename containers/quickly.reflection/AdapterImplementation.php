<?php

use Idrinth\Quickly\DependencyInjection\Container as QuicklyContainer;

class AdapterImplementation {
    private QuicklyContainer $container;
    public function __construct() {
        $this->container = new QuicklyContainer(['DI_USE_REFLECTION' => 'true']);
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}
