<?php

namespace Phpysics;

use Phpysics\Coordinate;

class Velocity implements Vector
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

    public function add(Velocity $v): Velocity
    {
        return new Velocity($this->x + $v->x, $this->y + $v->y, $this->z + $v->z);
    }

    /**
     * 速度から変位を計算する
     *
     * @param  int $time 時間
     * @return Coordinate 変位
     */
    public function toDistance(int $time): Coordinate
    {
        return new Coordinate($this->x * $time, $this->y * $time, $this->z * $time);
    }
}
