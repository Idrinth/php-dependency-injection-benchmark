<?php

use Idrinth\Quickly\DependencyInjection\Container as QuicklyContainer;
use Psr\Container\ContainerInterface;

class AdapterImplementation {
    private QuicklyContainer $container;
    public function __construct() {
        $config = require __DIR__ . '/.quickly/generated.php';
        $this->container = new QuicklyContainer(
            [],
            new class implements ContainerInterface {
                public function has(string $name): bool {
                    return false;
                }
                public function get(string $name): object {
                    throw new BadMethodCallException("Not implemented");
                }
            },
            $config['constructors'] ?? [],
            $config['factories'] ?? [],
            $config['classAliases'] ?? []
        );
    }
    public function get(string $class): object {
        return $this->container->get($class);
    }
}

