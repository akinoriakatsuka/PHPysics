<?php
require __DIR__ . '/vendor/autoload.php';

use Phpysics\Particle;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\Force;
use Phpysics\System;

use Io\FileOutput;

$cell = [];

$coordinate = new Coordinate(1, 0, 0);
$velocity = new Velocity(0, 0, 1);
$force = new Force(0, 0, 0);

$molecule = new Particle(100, $coordinate, $velocity, $force);

$cell[] = $molecule;

$system = new System($cell);

$file = 'data.csv';
file_put_contents($file,'');
$system->calculate(100, new FileOutput($file));
