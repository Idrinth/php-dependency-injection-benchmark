<?php

class A06 {}
class B06 { public function __construct(A06 $a) {} }
class C06 { public function __construct(B06 $b) {} }
class D06 { public function __construct(C06 $c, B06 $b, A06 $a) {} }
class E06 { public function __construct(D06 $d, C06 $c, B06 $b) {} }
class F06 { public function __construct(E06 $e, D06 $d, B06 $b) {} }
