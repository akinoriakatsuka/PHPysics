<?php

namespace Phpysics;

use Phpysics\Body;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\Force;

class FixedPoint implements Body
{
    public float $mass;
    public Coordinate $position;
    public Velocity $velocity;
    public Force $force;

    public function __construct(float $mass, Coordinate $position, Velocity $velocity)
    {
        $this->mass = $mass;
        $this->position = $position;
        $this->velocity = $velocity;
        $this->force = new Force(0, 0, 0);
    }

    public function move(int $time): void
    {
        $this->velocity = new Velocity(0, 0, 0);

        $this->position = $this->position->add(
            $this->velocity->toDistance(time: $time)
        );
    }

}
