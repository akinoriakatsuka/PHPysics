<?php
require __DIR__ . '/vendor/autoload.php';

use Phpysics\Particle;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\System;

use Io\FileOutput;

$cell = [];

$config = require __DIR__ . '/config.php';

foreach ($config['particles'] as $p) {
    $coordinate = new Coordinate($p['x'], $p['y'], $p['z']);
    $velocity = new Velocity($p['vx'], $p['vy'], $p['vz']);
    $molecule = new Particle($p['mass'], $coordinate, $velocity);
    $cell[] = $molecule;
}

$system = new System($cell, $config['constants'], $config['boundary']);

$file = 'data.json';
file_put_contents($file, '');

$steps = $config['steps'] ?? 100;
$interval = $config['interval'] ?? 1;
$system->calculate($steps, new FileOutput($file), $interval);
