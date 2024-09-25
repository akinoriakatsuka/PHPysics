<?php
require __DIR__ . '/../vendor/autoload.php';

use Phpysics\Particle;
use Phpysics\FixedPoint;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\System;

use IO\ConsoleOutput;

// $config_file = '../configs/pendulum.php';
// $config = require __DIR__ . '/' . $config_file;

if($_REQUEST['config']) {
    $config = json_decode(base64_decode($_REQUEST['config']), true);
}

$particles = [];
foreach ($config['particles'] as $p) {
    $coordinate = new Coordinate($p['x'], $p['y'], $p['z']);
    $velocity = new Velocity($p['vx'], $p['vy'], $p['vz']);
    $particle = new Particle($p['mass'], $coordinate, $velocity);
    $particles[] = $particle;
}

if (isset($config['fixed_points'])) {
    foreach ($config['fixed_points'] as $f) {
        $coordinate = new Coordinate($f['x'], $f['y'], $f['z']);
        $fixed_point = new FixedPoint($f['mass'], $coordinate);
        $particles[] = $fixed_point;
    }
}

$system = new System($particles, $config['constants'], $config['boundary']);

$steps = $config['steps'] ?? 100;
$interval = $config['interval'] ?? 1;

header('Content-Type: application/json');
$system->calculate($steps, new ConsoleOutput(), $interval);
