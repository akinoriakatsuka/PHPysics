<?php

$cell = [];

$molecule = [0, 0, 0]; // x, y, z

$cell[] = $molecule;
$v = [0, 0, 0]; // velocity
$f = [1, 0, 0]; // force
$t = 0; // time

while (true) {
    usleep(100 * 1000);
    $molecule = &$cell[0];
    $molecule[0] += $v[0];
    $molecule[1] += $v[1];
    $molecule[2] += $v[2];

    $v[0] += $f[0] / 1;
    $v[1] += $f[1] / 1;
    $v[2] += $f[2] / 1;

    $t++;
    echo "Time: $t\n";
    echo "Position: " . implode(", ", $cell[0]) . "\n";
}
