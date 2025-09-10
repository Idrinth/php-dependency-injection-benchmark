<?php

interface AIn16
{
}
class AIm16 implements AIn16
{
}

interface BIn16
{
}
class BIm16 implements BIn16
{
    public function __construct(AIn16 $a)
    {
    }
}

interface CIn16
{
}
class CIm16 implements CIn16
{
    public function __construct(BIn16 $b)
    {
    }
}

interface DIn16
{
}
class DIm16 implements DIn16
{
    public function __construct(CIn16 $c, BIn16 $b, AIn16 $a)
    {
    }
}

interface EIn16
{
}
class EIm16 implements EIn16
{
    public function __construct(DIn16 $d, CIn16 $c)
    {
    }
}

interface FIn16
{
}
class FIm16 implements FIn16
{
    public function __construct(EIn16 $e, DIn16 $d, BIn16 $b)
    {
    }
}

interface GIn16
{
}
class GIm16 implements GIn16
{
    public function __construct(FIn16 $f)
    {
    }
}

interface HIn16
{
}
class HIm16 implements HIn16
{
    public function __construct(GIn16 $g, FIn16 $f)
    {
    }
}

interface IIn16
{
}
class IIm16 implements IIn16
{
    public function __construct(HIn16 $h, GIn16 $g, FIn16 $f)
    {
    }
}

interface JIn16
{
}
class JIm16 implements JIn16
{
    public function __construct(IIn16 $i, HIn16 $h)
    {
    }
}

interface KIn16
{
}
class KIm16 implements KIn16
{
    public function __construct(JIn16 $j, IIn16 $i, HIn16 $h)
    {
    }
}

interface LIn16
{
}
class LIm16 implements LIn16
{
    public function __construct(KIn16 $k)
    {
    }
}

interface MIn16
{
}
class MIm16 implements MIn16
{
    public function __construct(LIn16 $l, KIn16 $k)
    {
    }
}

interface NIn16
{
}
class NIm16 implements NIn16
{
    public function __construct(MIn16 $m, LIn16 $l, KIn16 $k)
    {
    }
}

interface OIn16
{
}
class OIm16 implements OIn16
{
    public function __construct(NIn16 $n, MIn16 $m)
    {
    }
}

interface PIn16
{
}
class PIm16 implements PIn16
{
    public function __construct(OIn16 $o, NIn16 $n, MIn16 $m)
    {
    }
}
