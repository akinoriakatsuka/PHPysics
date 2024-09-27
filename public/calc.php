<?php
require __DIR__ . '/../vendor/autoload.php';

use Phpysics\Particle;
use Phpysics\FixedPoint;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\System;

use IO\ConsoleOutput;

// バリデーション
if (!isset($_REQUEST['config']) || empty($_REQUEST['config'])) {
    http_response_code(400);
    echo json_encode(['error' => 'config is required']);
    exit;
}
$result = json_decode(base64_decode($_REQUEST['config']), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    echo json_encode(['error' => 'config is invalid']);
    exit;
}
// stepが10000を超える場合はエラー
if (isset($result['steps']) && $result['steps'] > 10000) {
    http_response_code(400);
    echo json_encode(['error' => 'steps is too large']);
    exit;
}
// particleとfixed_pointsの合計が5を超える場合はエラー
if (count($result['particles']) + count($result['fixed_points']) > 5) {
    http_response_code(400);
    echo json_encode(['error' => 'bodies are too many']);
    exit;
}

$config = json_decode(base64_decode($_REQUEST['config']), true);
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
try {
    $system->calculate($steps, new ConsoleOutput(), $interval);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'calculation failed']);
    exit;
}
