<?php
require __DIR__ . '/vendor/autoload.php';

use Phpysics\Particle;
use Phpysics\FixedPoint;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\System;

use IO\FileOutput;

$cell = [];

$config_file = $argv[1] ?? 'configs/config.php';

$config = require __DIR__ . '/' . $config_file;

$particles = [];
foreach ($config['particles'] as $p) {
    $coordinate = new Coordinate($p['x'], $p['y'], $p['z']);
    $velocity = new Velocity($p['vx'], $p['vy'], $p['vz']);
    $particle = new Particle($p['mass'], $coordinate, $velocity);
    $particles[] = $particle;
}

$fixed_points = [];
if (isset($config['fixed_points'])) {
    foreach ($config['fixed_points'] as $f) {
        $coordinate = new Coordinate($f['x'], $f['y'], $f['z']);
        $fixed_point = new FixedPoint($f['mass'], $coordinate);
        $particles[] = $fixed_point;
    }
}

$system = new System($particles, $config['constants'], $config['boundary']);

$output_file = 'data.json';
file_put_contents($output_file, '');

$steps = $config['steps'] ?? 100;
$interval = $config['interval'] ?? 1;
$system->calculate($steps, new FileOutput($output_file), $interval);
