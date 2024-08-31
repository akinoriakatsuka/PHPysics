<?php

namespace Phpysics;

class Particle
{
    public $mass;
    public $position;
    public $velocity;
    public $force;

    public function __construct($mass, $position, $velocity, $force)
    {
        $this->mass = $mass;
        $this->position = $position;
        $this->velocity = $velocity;
        $this->force = $force;
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



