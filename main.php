<?php
require __DIR__ . '/vendor/autoload.php';

use Phpysics\Particle;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\System;

use Io\FileOutput;

$cell = [];

$config_file = $argv[1] ?? 'configs/config.php';

$config = require __DIR__ . '/' . $config_file;

foreach ($config['particles'] as $p) {
    $coordinate = new Coordinate($p['x'], $p['y'], $p['z']);
    $velocity = new Velocity($p['vx'], $p['vy'], $p['vz']);
    $particle = new Particle($p['mass'], $coordinate, $velocity);
    $particles[] = $particle;
}

$system = new System($particles, $config['constants'], $config['boundary']);

$file = 'data.json';
file_put_contents($file, '');

$steps = $config['steps'] ?? 100;
$interval = $config['interval'] ?? 1;
$system->calculate($steps, new FileOutput($file), $interval);
