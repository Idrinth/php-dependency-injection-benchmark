<?php

interface AIn06
{
}
class AIm06 implements AIn06
{
}

interface BIn06
{
}
class BIm06 implements BIn06
{
    public function __construct(AIn06 $a)
    {
    }
}

interface CIn06
{
}
class CIm06 implements CIn06
{
    public function __construct(BIn06 $b)
    {
    }
}

interface DIn06
{
}
class DIm06 implements DIn06
{
    public function __construct(CIn06 $c, BIn06 $b, AIn06 $a)
    {
    }
}

interface EIn06
{
}
class EIm06 implements EIn06
{
    public function __construct(DIn06 $d, CIn06 $c, BIn06 $b)
    {
    }
}

interface FIn06
{
}
class FIm06 implements FIn06
{
    public function __construct(EIn06 $e, DIn06 $d, BIn06 $b)
    {
    }
}
