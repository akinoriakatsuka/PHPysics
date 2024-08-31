<?php

namespace Phpysics;

class Molecule
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

class Coordinate implements Vector
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
}

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
}

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
}

interface Vector
{
    public function __construct($x, $y, $z);
}
