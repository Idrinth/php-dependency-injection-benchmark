<?php

declare(strict_types=1);

class AdapterImplementation
{
    private array $cache = [];

    public function get(string $class): object
    {
        if (!isset($this->cache[$class])) {
            $this->cache[$class] = match ($class) {
                F06::class => $this->createF06(),
                P16::class => $this->createP16(),
                Z26::class => $this->createZ26(),
                default => throw new InvalidArgumentException("Unknown class {$class}"),
            };
        }

        return $this->cache[$class];
    }

    private function createF06(): F06
    {
        $a = new A06();
        $b = new B06($a);
        $c = new C06($b);
        $d = new D06($c, $b, $a);
        $e = new E06($d, $c, $b);
        return new F06($e, $d, $b);
    }

    private function createP16(): P16
    {
        $a = new A16();
        $b = new B16($a);
        $c = new C16($b);
        $d = new D16($c, $b, $a);
        $e = new E16($d, $c);
        $f = new F16($e, $d, $b);
        $g = new G16($f);
        $h = new H16($g, $f);
        $i = new I16($h, $g, $f);
        $j = new J16($i, $h);
        $k = new K16($j, $i, $h);
        $l = new L16($k);
        $m = new M16($l, $k);
        $n = new N16($m, $l, $k);
        $o = new O16($n, $m);
        return new P16($o, $n, $m);
    }

    private function createZ26(): Z26
    {
        $a = new A26();
        $b = new B26($a);
        $c = new C26($b);
        $d = new D26($c, $b, $a);
        $e = new E26($d, $c);
        $f = new F26($e, $d, $b);
        $g = new G26($f);
        $h = new H26($g, $f);
        $i = new I26($h, $g, $f);
        $j = new J26($i, $h, $g, $f);
        $k = new K26($j, $i, $h, $g, $f);
        $l = new L26($k, $j, $i, $h, $g);
        $m = new M26($l, $k, $j, $i, $h);
        $n = new N26($m, $l);
        $o = new O26($n, $m, $l);
        $p = new P26($o, $n, $m, $l);
        $q = new Q26($p, $o, $n, $m, $l);
        $r = new R26($q, $p);
        $s = new S26($r, $q, $p);
        $t = new T26($s, $r, $q, $p);
        $u = new U26($t, $s, $r, $q, $p);
        $v = new V26($u);
        $w = new W26($v, $u);
        $x = new X26($w, $v, $u);
        $y = new Y26($x, $w, $v, $u);
        return new Z26($y, $x, $w, $v, $u);
    }
}
