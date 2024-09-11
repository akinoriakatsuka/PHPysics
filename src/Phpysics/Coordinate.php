<?php

namespace Phpysics;

class Coordinate implements Vector
{
    private float $x;
    private float $y;
    private float $z;

    public function __construct(float $x, float $y, float $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function add(Coordinate $c): Coordinate
    {
        return new Coordinate($this->x + $c->x, $this->y + $c->y, $this->z + $c->z);
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    public function getZ(): float
    {
        return $this->z;
    }
}
