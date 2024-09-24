<?php

namespace Phpysics;

use Phpysics\Body;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\Force;

class FixedPoint extends Body
{
    public float $mass;
    public Coordinate $position;
    public Velocity $velocity;
    public Force $force;

    public function __construct(float $mass, Coordinate $position)
    {
        $this->mass = $mass;
        $this->position = $position;
        $this->velocity = new Velocity(0, 0, 0);
        $this->force = new Force(0, 0, 0);
    }

    public function move(int $time): void
    {
        // do nothing
    }

}
