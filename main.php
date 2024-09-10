<?php
require __DIR__ . '/vendor/autoload.php';

use Phpysics\Particle;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\System;

use Io\FileOutput;

$cell = [];

$config = [
    'particles' => [
        ['mass' => 100, 'x' => 100, 'y' => 0, 'z' => 0, 'vx' => 0, 'vy' => -1, 'vz' => 0],
        ['mass' => 100, 'x' => -100, 'y' => 0, 'z' => 0, 'vx' => 0, 'vy' => 1, 'vz' => 0],
    ],
    'constants' => [
        'gravitational_constant' => 1,
        'reflection_coefficient' => 1,
    ],
    'boundary' => [
        'x' => [-1000, 1000],
        'y' => [-1000, 1000],
        'z' => [-1000, 1000],
    ],
];

foreach ($config['particles'] as $p) {
    $coordinate = new Coordinate($p['x'], $p['y'], $p['z']);
    $velocity = new Velocity($p['vx'], $p['vy'], $p['vz']);
    $molecule = new Particle($p['mass'], $coordinate, $velocity);
    $cell[] = $molecule;
}

$system = new System($cell, $config['constants'], $config['boundary']);

$file = 'data.json';
file_put_contents($file, '');

$steps = 10000;
$interval = 20;
$system->calculate($steps, new FileOutput($file), $interval);
