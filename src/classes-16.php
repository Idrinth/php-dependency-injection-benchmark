<?php

class A16 {}
class B16 { public function __construct(A16 $a) {} }
class C16 { public function __construct(B16 $b) {} }
class D16 { public function __construct(C16 $c, B16 $b, A16 $a) {} }
class E16 { public function __construct(D16 $d, C16 $c) {} }
class F16 { public function __construct(E16 $e, D16 $d, B16 $b) {} }
class G16 { public function __construct(F16 $f) {} }
class H16 { public function __construct(G16 $g, F16 $f) {} }
class I16 { public function __construct(H16 $h, G16 $g, F16 $f) {} }
class J16 { public function __construct(I16 $i, H16 $h, G16 $g, F16 $f) {} }
class K16 { public function __construct(J16 $j, I16 $i, H16 $h, G16 $g, F16 $f) {} }
class L16 { public function __construct(K16 $k, J16 $j, I16 $i, H16 $h, G16 $g) {} }
class M16 { public function __construct(L16 $l, K16 $k, J16 $j, I16 $i, H16 $h) {} }
class N16 { public function __construct(M16 $m, L16 $l) {} }
class O16 { public function __construct(N16 $n, M16 $m, L16 $l) {} }
class P16 { public function __construct(O16 $o, N16 $n, M16 $m, L16 $l) {} }
class Q16 { public function __construct(P16 $p, O16 $o, N16 $n, M16 $m, L16 $l) {} }
class R16 { public function __construct(Q16 $q, P16 $p) {} }
class S16 { public function __construct(R16 $r, Q16 $q, P16 $p) {} }
class T16 { public function __construct(S16 $s, R16 $r, Q16 $q, P16 $p) {} }
class U16 { public function __construct(T16 $t, S16 $s, R16 $r, Q16 $q, P16 $p) {} }
class V16 { public function __construct(U16 $u) {} }
class W16 { public function __construct(V16 $v, U16 $u) {} }
class X16 { public function __construct(W16 $w, V16 $v, U16 $u) {} }
class Y16 { public function __construct(X16 $x, W16 $w, V16 $v, U16 $u) {} }
class Z16 { public function __construct(Y16 $y, X16 $x, W16 $w, V16 $v, U16 $u) {} }
