<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Phpysics\Coordinate;
use Phpysics\Force;
use Phpysics\Particle;
use Phpysics\Velocity;

class SystemTest extends TestCase
{
    public function testMove()
    {
        $particle = new Particle(
            mass: 1.0,
            position: new Coordinate(0, 0, 0),
            velocity: new Velocity(0, 0, 0)
        );

        $particle->force = new Force(1, 1, 1);

        $particle->move(1);

        $this->assertSame(1.0, $particle->position->getX());
        $this->assertSame(1.0, $particle->position->getY());
        $this->assertSame(1.0, $particle->position->getZ());
    }
}