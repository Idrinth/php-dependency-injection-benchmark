<?php

declare(strict_types=1);

class A16
{
}
class B16
{
    public function __construct(A16 $a)
    {
    }
}
class C16
{
    public function __construct(B16 $b)
    {
    }
}
class D16
{
    public function __construct(C16 $c, B16 $b, A16 $a)
    {
    }
}
class E16
{
    public function __construct(D16 $d, C16 $c)
    {
    }
}
class F16
{
    public function __construct(E16 $e, D16 $d, B16 $b)
    {
    }
}
class G16
{
    public function __construct(F16 $f)
    {
    }
}
class H16
{
    public function __construct(G16 $g, F16 $f)
    {
    }
}
class I16
{
    public function __construct(H16 $h, G16 $g, F16 $f)
    {
    }
}
class J16
{
    public function __construct(I16 $i, H16 $h)
    {
    }
}
class K16
{
    public function __construct(J16 $j, I16 $i, H16 $h)
    {
    }
}
class L16
{
    public function __construct(K16 $k)
    {
    }
}
class M16
{
    public function __construct(L16 $l, K16 $k)
    {
    }
}
class N16
{
    public function __construct(M16 $m, L16 $l, K16 $k)
    {
    }
}
class O16
{
    public function __construct(N16 $n, M16 $m)
    {
    }
}
class P16
{
    public function __construct(O16 $o, N16 $n, M16 $m)
    {
    }
}
