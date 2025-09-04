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
                    A26::class,
                    B26::class,
                    C26::class,
                    D26::class,
                    E26::class,
                    F26::class,
                    G26::class,
                    H26::class,
                    I26::class,
                    J26::class,
                    K26::class,
                    L26::class,
                    M26::class,
                    N26::class,
                    O26::class,
                    P26::class,
                    Q26::class,
                    R26::class,
                    S26::class,
                    T26::class,
                    U26::class,
                    V26::class,
                    W26::class,
                    X26::class,
                    Y26::class,
                    Z26::class,
                ],
            ]);
        });
        $this->container = new $class();
    }
    public function get(string $class): object {
        return $this->container->getByType($class);
    }
}
