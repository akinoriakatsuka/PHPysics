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
    // 'particles' => [
    //     ['mass' => 100, 'x' => 100, 'y' => 0, 'z' => 0, 'vx' => 1, 'vy' => 1, 'vz' => 0],
    //     ['mass' => 100, 'x' => 0, 'y' => 100, 'z' => 0, 'vx' => 0, 'vy' => -1, 'vz' => -1],
    //     ['mass' => 100, 'x' => 0, 'y' => 0, 'z' => 100, 'vx' => -1, 'vy' => 0, 'vz' => 1],
    // ],
];

foreach ($config['particles'] as $p) {
    $coordinate = new Coordinate($p['x'], $p['y'], $p['z']);
    $velocity = new Velocity($p['vx'], $p['vy'], $p['vz']);
    $molecule = new Particle($p['mass'], $coordinate, $velocity);
    $cell[] = $molecule;
}

$system = new System($cell);

$file = 'data.json';
file_put_contents($file, '');

$steps = 10000;
$interval = 20;
$system->calculate($steps, new FileOutput($file), $interval);
