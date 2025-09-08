<?php

use Ray\Compiler\CompiledInjector;
use Ray\Compiler\Compiler;
use Ray\Di\AbstractModule;

class AdapterImplementation {
    private CompiledInjector $injector;
    public function __construct() {
        $classes = [
            A06::class,
            B06::class,
            C06::class,
            D06::class,
            E06::class,
            F06::class,
            A16::class,
            B16::class,
            C16::class,
            D16::class,
            E16::class,
            F16::class,
            G16::class,
            H16::class,
            I16::class,
            J16::class,
            K16::class,
            L16::class,
            M16::class,
            N16::class,
            O16::class,
            P16::class,
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
        ];
        $module = new class($classes) extends AbstractModule {
            /** @var array<int, string> */
            private array $classes;
            public function __construct(array $classes) {
                $this->classes = $classes;
                parent::__construct();
            }
            protected function configure(): void {
                foreach ($this->classes as $class) {
                    $this->bind($class);
                }
            }
        };
        $dir = __DIR__ . '/compiled';
        (new Compiler())->compile($module, $dir);
        $this->injector = new CompiledInjector($dir);
    }
    public function get(string $class): object {
        return $this->injector->getInstance($class);
    }
}
