<?php

use Nette\DI\ContainerLoader;
use Nette\DI\Compiler;

class AdapterImplementation {
    private Nette\DI\Container $container;
    public function __construct() {
        $loader = new ContainerLoader(sys_get_temp_dir(), true);
        $class = $loader->load(function (Compiler $compiler) {
            $compiler->addConfig([
                'services' => [
                    A::class,
                    B::class,
                    C::class,
                    D::class,
                    E::class,
                    F::class,
                ],
            ]);
        });
        $this->container = new $class();
    }
    public function get(string $class): object {
        return $this->container->getByType($class);
    }
}
