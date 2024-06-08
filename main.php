<?php
require __DIR__ . '/src/Molecule.php';

use Phpysics\Molecule;
use Phpysics\Coordinate;
use Phpysics\Velocity;
use Phpysics\Force;

$cell = [];

$coordinate = new Coordinate(0, 0, 0);
$velocity = new Velocity(0, 0, 0);
$force = new Force(1, 0, 0);

$molecule = new Molecule(1, $coordinate, $velocity, $force);

$cell[] = $molecule;

$t = 0;

while ($t < pow(10, 5)) {
    $molecule = &$cell[0];
    $molecule->position->x += $molecule->velocity->x;
    $molecule->position->y += $molecule->velocity->y;
    $molecule->position->z += $molecule->velocity->z;

    $molecule->velocity->x += $molecule->force->x / $molecule->mass;
    $molecule->velocity->y += $molecule->force->y / $molecule->mass;
    $molecule->velocity->z += $molecule->force->z / $molecule->mass;

    if($t % 10000 == 0) {
        printInfo($t, $cell);
    }
    $t++;
}

printInfo($t, $cell);

function printInfo($t, $cell)
{
    echo "Time: $t\n";
    echo "Position: " . implode(', ', [$cell[0]->position->x, $cell[0]->position->y, $cell[0]->position->z]) . "\n";
    echo "Velocity: " . implode(', ', [$cell[0]->velocity->x, $cell[0]->velocity->y, $cell[0]->velocity->z]) . "\n";
    echo "Force: " . implode(', ', [$cell[0]->force->x, $cell[0]->force->y, $cell[0]->force->z]) . "\n";
    echo "Kinetic Energy: " . $cell[0]->kineticEnergy() . "\n";
    echo "Momentum: " . $cell[0]->momentum() . "\n";
    echo "\n";
}
