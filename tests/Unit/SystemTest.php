<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Phpysics\System;
use Phpysics\Particle;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\Force;
use Phpysics\OutputInterface;

class SystemTest extends TestCase
{
    public function testCalculate(): void
    {
        $particles = [
            new Particle(
                mass: 1.0,
                position: new Coordinate(0, 0, 0),
                velocity: new Velocity(0, 0, 0)
            ),
            new Particle(
                mass: 1.0,
                position: new Coordinate(1, 1, 1),
                velocity: new Velocity(0, 0, 0)
            )
        ];

        $constants = [
            'gravitational_constant' => 0.0,
            'reflection_coefficient' => 1.0,
            'gravitational_acceleration' => 0.0,
        ];

        $output_mock = $this->createMock(OutputInterface::class);
        $output_mock->method('write');

        $system = new System(
            cell: $particles,
            constants: $constants,
            boundary: [],
        );

        $system->calculate(1, $output_mock);

        $this->assertSame(0.0, $particles[0]->position->getX());
        $this->assertSame(0.0, $particles[0]->position->getY());
        $this->assertSame(0.0, $particles[0]->position->getY());

        $this->assertSame(1.0, $particles[1]->position->getX());
        $this->assertSame(1.0, $particles[1]->position->getY());
        $this->assertSame(1.0, $particles[1]->position->getY());
    }

}