<?php
require __DIR__ . '/src/Molecule.php';

use Phpysics\Molecule;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\Force;

$cell = [];

$coordinate = new Coordinate(1, 0, 0);
$velocity = new Velocity(0, 0, 0);
$force = new Force(0, 0, 0);

$molecule = new Molecule(100, $coordinate, $velocity, $force);

$cell[] = $molecule;

$t = 0;

echo 't,x,y,z' . PHP_EOL;

while ($t < pow(10, 2)) {
    $molecule = &$cell[0];

    $molecule->force->x = -1 * $molecule->position->x;
    $molecule->force->y = -1 * $molecule->position->y;
    $molecule->force->z = -1 * $molecule->position->z;

    $molecule->velocity->x += $molecule->force->x / $molecule->mass;
    $molecule->velocity->y += $molecule->force->y / $molecule->mass;
    $molecule->velocity->z += $molecule->force->z / $molecule->mass;

    $molecule->position->x += $molecule->velocity->x;
    $molecule->position->y += $molecule->velocity->y;
    $molecule->position->z += $molecule->velocity->z;
    if ($t % 1 == 0) {
        $arr = [
            $t,
            sprintf("%01.8f", $molecule->position->x),
            sprintf("%01.8f", $molecule->position->y),
            sprintf("%01.8f", $molecule->position->z),
        ];
        echo implode(',', $arr) . "\n";
    }

    $t++;
}
