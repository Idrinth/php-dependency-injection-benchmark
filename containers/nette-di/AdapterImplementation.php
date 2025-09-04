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
                    A06::class,
                    B06::class,
                    C06::class,
                    D06::class,
                    E06::class,
                    F06::class,
                ],
            ]);
        });
        $this->container = new $class();
    }
    public function get(string $class): object {
        return $this->container->getByType($class);
    }
}
