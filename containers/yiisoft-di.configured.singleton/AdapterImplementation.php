<?php

declare(strict_types=1);

use Yiisoft\Definitions\Reference;
use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;

final class AdapterImplementation
{
    private Container $container;

    public function __construct()
    {
        $definitions = [
            A06::class => A06::class,
            B06::class => [
                '__construct()' => [Reference::to(A06::class)],
            ],
            C06::class => [
                '__construct()' => [Reference::to(B06::class)],
            ],
            D06::class => [
                '__construct()' => [Reference::to(C06::class), Reference::to(B06::class), Reference::to(A06::class)],
            ],
            E06::class => [
                '__construct()' => [Reference::to(D06::class), Reference::to(C06::class), Reference::to(B06::class)],
            ],
            F06::class => [
                '__construct()' => [Reference::to(E06::class), Reference::to(D06::class), Reference::to(B06::class)],
            ],

            A16::class => A16::class,
            B16::class => [
                '__construct()' => [Reference::to(A16::class)],
            ],
            C16::class => [
                '__construct()' => [Reference::to(B16::class)],
            ],
            D16::class => [
                '__construct()' => [Reference::to(C16::class), Reference::to(B16::class), Reference::to(A16::class)],
            ],
            E16::class => [
                '__construct()' => [Reference::to(D16::class), Reference::to(C16::class)],
            ],
            F16::class => [
                '__construct()' => [Reference::to(E16::class), Reference::to(D16::class), Reference::to(B16::class)],
            ],
            G16::class => [
                '__construct()' => [Reference::to(F16::class)],
            ],
            H16::class => [
                '__construct()' => [Reference::to(G16::class), Reference::to(F16::class)],
            ],
            I16::class => [
                '__construct()' => [Reference::to(H16::class), Reference::to(G16::class), Reference::to(F16::class)],
            ],
            J16::class => [
                '__construct()' => [Reference::to(I16::class), Reference::to(H16::class)],
            ],
            K16::class => [
                '__construct()' => [Reference::to(J16::class), Reference::to(I16::class), Reference::to(H16::class)],
            ],
            L16::class => [
                '__construct()' => [Reference::to(K16::class)],
            ],
            M16::class => [
                '__construct()' => [Reference::to(L16::class), Reference::to(K16::class)],
            ],
            N16::class => [
                '__construct()' => [Reference::to(M16::class), Reference::to(L16::class), Reference::to(K16::class)],
            ],
            O16::class => [
                '__construct()' => [Reference::to(N16::class), Reference::to(M16::class)],
            ],
            P16::class => [
                '__construct()' => [Reference::to(O16::class), Reference::to(N16::class), Reference::to(M16::class)],
            ],

            A26::class => A26::class,
            B26::class => [
                '__construct()' => [Reference::to(A26::class)],
            ],
            C26::class => [
                '__construct()' => [Reference::to(B26::class)],
            ],
            D26::class => [
                '__construct()' => [Reference::to(C26::class), Reference::to(B26::class), Reference::to(A26::class)],
            ],
            E26::class => [
                '__construct()' => [Reference::to(D26::class), Reference::to(C26::class)],
            ],
            F26::class => [
                '__construct()' => [Reference::to(E26::class), Reference::to(D26::class), Reference::to(B26::class)],
            ],
            G26::class => [
                '__construct()' => [Reference::to(F26::class)],
            ],
            H26::class => [
                '__construct()' => [Reference::to(G26::class), Reference::to(F26::class)],
            ],
            I26::class => [
                '__construct()' => [Reference::to(H26::class), Reference::to(G26::class), Reference::to(F26::class)],
            ],
            J26::class => [
                '__construct()' => [Reference::to(I26::class), Reference::to(H26::class), Reference::to(G26::class), Reference::to(F26::class)],
            ],
            K26::class => [
                '__construct()' => [Reference::to(J26::class), Reference::to(I26::class), Reference::to(H26::class), Reference::to(G26::class), Reference::to(F26::class)],
            ],
            L26::class => [
                '__construct()' => [Reference::to(K26::class), Reference::to(J26::class), Reference::to(I26::class), Reference::to(H26::class), Reference::to(G26::class)],
            ],
            M26::class => [
                '__construct()' => [Reference::to(L26::class), Reference::to(K26::class), Reference::to(J26::class), Reference::to(I26::class), Reference::to(H26::class)],
            ],
            N26::class => [
                '__construct()' => [Reference::to(M26::class), Reference::to(L26::class)],
            ],
            O26::class => [
                '__construct()' => [Reference::to(N26::class), Reference::to(M26::class), Reference::to(L26::class)],
            ],
            P26::class => [
                '__construct()' => [Reference::to(O26::class), Reference::to(N26::class), Reference::to(M26::class), Reference::to(L26::class)],
            ],
            Q26::class => [
                '__construct()' => [Reference::to(P26::class), Reference::to(O26::class), Reference::to(N26::class), Reference::to(M26::class), Reference::to(L26::class)],
            ],
            R26::class => [
                '__construct()' => [Reference::to(Q26::class), Reference::to(P26::class)],
            ],
            S26::class => [
                '__construct()' => [Reference::to(R26::class), Reference::to(Q26::class), Reference::to(P26::class)],
            ],
            T26::class => [
                '__construct()' => [Reference::to(S26::class), Reference::to(R26::class), Reference::to(Q26::class), Reference::to(P26::class)],
            ],
            U26::class => [
                '__construct()' => [Reference::to(T26::class), Reference::to(S26::class), Reference::to(R26::class), Reference::to(Q26::class), Reference::to(P26::class)],
            ],
            V26::class => [
                '__construct()' => [Reference::to(U26::class)],
            ],
            W26::class => [
                '__construct()' => [Reference::to(V26::class), Reference::to(U26::class)],
            ],
            X26::class => [
                '__construct()' => [Reference::to(W26::class), Reference::to(V26::class), Reference::to(U26::class)],
            ],
            Y26::class => [
                '__construct()' => [Reference::to(X26::class), Reference::to(W26::class), Reference::to(V26::class), Reference::to(U26::class)],
            ],
            Z26::class => [
                '__construct()' => [Reference::to(Y26::class), Reference::to(X26::class), Reference::to(W26::class), Reference::to(V26::class), Reference::to(U26::class)],
            ],

            AIn06::class => [
                'class' => AIm06::class,
            ],
            BIn06::class => [
                'class' => BIm06::class,
                '__construct()' => [Reference::to(AIn06::class)],
            ],
            CIn06::class => [
                'class' => CIm06::class,
                '__construct()' => [Reference::to(BIn06::class)],
            ],
            DIn06::class => [
                'class' => DIm06::class,
                '__construct()' => [Reference::to(CIn06::class), Reference::to(BIn06::class), Reference::to(AIn06::class)],
            ],
            EIn06::class => [
                'class' => EIm06::class,
                '__construct()' => [Reference::to(DIn06::class), Reference::to(CIn06::class), Reference::to(BIn06::class)],
            ],
            FIn06::class => [
                'class' => FIm06::class,
                '__construct()' => [Reference::to(EIn06::class), Reference::to(DIn06::class), Reference::to(BIn06::class)],
            ],

            AIn16::class => [
                'class' => AIm16::class,
            ],
            BIn16::class => [
                'class' => BIm16::class,
                '__construct()' => [Reference::to(AIn16::class)],
            ],
            CIn16::class => [
                'class' => CIm16::class,
                '__construct()' => [Reference::to(BIn16::class)],
            ],
            DIn16::class => [
                'class' => DIm16::class,
                '__construct()' => [Reference::to(CIn16::class), Reference::to(BIn16::class), Reference::to(AIn16::class)],
            ],
            EIn16::class => [
                'class' => EIm16::class,
                '__construct()' => [Reference::to(DIn16::class), Reference::to(CIn16::class)],
            ],
            FIn16::class => [
                'class' => FIm16::class,
                '__construct()' => [Reference::to(EIn16::class), Reference::to(DIn16::class), Reference::to(BIn16::class)],
            ],
            GIn16::class => [
                'class' => GIm16::class,
                '__construct()' => [Reference::to(FIn16::class)],
            ],
            HIn16::class => [
                'class' => HIm16::class,
                '__construct()' => [Reference::to(GIn16::class), Reference::to(FIn16::class)],
            ],
            IIn16::class => [
                'class' => IIm16::class,
                '__construct()' => [Reference::to(HIn16::class), Reference::to(GIn16::class), Reference::to(FIn16::class)],
            ],
            JIn16::class => [
                'class' => JIm16::class,
                '__construct()' => [Reference::to(IIn16::class), Reference::to(HIn16::class)],
            ],
            KIn16::class => [
                'class' => KIm16::class,
                '__construct()' => [Reference::to(JIn16::class), Reference::to(IIn16::class), Reference::to(HIn16::class)],
            ],
            LIn16::class => [
                'class' => LIm16::class,
                '__construct()' => [Reference::to(KIn16::class)],
            ],
            MIn16::class => [
                'class' => MIm16::class,
                '__construct()' => [Reference::to(LIn16::class), Reference::to(KIn16::class)],
            ],
            NIn16::class => [
                'class' => NIm16::class,
                '__construct()' => [Reference::to(MIn16::class), Reference::to(LIn16::class), Reference::to(KIn16::class)],
            ],
            OIn16::class => [
                'class' => OIm16::class,
                '__construct()' => [Reference::to(NIn16::class), Reference::to(MIn16::class)],
            ],
            PIn16::class => [
                'class' => PIm16::class,
                '__construct()' => [Reference::to(OIn16::class), Reference::to(NIn16::class), Reference::to(MIn16::class)],
            ],

            AIn26::class => [
                'class' => AIm26::class,
            ],
            BIn26::class => [
                'class' => BIm26::class,
                '__construct()' => [Reference::to(AIn26::class)],
            ],
            CIn26::class => [
                'class' => CIm26::class,
                '__construct()' => [Reference::to(BIn26::class)],
            ],
            DIn26::class => [
                'class' => DIm26::class,
                '__construct()' => [Reference::to(CIn26::class), Reference::to(BIn26::class), Reference::to(AIn26::class)],
            ],
            EIn26::class => [
                'class' => EIm26::class,
                '__construct()' => [Reference::to(DIn26::class), Reference::to(CIn26::class)],
            ],
            FIn26::class => [
                'class' => FIm26::class,
                '__construct()' => [Reference::to(EIn26::class), Reference::to(DIn26::class), Reference::to(BIn26::class)],
            ],
            GIn26::class => [
                'class' => GIm26::class,
                '__construct()' => [Reference::to(FIn26::class)],
            ],
            HIn26::class => [
                'class' => HIm26::class,
                '__construct()' => [Reference::to(GIn26::class), Reference::to(FIn26::class)],
            ],
            IIn26::class => [
                'class' => IIm26::class,
                '__construct()' => [Reference::to(HIn26::class), Reference::to(GIn26::class), Reference::to(FIn26::class)],
            ],
            JIn26::class => [
                'class' => JIm26::class,
                '__construct()' => [Reference::to(IIn26::class), Reference::to(HIn26::class), Reference::to(GIn26::class), Reference::to(FIn26::class)],
            ],
            KIn26::class => [
                'class' => KIm26::class,
                '__construct()' => [Reference::to(JIn26::class), Reference::to(IIn26::class), Reference::to(HIn26::class), Reference::to(GIn26::class), Reference::to(FIn26::class)],
            ],
            LIn26::class => [
                'class' => LIm26::class,
                '__construct()' => [Reference::to(KIn26::class), Reference::to(JIn26::class), Reference::to(IIn26::class), Reference::to(HIn26::class), Reference::to(GIn26::class)],
            ],
            MIn26::class => [
                'class' => MIm26::class,
                '__construct()' => [Reference::to(LIn26::class), Reference::to(KIn26::class), Reference::to(JIn26::class), Reference::to(IIn26::class), Reference::to(HIn26::class)],
            ],
            NIn26::class => [
                'class' => NIm26::class,
                '__construct()' => [Reference::to(MIn26::class), Reference::to(LIn26::class)],
            ],
            OIn26::class => [
                'class' => OIm26::class,
                '__construct()' => [Reference::to(NIn26::class), Reference::to(MIn26::class), Reference::to(LIn26::class)],
            ],
            PIn26::class => [
                'class' => PIm26::class,
                '__construct()' => [Reference::to(OIn26::class), Reference::to(NIn26::class), Reference::to(MIn26::class), Reference::to(LIn26::class)],
            ],
            QIn26::class => [
                'class' => QIm26::class,
                '__construct()' => [Reference::to(PIn26::class), Reference::to(OIn26::class), Reference::to(NIn26::class), Reference::to(MIn26::class), Reference::to(LIn26::class)],
            ],
            RIn26::class => [
                'class' => RIm26::class,
                '__construct()' => [Reference::to(QIn26::class), Reference::to(PIn26::class)],
            ],
            SIn26::class => [
                'class' => SIm26::class,
                '__construct()' => [Reference::to(RIn26::class), Reference::to(QIn26::class), Reference::to(PIn26::class)],
            ],
            TIn26::class => [
                'class' => TIm26::class,
                '__construct()' => [Reference::to(SIn26::class), Reference::to(RIn26::class), Reference::to(QIn26::class), Reference::to(PIn26::class)],
            ],
            UIn26::class => [
                'class' => UIm26::class,
                '__construct()' => [Reference::to(TIn26::class), Reference::to(SIn26::class), Reference::to(RIn26::class), Reference::to(QIn26::class), Reference::to(PIn26::class)],
            ],
            VIn26::class => [
                'class' => VIm26::class,
                '__construct()' => [Reference::to(UIn26::class)],
            ],
            WIn26::class => [
                'class' => WIm26::class,
                '__construct()' => [Reference::to(VIn26::class), Reference::to(UIn26::class)],
            ],
            XIn26::class => [
                'class' => XIm26::class,
                '__construct()' => [Reference::to(WIn26::class), Reference::to(VIn26::class), Reference::to(UIn26::class)],
            ],
            YIn26::class => [
                'class' => YIm26::class,
                '__construct()' => [Reference::to(XIn26::class), Reference::to(WIn26::class), Reference::to(VIn26::class), Reference::to(UIn26::class)],
            ],
            ZIn26::class => [
                'class' => ZIm26::class,
                '__construct()' => [Reference::to(YIn26::class), Reference::to(XIn26::class), Reference::to(WIn26::class), Reference::to(VIn26::class), Reference::to(UIn26::class)],
            ],
        ];

        $config = ContainerConfig::create()
            ->withDefinitions($definitions)
            ->withValidate(false)
            ->withStrictMode(true);

        $this->container = new Container($config);
    }

    public function get(string $class): object
    {
        return $this->container->get($class);
    }
}
