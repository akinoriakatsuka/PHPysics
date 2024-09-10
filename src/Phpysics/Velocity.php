<?php

namespace Phpysics;

class Velocity implements Vector
{
    public $x;
    public $y;
    public $z;

    public function __construct($x, $y, $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public function add(Velocity $v): Velocity
    {
        return new Velocity($this->x + $v->x, $this->y + $v->y, $this->z + $v->z);
    }
}
