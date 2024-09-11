<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Phpysics\Coordinate;

class CoordinateTest extends TestCase
{
    public function testAdd()
    {
        $c1 = new Coordinate(1, 2, 3);
        $c2 = new Coordinate(4, 5, 6);

        $c3 = $c1->add($c2);

        $this->assertSame(5.0, $c3->getX());
        $this->assertSame(7.0, $c3->getY());
        $this->assertSame(9.0, $c3->getZ());
    }
}