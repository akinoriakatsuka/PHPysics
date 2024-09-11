<?php

namespace Phpysics;

class Force implements Vector
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

    /**
     * 質量と時間を受け取り、速度変化を計算する
     */
    public function toVelocity(int $mass, int $time): Velocity
    {
        return new Velocity($this->x / $mass * $time, $this->y / $mass * $time, $this->z / $mass * $time);
    }

    public function add(Force $f): Force
    {
        return new Force($this->x + $f->x, $this->y + $f->y, $this->z + $f->z);
    }
}
