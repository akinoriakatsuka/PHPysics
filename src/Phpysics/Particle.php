<?php

namespace Phpysics;

use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\Force;

class Particle
{
    public $mass;
    public Coordinate $position;
    public Velocity $velocity;
    public Force $force;

    public function __construct($mass, Coordinate $position, Velocity $velocity)
    {
        $this->mass = $mass;
        $this->position = $position;
        $this->velocity = $velocity;
        $this->force = new Force(0, 0, 0);
    }

    public function kineticEnergy()
    {
        return 0.5 * $this->mass * (pow($this->velocity->x, 2) + pow($this->velocity->y, 2) + pow($this->velocity->z, 2));
    }

    public function potentialEnergy()
    {
        return 0.5 * (pow($this->position->x, 2) + pow($this->position->y, 2) + pow($this->position->z, 2));
    }

    public function totalEnergy()
    {
        return $this->kineticEnergy() + $this->potentialEnergy();
    }

    public function momentum()
    {
        return $this->mass * sqrt(pow($this->velocity->x, 2) + pow($this->velocity->y, 2) + pow($this->velocity->z, 2));
    }
}
