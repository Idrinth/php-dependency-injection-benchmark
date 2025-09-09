<?php

interface AIn26 {}
class AIm26 implements AIn26 {}

interface BIn26 {}
class BIm26 implements BIn26 { public function __construct(AIn26 $a) {} }

interface CIn26 {}
class CIm26 implements CIn26 { public function __construct(BIn26 $b) {} }

interface DIn26 {}
class DIm26 implements DIn26 { public function __construct(CIn26 $c, BIn26 $b, AIn26 $a) {} }

interface EIn26 {}
class EIm26 implements EIn26 { public function __construct(DIn26 $d, CIn26 $c) {} }

interface FIn26 {}
class FIm26 implements FIn26 { public function __construct(EIn26 $e, DIn26 $d, BIn26 $b) {} }

interface GIn26 {}
class GIm26 implements GIn26 { public function __construct(FIn26 $f) {} }

interface HIn26 {}
class HIm26 implements HIn26 { public function __construct(GIn26 $g, FIn26 $f) {} }

interface IIn26 {}
class IIm26 implements IIn26 { public function __construct(HIn26 $h, GIn26 $g, FIn26 $f) {} }

interface JIn26 {}
class JIm26 implements JIn26 { public function __construct(IIn26 $i, HIn26 $h, GIn26 $g, FIn26 $f) {} }

interface KIn26 {}
class KIm26 implements KIn26 { public function __construct(JIn26 $j, IIn26 $i, HIn26 $h, GIn26 $g, FIn26 $f) {} }

interface LIn26 {}
class LIm26 implements LIn26 { public function __construct(KIn26 $k, JIn26 $j, IIn26 $i, HIn26 $h, GIn26 $g) {} }

interface MIn26 {}
class MIm26 implements MIn26 { public function __construct(LIn26 $l, KIn26 $k, JIn26 $j, IIn26 $i, HIn26 $h) {} }

interface NIn26 {}
class NIm26 implements NIn26 { public function __construct(MIn26 $m, LIn26 $l) {} }

interface OIn26 {}
class OIm26 implements OIn26 { public function __construct(NIn26 $n, MIn26 $m, LIn26 $l) {} }

interface PIn26 {}
class PIm26 implements PIn26 { public function __construct(OIn26 $o, NIn26 $n, MIn26 $m, LIn26 $l) {} }

interface QIn26 {}
class QIm26 implements QIn26 { public function __construct(PIn26 $p, OIn26 $o, NIn26 $n, MIn26 $m, LIn26 $l) {} }

interface RIn26 {}
class RIm26 implements RIn26 { public function __construct(QIn26 $q, PIn26 $p) {} }

interface SIn26 {}
class SIm26 implements SIn26 { public function __construct(RIn26 $r, QIn26 $q, PIn26 $p) {} }

interface TIn26 {}
class TIm26 implements TIn26 { public function __construct(SIn26 $s, RIn26 $r, QIn26 $q, PIn26 $p) {} }

interface UIn26 {}
class UIm26 implements UIn26 { public function __construct(TIn26 $t, SIn26 $s, RIn26 $r, QIn26 $q, PIn26 $p) {} }

interface VIn26 {}
class VIm26 implements VIn26 { public function __construct(UIn26 $u) {} }

interface WIn26 {}
class WIm26 implements WIn26 { public function __construct(VIn26 $v, UIn26 $u) {} }

interface XIn26 {}
class XIm26 implements XIn26 { public function __construct(WIn26 $w, VIn26 $v, UIn26 $u) {} }

interface YIn26 {}
class YIm26 implements YIn26 { public function __construct(XIn26 $x, WIn26 $w, VIn26 $v, UIn26 $u) {} }

interface ZIn26 {}
class ZIm26 implements ZIn26 { public function __construct(YIn26 $y, XIn26 $x, WIn26 $w, VIn26 $v, UIn26 $u) {} }

