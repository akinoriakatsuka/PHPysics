<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Phpysics\System;
use Phpysics\Particle;
use Phpysics\FixedPoint;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\OutputInterface;

class SystemTest extends TestCase
{
    /**
     * @param Particle[] $particles
     * @param float[] $constants
     * @param float[] $expected
     */
    #[DataProvider('configDataProvider')]
    public function testCalculate($particles, $constants, $expected): void
    {
        $output_mock = $this->createMock(OutputInterface::class);
        $output_mock->method('write');

        $system = new System(
            cell: $particles,
            constants: $constants,
            boundary: [],
        );

        $system->calculate(1, $output_mock);

        $this->assertSame($expected[0], $particles[0]->position->getX());
        $this->assertSame($expected[1], $particles[0]->position->getY());
        $this->assertSame($expected[2], $particles[0]->position->getZ());

        $this->assertSame($expected[3], $particles[1]->position->getX());
        $this->assertSame($expected[4], $particles[1]->position->getY());
        $this->assertSame($expected[5], $particles[1]->position->getZ());
    }

    public static function configDataProvider(): array
    {
        return [
            'test1' => [
                [
                    new Particle(
                        mass: 1.0,
                        position: new Coordinate(0, 0, 0),
                        velocity: new Velocity(0, 0, 0)
                    ),
                    new Particle(
                        mass: 1.0,
                        position: new Coordinate(1, 0, 0),
                        velocity: new Velocity(0, 0, 0)
                    )
                ],
                [
                    'gravitational_constant' => 0.1,
                    'reflection_coefficient' => 1.0,
                    'gravitational_acceleration' => 0.0,
                ],
                [0.1, 0.0, 0.0, 0.9, 0.0, 0.0],
            ],
            'test2' => [
                [
                    new Particle(
                        mass: 1.0,
                        position: new Coordinate(0, 0, 0),
                        velocity: new Velocity(0, 0, 0)
                    ),
                    new Particle(
                        mass: 1.0,
                        position: new Coordinate(1, 0, 0),
                        velocity: new Velocity(0, 0, 0)
                    )
                ],
                [
                    'gravitational_constant' => 0.0,
                    'reflection_coefficient' => 1.0,
                    'gravitational_acceleration' => 9.8,
                ],
                [0.0, 0.0, -9.8, 1.0, 0.0, -9.8],
            ],
            'test3' => [
                [
                    new Particle(
                        mass: 1.0,
                        position: new Coordinate(0, 0, 0),
                        velocity: new Velocity(0, 0, 0)
                    ),
                    new FixedPoint(
                        mass: 1.0,
                        position: new Coordinate(1, 0, 0),
                        velocity: new Velocity(0, 0, 0)
                    )
                ],
                [
                    'gravitational_constant' => 0.0,
                    'reflection_coefficient' => 1.0,
                    'gravitational_acceleration' => 9.8,
                ],
                [0.0, 0.0, -9.8, 1.0, 0.0, 0.0],
            ],
        ];
    }
}
