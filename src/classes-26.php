<?php

class A26 {}
class B26 { public function __construct(A26 $a) {} }
class C26 { public function __construct(B26 $b) {} }
class D26 { public function __construct(C26 $c, B26 $b, A26 $a) {} }
class E26 { public function __construct(D26 $d, C26 $c) {} }
class F26 { public function __construct(E26 $e, D26 $d, B26 $b) {} }
class G26 { public function __construct(F26 $f) {} }
class H26 { public function __construct(G26 $g, F26 $f) {} }
class I26 { public function __construct(H26 $h, G26 $g, F26 $f) {} }
class J26 { public function __construct(I26 $i, H26 $h, G26 $g, F26 $f) {} }
class K26 { public function __construct(J26 $j, I26 $i, H26 $h, G26 $g, F26 $f) {} }
class L26 { public function __construct(K26 $k, J26 $j, I26 $i, H26 $h, G26 $g) {} }
class M26 { public function __construct(L26 $l, K26 $k, J26 $j, I26 $i, H26 $h) {} }
class N26 { public function __construct(M26 $m, L26 $l) {} }
class O26 { public function __construct(N26 $n, M26 $m, L26 $l) {} }
class P26 { public function __construct(O26 $o, N26 $n, M26 $m, L26 $l) {} }
class Q26 { public function __construct(P26 $p, O26 $o, N26 $n, M26 $m, L26 $l) {} }
class R26 { public function __construct(Q26 $q, P26 $p) {} }
class S26 { public function __construct(R26 $r, Q26 $q, P26 $p) {} }
class T26 { public function __construct(S26 $s, R26 $r, Q26 $q, P26 $p) {} }
class U26 { public function __construct(T26 $t, S26 $s, R26 $r, Q26 $q, P26 $p) {} }
class V26 { public function __construct(U26 $u) {} }
class W26 { public function __construct(V26 $v, U26 $u) {} }
class X26 { public function __construct(W26 $w, V26 $v, U26 $u) {} }
class Y26 { public function __construct(X26 $x, W26 $w, V26 $v, U26 $u) {} }
class Z26 { public function __construct(Y26 $y, X26 $x, W26 $w, V26 $v, U26 $u) {} }
