<?php

declare(strict_types=1);

use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;

final class AdapterImplementation
{
    private Container $container;

    public function __construct()
    {
        $definitions = [
            AIn06::class => AIm06::class,
            BIn06::class => BIm06::class,
            CIn06::class => CIm06::class,
            DIn06::class => DIm06::class,
            EIn06::class => EIm06::class,
            FIn06::class => FIm06::class,

            AIn16::class => AIm16::class,
            BIn16::class => BIm16::class,
            CIn16::class => CIm16::class,
            DIn16::class => DIm16::class,
            EIn16::class => EIm16::class,
            FIn16::class => FIm16::class,
            GIn16::class => GIm16::class,
            HIn16::class => HIm16::class,
            IIn16::class => IIm16::class,
            JIn16::class => JIm16::class,
            KIn16::class => KIm16::class,
            LIn16::class => LIm16::class,
            MIn16::class => MIm16::class,
            NIn16::class => NIm16::class,
            OIn16::class => OIm16::class,
            PIn16::class => PIm16::class,

            AIn26::class => AIm26::class,
            BIn26::class => BIm26::class,
            CIn26::class => CIm26::class,
            DIn26::class => DIm26::class,
            EIn26::class => EIm26::class,
            FIn26::class => FIm26::class,
            GIn26::class => GIm26::class,
            HIn26::class => HIm26::class,
            IIn26::class => IIm26::class,
            JIn26::class => JIm26::class,
            KIn26::class => KIm26::class,
            LIn26::class => LIm26::class,
            MIn26::class => MIm26::class,
            NIn26::class => NIm26::class,
            OIn26::class => OIm26::class,
            PIn26::class => PIm26::class,
            QIn26::class => QIm26::class,
            RIn26::class => RIm26::class,
            SIn26::class => SIm26::class,
            TIn26::class => TIm26::class,
            UIn26::class => UIm26::class,
            VIn26::class => VIm26::class,
            WIn26::class => WIm26::class,
            XIn26::class => XIm26::class,
            YIn26::class => YIm26::class,
            ZIn26::class => ZIm26::class,
        ];

        $config = ContainerConfig::create()
            ->withDefinitions($definitions)
            ->withValidate(false);

        $this->container = new Container($config);
    }

    public function get(string $class): object
    {
        return $this->container->get($class);
    }
}
