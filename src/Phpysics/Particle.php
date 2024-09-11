<?php

namespace Phpysics;

use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\Force;

class Particle
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
        $this->velocity = $this->velocity->add(
            $this->force->toVelocity(mass: $this->mass, time: $time)
        );

        $this->position = $this->position->add(
            $this->velocity->toDistance(time: $time)
        );
    }

}
