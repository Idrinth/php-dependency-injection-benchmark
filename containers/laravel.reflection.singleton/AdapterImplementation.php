<?php

declare(strict_types=1);

use Illuminate\Container\Container;

class AdapterImplementation
{
    private Container $container;
    public function __construct()
    {
        $this->container = new Container();
        foreach (
            [
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
            ] as $service
        ) {
            $this->container->singleton($service);
        }
    }
    public function get(string $class): object
    {
        return $this->container->make($class);
    }
}
